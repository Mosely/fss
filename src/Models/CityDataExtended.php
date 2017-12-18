<?php
namespace FSS\Models;

/**
 * The "city_data_extended" model.
 *
 * @author Dewayne
 *        
 */
class CityDataExtended extends AbstractModel
{

    // The table for this model
    protected $table = "city_data_extended";

    // Fields that can be mass-updated/insterted
    protected $fillable = array(
        'city',
        'state_code',
        'zip',
        'latitude',
        'longitude',
        'county',
        'created_at',
        'updated_at',
        'updated_by'
    );
        public function CityData()
    {
        return $this->belongsTo('FSS\Models\CityData');
    }
}
