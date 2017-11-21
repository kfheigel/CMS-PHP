<?php 
if(isset($_POST['create_post'])){
    
    $post_title         = escape($_POST['post_title']);
    $post_category_id   = escape($_POST['post_category'];)
    $post_user          = escape($_POST['post_user'];)
    $post_status        = escape($_POST['post_status'];)
    
    $post_image         = escape($_FILES['post_image']['name'];)
    $post_image_temp    = escape($_FILES['post_image']['tmp_name'];)
    
    $post_tags          = escape($_POST['post_tags'];)
    $post_content       = escape($_POST['post_content'];)
    $post_date          = escape(date('d-m-y'));    
    
    move_uploaded_file($post_image_temp, "../images/$post_image");
    
    $query  = "INSERT INTO posts(post_title, post_category_id, post_user, post_status, post_image, post_tags, post_content, post_date) ";
    $query .= "VALUES('{$post_title}', {$post_category_id}, '{$post_user}', '{$post_status}', '{$post_image}', '{$post_tags}', '{$post_content}', now())";
    
    $create_post_query = mysqli_query($connection, $query);
    
    confirm($create_post_query);
    
    $the_post_id = mysqli_insert_id($connection);
    
    echo "<p class='bg-success'>Post Created. <a href='../post.php?p_id={$the_post_id}'>View Post</a> or <a href='posts.php'> Edit Other Posts</a></p>";
    
}

?>
  

  <form action="" method="post" enctype="multipart/form-data">
   
    <div class="form-group">
       <label for="post_title">Post Title</label>
       <input type="text" class="form-control" name="post_title">
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
        <label for="post_user">Users</label><br>

        <select class="form-control" name="post_user" id="">
            <option value="klekseusz">Users</option>
        <?php
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
<!--
    
    <div class="form-group">
       <label for="post_author">Post Author</label>
       <input type="text" class="form-control" name="post_author">
    </div>
-->
    
    <div class="form-group">
        <label for="post_category">Post Status</label><br>

        <select class="form-control" name="post_status" id="">
            <option value="draft">Post Status</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
        </select>
    </div>
    
    <div class="form-group">
       <label for="post_image">Image</label>
       <input type="file" class="form-control" name="post_image">
    </div>
    
    <div class="form-group">
       <label for="post_tags">Tags</label>
       <input type="text" class="form-control" name="post_tags">
    </div>
    
    <div class="form-group">
       <label for="post_content">Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"></textarea>
    </div>
    
    <div class="form-group">
       <input type="submit" class="btn btn-primary" name="create_post" value="Publish">
    </div>
    
</form>

