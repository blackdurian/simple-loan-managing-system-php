
<?php 
    require_once "class/admin.php";
    $admin = new admin();
    $admin_id = $user_id;
    $result = $admin->getAdminByID($admin_id);


//!TODO validation

if(isset($_POST['submit'])){
    $name = $_POST["name"];
    $citizen_id = $_POST["citizen-id"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];

        $admin->editAdmin($name, $citizen_id, $phone, $role, $admin_id);
        header("Location: borrowers.php");


}
if(isset($_POST['cancel'])){
    //TODO unset post value
    header("Location: index.php");
} 

 
include('partials/_header.php');
?>


<div class="col-md-6 grid-margin stretch-card">
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">Manage Account</h4>
        
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
            <label for="role">Role</label>
            <input type="text" class="form-control" id="role" name="role" placeholder="Role" 
            value="<?php echo $result[0]["role"]; ?>">
        </div>
    
        <button type="submit" class="btn btn-success mr-2" name="submit" value="save">Submit</button>
        <button type="button" class="btn btn-light" name="cancel" value="cancel">Cancel</button>
        </form>
    </div>
    </div>
</div>

<?php include('partials/_footer.php');
    
?>