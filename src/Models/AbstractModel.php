<?php
namespace FSS\Models;

use Illuminate\Database\Eloquent\Model;
use Monolog\Logger;
use Illuminate\Database\Capsule\Manager;
use FSS\Utilities\Cache;
use \Exception;

/**
 * The AbstractModel class will hold any
 * common code that all models can use.
 *
 * @author Dewayne
 *        
 */
abstract class AbstractModel extends Model
{

    // There's no need to return these three
    // columns with every request.
    protected $hidden = [
        'created_at',
        'updated_at',
        'updated_by'
    ];

    /**
     * This will verify that the specified column
     * is indeed a column for the specified table.
     * 
     * @param string $theTable
     * @param string $column
     * @param Logger $logger
     * @param Cache $cache
     * @param Manager $db
     * @throws Exception
     */
    public function validateColumn(string $theTable, string $column,
        Logger $logger, Cache $cache, Manager $db)
    {
        $columns = null;
        if (($cacheValue = $cache->get($theTable)) != false) {
            $logger->debug(
                "Retrieved $theTable column listing from cache.");
            $columns = $cacheValue;
        } else {
            $columns = $db::getSchemaBuilder()->getColumnListing(
                $theTable);
            $logger->debug(
                "Retrieved $theTable column listing from database: ",
                $db::getQueryLog());
            $cache->set($theTable, $columns);
        }
        if (! in_array($column, $columns)) {
            throw new Exception("$column is not a valid column option.");
        }
    }
}
