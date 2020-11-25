<?php

require_once(__DIR__.'/init.php');
use Exercise\Db;

// Check existence of id parameter before processing further
if(isset($_GET["name"]) && !empty(trim($_GET["name"]))){
    $db = new Db();

    $param_id = trim($_GET["id"]);
    $param_name = trim($_GET["name"]);

    $result = $db->viewCategory($param_id);
    $results = $result->fetchAll();
}

include __DIR__.'/templates/header.php';
?>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>View Categorie</h1>
                    </div>
                    <div class="form-group">
                        <label>Categorie</label>
                        <p class="form-control-static"><?php echo $param_name ?></p>
                    </div>
                   <div class="form-group">
                		<label>Titles</label>
                    	<?php foreach ($results as $key => $value) {
	                    	echo '<p class="form-control-static">'. $value['title'] .'</p>';
                    	} ?>
					</div>
                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
<?php 
include __DIR__.'/templates/footer.php';

