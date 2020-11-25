<?php 
require_once(__DIR__.'/init.php');
use Exercise\Db;

$selected = 'articles';

$db = new Db();
$result = $db->select('articles');

include __DIR__.'/templates/header.php';
?>
<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Articles</h2>
                        <a href="create_article.php" class="btn btn-success pull-right">Add New Articles</a>
                    </div>
                    <?php
                        if ($result){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Title</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                    
                                  // output data of each row
                                  while($row = $result->fetch()) {
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['title'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='view_article.php?id=". $row['id'] ."' title='View Article' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='update_article.php?id=". $row['id'] ."' title='Update Article' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                        echo "</td>";
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