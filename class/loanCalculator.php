<?php
class loanCalculator {
    
    private $loanAmount;
    /* year */
    private $loanTerm;
    private $month;
    private $monthlyRate;
    private $rate;
    private static $result = [];
    private static $totalInterest;
    private static $totalPayment;

    public function __construct($amount, $interestRate, $term) {
        $this->loanAmount = $amount;
        $this->loanTerm = $term;
        $this->rate = $interestRate;
        $this->month = $this->loanTerm * 12.0;  
        $this->monthlyRate = $interestRate/12.0;
        
    }

    function equalPrincipal() {
        /* reset static field */
        self::$result = [];
        self::$totalInterest = 0;
        self::$totalPayment = 0;

        if ($this->month>0) {
        $balanceLoan = $this->loanAmount;
        $monthlyPrincipal =  $balanceLoan/$this->month;
        $balancePrincipal = 0;

            for ($i = 1; $i <= $this->month; $i++){
                $mInterest = $balanceLoan*$this->monthlyRate;
                $mPayment = $mInterest + $monthlyPrincipal;
                $balancePrincipal += $monthlyPrincipal;
                $balanceLoan -= $monthlyPrincipal;
                self::$totalPayment+=$mPayment;
                /* find total interest */
                self::$totalInterest+=$mInterest;
                /* Save to Array */
                $row['ID'] = $i;
                $row['PRINCIPAL BALANCE'] = round($balancePrincipal,2);
                $row['INTEREST'] = round($mInterest,2);
                $row['PAYMENT'] = round($mPayment,2);
                $row['AMOUNT BALANCE'] = round($balanceLoan,2);
                self::$result[] = $row;
            }
        }
    }

    function equalPayment() {
        /* reset static field */
        self::$result = [];
        self::$totalInterest = 0;
        self::$totalPayment = 0;
        $balanceLoan = $this->loanAmount;
        /* loan fomula */
        $mPayment = (($balanceLoan*$this->monthlyRate)*
                    pow((1 + $this->monthlyRate), $this->month)) /
                    ((pow((1 + $this->monthlyRate), $this->month)-1));

        self::$totalPayment = $mPayment*$this->month;
        self::$totalInterest = self::$totalPayment-$balanceLoan;
        $mInterest = self::$totalInterest/$this->month;
        $monthlyPrincipal = $mPayment - $mInterest;
        $balancePrincipal = 0;
        for ($i = 1; $i <= $this->month; $i++){
            $balancePrincipal += $monthlyPrincipal;
            $balanceLoan -= $monthlyPrincipal;
            
            /* Save to Array */
            $row['ID'] = $i;
            $row['PRINCIPAL BALANCE'] = round($balancePrincipal,2);
            $row['INTEREST'] = round($mInterest,2);
            $row['PAYMENT'] = round($mPayment,2);
            $row['AMOUNT BALANCE'] = round($balanceLoan,2);
            self::$result[] = $row;
        }
    }

    function getTotalInterest(){
        return self::$totalInterest;
    }

    function getResult(){
        return self::$result;
    }

    function getTotalPayment(){
        return self::$totalPayment;
    }

    
    /* result will look like this 
    $result = array(
                array(
                    'ID' => 1,
                    'PRINCIPAL BALANCE' => 212256,23,
                    'INTEREST' => 15533.20,
                    'PAYMENT' => 32113.23,
                    'AMOUNT BALANCE' => 2133.00
                ),
                array(
                    'ID' => 2,
                    'PRINCIPAL BALANCE' => 2145656,23,
                    'INTEREST' => 15453.20,
                    'PAYMENT' => 32113.23,
                    'AMOUNT BALANCE' => 2133.00
                ),
                array(
                    'ID' => 3,
                    'PRINCIPAL BALANCE' => 2256,23,
                    'INTEREST' => 1533.20,
                    'PAYMENT' => 3113.23,
                    'AMOUNT BALANCE' => 21433.00
                )
            )
    */
  /*   public function __get($key){
        if(array_key_exists($key, $value)){
        return $this->properties[$key];
        }
        
    } 
    public function __set($key, $value){
        $this->properties[$key] = $value;
    } 
     */
}
?>