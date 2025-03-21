<?php
 const BASE_PATH = __DIR__ . '/../';
 
  require BASE_PATH . 'functions.php';

spl_autoload_register(function ($class) {
require base_path("Core/" . $class . '.php');
});
 
require base_path('router.php');

$config = require base_path ('config.php'); // Corrigido para usar base_pathp // Corrigido para usar base_path' // Corrigido para usar base_path) // Corrigido para usar base_path; // Corrigido para usar base_path

$db = new Database($config['database']);

$id = $_GET['id'] ?? null; // Verificar se 'id' está definido
if ($id) {
$query = "select * from posts where id = :id";
  $posts = $db->query($query, [':id' => $id])->get();
 dd($posts); // Exibir os resultados reais
} else {
    dd('No ID provided'); // Mensagem caso 'id' não seja fornecido
}
