<?php 
if(isset($_POST['create_user'])){
    
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $user_name = $_POST['user_name'];
    
    $user_password = password_hash($user_password,PASSWORD_BCRYPT, array('cost'=>10) );

    
//    $user_image = $_FILES['user_image']['name'];
//    $user_image_temp = $_FILES['user_image']['tmp_name'];
////    post_date = date('d-m-y');    
//    
//    move_uploaded_file($user_image_temp, "../images/$user_image");
//    
    $query  = "INSERT INTO users(user_name, user_password, user_firstname, user_lastname, user_email, user_role) ";
    $query .= "VALUES('{$user_name}', '{$user_password}', '{$user_firstname}', '{$user_lastname}', '{$user_email}', '{$user_role}')";
    
    $create_user_query = mysqli_query($connection, $query);
    
    confirm($create_user_query);
    
    echo "User Created: " . " " . "<a href='users.php'>View Users</a>";
    
}

?>
  

  <form action="" method="post" enctype="multipart/form-data">
   
    <div class="form-group">
       <label for="user_firstname">First Name</label>
       <input type="text" class="form-control" name="user_firstname">
    </div>
    
    <div class="form-group">
       <label for="user_lastname">Last Name</label>
       <input type="text" class="form-control" name="user_lastname">
    </div>
    
    <div class="form-group">
        <label for="user_role">Role</label><br>
        <select class="form-control" name="user_role" id="">
            <option value="Subscriber">Select Options</option>
            <option value="Admin">Admin</option>
            <option value="Subscriber">Subscriber</option>
        </select>
    </div>
    
<!--
    <div class="form-group">
       <label for="user_image">Image</label>
       <input type="file" class="form-control" name="user_image">
    </div>
-->
    
    <div class="form-group">
       <label for="user_name">Username</label>
       <input type="text" class="form-control" name="user_name">
    </div>
    
    <div class="form-group">
       <label for="user_email">E-mail</label>
        <input type=email class="form-control" name="user_email" >
    </div>
    
    <div class="form-group">
       <label for="user_password">Password</label>
        <input type=password class="form-control" name="user_password" >
    </div>
    
    <div class="form-group">
       <input type="submit" class="btn btn-primary" name="create_user" value="Create">
    </div>
    
</form>

