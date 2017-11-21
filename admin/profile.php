<?php include "includes/admin_header.php"; ?>   
<?php 
if(isset($_SESSION['user_name'])){
    $user_name = $_SESSION['user_name'];
    
    $query = "SELECT * FROM users WHERE user_name = '{$user_name}'";
    
    $select_user_profile_query = mysqli_query($connection, $query);
    
    while($row = mysqli_fetch_array($select_user_profile_query)){
        $user_id            = $row['user_id'];
        $user_name          = $row['user_name'];
        $user_password      = $row['user_password'];
        $user_firstname     = $row['user_firstname'];
        $user_lastname      = $row['user_lastname'];
        $user_email         = $row['user_email'];
//        $user_image         = $row['user_image'];
        $user_role          = $row['user_role'];

    }
    
}
?>
   
   
<?php 
if(isset($_POST['edit_user'])){
    
    $user_firstname = $_POST['user_firstname'];
    $user_lastname  = $_POST['user_lastname'];
    $user_role      = $_POST['user_role'];
    $user_email     = $_POST['user_email'];
    $user_password  = $_POST['user_password'];
    $user_name      = $_POST['user_name'];
   
    
//    $user_image = $_FILES['user_image']['name'];
//    $user_image_temp = $_FILES['user_image']['tmp_name'];
//    post_date = date('d-m-y');    
    
//    move_uploaded_file($user_image_temp, "../images/$user_image");

    
    $query  = "UPDATE users SET ";
    $query .= "user_name = '{$user_name}', ";
    $query .= "user_password = '{$user_password}', ";
    $query .= "user_firstname = '{$user_firstname}', ";
    $query .= "user_lastname = '{$user_lastname}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_role = '{$user_role}' ";
    $query .= "WHERE user_name = '{$user_name}'";
    
    $edit_user_query = mysqli_query($connection, $query);
    
    confirm($edit_user_query);
    
}

?>
    <div id="wrapper">
<!-- Navigation -->
<?php include "includes/admin_navigation.php"; ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                    
                        <h1 class="page-header">
                            Welcome to admin
                            
                            <small>Author</small>
                        </h1>
                        
<form action="" method="post" enctype="multipart/form-data">
   
    <div class="form-group">
       <label for="user_firstname">First Name</label>
       <input value="<?php echo $user_firstname; ?>" type="text" class="form-control" name="user_firstname">
    </div>
    
    <div class="form-group">
       <label for="user_lastname">Last Name</label>
       <input value="<?php echo $user_lastname; ?>" type="text" class="form-control" name="user_lastname">
    </div>
    
    <div class="form-group">
        <label for="user_role">Role</label><br>
        <select class="form-control" name="user_role" id="">
            <option value="Subscriber"><?php echo $user_role; ?></option>
           <?php 
            if($user_role == 'Admin'){
                echo '<option value="Subscriber">Subscriber</option>';

            }else{
                echo '<option value="Admin">Admin</option>';
            }
            ?>
        </select>
    </div>
    
<!--
    <div class="form-group">
       <label for="user_image">Image</label>
       <input value="<?php echo $user_image; ?>"type="file" class="form-control" name="user_image">
    </div>
-->
    
    <div class="form-group">
       <label for="user_name">Username</label>
       <input value="<?php echo $user_name; ?>" type="text" class="form-control" name="user_name">
    </div>
    
    <div class="form-group">
       <label for="user_email">E-mail</label>
        <input value="<?php echo $user_email; ?>" type=email class="form-control" name="user_email" >
    </div>
    
    <div class="form-group">
       <label for="user_password">Password</label>
        <input value="<?php echo $user_password; ?>" type=password class="form-control" name="user_password" >
    </div>
    
    <div class="form-group">
       <input type="submit" class="btn btn-primary" name="edit_user" value="Update Profile">
    </div>
    
</form>
                        
                   
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include "includes/admin_footer.php"; ?>