<?php
require_once "class/DBController.php";
class loginAuth {
    
    function getMemberByUsername($username) {
        $db_handle = new DBController();
        $query = "SELECT * FROM login WHERE username = ?";
        $result = $db_handle->runQuery($query, 's', array($username));
        return $result;
    }
    
    function getMemberByUserID($id) {
        $db_handle = new DBController();
        $query = "SELECT * FROM login WHERE user_id = ?";
        $result = $db_handle->runQuery($query, 'i', array($id));
        return $result;
    }

    function updatePasswordByID($password, $id) {
        $db_handle = new DBController();
        $query = "UPDATE login SET `password` = ? WHERE id = ?";
        $paramType = "si";
        $paramValue = array(
            $password,
            $id
        );
        $db_handle->update($query, $paramType, $paramValue);
    }

    function update($query) {
        mysqli_query($this->conn,$query);
    }
}
?>