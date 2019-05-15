
<?php 
require_once "class/loanRequest.php";
$loanRequest = new loanRequest();
$result = $loanRequest->getAllCurrentRequestWithBorr();
 
include('partials/_header.php');

?>
<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Loan Requests</h4>
        <p class="card-description">
       <!--  <button type="button" class="btn btn-inverse-primary btn-fw float-right mr-5"><i class="mdi mdi-plus"></i>New Request </button>
            Descrpition -->
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
                <th>Date</th>
                <th>ID</th>
                <th>Name</th>
                <th>Amount</th>
                <th>Loan Start</th>
                <th>Terms</th>
                <th>Memo</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
                  if (! empty($result)) {
                    foreach ($result as $k => $v) {
                ?>
              <tr>
              <td><?php echo $result[$k]["date"]; ?></td>
                <td><?php echo $result[$k]["request_id"]; ?></td>
                <td><?php echo $result[$k]["name"]; ?></td>
                <td><?php echo $result[$k]["amount"]; ?></td>
                <td><?php echo $result[$k]["loan_start"]; ?></td>
                <td><?php echo $result[$k]["loan_term"]; ?></td>
                <td><?php echo $result[$k]["memo"]; ?></td>
                <td>
                  <div class="ticket-actions col-md-2">
                    <div class="btn-group dropdown">
                      <button type="button" class="btn btn-success dropdown-toggle btn-xs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Manage
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="loan_offer-add.php?req_id=<?php echo $result[$k]["request_id"];
                                                                    ?>&borr_id=<?php echo $result[$k]["borrower_id"];
                                                                    ?>&amount=<?php echo $result[$k]["amount"];
                                                                    ?>&loan_start=<?php echo $result[$k]["loan_start"];
                                                                    ?>&loan_term=<?php echo $result[$k]["loan_term"];
                                                                    ?>">

                          <i class="fa fa-reply fa-fw"></i>New loan offer </a>
                        <a class="dropdown-item" href="#">
                          <i class="fa fa-history fa-fw"></i>Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                          <i class="fa fa-check text-success fa-fw"></i>Resolve Issue</a>
                        <a class="dropdown-item" href="#">
                          <i class="fa fa-times text-danger fa-fw"></i>Close Issue</a>
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