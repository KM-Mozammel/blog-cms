<?php
require 'includes/config.inc.php';
require 'includes/database.php';

require 'includes/functions.php';
not_logged_in_action();

require 'includes/header.php';

if(isset($_GET['delete'])){


    $stmt = $connect->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->bind_param('i', $_GET['delete']);
    $stmt->execute();

    set_message("A post Delete by ".$_SESSION['username']."");
    header("Location: posts.php");
    
    $stmt->close();

}


if($stmt = $connect->prepare('SELECT * FROM posts')){
    $stmt->execute();

    $result = $stmt->get_result();
    $users = $result->fetch_assoc();

    if($users){


        
?>

<div class="container">
    <br>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1>Posts Management</h1><hr>
            
            <a href="add_posts.php">Add new post</a>

            <table class="table table-striped table-hover">
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Author</th>
                    <th>Publish Time</th>
                    <th>Edit | Delete</th>
                </tr>

                <?php while($record = mysqli_fetch_assoc($result)){ ?> 
                    
                <tr>
                    <td> <?php echo $record['id']; ?></td>
                    <td> <?php echo $record['title']; ?></td>
                    <td> <?php echo substr($record['content'], 0, 30).'.....'; ?></td>
                    <td> <?php echo $record['author']; ?></td>
                    <td> <?php echo $record['date']; ?></td>
                    <td>
                        <a href="edit_posts.php?id=<?php echo $record['id']; ?>">Edit</a>
                        |
                        <a href="posts.php?delete=<?php echo $record['id']; ?>">Delete</a>
                    </td>
                </tr>
                
                <?php } ?>

            </table>


        </div>
    </div>
</div>

<?php

}else{
    echo 'No post Found';
    $stmt->close();  
} 

} else{
    echo 'Could not found any user!';
}
?>


<?php
include 'includes/footer.php';
?>