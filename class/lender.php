<?php
require_once "class/DBController.php";
class lender {
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function getAllLender() {
        $query = "SELECT * FROM lender ORDER BY id";
        $result = $this->db_handle->runBaseQuery($query);
        return $result;
    }

    function getLenderByID($lender_id) {
        $query = "SELECT * FROM lender WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $lender_id
        );
        
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }

    function deleteLenderByID($lender_id) {
        $query = "DELETE FROM lender WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $lender_id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }
    

    function editLender($name, $citizen_id, $phone, $email,  $lender_id) {
        $query = "UPDATE lender SET name = ?,citizen_id = ?,phone = ?,email = ? WHERE id = ?";
        $paramType = "ssssi";
        $paramValue = array(
            $name,
            $citizen_id,
            $phone,
            $email,
            $lender_id
        );
        
        $this->db_handle->update($query, $paramType, $paramValue);
    }

    
    function registerLender($name, $citizen_id, $phone, $email) {
        $query = "INSERT INTO lender (name, citizen_id, phone,email) VALUES (?, ?, ?, ?)";
        $paramType = "ssss";
        $paramValue = array(
            $name,
            $citizen_id,
            $phone,
            $email
        );       
        $this->db_handle->insert($query, $paramType, $paramValue); 
    }
}
?>