<?php 
   require_once "class/DBController.php";

    class loanSchedule{

        private $db_handle;

        function __construct(){
        $this->db_handle = new DBController();
        }


        function addLoanSchedule (  $loan_offer_id, $month_id, $principal, $interest, 
                                    $installment_amount, $principal_balance, $due_date){
        //!TODO velidation, throw exception $due_date is a date                             
            $query = "  INSERT INTO loan_schedule (
                        loan_offer_id, month_id, principal, interest, 
                        installment_amount, principal_balance, due_date)
                        VALUES (
                        ?, ?, ?, ?,
                        ?, ?, ?
                        );";
            $paramType = "iidddds";
            $paramValue = array( 
                $loan_offer_id, $month_id, $principal, $interest, 
                $installment_amount, $principal_balance, $due_date
            );       
            return $result = $this->db_handle->insert($query, $paramType, $paramValue); 
        }


        function getAllComingSchedule(){
            $query = "SELECT * FROM loan_schedule WHERE pay_date IS NULL ORDER BY id";
            $result = $this->db_handle->runBaseQuery($query);
            return $result;
        }


        function getScheduleByLoanOfferID($loan_offer_id){
            $query = "SELECT * FROM loan_Schedule WHERE loan_offer_id = ? ORDER BY month_id";
            $paramType = "i";
            $paramValue = array(
            $loan_offer_id
            );
            $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
            return $result;
        }


        function getScheduleByDueDate($due_date){
            $query = "SELECT * FROM loan_Schedule WHERE due_date = ?";
            $paramType = "s";
            $paramValue = array(
            $due_date
            );
            $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
            return $result;
        }


        function getUnpayScheduleByLoanOfferID($loan_offer_id){
            $query = "SELECT * FROM loan_Schedule WHERE loan_offer_id = ? AND pay_date IS NULL";
            $paramType = "i";
            $paramValue = array(
            $loan_offer_id
            );
            $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
            return $result;
        }


        function editLoanSchedule($id, $loan_request_id, $borrower_id, $lender_id, 
                                $Schedule_amount, $payment_method, $interest_rate, 
                                $loan_start, $loan_term_by_month, $memo, 
                                $is_accepted, $is_expired, $verify_by) {
            //!TODO velidation, throw exception 
            $query = "  UPDATE loan_Schedule SET 
                        loan_request_id = ?, borrower_id = ?, lender_id = ?,
                        schedule_amount = ?, payment_method = ?, interest_rate = ?, 
                        loan_start = ?, loan_term_by_month = ?, memo = ?,
                        is_accepted = ?, is_expired = ?, verify_by = ? 
                        WHERE id = ?";
            $paramType = "iiidsdsisiisi";
            $paramValue = array(
            $loan_request_id, $borrower_id, $lender_id, 
            $Schedule_amount, $payment_method, $interest_rate, 
            $loan_start, $loan_term_by_month, $memo, 
            $is_accepted, $is_expired, $verify_by,
            $id
            );
            $this->db_handle->update($query, $paramType, $paramValue);
        }


        function setPayDate($loan_offer_id, $pay_date){
            //!TODO velidation, throw exception $pay_date must a date
            $query = " UPDATE loan_schedule SET pay_date = ?  WHERE id IN(
                    SELECT MAX(id)
                    FROM loan_schedule
                    WHERE loan_offer_id = ? AND pay_date IS NULL
                    GROUP BY loan_offer_id
                    )";
            $paramType = "si";
            $paramValue = array(
            $pay_date,
            $loan_offer_id
            );
            $this->db_handle->update($query, $paramType, $paramValue);
        }
      
    }


?> 