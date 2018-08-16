<?php
namespace FSS\Models;


/**
 * The "table" model.
 *
 * @author Dewayne
 *        
 *         @SWG\Model(
 *         id="table",
 *         @SWG\Property(name="Tables_in_fss", type="string", required=true)
 *         )
 */
class table extends AbstractModel
{

    // The primary key
    protected $primaryKey = "Tables_in_fss";

    // The table for this model
    protected $table = "Table";
}
