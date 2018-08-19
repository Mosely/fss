<?php
namespace FSS\Models;


/**
 * The "tablecolumn" model.
 *
 * @author Dewayne
 *        
 *         @SWG\Model(
 *         id="tablecolumn",
 *         @SWG\Property(name="TABLE_COLUMN", type="string", required=true)
 *         )
 */
class TableColumn extends AbstractModel
{

    // The primary key
    protected $primaryKey = "id";

    // The table for this model
    protected $table = "TableColumn";
    
    protected $fillable = ["table_column"];
}
