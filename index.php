<?php
header("Content-Type: application/json");
require 'db.php';

$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

/*
|--------------------------------------------------------------------------
| HEALTH CHECK
|--------------------------------------------------------------------------
*/
if ($method === 'GET' && $uri === '/health') {
    echo json_encode(["status" => "ok"]);
    exit;
}

/*
|--------------------------------------------------------------------------
| GET ALL BOOKS
|--------------------------------------------------------------------------
*/
if ($method === 'GET' && $uri === '/books') {
    try {
        $stmt = $pdo->query("SELECT * FROM books ORDER BY id ASC");
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["error" => "Failed to fetch books"]);
    }
    exit;
}

/*
|--------------------------------------------------------------------------
| ADD BOOK
|--------------------------------------------------------------------------
*/
if ($method === 'POST' && $uri === '/books') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!isset($data['title']) || !isset($data['author'])) {
        http_response_code(400);
        echo json_encode(["error" => "Title and author required"]);
        exit;
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO books (title, author) VALUES (?, ?)");
        $stmt->execute([$data['title'], $data['author']]);

        echo json_encode(["message" => "Book added"]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["error" => "Failed to add book"]);
    }
    exit;
}

/*
|--------------------------------------------------------------------------
| DELETE BOOK
|--------------------------------------------------------------------------
*/
if ($method === 'DELETE') {
    if (preg_match('#^/books/(\d+)$#', $uri, $matches)) {
        $id = $matches[1];

        try {
            $stmt = $pdo->prepare("DELETE FROM books WHERE id = ?");
            $stmt->execute([$id]);

            echo json_encode(["message" => "Book deleted"]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(["error" => "Failed to delete book"]);
        }
        exit;
    }
}

/*
|--------------------------------------------------------------------------
| DEFAULT RESPONSE
|--------------------------------------------------------------------------
*/
http_response_code(404);
echo json_encode(["error" => "Route not found"]);

