<?php
require 'includes/config.inc.php';
require 'includes/functions.php';
not_logged_in_action();

require 'includes/header.php';

?>

<div class="container">
    <br>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1>Dashboard <?php echo $_SESSION['username'];?></h1>
            <hr>
            <a href="users.php">Users Management</a>
            |
            <a href="posts.php">Posts Management</a>
        </div>
    </div>
</div>


<?php
include 'includes/footer.php';
?>