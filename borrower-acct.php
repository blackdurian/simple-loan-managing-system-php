<?php 
require_once "class/borrowerAcct.php";
require_once "class/borrower.php";
require_once "class/installmentAcct.php";

$borrAcct = new borrowerAcct();
$borrower = new borrower();
$installAcct = new installmentAcct();
if(!empty($_GET["id"])){
    $borrower_id = $_GET["id"];
    $borrower_detail = $borrower->getBorrowerByID($borrower_id);
    $borrowerAccount = $borrAcct->getAllAccountByBorrowerID($borrower_id);
    $installAccount = $installAcct->getAllBalanceByBorrowerID($borrower_id);  
}
 
include('partials/_header.php');
?>
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Borrower > <?php echo $borrower_detail[0]["name"]?> > Account</h4>
          <div class="card-description">
           <!--  <a href="borrower-add.php">
              <button type="button" class="btn btn-primary btn-fw float-right" onclick="">
              <i class="mdi mdi-plus"></i>New Borrower </button>
            </a> -->
          </div>
          <div class="table-responsive-fluid">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Account ID</th>
                  <th>Balance</th>
                  <th>Memo</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if (! empty($borrowerAccount)) {
                    foreach ($borrowerAccount as $k => $v) {
                ?>
                <tr>
                  <td class="py-1"><?php echo $borrowerAccount[$k]["id"]; ?></td>
                  <td class="py-1"><?php echo $borrowerAccount[$k]["balance"]; ?></td>
                  <td class="py-1"><?php echo $borrowerAccount[$k]["memo"]; ?></td>
                  <td class="py-1">
                    <div class="btn-group dropdown">
                      <button type="button" class="btn btn-success dropdown-toggle btn-xs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="trans-history.php?type=borrower&id=<?php echo $borrowerAccount[$k]["id"]; ?>">
                          <i class="fa fa-check text-success fa-fw"></i>Transaction History</a>
                        <a class="dropdown-item" href="trans-new.php?type=borrower&id=<?php echo $borrowerAccount[$k]["id"]; ?>">
                          <i class="fa fa-check text-success fa-fw"></i>New Transaction</a>
                      </div>
                    </div>
                  </td>
                </tr>
                <?php
                    }
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
<!-- installment account -->
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Borrower > <?php echo $borrower_detail[0]["name"]?> > Installment Account</h4>
          <div class="card-description">
           <!--  <a href="borrower-add.php">
              <button type="button" class="btn btn-primary btn-fw float-right" onclick="">
              <i class="mdi mdi-plus"></i>New Borrower </button>
            </a> -->
          </div>
          <div class="table-responsive-fluid">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Account ID</th>
                  <th>Balance</th>
                  <th>Loan Offer ID</th>
                  <th>Memo</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if (! empty($installAccount)) {
                    foreach ($installAccount as $k => $v) {
                ?>
                <tr>
                  <td class="py-1"><?php echo $installAccount[$k]["id"]; ?></td>
                  <td class="py-1"><?php echo $installAccount[$k]["balance"]; ?></td>
                  <td class="py-1"><?php echo $installAccount[$k]["loan_offer_id"]; ?></td>
                  <td class="py-1"><?php echo $installAccount[$k]["memo"]; ?></td>
                  <td class="py-1">
                    <div class="btn-group dropdown">
                      <button type="button" class="btn btn-success dropdown-toggle btn-xs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="trans-history.php?type=installment&id=<?php echo $installAccount[$k]["id"]; ?>">
                          <i class="fa fa-check text-success fa-fw"></i>Transaction History</a>
                        <a class="dropdown-item" href="trans.php?type=installment&id=<?php echo $installAccount[$k]["id"]; ?>">
                          <i class="fa fa-check text-success fa-fw"></i>New Transaction</a>
                      </div>
                    </div>
                  </td>
                </tr>
                <?php
                    }
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>


  </div>
<?php require_once('partials/_footer.php');?>