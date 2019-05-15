<?php
require_once "class/DBController.php";
class admin {

    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function getAllAdmin() {
        $query = "SELECT * FROM admin ORDER BY id";
        $result = $this->db_handle->runBaseQuery($query);
        return $result;
    }


    function getAdminByID($admin_id) {
        $query = "SELECT * FROM admin WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $admin_id
        );
        
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }

    function deleteAdminByID($admin_id) {
        $query = "DELETE FROM admin WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $admin_id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }
    

    function editAdmin($name, $citizen_id, $phone, $role, $admin_id) {
        $query = "UPDATE admin SET name = ?,citizen_id = ?,phone = ?,role = ? WHERE id = ?";
        $paramType = "ssssi";
        $paramValue = array(
            $name,
            $citizen_id,
            $phone,
            $role,
            $admin_id
        );
        
        $this->db_handle->update($query, $paramType, $paramValue);
    }

    
    function registerAdmin($name, $citizen_id, $phone, $role) {
        $query = "INSERT INTO admin (name, citizen_id, phone, role) VALUES (?, ?, ?, ?)";
        $paramType = "ssss";
        $paramValue = array(
            $name,
            $citizen_id,
            $phone,
            $role
        );       
        $this->db_handle->insert($query, $paramType, $paramValue); 
    }
}
?>