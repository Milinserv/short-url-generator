<?php
use App\Controllers\DataController;

require_once __DIR__ . "/../bootstrap.php";
class ApiRouter
{
    public function __construct() {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST');
        header("Access-Control-Allow-Headers: X-Requested-With");
        header('Content-Type: application/json');
    }

    public function handleRequest(): void
    {
        $method = $_SERVER['REQUEST_METHOD']; // Получаем метод запроса

        switch ($method) {
            case 'POST':
                $this->handlePostRequest($_POST);
                break;
            case 'GET':
                $this->handleGetRequest($_GET);
                break;
            default:
                echo json_encode(['error' => 'Unsupported method']);
        }
    }

    private function handlePostRequest($post): void {
        $result = '';
        switch ($post) {
            case '':
                break;
        }
        echo json_encode($result);
    }

    private function handleGetRequest($get): void {
        $result = [];

        switch (true) {
            case isset($get['gen']) && $get['gen'] == "true":
                $result = DataController::create();
                break;
            case isset($get['code']):
                $result = DataController::search($get['code']);
                break;
            default:
                echo json_encode("");
                break;
        }
        echo json_encode($result);
    }
}

$router = new ApiRouter();
$router->handleRequest();

