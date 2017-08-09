<?php

namespace FSS\Models;

use \Illuminate\Database\Eloquent\Model;

class CommonModel extends Model
{
    protected $hidden = ['created_at', 'updated_at', 'updated_by'];

    public function validateColumn($theTable, $column, $container) {
        $columns = null;
        if (($cacheValue = $container['cache']->get($theTable)) != false) {
            $container['logger']->debug("Retrieved $theTable column listing from cache.");
            $columns = $cacheValue;
        } else {
            $columns = $container['db']::getSchemaBuilder()->getColumnListing($theTable);
            $container['logger']->debug("Retrieved $theTable column listing from database: ", $container['db']::getQueryLog());
            $container['cache']->set($theTable, $columns);
        }
        if(!in_array($column, $columns)) {
            throw new \Exception("$column is not a valid column option.");
        }
    }

}