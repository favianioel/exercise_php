<?php 
require_once(__DIR__.'/../init.php');
$selected = 'articles';

include __DIR__.'/header.php';
?>
<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Articles</h2>
                        <a href="create_article.php" class="btn btn-success pull-right">Add New Articles</a>
                    </div>
                    <table class='table table-bordered table-striped'>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>id</td>
                                <td>titlu</td>
                                <td>
                                    <a href='view_article.php?id=' title='View Article' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>
                                    <a href='update_article.php?id=' title='Update Article' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>
                                </td>
                            </tr>
                        </tbody>                            
                    </table>
                </div>
            </div>        
        </div>
    </div>
    <script type="text/javascript">
        
    </script>
<?php 
include __DIR__.'/footer.php';