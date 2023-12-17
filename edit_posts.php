<?php
require 'includes/config.inc.php';
require 'includes/database.php';
require 'includes/functions.php';
not_logged_in_action();

require 'includes/header.php';

if(isset($_POST['title'])){

    if($stmt = $connect->prepare("UPDATE posts set title = ?, author = ?, content = ?, date = ? WHERE id = ?")){

        $stmt->bind_param('ssssi', $_POST['title'], $_POST['author'], $_POST['content'], $_POST['date'], $_GET['id']);
        $stmt->execute();
        $stmt->close();

        set_message("".$_POST['title']." Post Updated!");
        header("Location: posts.php");


    } else{

        echo "Could not prepare statement!";

    }

}

if(isset($_GET['id'])){

    if($stmt = $connect->prepare("SELECT * FROM posts WHERE id = ?")){

        $stmt->bind_param('i', $_GET['id']);
        $stmt->execute();

        $result = $stmt->get_result();
        $post = $result->fetch_assoc();

        if($post){

    
?>

<div class="container">
    <br>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1>Edit Post :</h1><hr>

            <form method = "post">
                <!-- Username input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input 
                        type="text" 
                        id="title" 
                        name = "title" 
                        class="form-control active" 
                        value="<?php echo $post['title'] ?>"
                    
                    />
                    <label class="form-label" for="title">Title</label>
                </div>

                <!-- author input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input value="<?php echo $post['author'] ?>" type="author" id="author" name = "author" class="form-control active" />
                    <label class="form-label" for="author">author</label>
                </div>

                <!-- content input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <textarea id="content" name = "content" <?php echo $post['content'];  ?>>
                    </textarea>
                </div>

                <!-- Active Select -->
                <div class="form-outline mb-4">
                    <input type="date" name="date" class="form-control" value="<?php echo $user['date'];?>">
                </div>

                <!-- Submit button -->
                <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block">Edit post</button>
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


<script src="js/tinymce/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: '#content'
    });
</script>