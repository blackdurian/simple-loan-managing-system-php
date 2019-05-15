<?php 
require_once "class/transaction.php";
require_once "class/balance_record.php";

$transaction = new transaction();
$balance_record = new balance_record();

if(!empty($_GET["id"]) && !empty($_GET["type"])){
    $account_id = $_GET["id"];
    $account_type = $_GET["type"];
    $histroy = $transaction->getHistoryByAcountID($account_id, $account_type);
    $balance = $balance_record->getAllBalanceByAccountID($account_id, $account_type);
}
 
include('partials/_header.php');
?>
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title"><?php echo $_GET["type"]." Account > ".$_GET["id"]." > Transaction History "?></h4>
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
                  <th>Date</th>
                  <th>Account Type</th>
                  <th>Account ID</th>
                  <th>Dr.</th>
                  <th>Cr.</th>
                  <th>Balance</th>
                  <th>Memo</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if (! empty($histroy)) {
                    foreach ($histroy as $k => $v) {
                ?>
                <tr>
                  <td class="py-1"><?php echo date("Y-m-d", strtotime($histroy[$k]["date_created"]));?></td> <!-- date -->
                  <td class="py-1"> <!-- Type -->
                    <?php 
                      if($histroy[$k]["payer_acct_type"]!=$account_type){
                        echo $histroy[$k]["payer_acct_type"];
                      }
                        if($histroy[$k]["payee_acct_type"]!=$account_type){
                          echo $histroy[$k]["payee_acct_type"];
                      }; 
                    ?>
                  <td class="py-1"> <!-- Particuler -->
                    <?php 
                      if($histroy[$k]["payer_acct_type"]!=$account_type){
                        echo $histroy[$k]["payer_acct_id"];
                      }
                        if($histroy[$k]["payee_acct_type"]!=$account_type){
                          echo $histroy[$k]["payee_acct_id"];
                      }; 
                    ?>
                  </td>
                  <td class="py-1 text-success"> <!-- debit or income -->
                    <?php 
                      if($histroy[$k]["payee_acct_type"]==$account_type){
                        echo $histroy[$k]["debit_amount"];
                      } 
                    ?>
                  </td>
                  <td class="py-1 text-danger"> <!-- credit or expenses -->
                    <?php 
                      if($histroy[$k]["payer_acct_type"]==$account_type){
                        echo $histroy[$k]["credit_amount"];
                      } 
                    ?>
                  </td>
                  <td class="py-1"><?php echo $balance[$k]["balance"]; ?></td> <!-- balance -->
                  <td class="py-1"><?php echo $histroy[$k]["memo"]; ?></td> <!--  -->
                  
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