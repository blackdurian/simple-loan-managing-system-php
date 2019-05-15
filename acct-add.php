
<?php 

if(!empty($_GET["id"]) && !empty($_GET["type"])){
    $id = $_GET["id"];
    $type = $_GET["type"];
    if($type=="borrower"){
        require_once "class/borrower.php";
        require_once "class/borrowerAcct.php";
        $borrower = new borrower();
        $account = new borrowerAcct();
        $result = $borrower->getBorrowerByID($id);   
    }
    if($type=="lender"){
        require_once "class/lender.php";
        require_once "class/lenderAcct.php";
        $lender = new lender();
        $account = new lenderAcct();
        $result = $lender->getLenderByID($id);      
    }
}


//!TODO validation
if (isset($_POST['is_submit'])){
    $is_submit = $_POST['is_submit'];
    if($is_submit == "submit"){
        $amount = $_POST["amount"];
        $memo = $_POST["memo"];
        $account->addAccount($amount,$id,$memo);
        header("Location: ".$type."s.php");
    }
    
    if($is_submit == "cancel"){
        //TODO unset post value
        header("Location: ".$type."s.php");
    } 

}
function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}
 
include('partials/_header.php');
?>


<div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Create <?php echo $type?> account form</h4>
                  <form class="form-sample" action="" method="post" name="frmAcct" >
                    <p class="card-description">
                     
                    </p>
                    
                      <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                            <label class="col-sm-3 col-form-label">ID#:</label>
                            <div class="col-sm-9">
                                <label class="form-control"> <?php echo $id?> </label>
                            </div>
                            </div>
                        </div>
                  
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Name:</label>
                                <div class="col-sm-9">
                                <label class="form-control"><?php echo $result[0]["name"]?></label>
                                </div>
                            </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Type:</label>
                                <div class="col-sm-9">
                                    <label class="form-control"><?php echo $type?></label>
                                </div>
                            </div>
                        </div>
                      </div>
         
               
                      <div class="dropdown-divider"></div>

                  

           
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Cash In Amount:</label>
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

                      <div class="col-sm-3">
                        <div class="form-group row ">
                          <input type="submit" class="btn btn-success mr-4" name="is_submit" value="submit"> 
                          <input type="submit" class="btn btn-light" name="is_submit" value="cancel" > 
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