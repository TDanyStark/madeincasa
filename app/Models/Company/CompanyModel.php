<?php

namespace App\Models\Company;

use CodeIgniter\Model;

class CompanyModel extends Model
{

    protected $table = 'company';
    protected $primaryKey = 'Comp_id';
    protected $allowedFields = [
    'Comp_id', 
    'Comp_name', 
    'Comp_identification', 
    'Comp_email', 
    'Comp_id', 
    'Comp_phone', 
    'DocType_id', 
    'Stat_id'];
    protected $updatedField = 'updated_at';
}