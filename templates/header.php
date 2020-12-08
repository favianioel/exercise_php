<!DOCTYPE html>
<html lang="en">

<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
	<script type="text/javascript" src="http://ajax.cdnjs.com/ajax/libs/underscore.js/1.1.4/underscore-min.js"></script>
	<script type="text/javascript" src="http://ajax.cdnjs.com/ajax/libs/backbone.js/0.3.3/backbone-min.js"></script>
	<style type="text/css">
	    .wrapper{
	        width: 650px;
	        margin: 0 auto;
	    }
	    .page-header h2{
	        margin-top: 0;
	    }
	    table tr td:last-child a{
	        margin-right: 15px;
	    }
	</style>
	<script type="text/javascript">
	    $(document).ready(function(){
	        $('[data-toggle="tooltip"]').tooltip();   
	    });
	</script>
</head>
<body>

<div class="container">
	<ul class="nav nav-tabs">
	  <li role="presentation" class="<?php if ($selected == "articles")   echo 'active'; ?>">
	    <a href="/">Articles</a></li>
	  <li role="presentation" class="<?php if ($selected == "authors")    echo 'active'; ?>">
	    <a href="/authors">Authors</a></li>
	  <li role="presentation" class="<?php if ($selected == "categories") echo 'active'; ?>">
	    <a href="/categories">Categories</a></li>
	</ul>
</div>