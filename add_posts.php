<?php
require 'includes/config.inc.php';
require 'includes/database.php';

require 'includes/functions.php';
not_logged_in_action();

require 'includes/header.php';

if(isset($_POST['title'])){

    if($stmt = $connect->prepare("INSERT INTO posts (title, content, author, date) VALUES(?, ?, ?, ?)")){

        $title = $_POST['title'];
        $content = $_POST['content'];
        $author = $_POST['author'];
        $date = $_POST['date'];
        $stmt->bind_param('sssd', $title, $content,  $author, $date);
        $stmt->execute();

        set_message("A new post has been added by ". $_SESSION['username']);
        header("Location: posts.php");
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
            <h1>Add post</h1><hr>

            <form method = "post">
                <!-- Title input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" id="title" name = "title" class="form-control" />
                    <label class="form-label" for="title">Title</label>
                </div>

                <!-- Author input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" id="author" name = "author" class="form-control" />
                    <label class="form-label" for="author">Author</label>
                </div>

                <!-- Content input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <textarea name="content" id="content"></textarea>
                </div>

                <!-- Date Select -->
                <div class="form-outline mb-4">
                    <input type="date" id="date" name="date" class="form-control active">
                    <label class="form-label" for="date">Date</label>
                </div>

                <!-- Submit button -->
                <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block">Add new post</button>
            </form>

            
        </div>
    </div>
</div>

<script src="js/tinymce/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: '#content'
    });
</script>

<?php
include 'includes/footer.php';
?>