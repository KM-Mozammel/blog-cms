<?php
require 'includes/config.inc.php';
require 'includes/database.php';

require 'includes/functions.php';
not_logged_in_action();

require 'includes/header.php';

if(isset($_POST['username'])){

    if($stmt = $connect->prepare("INSERT INTO users (username, email, password, active) VALUES(?, ?, ?, ?)")){

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = sha1($_POST['password']);
        $activity = $_POST['active'];
        $stmt->bind_param('ssss', $username, $email,  $password, $activity);
        $stmt->execute();

        set_message("A new user has been added by ". $_SESSION['username']);
        header("Location: users.php");
        die();
        $stm->close();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        
    } else{
        echo 'Could not prepare statement!';
    }



}

        
?>

<div class="container">
    <br>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1>Add user</h1><hr>

            <form method = "post">
                <!-- Username input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" id="username" name = "username" class="form-control" />
                    <label class="form-label" for="form1Example1">Username</label>
                </div>

                <!-- Email input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="email" id="email" name = "email" class="form-control" />
                    <label class="form-label" for="form1Example1">Email address</label>
                </div>

                <!-- Password input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="password" id="password" name = "password" class="form-control" />
                    <label class="form-label" for="form1Example2">Password</label>
                </div>

                <!-- Active Select -->
                <div class="form-outline mb-4">
                    <select class="form-select" name="active" id="active">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <!-- Submit button -->
                <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block">Add user</button>
            </form>

            
        </div>
    </div>
</div>

<?php
include 'includes/footer.php';
?>