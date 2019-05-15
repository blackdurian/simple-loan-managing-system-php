
<?php 
if(!empty($_GET["type"])){
    $type = $_GET["type"];
    if($type=="borrower"){
        require_once "class/borrower.php";
        $borrower = new borrower();
    }
    if($type=="lender"){
        require_once "class/lender.php";
        $lender = new lender();      
    }
}




//!TODO validation
if (isset($_POST['is_submit'])){
    $is_submit = $_POST['is_submit'];
    if($is_submit == "save"){
        $name = $_POST["name"];
        $citizen_id = $_POST["citizen-id"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];
        if($type=="borrower"){
            $borrower->registerBorrower($name, $citizen_id, $phone, $email);
            header("Location: borrowers.php");
        }
        if($type=="lender"){
            $lender->registerLender($name, $citizen_id, $phone, $email);
            header("Location: lenders.php");
        }
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


<div class="col-md-6 grid-margin stretch-card">
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">New <?php echo $type;?> register form</h4>
        
        <form class="forms-sample" name="frm" method="POST" action="">
        <div class="form-group">
            <label for="InputName">Name</label>
            <input type="text" class="form-control" id="InputName" name="name" placeholder="Name">
        </div>
        <div class="form-group">
            <label for="InputCitizen-ID">Citizen ID</label>
            <input type="text" class="form-control" id="InputCitizen-ID" name="citizen-id" placeholder="Citizen ID">
        </div>
        <div class="form-group">
            <label for="InputPhone">Phone</label>
            <input type="texts" class="form-control" id="InputPhone" name="phone" placeholder="Phone Number">
        </div>
        <div class="form-group">
            <label for="InputEmail">Email address</label>
            <input type="email" class="form-control" id="InputEmail" name="email" placeholder="Email">
        </div>
    
        <!-- <div class="form-group">
            <label>File upload</label>
            <input type="file" name="img[]" class="file-upload-default">
            <div class="input-group col-xs-12">
            <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
            <span class="input-group-append">
                <button class="file-upload-browse btn btn-info" type="button">Upload</button>
            </span>
            </div>
        </div> -->
        <!-- <div class="form-group">
            <label for="exampleInputCity1">City</label>
            <input type="text" class="form-control" id="exampleInputCity1" placeholder="Location">
        </div>
        <div class="form-group">
            <label for="exampleTextarea1">Textarea</label>
            <textarea class="form-control" id="exampleTextarea1" rows="2"></textarea>
        </div> -->
        <input type="submit" class="btn btn-success mr-2" name="is_submit" value="save"> 
        <input type="submit" class="btn btn-light" name="is_submit" value="cancel"> 
        </form>
    </div>
    </div>
</div>

<?php include('partials/_footer.php');
    
?>