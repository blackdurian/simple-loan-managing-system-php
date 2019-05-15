
<?php 
require_once "class/transfer.php";

$transfer = new transfer();

if(!empty($_GET["id"]) && !empty($_GET["type"])){
  $payer_id = $_GET["id"];
  $payer_type = $_GET["type"];
  if($payer_type=="borrower"){

      require_once "class/borrowerAcct.php";
      $borr_acc = new borrowerAcct();
      $payer_balance = $borr_acc->getCurrentBalanceByID($payer_id);
      
  }
  if($payer_type=="lender"){

      require_once "class/lenderAcct.php";
      $lend_acc = new lenderAcct();
      $payer_balance = $lend_acc->getCurrentBalanceByID($payer_id);
      
  }
  if($payer_type=="installment"){

    require_once "class/installmentAcct.php";
    $install_acc = new installmentAcct();
    $payer_balance = $install_acc->getCurrentBalanceByID($payer_id);
    
}

}


//!TODO validation

if(isset($_POST['submit'])){
    $payee_id = $_POST["payee_id"];
    $payee_type = $_POST["payee_type"];
    $amount = $_POST["amount"];
    $memo = $_POST["memo"];
    $transfer->newtransfer($payer_type, $payer_id, $payee_type, $payee_id, $amount, $memo);
    header(sprintf("Location: trans-history.php?type=$payer_type&id=$payer_id"));
}
if(isset($_POST['cancel'])){
    //TODO unset post value
    header(sprintf("Location: trans-history.php?type=$payer_type&id=$payer_id"));
} 


function searchForId($id, $array) {
  foreach ($array as $key => $val) {
      if ($val['uid'] === $id) {
          return $key;
      }
  }
  return null;
}


 
include('partials/_header.php');
?>


<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">New Transaction</h4>
                  <form class="form-sample" action="" method="post" name="frmTrans" >
                    <p class="card-description">
                     
                    </p>
                    
                      <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">From Account ID#:</label>
                          <div class="col-sm-9">
                            <label class="form-control"> <?php echo $payer_id?> </label>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Type:</label>
                          <div class="col-sm-9">
                            <label class="form-control"><?php echo $payer_type?></label>
                          </div>
                        </div>
                      </div>
                      </div>
         
                      <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Balance:</label>
                          <div class="col-sm-9">
                          <label class="form-control"><?php echo $payer_balance[0]["balance"]?></label>
                          </div>
                        </div>
                      </div>
                      </div>
                      <div class="dropdown-divider"></div>

                    <div class="row">
                      
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">To Account ID#:</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="payee_id">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Account Type:</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="payee_type">
                              <option value="borrower">Borrower</option>
                              <option value="lender">Lender</option>
                              <option value="installment">Installment</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>

           
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Amount:</label>
                          <div class="col-sm-9">
                            <input type="currency" class="form-control" name="amount">
                          </div>
                        </div>
                      </div>
                    </div>
                

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Memo:</label>
                          <div class="col-sm-9">
                            <textarea type="text" class="form-control" name="memo"></textarea>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col"></div>
                      <div class="col-sm-3">
                        <div class="form-group row ">
                          <button type="submit" class="btn btn-success mr-4" name="submit" value="submit">Submit</button>
                          <button class="btn btn-light" name="cancel" value="cancel" >Cancel</button>
                        </div>
                      </div>
                      <div class="col"></div>
                    </div>
                
                  </form>
                </div>
              </div>
            </div>

<?php include('partials/_footer.php');
    
?>