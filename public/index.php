<?php
use Core\Session;
use Core\ValidationException;



const BASE_PATH = __DIR__ . '/../';

session_start();

require BASE_PATH . 'vendor/autoload.php';
require BASE_PATH . 'Core/functions.php';
require BASE_PATH . 'bootstrap.php';

// SUBSTITUIDO PELO COMPOSER
//spl_autoload_register(function ($class) {
//   // class = Core\Database
// $class = str_replace('\\', DIRECTORY_SEPARATOR , $class);
// require base_path($class . '.php');
// });
 
$router = new \Core\router();
require BASE_PATH . 'routes.php';

$uri = parse_url ($_SERVER ['REQUEST_URI']) ['path'];
$method = $_POST['_method'] ?? $_SERVER ['REQUEST_METHOD'];

try {
  $router->route($uri, $method);
} catch (ValidationException $exception) {
  Session::flash('errors', $exception->errors);
  Session::flash('old', $exception->old);

  return redirect($router->previousUrl());
}

Session::unflash();


use Core\Database;


$config = require base_path ('config.php'); 
$db = new Database($config['database']);

$id = $_GET['id'] ?? null; // Verificar se 'id' está definido
if ($id) {
$query = "select * from posts where id = :id";
  $posts = $db->query($query, [':id' => $id])->get();
 dd($posts); // Exibir os resultados reais
} else {
    dd('No ID provided'); // Mensagem caso 'id' não seja fornecido
}


