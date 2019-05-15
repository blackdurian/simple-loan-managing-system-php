<?php
    //TODO Extend class from balance_record
    require_once "class/DBController.php";
    require_once "class/balance_record.php";
    class installmentAcct{

        private $db_handle;
        private $balance_record;

        function __construct() {
            $this->db_handle = new DBController();
            $this->balance_record = new balance_record;
        }


        function addAccount($start_amount, $loan_offer_id, $memo){
            //TODO Validation 
           $query = "INSERT INTO installment_acct (loan_offer_id, memo)
                            VALUES (?, ?);";
            $paramType = "is";
            $paramValue = array( 
                $loan_offer_id,
                $memo
            );       
            $account_id = $this->db_handle->insert($query, $paramType, $paramValue); 
            $this->balance_record->add($start_amount,'installment',$account_id);
        }

        function deleteAccountByID($id) { 
            $query = "DELETE FROM installment_acct WHERE id = ?";
            $paramType = "i";
            $paramValue = array(
                $installment_id
            );
            $this->db_handle->update($query, $paramType, $paramValue); 
            //!TODO delete transfer record, delete balance_record   
        }


        function editMemoByID($memo, $id) {
            $query = "UPDATE installment_acct SET memo = ? WHERE id = ?";
            $paramType = "si";
            $paramValue = array(
                $memo, 
                $id
            );
            
            $this->db_handle->update($query, $paramType, $paramValue);
        }

        function addBalance($balance, $id){
            $this->balance_record->add($balance,'installment',$id);
        }

        function getCurrentBalanceByID($id){
           $result = $this->balance_record->getLatestBalanceByAccountID('installment', $id);
           return $result;
        }


        function getAllBalanceByID($id){
            $result = $this->balance_record->getAllBalanceByAccountID('installment', $id);
            return $result;
        }

        function getAllBalanceByBorrowerID($borrower_id){
            $query = "  SELECT t1.id, t2.balance,t1.loan_offer_id, t1.memo FROM (
                        SELECT * FROM `installment_acct` 
                        ) t1
                        INNER JOIN (
                        SELECT * FROM balance_record WHERE id 
                            IN(
                                SELECT MAX(id)
                                FROM balance_record 
                                GROUP BY account_id ,account_type
                            )
                        ) t2
                        ON t1.id = t2.account_id
                        INNER JOIN loan_offer 
                        ON t1.loan_offer_id = loan_offer.id
                        WHERE loan_offer.borrower_id = ?
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

            function getAllAccountByinstallmentId
        
        */
    }
?>