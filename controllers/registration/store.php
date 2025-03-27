<?php
use Core\App;
use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];

$errors=[];
if(! Validator::email($email)){
    $errors['email'] = 'The email is not valid';
}

if (! Validator::string($password, 7, 255)) {
    $errors['password'] = 'The password is not valid, provide a password of at least seven characters';
}

if (! empty($errors)){
    return view('registration/create.view.php', [
        'errors' => $errors
]);
}

$db = App::resolve(Database::class); 
$user = $db -> query('select * from users where email = :email', [
    'email' => $email
])->find();

if ($user){
    header('location: /');
    exit();
} else {
    $db -> query('insert into users (email, password) values (:email, :password)', [
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT)
    ]);

   $_SESSION ['user'] = [
    'email'=> $email
   ];
    header('location: /');
    exit();
}