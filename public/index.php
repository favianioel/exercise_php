<?php
require_once __DIR__ . '/../init.php';
require_once __DIR__ . '/../src/functions.php';
header('Access-Control-Allow-Origin: *');


use Exercise\Db;

// GET all entities from one table
router('GET', '^/authors$', function() {
	$db = new Db();
	$result = $db->selectAllByTable('authors');
	echo json_encode($result->fetchAll());
});

router('GET', '^/articles$', function() {
	$db = new Db();
	$result = $db->selectAllByTable('articles');
	echo json_encode($result->fetchAll());
});

router('GET', '^/categories$', function() {
	$db = new Db();
	$result = $db->selectAllByTable('categories');
	echo json_encode($result->fetchAll());
});

// GET individual entities
router('GET', '^/authors/(?<id>\d+)$', function($params) {
	$db = new Db();
	$result = $db->getAuthorById($params['id']);
    echo json_encode($result->fetchAll());
});

router('GET', '^/articles/(?<id>\d+)$', function($params) {
	$db = new Db();
	$result = $db->getArticleById($params['id']);
    echo json_encode($result->fetchAll());
});

router('GET', '^/categories/(?<id>\d+)$', function($params) {
	$db = new Db();
	$result = $db->getCategorieById($params['id']);
    echo json_encode($result->fetchAll());
});

// POST requests
router('POST', '^/articles$', function() {
	header('Content-Type: application/json');
	$input = file_get_contents("php://input");
	$json = json_decode($input,true);
    $db = new Db();
    $result = $db->createArticle($json["title"], $json["author"]);
    echo json_encode($result->fetchAll());
});

router('POST', '^/authors$', function() {
});

router('POST', '^/categories$', function() {
});

// PUT requests
router('PUT', '^/articles/(?<id>\d+)$', function() {
	$db = new Db();
    $result = $db->updateArticleById($title, $author, $id);
    echo json_encode($result->fetchAll());
});
router('PUT', '^/authors/(?<id>\d+)$', function() {
});
router('PUT', '^/categories/(?<id>\d+)$', function() {
});

// DELETE requests
router('DELETE', '^/articles/(?<id>\d+)$', function() {
	$db = new Db();
	$result = $db->delete("articles", $params['id']);
    echo json_encode($result->fetchAll());
});
router('DELETE', '^/authors/(?<id>\d+)$', function() {
	$db = new Db();
	$result = $db->delete("authors", $params['id']);
    echo json_encode($result->fetchAll());
});
router('DELETE', '^/categories/(?<id>\d+)$', function() {
	$db = new Db();
	$result = $db->delete("categories", $params['id']);
    echo json_encode($result->fetchAll());
});

header("HTTP/1.0 404 Not Found");
echo '404 Not Found';