<?php 


if(!empty($_GET["id"])){
    $offer_id = $_GET["id"];

    require_once "class/loanSchedule.php";
    $schedule = new loanSchedule();
    $result = $schedule->getScheduleByLoanOfferID($offer_id);
}

include('partials/_header.php');


function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}


?>


  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title ml-3">Loan Schedule</h4>

          <div class="card-description ">
            
          <div class="row text-gray d-md-flex d-none">
                <div class="col-3 d-flex">
                    <small class="mb-0 mr-2 text-muted text-muted">Offer ID :</small>
                    <small class="Last-responded mr-2 mb-0 text-muted text-muted"><?php echo $offer_id; ?></small>
                </div>
               
            </div>
           
            
            <!-- search bar function in custom js-->
            <form class="nav-link form-inline mt-2 mt-md-0 d-none d-lg-flex">   
              <div class="input-group">
                <input type="text" class="form-control search-table-filter" placeholder="Search" data-table="order-table">
                <div class="input-group-append">
                  <span class="input-group-text">
                    <i class="mdi mdi-magnify"></i>                  
                  </span>
                </div>
              </div>    
            </form>

            

          </div>

          <div class="table-responsive-fluid">
            <table class="table table-striped order-table" id="myTable">
              <thead>
                <tr>
                <!-- <th>#</th> -->
                  <th>Due Date</th>
                  <th>Amount Balance</th>
                  <th>Interest</th>
                  <th>Payment</th>
                  <th>Principal Balance</th>
                  <th>Pay Date</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if (! empty($result)) {
                    foreach ($result as $k => $v) {
                ?>
                <tr>
                  <td class="py-1"><?php echo $result[$k]["due_date"]; ?></td>
                  <td class="py-1"><?php echo $result[$k]["principal"]; ?></td>
                  <td class="py-1"><?php echo $result[$k]["interest"]; ?></td>        
                  <td class="py-1"><?php echo $result[$k]["installment_amount"]; ?></td>
                  <td class="py-1"><?php echo $result[$k]["principal_balance"]; ?></td>
                  <td class="py-1"><?php echo $result[$k]["pay_date"]; ?></td>
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