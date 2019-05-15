<?php

if(isset($_GET['action'])){
    $action = $_GET['action'];    

 }else{
   $action = '';
 }
 if(isset($_GET['id'])){
   $id = $_GET['id'];   
   
 switch($action){
 
   case 'accept-offer':
      require_once "class/loanOffer.php";
      $loanOffer = new loanOffer;
      $loanOffer->setAccepted($id);
      header("Location: loan_offers.php");
      break;
   case 'decline':
      require_once "class/loanOffer.php";
      $loanOffer = new loanOffer;
      $loanOffer->setAccepted($id,FALSE);
      header("Location: loan_offers.php");
      break;
   case 'triangle':
      echo 'square';
      break;
   case 'rectangle':
      echo 'square';
      break;
   default:
      echo 'not';
 }
   


}


?>