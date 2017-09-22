<?php
namespace FSS\Models;

class Report extends AbstractModel
{

    protected $table = "report";

    protected $primaryKey = "id";

    protected $fillable = array(
        'name',
        'type',
        'created_at',
        'updated_at',
        'updated_by'
    );
}
