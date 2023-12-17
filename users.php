<?php
require 'includes/config.inc.php';
require 'includes/database.php';

require 'includes/functions.php';
not_logged_in_action();

require 'includes/header.php';

if(isset($_GET['delete'])){


    $stmt = $connect->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param('i', $_GET['delete']);
    $stmt->execute();

    set_message("User Delete by ".$_SESSION['username']."");
    header("Location: users.php");
    
    $stmt->close();
    die();

}


if($stmt = $connect->prepare('SELECT * FROM users')){
    $stmt->execute();

    $result = $stmt->get_result();
    $users = $result->fetch_assoc();

    if($users){


        
        ?>

<div class="container">
    <br>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1>Users Management</h1><hr>
            
            <a href="add_users.php">Add new user</a>

            <table class="table table-striped table-hover">
                <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Edit | Delete</th>
                </tr>

                <?php while($record = mysqli_fetch_assoc($result)){ ?> 
                    
                <tr>
                    <td> <?php echo $record['id']; ?></td>
                    <td> <?php echo $record['username']; ?></td>
                    <td> <?php echo $record['email']; ?></td>
                    <td> <?php echo $record['active']; ?></td>
                    <td>
                        <a href="edit_users.php?id=<?php echo $record['id']; ?>">Edit</a>
                        |
                        <a href="users.php?delete=<?php echo $record['id']; ?>">Delete</a>
                    </td>
                </tr>
                
                <?php } ?>

            </table>


        </div>
    </div>
</div>

<?php

} $stmt->close();

} else{
    echo 'Could not found any user!';
}
?>


<?php
include 'includes/footer.php';
?>