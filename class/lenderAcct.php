<?php
    //TODO Extend class from balance_record
    require_once "class/DBController.php";
    require_once "class/balance_record.php";
    class lenderAcct{

        private $db_handle;
        private $balance_record;

        function __construct() {
            $this->db_handle = new DBController();
            $this->balance_record = new balance_record;
        }


        function addAccount($start_amount, $lender_id, $memo){
            //TODO Validation 
           $query = "INSERT INTO lender_acct (lender_id, memo)
                            VALUES (?, ?);";
            $paramType = "is";
            $paramValue = array( 
                $lender_id,
                $memo
            );       
            $account_id = $this->db_handle->insert($query, $paramType, $paramValue); 
            $this->balance_record->add($start_amount,'lender',$account_id);
        }

        function deleteAccountByID($id) { 
            $query = "DELETE FROM lender_acct WHERE id = ?";
            $paramType = "i";
            $paramValue = array(
                $lender_id
            );
            $this->db_handle->update($query, $paramType, $paramValue); 
            //!TODO delete transfer record, delete balance_record   
        }


        function editMemoByID($memo, $id) {
            $query = "UPDATE lender_acct SET memo = ? WHERE id = ?";
            $paramType = "si";
            $paramValue = array(
                $memo, 
                $id
            );
            
            $this->db_handle->update($query, $paramType, $paramValue);
        }

        function addBalance($balance, $id){
            $this->balance_record->add($balance,'lender',$id);
        }

        function getCurrentBalanceByID($id){
           $result = $this->balance_record->getLatestBalanceByAccountID('lender', $id);
           return $result;
        }


        function getAllBalanceByID($id){
            $result = $this->balance_record->getAllBalanceByAccountID('lender', $id);
            return $result;
        }

        function getAllAccountByLenderID($lender_id){
            $query = "  SELECT t1.id, t2.balance, t1.memo FROM (
                        SELECT * FROM `lender_acct` WHERE lender_id = ?
                        ) t1
                        INNER JOIN 
                        (SELECT * FROM balance_record WHERE id 
                                    IN(
                                        SELECT MAX(id)
                                        FROM balance_record 
                                        GROUP BY account_id ,account_type
                                    )
                        ) t2
                        ON t1.id = t2.account_id
                     ";
            $paramType = "i";
            $paramValue = array(
                $lender_id
            );
            $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
            return $result;
        }
        /* !TODO  
            fucntion getAccountHistroy

            function getAllAccountBylenderId
        
        */
    }
?>