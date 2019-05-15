
<?php 

    if(!empty($_GET["req_id"])){
        $req_id = $_GET["req_id"];
        $borrower_id = $_GET["borr_id"];
        $req_amount = $_GET["amount"];
        $req_start = $_GET["loan_start"];
        $req_term = $_GET["loan_term"]; 
        require_once "class/loanOffer.php";
        $loan_offer = new loanOffer();
        console_log($req_term );
    }
    //!TODO validation

    if(isset($_POST['is_submit'])){
        $is_submit=$_POST['is_submit'];

        if($is_submit=="Submit"){
            $lender_id = $_POST["lender_id"];
            $offer_amount = $_POST["offer_amount"];
            $payment_method = $_POST["payment_method"];
            $interest_rate = $_POST["interest_rate"]/100;
            $loan_start = $_POST["start_date"];
            $loan_term = $_POST["term"];
            $memo = $_POST["memo"];
            $loan_offer->addLoanOffer($req_id, $borrower_id, $lender_id, 
                                        $offer_amount, $payment_method, $interest_rate,
                                        $loan_start, $loan_term, $memo);
            header("Location: loan_offers.php");
        }elseif($is_submit=="Cancel"){
               //TODO unset post value
            header("Location: loan_requests.php");


        }
    
        
    }

    function console_log( $data ){
        echo '<script>';
        echo 'console.log('. json_encode( $data ) .')';
        echo '</script>';
}
    include('partials/_header.php');
?>

<!-- offer form -->
<div class="row"> 
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Offer form</h4>
           
            <form class="forms-sample" method="post">
            <div class="form-group">
                <label for="lender_id">Lender ID</label>
                <input type="text" class="form-control" id="lender_id" name="lender_id" placeholder="ID">
            </div>
            <div class="form-group">
                <label for="offer_amount">Offer amount</label>

                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">RM</span>
                    </div>
                    <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" id="offer_amount" name="offer_amount" placeholder="Amount">
                    <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                    </div>
                </div>
               
            </div>
            <div class="form-group">
                <label for="interestRate">Year Interest rate</label>
                <div class="input-group">
                <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" id="interestRate" name="interest_rate" placeholder="Rate">
                    <div class="input-group-append">
                        <span class="input-group-text">%</span>
                    </div>
                    </div>
            </div>
            <div class="form-group">
                <label for="term">Term</label>
                <input type="text" class="form-control" id="term" name="term" placeholder="year">
            </div>

            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="text" class="form-control" id="start_date" name="start_date" placeholder="date">
            </div>

            <div class="form-group">
                    <label for="paymentMethod">Payment Method</label>
                    <select class="form-control" id="paymentMethod" name="payment_method">
                      <option value="equal principal">Equal Principal Payment</option>
                      <option value="equal loan">Equal Loan Payment</option>
                    </select>
                  </div>
            <div class="form-group">
                <label for="memo">Memo</label>
                <textarea class="form-control" id="memo" name="memo" rows="2"></textarea>
            </div>
            <input type="submit" class="btn btn-success mr-2" name="is_submit" value="Submit">
            <input type="submit" class="btn btn-light" name="is_submit" value="Cancel" >
            </form>
        </div>
        </div>
    </div>
<!-- offer form end -->


    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
        <div class="card-body">
            <h4 class="card-title">Request info</h4>
            
            <form class="forms-sample" name="frm" >
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Request ID</label>
                    <div class="col-sm-9">
                        <p class="form-control"><?php echo $req_id ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Amount</label>
                    <div class="col-sm-9">
                        <p class="form-control"><?php echo $req_amount ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Date start</label>
                    <div class="col-sm-9">
                        <p class="form-control"><?php echo $req_start ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">borrower year</label>
                    <div class="col-sm-9">
                        <p class="form-control"><?php echo $req_term ?></p>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>


<?php include('partials/_footer.php');
   
?>