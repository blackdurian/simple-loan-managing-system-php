<?php 
class _home_content{
  
  private $role = null;

  function __construct($user_role) {
    $this->$role = $user_role;

  }

}

?>
<!-- card row -->
<div class="row">
<!-- 1st card -->
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="clearfix">
          <div class="float-left">
            <i class="mdi mdi-cube text-danger icon-xl"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">Collections</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0">$65,650</h3>
            </div>
          </div>
        </div>
        <p class="text-muted mt-3 mb-0">
          <i class="mdi mdi-calendar mr-1" aria-hidden="true"></i>Monthly
        </p>
      </div>
    </div>
  </div>
<!-- 1st card end -->
<!-- 2nd card -->
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="clearfix">
          <div class="float-left">
            <i class="mdi mdi-poll-box text-success icon-xl"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">Collected</p>
            <div class="fluid-container">
              <h3 class="font-weight-medium text-right mb-0">5693</h3>
            </div>
          </div>
        </div>
        <p class="text-muted mt-3 mb-0">
          <i class="mdi mdi-calendar mr-1" aria-hidden="true"></i>Monthly
        </p>
      </div>
    </div>
  </div>
  
<!-- 2nd card end -->       
<!-- 3rd card -->     
<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
  <div class="card card-statistics">
    <div class="card-body">
      <div class="clearfix">
        <div class="float-left">
          <i class="mdi mdi-receipt text-warning icon-xl"></i>
        </div>
        <div class="float-right">
          <p class="mb-0 text-right">Under Payments</p>
          <div class="fluid-container">
            <h3 class="font-weight-medium text-right mb-0"><?php echo $num_overdue; ?></h3>
          </div>
        </div>
      </div>
      <p class="text-muted mt-3 mb-0">
        <i class="mdi mdi-calendar mr-1" aria-hidden="true"></i>Yearly
      </p>
    </div>
  </div>
</div>
<!-- 3rt card end -->
<!-- 4th card -->
  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
    <div class="card card-statistics">
      <div class="card-body">
        <div class="clearfix">
          <div class="float-left">
            <i class="mdi mdi-cloud text-primary icon-xl"></i>
          </div>
          <div class="float-right">
            <p class="mb-0 text-right">Today</p>
            <div class="fluid-container">
              <h4 class="font-weight-medium text-right mb-0"><?php echo date('j M Y l')?></h4>
            </div>
          </div>
        </div>
        <p class="text-muted mt-3 mb-0">
          <i class="mdi mdi-calendar" aria-hidden="true"></i> Work Day
        </p>
      </div>
    </div>
  </div>
<!-- 4th card end -->
</div>
<!-- card row end -->
<div class="row">
<!-- quick state -->
  <div class="col-lg-4 col-md-12 col-sm-12 grid-margin stretch-card">
    <div class="card quick-stat">
      <div class="card-body">
        <h2 class="card-title">Quick Status</h2>
        <div class="row mt-3">
          <div class="col">
            <div id="YearlyProgress" class="progressbar-js-circle item-relative">
              <svg viewBox="0 0 100 100" style="display: block; width: 100%;">
              <path d="M 50,50 m 0,-44 a 44,44 0 1 1 0,88 a 44,44 0 1 1 0,-88" stroke="#f5f5f5" stroke-width="12" fill-opacity="0"></path>
              <path d="M 50,50 m 0,-44 a 44,44 0 1 1 0,88 a 44,44 0 1 1 0,-88" stroke="rgb(121,0,227)" stroke-width="12" fill-opacity="0" style="stroke-dasharray: 276.499, 276.499; stroke-dashoffset: 165.899;"></path>
              </svg>
              <div class="progressbar-text" style="position: absolute; left: 50%; top: 50%; padding: 0px; margin: 0px; transform: translate(-50%, -50%); color: rgb(0, 0, 0); font-size: 1.5rem;">
              40
              </div>
            </div>
            <p class="graph-name text-center mt-2">Yearly Income</p>
          </div>
          <div class="col">
            <div id="MonthlyProgress" class="progressbar-js-circle item-relative">
              <svg viewBox="0 0 100 100" style="display: block; width: 100%;">
              <path d="M 50,50 m 0,-44 a 44,44 0 1 1 0,88 a 44,44 0 1 1 0,-88" stroke="#f5f5f5" stroke-width="12" fill-opacity="0"></path>
              <path d="M 50,50 m 0,-44 a 44,44 0 1 1 0,88 a 44,44 0 1 1 0,-88" stroke="rgb(255,0,62)" stroke-width="12" fill-opacity="0" style="stroke-dasharray: 276.499, 276.499; stroke-dashoffset: 165.899;"></path>
              </svg>
              <div class="progressbar-text" style="position: absolute; left: 50%; top: 50%; padding: 0px; margin: 0px; transform: translate(-50%, -50%); color: rgb(0, 0, 0); font-size: 1.5rem;">
              40
              </div>
            </div>
            <p class="graph-name text-center mt-2">Monthly Income</p>
          </div>
        </div>

        <div class="pending-amount">
          <div class="data d-flex justify-content-between">
            <p class="txt">Pending Amount</p>
            <p class="pendin-percentage">65%</p>
          </div>
          <div class="progress">
            <div class="progress-bar bg-primary" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- quick state end -->
  <!-- quick access -->
  <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 grid-margin stretch-card">
    <div class="card quick-btn">
      <div class="card-body">
        <!-- first row -->
        <h2 class="card-title">Quick Access</h2>
        <div class="row"> 
            <div class = "col-xl-2 col-lg-3 col-md-3 col-sm-6 grid-margin">
                <button href="#" class="btn btn-squared-default-plain btn-primary">
                  <i class="mdi mdi-key icon-xl"></i>
                  <br />
                  Register
                  <br />
                  Borrower
                </button>
            
            </div>
            <div class = "col-xl-2 col-lg-3 col-md-3 col-sm-6 grid-margin">
                <button href="#" class="btn btn-squared-default-plain btn-success">
                  <i class="mdi mdi-laptop icon-xl"></i>
                  <br />
                  success
                  <br />
                  Button
                </button>
                </div>
                <div class = "col-xl-2 col-lg-3 col-md-3 col-sm-6 grid-margin">
                <button href="#" class="btn btn-squared-default-plain btn-info">
                  <i class="mdi mdi-compass icon-xl"></i>
                  <br />
                  info 
                  <br />
                  Button
                </button>
                </div>
                <div class = "col-xl-2 col-lg-3 col-md-3 col-sm-6 grid-margin">
                <button href="#" class="btn btn-squared-default-plain btn-warning">
                  <i class="mdi mdi-pencil icon-xl"></i>
                  <br />
                  warning
                  <br />
                  Button
                </button>
                </div>
                <div class = "col-xl-2 col-lg-3 col-md-3 col-sm-6 grid-margin">
                <button href="#" class="btn btn-squared-default-plain btn-danger">
                  <i class="mdi mdi-car icon-xl"></i>
                  <br />
                  danger
                  <br />
                  Button
                </button>
                </div>
            
          
        </div>
        <!-- first row end-->
        <!-- second row -->
        <div class="row mt-3">
          
        <div class = "col-xl-2 col-lg-3 col-md-3 col-sm-6 grid-margin">
            <button href="#" class="btn btn-squared-default-plain btn-primary">
                  <i class="mdi mdi-barcode icon-xl"></i>
                  <br />Register
                  <br />Leader
            </button>
            </div>
            <div class = "col-xl-2 col-lg-3 col-md-3 col-sm-6 grid-margin">
            <button href="#" class="btn btn-squared-default-plain btn-success">
                  <i class="mdi mdi-laptop icon-xl"></i>
                  <br />
                  Register
                  <br />
                  Borrower
            </button>
            </div>
            <div class = "col-xl-2 col-lg-3 col-md-3 col-sm-6 grid-margin">
        <button href="#" class="btn btn-squared-default-plain btn-info">
                  <i class="mdi mdi-compass icon-xl"></i>
                  <br />
                  info 
                  <br />
                  Button
       </button>
       </div>
       <div class = "col-xl-2 col-lg-3 col-md-3 col-sm-6 grid-margin">
       <button href="#" class="btn btn-squared-default-plain btn-warning">
                  <i class="mdi mdi-pencil icon-xl"></i>
                  <br />
                  warning
                  <br />
                  Button
       </button>
       </div>
       <div class = "col-xl-2 col-lg-3 col-md-3 col-sm-6 grid-margin">
       <button href="#" class="btn btn-squared-default-plain btn-danger">
                  <i class="mdi mdi-car icon-xl"></i>
                  <br />
                  danger
                  <br />
                  Button
       </button>
       </div>
          
          
        </div>
        <!-- second end -->
      </div>
    </div>
  </div>
  <!-- quick access end -->

  
</div>