
<?php 
require_once(__DIR__.'/init.php');
use Exercise\Db;

$selected = 'categories';

$db = new Db();
$result = $db->select('categories');

include __DIR__.'/templates/header.php';
?>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Categories</h2>
                        <!-- <a href="create.php" class="btn btn-success pull-right">Add New Categories</a> -->
                    </div>
                    <?php
                        if($result){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Categorie</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch()){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td><a href='view_categories.php?name=".$row['categorie']."&id=". $row['id'] ."'>" . $row['categorie'] . "</a></td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                        }
                    ?>
                </div>
            </div>        
        </div>
    </div>
<?php include __DIR__.'/templates/footer.php';