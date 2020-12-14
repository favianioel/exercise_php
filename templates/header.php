<!DOCTYPE html>
<html lang="en">

<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/underscore@1.12.0/underscore-min.js"></script>
	<script type="text/javascript" src="backbone/backbone.js"></script>
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