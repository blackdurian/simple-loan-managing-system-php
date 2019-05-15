<?php
    require_once "class/DBController.php";
    
    class balance_record{

        private $db_handle;
        

        function __construct() {
            $this->db_handle = new DBController();
        }


        function add($balance, $account_type, $account_id){
            $query = "  INSERT INTO balance_record (balance, account_type, account_id)
                        VALUES (?, ?, ?)";
            $paramType = "dsi";
            $paramValue = array(
                $balance,
                $account_type,
                $account_id
            );       
            $this->db_handle->insert($query, $paramType, $paramValue); 
        }

        function getAllLatestBalance(){
            $query = "  SELECT * FROM balance_record WHERE id 
                        IN(
                            SELECT MAX(id)
                            FROM balance_record 
                            GROUP BY account_id ,account_type
                        )
                        ORDER BY id ASC;";
            $result = $this->db_handle->runBaseQuery($query);
            return $result;
        }

        function getAllBalanceByAccountID($account_id, $account_type){
            $query = "SELECT * FROM balance_record WHERE account_type = ? AND account_id = ?";
            $paramType = "si";
            $paramValue = array(
                $account_type,
                $account_id
            );
            
            $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
            return $result;
        }
        

        function getLatestBalanceByAccountID($account_type, $account_id){
            $query = "  SELECT * FROM balance_record WHERE id 
                        IN(
                            SELECT MAX(id)
                            FROM balance_record 
                            GROUP BY account_id ,account_type
                        )
                        AND account_type = ? AND account_id = ? ";
             $paramType = "si";
             $paramValue = array(
                $account_type,
                $account_id
             );
             
             $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
            return $result;
        }

    }
?>