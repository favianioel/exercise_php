<?php

require_once(__DIR__.'/init.php');
use Exercise\Db;

// Define variables and initialize with empty values
$title = $author  = "";
$title_err = $author_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate title
    $input_title = trim($_POST["title"]);
    if(empty($input_title)){
        $title_err = "Please enter a title.";
    } else{
        $title = $input_title;
    }
    
    // Validate author author
    $input_author = trim($_POST["author"]);
    if(empty($input_author)){
        $author_err = "Please enter an author.";     
    } else{
        $author = $input_author;
    }
    
    // Check input errors before inserting in database
    if(empty($title_err) && empty($author_err)){
        $db = new Db();
        $db->insert('articles', ['title'=> $title, 'author_id' => $author]);
        header("location: index.php");
        exit();
    }

}
include __DIR__.'/templates/header.php';
?>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Create Article</h2>
                    </div>
                    <p>Please fill this form and submit to add a new article to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($title_err)) ? 'has-error' : ''; ?>">
                            <label>title</label>
                            <input type="text" name="title" class="form-control" value="<?php echo $title; ?>">
                            <span class="help-block"><?php echo $title_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($author_err)) ? 'has-error' : ''; ?>">
                            <label>author</label>
                            <input name="author" class="form-control"><?php echo $author; ?></textarea>
                            <span class="help-block"><?php echo $author_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
<?php 
include __DIR__.'/templates/footer.php';