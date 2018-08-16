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
class tablecolumn extends AbstractModel
{

    // The primary key
    protected $primaryKey = "TABLE_COLUMN";

    // The table for this model
    protected $table = "tablecolumn";
}
