<?php

require 'includes/config.inc.php';
require 'includes/database.php';
require 'includes/functions.php';

require 'includes/header.php';

if(isset($_SESSION['id'])){
    header("Location: dashboard.php");
    die();
}

if(isset($_POST['email'])){

    if($stmt = $connect->prepare("SELECT * FROM users WHERE email = ? AND password = ? AND active = 1")){

        $password = $_POST['password'];
        $email = $_POST['email'];
        $stmt->bind_param('ss', $email, $_POST['password']);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if($user){
            $_SESSION['id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['username'] = $user['username'];

            set_message("You Have Successfully Login");

            header("Location: dashboard.php");
            die();
        }
        $stm->close();

    } else{
        echo 'Could not prepare statement!';
    }
}

?>

<div class="container">
    <br>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form method = "post">
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

                <!-- Submit button -->
                <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block">Sign in</button>
            </form>
        </div>
    </div>
</div>


<?php
include 'includes/footer.php';
?>