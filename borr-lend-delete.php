<?php
     if(!empty($_GET["id"]) && !empty($_GET["type"])){
          $id = $_GET["id"];
          $type = $_GET["type"];
          if($type=="borrower"){
      
              require_once "class/borrower.php";
              $borrower = new borrower();
              $borrower->deleteBorrowerByID($id);   
              
          }
          if($type=="lender"){
      
              require_once "class/lender.php";
              $lender = new lender();
              $lender->deleteLenderByID($id);   
              
          }
          header("Location: ".$type."s.php");
      }


 
     
?>