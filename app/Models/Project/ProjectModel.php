<?php

namespace App\Models\Project;

use CodeIgniter\Model;

class ProjectModel extends Model{
    protected $table = 'project';
    protected $primaryKey = 'Project_id';
    protected $allowedFields = [
        'Project_id', 
        'Project_code', 
        'Project_name', 
        'Manager_id',
        'Brand_id',
        'Project_purchaseOrder', 
        'Project_ddtStartDate', 
        'Project_ddtEndDate', 
        'Project_startDate', 
        'Project_estimatedEndDate', 
        'Project_activitiEndDate',
        'Project_observation', 
        'Project_percentage',        
        'Project_url',        
        'Client_id', 
        'User_id', 
        'Project_commercial',
        'Stat_id',        
        'Priorities_id', 
        'Project_invoice', 
        'Project_invoiceState', 
        'Project_invoiceDate', 
        'updated_at'
    ];
    protected $updatedField = 'updated_at';

    function sp_select_all_project_table($userId)
    {
        $query = "CALL sp_select_all_project_table(" . $userId .")";
        $result = $this->db->query($query)->getResult();
        return $result;
    }
    
    function sp_select_all_project($projectId)
    {
        $query = "CALL sp_select_all_project($projectId)";
        $result = $this->db->query($query)->getResult();
        return $result;
    }

    function updateCode($id, $code){
        $query = 'UPDATE project SET Project_code = '.$code." WHERE Project_id = ".$id." ;";
        $result = $this->db->query($query)->getResult();
        return $result;
    }

    function sp_select_percent_project($projectId){
        $query = "call sp_select_percent_project($projectId)";
        $result = $this->db->query($query)->getResult();
        return $result;
    }

    function sp_select_info_project($projectId){
        $query = "call sp_select_info_project($projectId)";
        $result = $this->db->query($query)->getResult();
        return $result;
    }

    function sp_select_user_notification($subactivityId){
        $query = "call sp_select_user_notification($subactivityId)";
        $result = $this->db->query($query)->getResult();
        return $result;
    }

    function sp_create_general_chart($userId, $roleId, $initialDate, $finalDate){
        $query = "call sp_create_general_chart($userId, $roleId, '$initialDate', '$finalDate')";
        $result = $this->db->query($query)->getResult();
        return $result;
    }

    function sp_select_status_projects(){
        $query = "call sp_select_status_projects()";
        $result = $this->db->query($query)->getResult();
        return $result;
    }
}