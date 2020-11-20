<?php
// Check existence of id parameter before processing further
if(isset($_GET["name"]) && !empty(trim($_GET["name"]))){
    // Include config file
    include("includes/config.php");

    $sql = "SELECT articles.title  FROM articles 
            INNER JOIN authors ON authors.id=articles.author_id
            WHERE authors.name = ?";
    
    if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("s", $param_name);
        
        // Set parameters
        $param_name = trim($_GET["name"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            $result = $stmt->get_result();
        	$results = $result->fetch_all(MYSQLI_ASSOC);
            
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
                        <h1>View Author</h1>
                    </div>
                    <div class="form-group">
                        <label>Author</label>
                        <p class="form-control-static"><?php echo $param_name ?></p>
                    </div>
                   <div class="form-group">
                		<label>titles</label>
                    	<?php foreach ($results as $key => $value) {
	                    	echo '<p class="form-control-static">'. $value['title'] .'</p>';
                    	} ?>
					</div>
                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
