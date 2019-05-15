<?php
require_once "class/DBController.php";
class borrower {

    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function getAllBorrower() {
        $query = "SELECT * FROM borrower ORDER BY id";
        $result = $this->db_handle->runBaseQuery($query);
        return $result;
    }

    
    function getBorrowerByID($borrower_id) {
        $query = "SELECT * FROM borrower WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $borrower_id
        );
        
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }


    function deleteBorrowerByID($borrower_id) {
        //!TODO validation, not a foreign key  
        $query = "DELETE FROM borrower WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $borrower_id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }
    

    function editBorrower($name, $citizen_id, $phone, $email, $borrower_id) {
        $query = "UPDATE borrower SET name = ?,citizen_id = ?,phone = ?,email = ? WHERE id = ?";
        $paramType = "ssssi";
        $paramValue = array(
            $name,
            $citizen_id,
            $phone,
            $email,
            $borrower_id
        );
        
        $this->db_handle->update($query, $paramType, $paramValue);
    }

    
    function registerBorrower($name, $citizen_id, $phone, $email) {
        $query = "INSERT INTO borrower (name, citizen_id, phone, email) VALUES (?, ?, ?, ?)";
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