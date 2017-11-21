<?php
if(isset($_GET['p_id'])){
    $the_post_id        = $_GET['p_id'];
    $query              = "SELECT * FROM posts WHERE post_id = $the_post_id";
    $select_posts_by_id = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_posts_by_id)){
        $post_id            = $row['post_id'];
        $post_user          = $row['post_user'];
        $post_title         = $row['post_title'];
        $post_category_id   = $row['post_category_id'];
        $post_status        = $row['post_status'];
        $post_image         = $row['post_image'];
        $post_content       = $row['post_content'];
        $post_tags          = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_date          = $row['post_date']; 
    }
}
if(isset($_POST['update_post'])){
    
    $post_title         = $_POST['post_title'];
    $post_category_id   = $_POST['post_category'];
//    $post_author        = $_POST['post_author'];
    $post_user          = $_POST['post_user'];
    $post_status        = $_POST['post_status'];
    
    $post_image         = $_FILES['post_image']['name'];
    $post_image_temp    = $_FILES['post_image']['tmp_name'];
    
    $post_tags          = $_POST['post_tags'];
    $post_content       = $_POST['post_content'];
    
    
    move_uploaded_file($post_image_temp, "../images/$post_image");
    
    if(empty($post_image)){
        
        $query          = "SELECT * FROM posts WHERE post_id = {$the_post_id} ";
        $select_image   = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_image)){
            $post_image = $row['post_image'];
        }
    }
    $query  = "UPDATE posts SET ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_category_id = {$post_category_id}, ";
    $query .= "post_user = '{$post_user}', ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_image = '{$post_image}', ";
    $query .= "post_tags = '{$post_tags}', ";
    $query .= "post_content = '{$post_content}', ";
    $query .= "post_date = now(), ";
    $query .= "post_comment_count = {$post_comment_count} ";
    $query .= "WHERE post_id = {$the_post_id}";
    
    $update_post_query = mysqli_query($connection, $query);
    
    confirm($update_post_query);
    
    echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id={$the_post_id}'>View Post</a> or <a href='posts.php'> Edit Other Posts</a></p>";
    
}
?>
  <form action="" method="post" enctype="multipart/form-data">
   
    <div class="form-group">
       <label for="post_title">Post Title</label>
       <input value="<?php echo isset($post_title) ? $post_title : ''; ?>" type="text" class="form-control" name="post_title">
    </div>
    
    <div class="form-group">
        <label for="post_category">Post Category</label><br>

        <select class="form-control" name="post_category" id="">

<?php
$query = "SELECT * FROM categories";
$select_categories = mysqli_query($connection, $query);
confirm($query);

while($row = mysqli_fetch_assoc($select_categories)){
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title']; 
    echo "<option value='$cat_id'>{$cat_title}</option>";
}            
?>
           
        </select>
    </div>
    
    <div class="form-group">
       <label for="post_user">Users</label>
        <select class="form-control" name="post_user" id="">
        <?php echo "<option value='$post_user'>{$post_user}</option>";
            
            $query = "SELECT * FROM users";
            $select_users = mysqli_query($connection, $query);
            confirm($select_users);

            while($row = mysqli_fetch_assoc($select_users)){
                $user_id = $row['user_id'];
                $user_name = $row['user_name']; 
                echo "<option value='$user_name'>{$user_name}</option>";
            }     
        ?>  
        </select>
    </div>
    
    
    <div class="form-group">
        <label for="post_status">Post Status</label><br>
        <select class="form-control" name="post_status" id="">
            
            <option value='<?php echo $post_status?>'><?php echo $post_status?></option>
            
<?php 
    
    if($post_status =='published'){
        echo "<option value='draft'>Draft</option>";
    }else{
        echo "<option value='published'>Publish</option>";        
    }
?>
        </select>
      </div>
      
      
<!--
    <div class="form-group">
       <label for="post_status">Post Status</label>
       <input value="<?php echo $post_status; ?>" type="text" class="form-control" name="post_status">
    </div>
-->
   
   
    <div class="form-group">
        <label for="post_image">Image</label><br/><br>
       <img width="100" src="../images/<?php echo $post_image?>" alt="">
       <input type="file" class="form-control" name="post_image">
    </div>
    
    <div class="form-group">
       <label for="post_tags">Tags</label>
       <input value="<?php echo isset($post_tags) ? $post_tags : ''; ?>" type="text" class="form-control" name="post_tags">
    </div>
    
    <div class="form-group">
       <label for="post_content">Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"><?php echo isset($post_content) ? str_replace('\r\n', '</br>', $post_content)  : ''; ?></textarea>
    </div>
    
    <div class="form-group">
       <input type="submit" class="btn btn-primary" name="update_post" value="Update">
    </div>
    
</form>