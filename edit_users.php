<?php
require 'includes/config.inc.php';
require 'includes/database.php';
require 'includes/functions.php';
not_logged_in_action();

require 'includes/header.php';

if(isset($_POST['username'])){

    if($stmt = $connect->prepare("UPDATE users set username = ?, email = ?, active = ?, password = ? WHERE id = ?")){

        $stmt->bind_param('ssssi', $_POST['username'], $_POST['email'], $_POST['active'], $_POST['password'], $_GET['id']);
        $stmt->execute();
        $stmt->close();

        set_message("".$_POST['username']." User Updated!");
        header("Location: users.php");


    } else{

        echo "Could not prepare statement!";

    }

}

if(isset($_GET['id'])){

    if($stmt = $connect->prepare("SELECT * FROM users WHERE id = ?")){

        $stmt->bind_param('i', $_GET['id']);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if($user){

    
?>

<div class="container">
    <br>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1>Edit User :</h1><hr>

            <form method = "post">
                <!-- Username input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input 
                        type="text" 
                        id="username" 
                        name = "username" 
                        class="form-control active" 
                        value="<?php echo $user['username'] ?>"
                    
                    />
                    <label class="form-label" for="form1Example1">Username</label>
                </div>

                <!-- Email input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input value="<?php echo $user['email'] ?>" type="email" id="email" name = "email" class="form-control active" />
                    <label class="form-label" for="form1Example1">Email address</label>
                </div>

                <!-- Password input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input value="<?php echo $user['password'] ?>" type="text" id="password" name = "password" class="form-control active" />
                    <label class="form-label" for="form1Example2">Password</label>
                </div>

                <!-- Active Select -->
                <div class="form-outline mb-4">
                    <select class="form-select active" name="active" id="active">
                        <option <?php echo ($user['active']) ? "selected" : "";?> value="1">Active</option>
                        <option <?php echo ($user['active']) ? "" : "selected";?> value="0">Inactive</option>
                    </select>
                </div>

                <!-- Submit button -->
                <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block">Update user</button>
            </form>

            
        </div>
    </div>
</div>

<?php


}
$stmt->close();


} else{
echo 'Could not prepare statement!';
}

} else{
echo "No user selected";
die();
} 

include 'includes/footer.php';
?>
