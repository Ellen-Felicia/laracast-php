<?php
 const BASE_PATH = __DIR__ . '/../';

 session_start();
 
  require BASE_PATH . 'Core/functions.php';

spl_autoload_register(function ($class) {
  // class = Core\Database
$class = str_replace('\\', DIRECTORY_SEPARATOR , $class);

require base_path($class . '.php');
});

require base_path('Core/bootstrap.php');
 
$router = new \Core\router();
$routes = require base_path('routes.php');

$uri = parse_url ($_SERVER ['REQUEST_URI']) ['path'];
$method = $_POST['_method'] ?? $_SERVER ['REQUEST_METHOD'];

$router -> route($uri, $method);


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


