<?php
require_once __DIR__ . '/../init.php';
require_once __DIR__ . '/../src/functions.php';

use Exercise\Db;

// GET all entities from one table
router('GET', '^/api/authors$', function() {
	$db = new Db();
	$result = $db->selectAllByTable('authors');
	echo json_encode($result->fetchAll());
});

router('GET', '^/api/articles$', function() {
	$db = new Db();
	$result = $db->selectAllByTable('articles');
	echo json_encode($result->fetchAll());
});

router('GET', '^/api/categories$', function() {
	$db = new Db();
	$result = $db->selectAllByTable('categories');
	echo json_encode($result->fetchAll());
});

// GET individual entities
router('GET', '^/api/authors/(?<id>\d+)$', function($params) {
	$db = new Db();
	$result = $db->getAuthorById($params['id']);
    echo json_encode($result->fetchAll());
});

router('GET', '^/api/articles/(?<id>\d+)$', function($params) {
	$db = new Db();
	$result = $db->getArticleById($params['id']);
    echo json_encode($result->fetchAll());
});

router('GET', '^/api/categories/(?<id>\d+)$', function($params) {
	$db = new Db();
	$result = $db->getCategorieById($params['id']);
    echo json_encode($result->fetchAll());
});

// POST requests
router('POST', '^/api/articles$', function() {
	header('Content-Type: application/json');
	$input = file_get_contents("php://input");
	$json = json_decode($input);
	var_dump($input,$json);die;
    $db = new Db();
    $result = $db->createArticle($json["title"], $json["author"]);
    echo json_encode($result->fetchAll());
});

router('POST', '^/api/authors$', function() {
});

router('POST', '^/api/categories$', function() {
});

// PUT requests
router('PUT', '^/api/articles/(?<id>\d+)$', function() {
	$input = file_get_contents("php://input");
	$input = json_decode($input);
	
	$db 	= new Db();
    $result = $db->updateArticleById($input->id, $input->title, $input->author_id, $input->description);
    echo json_encode($result->fetchAll());
});
router('PUT', '^/api/authors/(?<id>\d+)$', function() {
});
router('PUT', '^/api/categories/(?<id>\d+)$', function() {
});

// DELETE requests
router('DELETE', '^/api/articles/(?<id>\d+)$', function() {
	$db = new Db();
	$result = $db->delete("articles", $params['id']);
    echo json_encode($result->fetchAll());
});
router('DELETE', '^/api/authors/(?<id>\d+)$', function() {
	$db = new Db();
	$result = $db->delete("authors", $params['id']);
    echo json_encode($result->fetchAll());
});
router('DELETE', '^/api/categories/(?<id>\d+)$', function() {
	$db = new Db();
	$result = $db->delete("categories", $params['id']);
    echo json_encode($result->fetchAll());
});

header("HTTP/1.0 404 Not Found");
echo '404 Not Found';