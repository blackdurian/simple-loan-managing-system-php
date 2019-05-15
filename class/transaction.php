<?php
require_once "class/DBController.php";
class transaction {

    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DBController();
    }
    
    function addTransaction($payer_type, $payer_id, $payee_type, $payee_id, $amount, $memo){
        //!TODO validate acount type
        $query = "  INSERT INTO transaction ( 
                    payer_acct_type, payer_acct_id, 
                    payee_acct_type, payee_acct_id, 
                    debit_amount, credit_amount, 
                    memo) 
                    VALUES
                    ( ?, ?, ?, ?, ?, ?, ?)";
        $paramType = "sisidds";
        $paramValue = array(
            $payer_type, $payer_id, 
            $payee_type, $payee_id, 
            $amount, $amount,
            $memo
        );       
        $this->db_handle->insert($query, $paramType, $paramValue); 
    }

    function getAllHistroy() {
        $query = "SELECT * FROM transaction ORDER BY id";
        $result = $this->db_handle->runBaseQuery($query);
        return $result;
    }

    function getHistoryByAcountID($id, $acountType) {  
        $query = "  SELECT * FROM transaction WHERE payee_acct_type = ? AND payee_acct_id = ? UNION 
                    SELECT * FROM transaction WHERE payer_acct_type = ? AND payer_acct_id = ?
                    ORDER BY id
                    ";
        $paramType = "sisi";
        $paramValue = array(
            $acountType, $id,
            $acountType, $id
        );
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }


    function getTransactionByID($trans_id) {
        $query = "SELECT * FROM transaction WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $trans_id
        );
        $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
        return $result;
    }


    function deleteTransactionByID($trans_id) {
        $query = "DELETE FROM transaction WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $trans_id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }

}
?>