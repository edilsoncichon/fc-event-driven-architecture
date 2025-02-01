<?php declare(strict_types=1);

require 'vendor/autoload.php';

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/balances/{account_id}', function($vars) {
        $account = getAccount($vars['account_id']);
        header('Content-type: application/json');
        echo json_encode($account);
    });
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo "404 Not Found";
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo "405 Method Not Allowed";
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $handler($vars);
        break;
}


function getAccount(string $account_id): array|null
{
    $connection = new mysqli('balances-db:3306', 'root', 'root', 'balances');
    if ($connection->connect_error) die("Error: " . $connection->connect_error);

    $result = $connection->query("SELECT * FROM accounts WHERE id = '$account_id';");
    $account = $result->fetch_assoc();
    $connection->close();

    if (is_null($account)) {
        $account = ['message' => "Account not found.",];
    };

    return $account;
}