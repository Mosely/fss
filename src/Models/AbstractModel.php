<?php
namespace FSS\Models;

use Interop\Container\ContainerInterface;
use \Illuminate\Database\Eloquent\Model;
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
     * @param ContainerInterface $container
     * @throws Exception
     */
    public function validateColumn(string $theTable, string $column,
        ContainerInterface $container)
    {
        $columns = null;
        if (($cacheValue = $container['cache']->get($theTable)) != false) {
            $container['logger']->debug(
                "Retrieved $theTable column listing from cache.");
            $columns = $cacheValue;
        } else {
            $columns = $container['db']::getSchemaBuilder()->getColumnListing(
                $theTable);
            $container['logger']->debug(
                "Retrieved $theTable column listing from database: ",
                $container['db']::getQueryLog());
            $container['cache']->set($theTable, $columns);
        }
        if (! in_array($column, $columns)) {
            throw new Exception("$column is not a valid column option.");
        }
    }
}
