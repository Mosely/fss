<?php
namespace FSS\Models;

class Report_column extends AbstractModel {
    protected $table = "report_column";
    
    protected $primaryKey = "id";
    
    protected $fillable = array('report_id','header','table_name','column_name','column_order','width');
    
}
