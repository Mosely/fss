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
class Table extends AbstractModel
{

    // The primary key
    //protected $primaryKey = "Tables_in_fss";
    protected $primaryKey = "id";

    // The table for this model
    protected $table = "Table";
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['Tables_in_fss'];
    
}
