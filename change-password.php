
<?php 
  
    if(!empty($_GET["user_id"])){
        require_once "class/loginAuth.php";
        $auth = new loginAuth();
        $user_id=$_GET["user_id"];
        $result = $auth->getMemberByUserID($user_id);
        $username = $result[0]["username"];
        $login_id = $result[0]["id"];
        $old_password1 =  $result[0]["password"];
    }

//!TODO validation

if(isset($_POST['submit'])){
    if(!empty($_POST['new_password'])){
        if($_POST['new_password']==$_POST['confirm_password']){
            $new_password =  $_POST['new_password'];
            $old_password2= $_POST["old_password"];
            if (password_verify($old_password2, $old_password1)){
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $auth->updatePasswordByID( $hashed_password,$login_id);
                console_log($hashed_password);
                console_log($old_password1 );
                console_log($new_password);
                
                header("Location: class/logout.php");
                
            }
            else{$message = "password invalid";}
        }else{$message = "confrim password incorrect";}
    }else{$message = "password is empty";} 
}

if(isset($_POST['cancel'])){
    //TODO unset post value
    header("Location: index.php");
} 





function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}
include('partials/_header.php');
?>


<div class="col-12 stretch-card">
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">Change password</h4>
        <p class="card-description text-danger"> <?php if(isset($message)){  echo $message; } ?> </p>
        <form class="forms-sample" method = "post" action="">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Username</label>
            <div class="col-sm-9">
                <p class="form-control"><?php echo $username ?></p>
            </div>
        </div>
        <div class="form-group row">
            <label for="oldPassword " class="col-sm-3 col-form-label">Old Password</label>
            <div class="col-sm-9">
            <input type="password" class="form-control" id="oldPassword" placeholder="Old Password" name="old_password">
            </div>
        </div>
        <div class="form-group row">
            <label for="newPassword " class="col-sm-3 col-form-label">New Password</label>
            <div class="col-sm-9">
            <input type="password" class="form-control" id="newPassword" placeholder="New Password" name="new_password">
            </div>
        </div>
        <div class="form-group row">
            <label for="confirmPassword " class="col-sm-3 col-form-label">Confirm New Password</label>
            <div class="col-sm-9">
            <input type="password" class="form-control" id="confirmPassword" placeholder="Rewrite New Password" name="confirm_password">
            </div>
        </div>
        <button type="submit" class="btn btn-success mr-2" name = "submit" value = "submit">Submit</button>
        <button class="btn btn-light" name="cancel" value="cancel">Cancel</button>
        </form>
        
       
    </div>
    </div>
</div>

<?php include('partials/_footer.php');
    
?>