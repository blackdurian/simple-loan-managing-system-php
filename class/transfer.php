<?php
// !TODO namespace 
require_once "class/borrowerAcct.php";
require_once "class/lenderAcct.php";
require_once "class/installmentAcct.php";
require_once "class/transaction.php";

    class transfer {
      
        private $acct = [];

        /* 
        !TODO
        public static $amount
            extend 'one to many acct /  many to one'
        */

        function __construct() {
            $this->acct["borrower"] = new borrowerAcct();
            $this->acct["lender"] = new lenderAcct();
            $this->acct["installment"] = new installmentAcct();
            $this->acct["transaction"] = new transaction();
        }

        function newtransfer($payer_type, $payer_id, $payee_type, $payee_id, $amount, $memo){

            $payerAcctResult = $this->acct[$payer_type]->getCurrentBalanceByID($payer_id); //current balance
            $payeeAcctResult = $this->acct[$payee_type]->getCurrentBalanceByID($payee_id); //current balance
            $payerAcctBalance = $payerAcctResult[0]["balance"];
            $payeeAcctBalance = $payeeAcctResult[0]["balance"];
            //!TODO throw exception balance > amount
            $payerAcctBalance -= $amount;
            $payeeAcctBalance += $amount;
            $this->acct["transaction"]->addTransaction($payer_type, $payer_id, $payee_type, $payee_id, $amount, $memo);
            $this->acct[$payer_type]->addBalance($payerAcctBalance, $payer_id);
            $this->acct[$payee_type]->addBalance($payeeAcctBalance, $payee_id);
        
        }


        
    /*     function borrAcctToInstallAcct ($borrAcct_id, $installAcct_id, $amount,$memo){
            $borrAcctBalance = $this->borrower->getCurrentBalanceByID($borrAcct_id); //current balance
            $installAcctBalance = $this->installment->getCurrentBalanceByID($installAcct_id); //current balance
            //!TODO throw exception balance > amount
            $borrAcctBalance -= $amount;
            $installAcctBalance += $amount;
            $this->transaction->addTransaction("borrower",$borrAcct_id,"installment",$installAcct_id,$amount,$memo);
            $this->borrower->addBalance($borrAcctBalance, $borrAcct_id);
            $this->installment->addBalance($installAcctBalance, $installAcct_id);
        }

        function lenderAcctToBorrAcct ($lenderAcct_id, $borrAcct_id, $amount,$memo){
            $lenderAcctBalance = $this->lender->getCurrentBalanceByID($lenderAcct_id); //current balance
            $borrAcctBalance = $this->installment->getCurrentBalanceByID($borrAcct_id); //current balance
            //!TODO throw exception balance > amount
            $lenderAcctBalance -= $amount;
            $borrAcctBalance += $amount;
            $this->transaction->addTransaction("lender",$lenderAcct_id,"borrower",$borrAcct_id,$amount,$memo);
            $this->lender->addBalance($lenderAcctBalance, $lenderAcct_id);
            $this->borrower->addBalance($borrAcctBalance, $borrAcct_id);
        }
 */












    }

?>