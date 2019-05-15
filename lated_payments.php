
<?php 


 
require_once "class/loanOffer.php";
$loanOffer = new loanOffer();
$result = $loanOffer->getAllLoanOffer();




include('partials/_header.php');

?>
<div class="row">
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Late Payment</h4>
      <p class="card-description">
         
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


      </p>
      <div class="table-responsive">
        <table class="table table-striped order-table" id="myTable">
          <thead>
            <tr>
              <th>Loan schedule ID	</th>
              <th>date </th>
              <th>Overdue Amount</th>
              <th>overdue Date</th>
              <th>overdue month</th>
     

              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
                if (! empty($result)) {
                  foreach ($result as $k => $v) {
              ?>
            <tr>
              <td><?php echo $result[$k]["id"]; ?></td>
              <td><?php echo $result[$k]["date"]; ?></td>
              <td><?php echo $result[$k]["offer_amount"]; ?></td>
              <td><?php echo $result[$k]["loan_start"]; ?></td>
              <td><?php echo $result[$k]["loan_term"]; ?></td>
      

              <td>
                <div class="ticket-actions col-md-2">
                  <div class="btn-group dropdown">
                    <button type="button" class="btn btn-success dropdown-toggle btn-xs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Action
                    </button>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="action.php?action=accept-offer&id=<?php echo $result[$k]["id"]; ?>">
                        <i class="fa fa-reply fa-fw"></i>Accept offer</a>
                      <a class="dropdown-item" href="action.php?action=decline-offer&id=<?php echo $result[$k]["id"]; ?>">
                        <i class="fa fa-history fa-fw"></i>Deline offer</a>
                      <div class="dropdown-divider"></div>
                      <?php  if(empty($result[$k]["verify_by"])){?>
                      <a class="dropdown-item" href="loan_schedule-add.php?id=<?php echo $result[$k]["id"]; ?>">
                      <i class="fa fa-check text-success fa-fw"></i>Create installment account</a> 
                      <?php }?>
                      <?php  if(!empty($result[$k]["verify_by"])){?>
                      <a class="dropdown-item" href="loan_schedule.php?id=<?php echo $result[$k]["id"]; ?>">
                      <i class="fa fa-check text-success fa-fw"></i>View Schedule</a> 
                      <?php }?>
                    </div>
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



  <!--table-wrapper ends -->
</div>
<?php include('partials/_footer.php');?>