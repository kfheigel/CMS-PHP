<?php 
function insert_categories(){
    global $connection;
    
    if(isset($_POST['submit'])){
        $cat_title = $_POST['cat_title'];
        if($cat_title == '' || empty($cat_title)){
            echo "This field should not be empty";
        }else{
            
            $stmt = mysqli_prepare($connection, "INSERT INTO categories(cat_title) VALUES(?) ");
            mysqli_stmt_bind_param($stmt, 's', $cat_title);
            
            mysqli_stmt_execute($stmt);

            if(!$stmt){
                die("Query Failed" . mysqli_error($connection));
            }
            mysqli_stmt_close($stmt); 
        }
    }
}

function redirect($location){
    header("Location:" . $location);
    exit;
}

function ifItIsMethod($method=null){
    if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){
        return true;
    }else{
        return false;
    }
}

function isLoggedIn(){
    if(isset($_SESSION['user_role'])){
        return true;
    }
    return false;
}

function checkIfUserIsLoggedInAndRedirect($redirectLocation=null){
    if(isLoggedIn()){
        redirect($redirectLocation);
    }
}


function findAllCategories(){
    global $connection;
    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_categories)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete<a/></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit<a/></td>";
        echo "</tr>";
    }
}

function delete_categories(){
    global $connection;    
    if(isset($_GET['delete'])){
        $the_cat_id = $_GET['delete'];

        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
        $delete_query = mysqli_query($connection, $query);
        header("Location: categories.php");  
    }
}

function confirm($result){
    global $connection;
    if(!$result){
        die("Query Failed" . mysqli_error($connection));
    }
}

function users_online() {
    if(isset($_GET['onlineusers'])) {
        global $connection;
        
        if(!$connection) {
            session_start();
            $db['db_host'] = 'localhost';
            $db['db_user'] = 'root';
            $db['db_pass'] = '';
            $db['db_name'] = 'cms';

            foreach($db as $key => $value){ 
                define(strtoupper($key), $value);  
            }

            $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            
            $session = session_id();
            $time = time();
            $time_out_in_seconds = 05;
            $time_out = $time - $time_out_in_seconds;
            $query = "SELECT * FROM users_online WHERE session = '$session'";
            $send_query = mysqli_query($connection, $query);
            $count = mysqli_num_rows($send_query);
            if($count == NULL) {
                mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session','$time')");
            } 
            else {
                mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
            }
            $users_online_query =  mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
            echo $count_user = mysqli_num_rows($users_online_query);
        }
    } // get request isset()
}
users_online();

function escape($string){
    global $connection;
    return mysqli_real_escape_string($connection, trim($string));
}



function recordCount($table){
    global $connection;
    $query  = "SELECT * FROM $table";
    $select = mysqli_query($connection, $query);
    $result = mysqli_num_rows($select);
    confirm($result);
    return $result;
}

function checkStatus($table, $column, $status){
    global $connection;
    echo $table, $column, $status;
    $query  = "SELECT * FROM $table WHERE $column = '$status'";
    $select = mysqli_query($connection, $query);
    $result = mysqli_num_rows($select);
    confirm($result);
    return $result;
}


function is_admin($username){
    global $connection;
    
    $query = "SELECT user_role FROM users WHERE user_name= '$username'";
    $result = mysqli_query($connection, $query);
    confirm($result);
    
    $row = mysqli_fetch_array($result);
    
    if($row['user_role'] == 'Admin'){
        return true;
    }else{
        return false;
    }
}

function username_exists($username){
    global $connection;
    $query = "SELECT user_name FROM users WHERE user_name = '$username'";
    $result = mysqli_query($connection, $query);
    confirm($result);
    
    if(mysqli_num_rows($result)>0){
        return true;
    }else{
        return false;
    }
}


function email_exists($email){
    global $connection;
    $query = "SELECT user_email FROM users WHERE user_email = '$email'";
    $result = mysqli_query($connection, $query);
    confirm($result);
    
    if(mysqli_num_rows($result)>0){
        return true;
    }else{
        return false;
    }
}

function register_user($username, $email, $password){
    global $connection;

    $username   = mysqli_real_escape_string($connection, $username);
    $email      = mysqli_real_escape_string($connection, $email);
    $password   = mysqli_real_escape_string($connection, $password);

    $password = password_hash($password,PASSWORD_BCRYPT, array('cost'=>10) );

    $query = "INSERT INTO users (user_name, user_email, user_password, user_role) ";
    $query .= "VALUES('{$username}','{$email}','{$password}','subscriber')";
    $register_user_query = mysqli_query($connection,$query);

    confirm($register_user_query);   

}

function login_user($user_name, $user_password){
    global $connection;
    $user_name     = trim($user_name);
    $user_password  = trim($user_password);
    
    $user_name      =   mysqli_real_escape_string($connection,$user_name);
    $user_password  =   mysqli_real_escape_string($connection,$user_password);
    
    
    $query="SELECT * FROM users WHERE user_name = '{$user_name}'";
    $select_user_query  =   mysqli_query($connection,$query);
    
    confirm($select_user_query);
    
    while($row=mysqli_fetch_array($select_user_query)){
        $db_user_id         =   $row['user_id'];
        $db_user_name       =   $row['user_name'];
        $db_user_firstnamef =   $row['user_firstname'];
        $db_user_lastname   =   $row['user_lastname'];
        $db_user_password   =   $row['user_password'];
        $db_user_role       =   $row['user_role'];
        
        if(password_verify($user_password, $db_user_password)){
            $_SESSION['username']       =   $db_user_name;
            $_SESSION['firstname']      =   $db_user_firstnamef;
            $_SESSION['lastname']       =   $db_user_lastname;
            $_SESSION['user_role']      =   $db_user_role; 

            header("Location: /cms/admin");
        }else{
            return false;
        }
    }
        
}
    







?>