<?php
require_once __DIR__ . '/../init.php';
require_once __DIR__ . '/../src/functions.php';

use Exercise\Db;


// Default index page
router('GET', '^/$', function() {
	$file = __DIR__ . '/../templates/articles.php';
	$output = template( $file, [] );
	print $output;
});

router('GET', '^/test$', function() {
	$file = __DIR__ . '/test.html';
	$output = template( $file, [] );
	print $output;
});

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

// POST request to /autors
router('POST', '^/authors$', function() {
    header('Content-Type: application/json');
    $json = json_decode(file_get_contents('php://input'), true);
    echo json_encode(['result' => 1]);
});

header("HTTP/1.0 404 Not Found");
echo '404 Not Found';