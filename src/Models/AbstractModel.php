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

    // Column validation exceptions, i.e.: grant_type
    protected $columnValidationBypass = [
        'grant_type',
        'client_id',
        'client_secret',
        'scope'
    ];
    /**
     * This will verify that the specified column
     * is indeed a column for the specified table.
     *
     * @param string $column
     * @param Logger $logger
     * @param Cache $cache
     * @param Manager $db
     * @throws Exception
     */
    public function validateColumn(
        string $column, 
        Logger $logger = null, 
        Cache $cache = null,
        Manager $db = null)
    {
        $columns = null;
        $theTable = static::getTableName();
        
        if (!is_null($cache) && ($cacheValue = $cache->get($theTable)) != false) {
            if(!is_null($logger)) {
                $logger->debug("Retrieved $theTable column listing from cache.");
            }
            $columns = $cacheValue;
        } else {
            if(!is_null($db)) {
                $columns = $db::getSchemaBuilder()->getColumnListing($theTable);
            }
            if(!is_null($logger)) {
                $logger->debug("Retrieved $theTable column listing from database: ",
                    $db::getQueryLog());
            }
            if (!is_null($cache)) {
                $cache->set($theTable, $columns);
            }
        }
        if (!is_null($db) && 
            !in_array($column, $columns) && 
            !in_array($column, static::$columnValidationBypass)) {
            throw new Exception("$column is not a valid column option.");
        }
    }

    /**
     * While trying to keep in line with the static
     * approach as implemented by Eloquent, here's
     * a static method called through any Model
     * in order to retrieve its table name.
     *
     * That should cut down on any typos.
     *
     * @return string
     */
    public static function getTableName(): string
    {
        return with(new static())->getTable();
    }
}
