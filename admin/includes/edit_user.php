<?php 

if(isset($_GET['edit_user'])){
    $the_user_id        = escape($_GET['edit_user']);
    $query              = "SELECT * FROM users WHERE user_id = $the_user_id";
    $select_users_by_id = mysqli_query($connection, $query);


    while($row = mysqli_fetch_assoc($select_users_by_id)){
        $user_firstname = $row['user_firstname'];
        $user_lastname  = $row['user_lastname'];
        $user_role      = $row['user_role'];
        $user_email     = $row['user_email'];
        $user_password  = $row['user_password'];
        $user_name      = $row['user_name'];
    }

    if(isset($_POST['edit_user'])){

        $user_firstname = $_POST['user_firstname'];
        $user_lastname  = $_POST['user_lastname'];
        $user_role      = $_POST['user_role'];
        $user_email     = $_POST['user_email'];
        $user_password  = $_POST['user_password'];
        $user_name      = $_POST['user_name'];
        $post_date = date('d-m-y');  

        if(!empty($user_password)){
            $query_password = "SELECT user_password FROM users WHERE user_id= $the_user_id";
            $get_user_query = mysqli_query($connection, $query_password);

            confirm($get_user_query);

            $row = mysqli_fetch_array($get_user_query);
            $db_user_password = $row['user_password'];


        if($db_user_password != $user_password){
            $hashed_password = password_hash($user_password,PASSWORD_BCRYPT, array('cost'=>10));
        }


        $query  = "UPDATE users SET ";
        $query .= "user_name = '{$user_name}', ";
        $query .= "user_password = '{$hashed_password}', ";
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_role = '{$user_role}' ";
        $query .= "WHERE user_id = {$the_user_id}";

        $edit_user_query = mysqli_query($connection, $query);

        confirm($edit_user_query);

            echo "User Updated " . "<a href='users.php'>View Users</a>";

        }
    }
}else{
    header("Location: index.php");
}
?>
  

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
            <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
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
       <input type="submit" class="btn btn-primary" name="edit_user" value="Update user">
    </div>
    
</form>

