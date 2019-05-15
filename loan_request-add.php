
<?php 

if(!empty($_GET["id"])){
    $borrower_id = $_GET["id"];

    require_once "class/loanRequest.php";
    $loan_request = new loanRequest();
}
//!TODO validation

if(isset($_POST['is_submit'])){
    $is_submit = $_POST['is_submit'];
    if($is_submit=="Submit"){
        $request_amount = $_POST["request_amount"];
        $loan_start = $_POST["start_date"];
        $loan_term = $_POST["term"];
        $memo = $_POST["memo"];
        $loan_request->add($borrower_id,$request_amount,$loan_start,$loan_term,$memo);
        header("Location: loan_requests.php");
    }elseif($is_submit == "Cancel"){
        //TODO unset post value
        header("Location: borrowers.php");
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
            <h4 class="card-title">Loan request form</h4>
        
            <form class="forms-sample" method="post">
                <div class="form-group">
                    <label for="lender_id">Borrower ID</label>
                    <div class="col-sm-9">
                        <p class="form-control"><?php echo $borrower_id ?></p>
                    </div>
                </div>

                <div class="form-group">
                    <label for="request_amount">Request amount</label>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">RM</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" id="request_amount" name="request_amount" placeholder="Amount">
                        <div class="input-group-append">
                            <span class="input-group-text">.00</span>
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
                    <label for="memo">Memo</label>
                    <textarea class="form-control" id="memo" name="memo" rows="3"></textarea>
                </div>
                <input type="submit" class="btn btn-success mr-2" name="is_submit" value="Submit">
                <input type="submit" class="btn btn-light" name="is_submit" value="Cancel" >
            </form>
        </div>
        </div>
    </div>
    <!-- offer form end -->
</div>


<?php include('partials/_footer.php');

?>