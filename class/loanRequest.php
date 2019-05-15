<?php 
   require_once "class/DBController.php";

   class loanRequest{

      private $db_handle;
        
      function __construct(){
         $this->db_handle = new DBController();
      }

      function add($borrower_id, $amount, $loan_start, $loan_term, $memo){
         $query = "  INSERT INTO loan_request (
                     borrower_id, amount, loan_start, 
                     loan_term, memo
                     )
                     VALUES(
                     ?, ?, ?,
                     ?, ?
                     )";
         $paramType = "idsis";
         $paramValue = array(
            $borrower_id, $amount, $loan_start, 
            $loan_term, $memo
         );       
         $this->db_handle->insert($query, $paramType, $paramValue); 
      }

      function getAllLoanRequest(){
         $query = "SELECT * FROM loan_request ORDER BY id";
         $result = $this->db_handle->runBaseQuery($query);
         return $result;
      }

      function getAllCurrentRequestWithBorr(){
         $query = "  SELECT 
                     loan_request.id AS 'request_id', 
                     loan_request.borrower_id,
                     loan_request.amount,
                     loan_request.loan_start,
                     loan_request.loan_term,
                     loan_request.memo,
                     DATE_FORMAT(loan_request.date_created,'%Y-%m-%d') AS 'date',
                     borrower.name,
                     borrower.phone,
                     borrower.email,
                     borrower.citizen_id
                     FROM loan_request  
                     LEFT JOIN borrower
                     ON loan_request.borrower_id = borrower.id
                     WHERE loan_request.is_expired IS NULL
                     ORDER BY loan_request.id
                  ";
         $result = $this->db_handle->runBaseQuery($query);
         return $result;
      }

      function getLoanRequestByID($id){
         $query = "SELECT * FROM loan_request WHERE id = ?";
         $paramType = "i";
         $paramValue = array(
            $id
         );
         $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
         return $result;
      }


      function getLoanRequestByBorrowerID($borrower_id){
         $query = "SELECT * FROM loan_request WHERE is_expired IS NULL AND borrower_id = ?;";
         $paramType = "i";
         $paramValue = array(
            $borrower_id
         );
         $result = $this->db_handle->runQuery($query, $paramType, $paramValue);
         return $result;
      }


      function editLoanRequest($id, $borrower_id, $amount, $loan_start, 
                                $loan_term, $memo, $is_expired) {
         //!TODO velidation, throw exception 
         $query = "UPDATE loan_request SET 
                  borrower_id = ?, amount = ?, loan_start = ?, 
                  loan_term = ?, memo = ?, is_expired = ?
                  WHERE id = ?";
         $paramType = "idsisii";
         $paramValue = array(
            $borrower_id,
            $amount, 
            $loan_start, 
            $loan_term, 
            $memo, 
            $is_expired, 
            $id
         );
         
         $this->db_handle->update($query, $paramType, $paramValue);
     }


      function setExpired($id, $bool = TRUE){
         //!TODO velidation, throw exception $bool must booleon
         if($bool){
            $is_expired = 1;
         }else{
            $is_expired = 0;
         }

         $query = "UPDATE loan_request SET is_expired = ? WHERE id = ?";
         $paramType = "ii";
         $paramValue = array(
            $is_expired,
            $id
         );

         $this->db_handle->update($query, $paramType, $paramValue);
      }


      
   }

 ?> 