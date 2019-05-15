<?php 
    
    if(!empty($_GET["id"])){
      $id = $_GET["id"];

      require_once "class/loanOffer.php";
      $loanOffer = new loanOffer();
      /* get loan offer info */
      $result = $loanOffer->getLoanOfferByID($id);
      
      $amount         = $result[0]["offer_amount"];
      $interest_rate  = $result[0]["interest_rate"];
      $term           = $result[0]["loan_term"];
      $start_date     = $result[0]["loan_start"];
      $request_id     = $result[0]["loan_request_id"];

      console_log($amount);

      require_once "class/loanCalculator.php";
      $calculater = new loanCalculator($amount,$interest_rate,$term);
/*         $calculater = new loanCalculator(120000,0.06,1); */
    }

    if($result[0]["payment_method"]=="equal principal"){
         $calculater->equalPrincipal();
    } 

    if($result[0]["payment_method"]=="equal loan"){ 
        $calculater->equalPayment();
    }

    $table = $calculater->getResult();
    $totalInterest = $calculater->getTotalInterest();
    console_log($totalInterest);
    
    //add due date to table
    $due_date = $start_date;
    foreach ($table as &$record) {
        $record['due_date'] =  $due_date;
        $due_date = date('Y-m-d', strtotime($due_date.'+1 month'));
        }
     /* -------------------------------- */  
     //for debug use 
    function console_log( $data ){
            echo '<script>';
            echo 'console.log('. json_encode( $data ) .')';
            echo '</script>';
    }
    //
    if(isset($_POST['is_submit'])){
      $is_submit = $_POST['is_submit'];
      
      
      if($is_submit=="Submit"){
        $auth_name = $_POST['admin_name'];
        $loanOffer->setVerifyBy($id,$auth_name);

        require_once "class/loanRequest.php";
        $loanRequest = new loanRequest();
        $loanRequest->setExpired($request_id);

        /* add table to db */
        require_once "class/loanSchedule.php";
        $schedule = new loanSchedule();
        foreach ($table as $k => $v) {
            $schedule->addLoanSchedule($id, $table[$k]["ID"], $table[$k]["AMOUNT BALANCE"], $table[$k]["INTEREST"],
                                        $table[$k]["PAYMENT"], $table[$k]["PRINCIPAL BALANCE"], $table[$k]["due_date"]);
        }
        
         /* create installment acct */
        require_once "class/installmentAcct.php";
        $installment = New installmentAcct();
        $installment->addAccount(0,$id,'');
        
        header("Location: loan_offers.php");

      }elseif($is_submit=="Cancel"){
        //TODO unset post value */
        header("Location: loan_offers.php");
      }
  
    }

    include('partials/_header.php');  
    
?>
<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Loan calculater</h4>
            <div class="row text-gray d-md-flex d-none">
                <div class="col-3 d-flex">
                    <small class="mb-0 mr-2 text-muted text-muted">Amount :</small>
                    <small class="Last-responded mr-2 mb-0 text-muted text-muted"><?php echo 'RM '.$amount; ?></small>
                </div>
                <div class="col-3 d-flex">
                    <small class="mb-0 mr-2 text-muted text-muted">Terms :</small>
                    <small class="Last-responded mr-2 mb-0 text-muted text-muted"><?php echo $term.' years'; ?></small>
                </div>
            </div>

            <div class="row text-gray d-md-flex d-none">    
                <div class="col-3 d-flex">
                    <small class="mb-0 mr-2 text-muted text-muted">Rate :</small>
                    <small class="Last-responded mr-2 mb-0 text-muted text-muted"><?php echo ($interest_rate*100).' %'; ?></small>
                </div>
                <div class="col-3 d-flex">
                    <small class="mb-0 mr-2 text-muted text-muted">Payment Method :</small>
                    <small class="Last-responded mr-2 mb-0 text-muted text-muted"><?php echo $result[0]["payment_method"]; ?></small>
                </div>
                <div class="col-3 d-flex">
                    <small class="mb-0 mr-2 text-muted text-muted">Offer ID# :</small>
                    <small class="Last-responded mr-2 mb-0 text-muted text-muted"><?php echo $id; ?></small>
                </div>
            </div>

        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Due Date</th>
                <th>PRINCIPAL BALANCE</th>
                <th>INTEREST</th>
                <th>PAYMENT</th>
                <th>AMOUNT BALANCE</th>
    
              </tr>
            </thead>
            <tbody>
              <?php
                  if (! empty($table)) {
                    foreach ($table as $k => $v) {
 
                ?>
              <tr>
                <td><?php echo $table[$k]["ID"]; ?></td>
                <td><?php echo $table[$k]["due_date"]; ?></td>
                <td><?php echo $table[$k]["PRINCIPAL BALANCE"]; ?></td>
                <td><?php echo $table[$k]["INTEREST"]; ?></td>
                <td><?php echo $table[$k]["PAYMENT"]; ?></td>
                <td><?php echo $table[$k]["AMOUNT BALANCE"]; ?></td>
                      
              

              </tr>
              <?php
                    }
                  }
                ?>
            </tbody>
          </table>
        </div>
        <form class="forms-sample" name="frm" method="POST" action="">
        <input type="hidden" value=<?php echo $name ?> name="admin_name" />
            <div class="row ">
                <div class="mx-auto">
                    <input class="btn btn-success mr-2" name="is_submit" type="submit" value="Submit">
                    <a href="loan_offers.php"> 
                    <input class="btn btn-light" name="is_submit" type="submit" value="Cancel">
                    </a>
                    
                </div>
            </div>        
        </form>
      </div>
    </div>
  </div>

  
  
    <!--table-wrapper ends -->
</div>
<?php include('partials/_footer.php');?>