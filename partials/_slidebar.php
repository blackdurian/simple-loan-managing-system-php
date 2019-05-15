
<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="user-wrapper">
                <div class="profile-image">
                  <img src="images/faces/face1.jpg" alt="profile image">
                </div>
                <div class="text-wrapper">
                  <p class="profile-name"><?php echo $name ?></p>
                  <div>
                    <small class="designation text-muted"><?php echo $role; ?></small>
                    <span class="status-indicator online"></span>
                  </div>
                </div>
              </div>
             <!--  <button class="btn btn-success btn-block">My Wallet 
              </button> -->
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php">
              <i class="menu-icon mdi mdi-television"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-content-copy"></i>
              <span class="menu-title">Loans</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="loan_requests.php">Loan Requests</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="loan_offers.php">Loan Offers</a>
                </li>
              </ul>
            </div>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="lated_payments.php">
              <i class="menu-icon mdi mdi-exclamation"></i>
              <span class="menu-title">Lated Payments</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="lenders.php">
              <i class="menu-icon mdi mdi-sticker"></i>
              <span class="menu-title">Lenders</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="borrowers.php">
              <i class="menu-icon mdi mdi-sticker"></i>
              <span class="menu-title">Borrowers</span>
            </a>
          </li>
        </ul>
      </nav>

