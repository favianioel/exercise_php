<?php 
require_once(__DIR__.'/init.php');
use Exercise\Db;

$selected = 'authors';

$db = new Db();
$result = $db->selectAllByTable('authors');

include __DIR__.'/templates/header.php';
?>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Authors</h2>
                        <!-- <a href="create.php" class="btn btn-success pull-right">Add New Categories</a> -->
                    </div>
                    <?php
                        if($result){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Author</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch()){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td><a href='view_author.php?name=". $row['name'] ."'>" . $row['name'] . "</a></td>";
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
<?php 
include __DIR__.'/templates/footer.php';