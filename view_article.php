<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    include("includes/config.php");
    
    // Prepare a select statement
    $sql = "SELECT articles.id, articles.title, articles.description, authors.name FROM articles 
            INNER JOIN authors ON articles.author_id=authors.id 
            WHERE articles.id = ?";


    // queries all movies of an author
    // $sql = "SELECT authors.name, articles.title  FROM authors 
    //         INNER JOIN articles ON authors.id=articles.author_id
    //         WHERE authors.id = ?";
    
    
    if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            $result = $stmt->get_result();

            
            if($result->num_rows == 1){
                /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                $row = $result->fetch_array(MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $title = $row["title"];
                $author = $row["name"];
                $description = $row['description'];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            // Close statement
            $stmt->close();
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    
    // Close connection
    $mysqli->close();
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("includes/head-tag-contents.php");?>
</head>
<body>
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
</body>
</html>
