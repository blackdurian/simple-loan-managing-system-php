<?php 
require_once "class/lenderAcct.php";
require_once "class/lender.php";

$lendAcct = new lenderAcct();
$lender = new lender();

if(!empty($_GET["id"])){
    
    $lender_id = $_GET["id"];
    $lender_detail = $lender->getLenderByID($lender_id);
    $lenderAccount = $lendAcct->getAllAccountByLenderID($lender_id);
}
 
include('partials/_header.php');
?>
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Lender > <?php echo $lender_detail[0]["name"]?> > Account</h4>
          <div class="card-description">
           <!--  <a href="lender-add.php">
              <button type="button" class="btn btn-primary btn-fw float-right" onclick="">
              <i class="mdi mdi-plus"></i>New lender </button>
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
                  if (! empty($lenderAccount)) {
                    foreach ($lenderAccount as $k => $v) {
                ?>
                <tr>
                  <td class="py-1"><?php echo $lenderAccount[$k]["id"]; ?></td>
                  <td class="py-1"><?php echo $lenderAccount[$k]["balance"]; ?></td>
                  <td class="py-1"><?php echo $lenderAccount[$k]["memo"]; ?></td>
                  <td class="py-1">
                    <div class="btn-group dropdown">
                      <button type="button" class="btn btn-success dropdown-toggle btn-xs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="trans-history.php?type=lender&id=<?php echo $lenderAccount[$k]["id"]; ?>">
                          <i class="fa fa-check text-success fa-fw"></i>Transaction History</a>
                        <a class="dropdown-item" href="trans-new.php?type=lender&id=<?php echo $lenderAccount[$k]["id"]; ?>">
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