<?php 
   require_once "class/DBController.php";

   class loanOffer{

      private $db_handle;
        
      function __construct(){
         $this->db_handle = new DBController();
      }


      function addLoanOffer($loan_request_id, $borrower_id, $lender_id, 
                            $offer_amount, $payment_method, $interest_rate,
                            $loan_start, $loan_term, $memo){
         $query = " INSERT INTO loan_offer 
                  (loan_request_id, borrower_id, lender_id, 
                   offer_amount, payment_method, interest_rate,
                   loan_start, loan_term, memo)
                  VALUES
                  (?, ?, ?,
                   ?, ?, ?,
                   ?, ?, ?)";
         $paramType = "iiidsdsis";
         $paramValue = array(
            $loan_request_id, $borrower_id, $lender_id, 
            $offer_amount, $payment_method, $interest_rate,
            $loan_start, $loan_term, $memo
         );       
         $this->db_handle->insert($query, $paramType, $paramValue); 

      }


      function getAllLoanOffer(){
         $query = "
                  SELECT 
                  DATE_FORMAT(loan_offer.date_created,'%Y-%m-%d') AS 'date',
                  loan_offer.id AS 'id', 
                  loan_offer.loan_request_id, 
                  borrower.name AS 'borrower',
                  lender.name AS 'lender',
                  loan_offer.payment_method,
                  loan_offer.offer_amount,
                  loan_offer.loan_start,
                  loan_offer.loan_term,
                  loan_offer.memo,
                  loan_offer.is_accepted,
                  loan_offer.is_expired,
                  loan_offer.verify_by,
                  borrower.id AS 'borrower_id',
                  lender.id AS 'lender_id'
                  FROM loan_offer
                  LEFT JOIN borrower
                  ON loan_offer.borrower_id = borrower.id
                  LEFT JOIN lender
                  ON loan_offer.lender_id = lender.id
                  ORDER BY date 
                  ";
         $result = $this->db_handle->runBaseQuery($query);
         return $result;
      }


      function getLoanOfferByID($id){
         $query = "SELECT * FROM loan_offer WHERE id = ?";
         $paramType = "i";
         $paramValue = array(
            $id
         );
         $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
         return $result;
      }


      function getLoanOfferByBorrowerID($borrower_id){
         $query = "SELECT * FROM loan_offer WHERE is_expired IS NULL AND is_accepted IS NULL AND borrower_id = ?;";
         $paramType = "i";
         $paramValue = array(
            $borrower_id
         );
         $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
         return $result;
      }


      function getLoanOfferByLenderID($lender_id){
         $query = "SELECT * FROM loan_offer WHERE is_expired IS NULL AND is_accepted IS NULL AND lender_id = ?;";
         $paramType = "i";
         $paramValue = array(
            $lender_id
         );
         $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
         return $result;
      }


      function editLoanOffer($id, $loan_request_id, $borrower_id, $lender_id, 
                              $offer_amount, $payment_method, $interest_rate, 
                              $loan_start, $loan_term, $memo, 
                              $is_accepted, $is_expired, $verify_by) {
         //!TODO velidation, throw exception 
         $query = "UPDATE loan_offer SET 
                  loan_request_id = ?, borrower_id = ?, lender_id = ?,
                  offer_amount = ?, payment_method = ?, interest_rate = ?, 
                  loan_start = ?, loan_term = ?, memo = ?,
                  is_accepted = ?, is_expired = ?, verify_by = ? 
                  WHERE id = ?";
         $paramType = "iiidsdsisiisi";
         $paramValue = array(
            $loan_request_id, $borrower_id, $lender_id, 
            $offer_amount, $payment_method, $interest_rate, 
            $loan_start, $loan_term, $memo, 
            $is_accepted, $is_expired, $verify_by,
            $id
         );
         
         $this->db_handle->update($query, $paramType, $paramValue);
     }


      function setAccepted($id, $bool = TRUE){
         //!TODO velidation, throw exception $bool must booleon
         if($bool){
            $is_accepted = 1;
         }else{
            $is_accepted = 1;
         }

         $query = "UPDATE loan_offer SET is_accepted = ? WHERE id = ?";
         $paramType = "ii";
         $paramValue = array(
            $is_accepted,
            $id
         );

         $this->db_handle->update($query, $paramType, $paramValue);
     }


      function setExpired($id, $bool = TRUE){
         //!TODO velidation, throw exception $bool must booleon
         if($bool){
            $is_expired = 1;
         }else{
            $is_expired = 1;
         }

         $query = "UPDATE loan_offer SET is_expired = ? WHERE id = ?";
         $paramType = "ii";
         $paramValue = array(
            $is_expired,
            $id
         );

         $this->db_handle->update($query, $paramType, $paramValue);
      }

      
      function setVerifyBy($id, $name){
         $query = "UPDATE loan_offer SET verify_by = ? WHERE id = ?";
         $paramType = "si";
         $paramValue = array(
            $name,
            $id
         );

         $this->db_handle->update($query, $paramType, $paramValue);
      }

      
   }

 ?> 