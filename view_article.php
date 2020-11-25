<?php

require_once(__DIR__.'/init.php');
use Exercise\Db;

// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){

    $db = new Db();
     
    $param_id = trim($_GET["id"]);
    $result = $db->viewArticle($param_id);
    
    if($result){
        $row = $result->fetch();
        
        // Retrieve individual field value
        $title = $row["title"];
        $author = $row["name"];
        $description = $row['description'];
    }
    

} 
include __DIR__.'/templates/header.php';
?>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>View Article</h1>
                    </div>
                    <div class="form-group">
                        <label>title</label>
                        <p class="form-control-static"><?php echo $title; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Author</label>
                        <p class="form-control-static"><?php echo $author; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <p class="form-control-static"><?php echo $description; ?></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
<?php 
include __DIR__.'/templates/footer.php';
