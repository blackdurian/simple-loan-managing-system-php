
<?php 
require_once "class/lender.php";
$lender = new lender();
$result = $lender->getAllLender();
 
include('partials/_header.php');
?>

  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title ml-3">Lenders List</h4>
          <div class="card-description">
            
            <a href="borr-lend-add.php?type=lender">
              <button type="button" class="btn btn-primary btn-fw float-right" onclick="">
              <i class="mdi mdi-plus"></i>New Lender</button>
            </a>


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
            <table class="table table-striped order-table"  id="myTable">
              <thead>
                <tr>
                <!-- <th>#</th> -->
                  <th>Name</th>
                  <th>Citizen ID</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                  if (! empty($result)) {
                    foreach ($result as $k => $v) {
                ?>
                <tr>
                <!-- <td class="py-1"><?php /* echo $result[$k]["ID"];  */?></td> -->
                  <td class="py-1"><?php echo $result[$k]["name"]; ?></td>
                  <td class="py-1"><?php echo $result[$k]["citizen_id"]; ?></td>
                  <td class="py-1"><?php echo $result[$k]["phone"]; ?></td>
                  <td class="py-1"><?php echo $result[$k]["email"]; ?></td>
                  <td class="py-1">
                    <div class="btn-group dropdown">
                      <button type="button" class="btn btn-success dropdown-toggle btn-xs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="lender-acct.php?id=<?php echo $result[$k]["id"]; ?>">
                          <i class="fa fa-times text-danger fa-fw"></i>User Account</a>
                        <a class="dropdown-item" href="lender-installment.php?id=<?php echo $result[$k]["id"]; ?>">
                          <i class="fa fa-times text-danger fa-fw"></i>Loan Info</a>  
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="acct-add.php?type=lender&id=<?php echo $result[$k]["id"]; ?>">
                          <i class="fa fa-times text-danger fa-fw"></i>Create Account</a>
                        <a class="dropdown-item" href="borr-lend-edit.php?type=lender&id=<?php echo $result[$k]["id"]; ?>">
                          <i class="fa fa-reply fa-fw"></i>Edit User</a>
                        <a class="dropdown-item" href="borr-lend-delete.php?type=lender&id=<?php echo $result[$k]["id"]; ?>">
                          <i class="fa fa-history fa-fw"></i>Delete User</a>  
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