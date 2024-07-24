<?php
// api.php
header('Content-Type: application/json');

// CORS configuration
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

$host = 'db';
$port = '5432';
$dbname = 'db';
$user = 'root';
$password = 'root';

$dsn = "pgsql:host=$host;port=$port;dbname=$dbname;";
try {
    $db = new PDO($dsn, $user, $password);

    // Simple router
    $method = $_SERVER['REQUEST_METHOD'];
    switch ($method) {
        case 'GET':
            handleGet($db);
            break;
            // Add cases for POST, PUT, DELETE as needed
        default:
            echo json_encode(["error" => "Method $method not supported"]);
    }
} catch (PDOException $e) {
    echo json_encode(["error" => "Connection failed: " . $e->getMessage()]);
}

function handleGet($db)
{
    // Example: Fetch data from database
    $query = $db->query('SELECT * FROM test'); // Adjust SQL query as needed
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($data);
}
