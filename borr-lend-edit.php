
<?php 
if(!empty($_GET["id"]) && !empty($_GET["type"])){
    $id = $_GET["id"];
    $type = $_GET["type"];
    if($type=="borrower"){
        require_once "class/borrower.php";
        $borrower = new borrower();
        $result = $borrower->getBorrowerByID($id);   
    }
    if($type=="lender"){
        require_once "class/lender.php";
        $lender = new lender();
        $result = $lender->getLenderByID($id);
    }
}

//!TODO validation

if(isset($_POST['is_submit'])){
    $is_submit = $_POST['is_submit'];
    if($is_submit = 'Submit'){
        $name = $_POST["name"];
        $citizen_id = $_POST["citizen-id"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];
        if($type=="borrower"){
            $borrower->editBorrower($name,$citizen_id,$phone,$email,$id);
            header("Location: borrowers.php");
        }
        if($type=="lender"){
            $lender->editLender($name,$citizen_id,$phone,$email,$id);
            header("Location: lenders.php");
        }
    }
    if($is_submit = 'Cancel'){
        //TODO unset post value
        header("Location: ".$type."s.php");
    }
}


 
include('partials/_header.php');
?>


<div class="col-md-6 grid-margin stretch-card">
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit <?php echo $type;?> form</h4>
        
        <form class="forms-sample" name="frm" method="post" action="">
        <div class="form-group">
            <label for="InputName">Name</label>
            <input type="text" class="form-control" id="InputName" name="name" placeholder="Name" 
            value="<?php echo $result[0]["name"]; ?>">
        </div>
        <div class="form-group">
            <label for="InputCitizen-ID">Citizen ID</label>
            <input type="text" class="form-control" id="InputCitizen-ID" name="citizen-id" placeholder="Citizen ID" 
            value="<?php echo $result[0]["citizen_id"]; ?>">
        </div>
        <div class="form-group">
            <label for="InputPhone">Phone</label>
            <input type="texts" class="form-control" id="InputPhone" name="phone" placeholder="Phone Number" 
            value="<?php echo $result[0]["phone"]; ?>">
        </div>
        <div class="form-group">
            <label for="InputEmail">Email address</label>
            <input type="email" class="form-control" id="InputEmail" name="email" placeholder="Email" 
            value="<?php echo $result[0]["email"]; ?>">
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
        <input type="submit" class="btn btn-success mr-2" name="is_submit" value="Submit">
        <input type="submit" class="btn btn-light" name="is_submit" value="Cancel">
        </form>
    </div>
    </div>
</div>

<?php include('partials/_footer.php');
    
?>