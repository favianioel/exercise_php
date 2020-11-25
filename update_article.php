<?php

require_once(__DIR__.'/init.php');
use Exercise\Db;
 
// Define variables and initialize with empty values
$title = $author  = "";
$title_err = $author_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
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
        $result = $db->update('articles', ['title' => $title, 'author_id' => $author], ['id' => (int)$id]);
        header("location: index.php");
        exit();

    }
    
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);

        $db = new Db();
        $result = $db->select('articles', '*', ['id' => $id]);
        
        if($result){
            $row = $result->fetch();
            
            // Retrieve individual field value
            $title = $row["title"];
            $author = $row["author_id"];
        }
    }
}
include __DIR__.'/templates/header.php';
?>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update Article</h2>
                    </div>
                    <p>Please edit the input values and submit to update the article.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($title_err)) ? 'has-error' : ''; ?>">
                            <label>title</label>
                            <input type="text" name="title" class="form-control" value="<?php echo $title; ?>">
                            <span class="help-block"><?php echo $title_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($author_err)) ? 'has-error' : ''; ?>">
                            <label>author</label>
                            <input type="text" name="author" class="form-control" value="<?php echo $author; ?>">
                            <span class="help-block"><?php echo $author_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
<?php 
include __DIR__.'/templates/footer.php';