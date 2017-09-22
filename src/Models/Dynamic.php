<?php
namespace FSS\Models;

/*
 * This model will be used to represent 
 * any particular table at runtime. This
 * functionality is the report generator.
 */
class Dynamic extends AbstractModel
{
    // This model will have its $table set at runtime.
    // All tables use "id" for the primary key, so
    // might as well set that here.
    protected $primaryKey = "id";
    
}