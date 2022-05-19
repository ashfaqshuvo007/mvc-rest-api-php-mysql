
<?php
require __DIR__ . "/StartUp/Register.php";
require PROJECT_ROOT_PATH . "/Controller/index.php";

$controller = null;
$action = null;

/* STEP 1: ROUTE PATH VALIDATION */ // highlight-line
$uri_pattern = explode('/', ROUTE_PATTERN); 

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

// pattern verification
if (count($uri) < count($uri_pattern)) {
    header("HTTP/1.1 404 Not Found");
    exit();
} else {
    for ($x = 0; $x < count($uri); $x++) {
        if ($x < count($uri_pattern)) {
            if ($uri_pattern[$x] == "{controller}") { 
                $controller = $uri[$x];
            } else if ($uri_pattern[$x] == "{action}") { 
                $action = $uri[$x];
            } else if ($uri_pattern[$x] != $uri[$x]) {  
                header("HTTP/1.1 404 Not Found");
                exit();
            } 
        }
    }
}

/* STEP 2: GET CONTROLLER INSTANCE */ // highlight-line
$controllerInstance = GetControllerInstance($controller);  
if ($controllerInstance == null) {
    header("HTTP/1.1 404 Not Found");
    exit();
}

/* STEP 3: PROCESS THE REQUEST */ // highlight-line
$method = $_SERVER["REQUEST_METHOD"];
switch ($method) {
    case "POST":
        $controllerInstance->{$action . 'PostAction'}($_POST);
        break;
    case "PUT":
        parse_str(file_get_contents("php://input"), $post_vars);
        $controllerInstance->{$action . 'PutAction'}($post_vars);
        break;
    case "DELETE":
        parse_str(file_get_contents("php://input"), $post_vars);
        $controllerInstance->{$action . 'DeleteAction'}($post_vars);
        break;
    default:
        $controllerInstance->{$action . 'Action'}($_GET);
        break;
}

