<?php
    //TODO Extend class from balance_record
    require_once "class/DBController.php";
    require_once "class/balance_record.php";
    class borrowerAcct{

        private $db_handle;
        private $balance_record;

        function __construct() {
            $this->db_handle = new DBController();
            $this->balance_record = new balance_record();
        }


        function addAccount($start_amount, $borrower_id, $memo){
            //TODO Validation 
           $query = "INSERT INTO borrower_acct (borrower_id, memo)
                            VALUES (?, ?);";
            $paramType = "is";
            $paramValue = array( 
                $borrower_id,
                $memo
            );       
            $account_id = $this->db_handle->insert($query, $paramType, $paramValue); 
            $this->balance_record->add($start_amount,'borrower',$account_id);
        }


        function addBalance($balance, $id){
            $this->balance_record->add($balance,'borrower',$id);
        }

        
        function deleteAccountByID($id) { 
            $query = "DELETE FROM borrower_acct WHERE id = ?";
            $paramType = "i";
            $paramValue = array(
                $borrower_id
            );
            $this->db_handle->update($query, $paramType, $paramValue); 
            //!TODO delete transfer record, delete balance_record   
        }


        function editMemoByID($memo, $id) {
            $query = "UPDATE borrower_acct SET memo = ? WHERE id = ?";
            $paramType = "si";
            $paramValue = array(
                $memo, 
                $id
            );
            
            $this->db_handle->update($query, $paramType, $paramValue);
        }

     

        function getCurrentBalanceByID($id){
           $result = $this->balance_record->getLatestBalanceByAccountID('borrower', $id);
           return $result;
        }


        function getAllBalanceByID($id){
            $result = $this->balance_record->getAllBalanceByAccountID('borrower', $id);
            return $result;
        }

    
        function getAllAccountByBorrowerID($borrower_id){
            $query = "  SELECT t1.id, t2.balance, t1.memo FROM (
                        SELECT * FROM `borrower_acct` WHERE borrower_id = ?
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
                $borrower_id
            );
            $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
            return $result;
        }
        
        /* !TODO  
            fucntion getAccountHistroy

            function getAllAccountByBorrowerId
        
        */
    }
?>