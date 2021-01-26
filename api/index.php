<?php
require_once __DIR__ . '/../init.php';
require_once __DIR__ . '/../src/functions.php';
header('Content-Type: application/json');

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

// PUT requests
router('PUT', '^/api/articles/(?<id>\d+)$', function() {
	$input = file_get_contents("php://input");
	$input = json_decode($input);
	
	$db 	= new Db();
    $result = $db->updateArticleById($input->id, $input->title, $input->author_id, $input->description);
    echo json_encode($result->fetchAll());
});
router('PUT', '^/api/articles/$', function() {
	$input = file_get_contents("php://input");
	$input = json_decode($input);
	$db 	= new Db();
    $result = $db->createArticle($input->title, $input->author_id, $input->description);
    echo json_encode($result->fetchAll());
});

router('PUT', '^/api/authors/(?<id>\d+)$', function() {
	$input = file_get_contents("php://input");
	$input = json_decode($input);
	
	$db 	= new Db();
    $result = $db->updateAuthorById($input->id, $input->name);
    echo json_encode($result->fetchAll());
});
router('PUT', '^/api/authors/$', function() {
	$input = file_get_contents("php://input");
	$input = json_decode($input);
	$db 	= new Db();
    $result = $db->createAuthor($input->name);
    echo json_encode($result->fetchAll());
});

router('PUT', '^/api/categories/(?<id>\d+)$', function() {
	$input = file_get_contents("php://input");
	$input = json_decode($input);
	$db 	= new Db();
    $result = $db->updateCategoryById($input->id, $input->categorie);
    echo json_encode($result->fetchAll());
});
router('PUT', '^/api/categories/$', function() {
	$input = file_get_contents("php://input");
	$input = json_decode($input);
	$db 	= new Db();
    $result = $db->createCategory($input->categorie);
    echo json_encode($result->fetchAll());
});

// DELETE requests
router('DELETE', '^/api/articles/(?<id>\d+)$', function($params) {
	$db = new Db();
	$result = $db->delete("articles", $params['id']);
    echo json_encode($result);
});
router('DELETE', '^/api/authors/(?<id>\d+)$', function($params) {
	$db = new Db();
	$result = $db->delete("authors", $params['id']);
    echo json_encode($result);
});
router('DELETE', '^/api/categories/(?<id>\d+)$', function($params) {
	$db = new Db();
	$result = $db->delete("categories", $params['id']);
    echo json_encode($result);
});

header("HTTP/1.0 404 Not Found");
echo '404 Not Found';