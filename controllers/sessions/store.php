<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class); 

$email = $_POST['email'];
$password = $_POST['password'];

$errors=[];
if(! Validator::email($email)){
    $errors['email'] = 'The email is not valid';
}

if (! Validator::string($password, 7, 255)) {
    $errors['password'] = 'The password is not valid';
}

if (! empty($errors)){
    return view('sessions/create.view.php', [
        'errors' => $errors
]);
}

$user = $db->query('select * from users where email = :email', [
    'email' => $email
])->find();

if (!$user){
    return view('sessions/create.view.php', [
        'errors' => [
            'email' => 'The provided email is incorrect'
        ]
    ]);
}

if(password_verify($password, $user['password'])){
    
    login([
        'email' => $email
    ]);
    
    header('location: /');
    exit();
     
} else {return view('sessions/create.view.php', [
    'errors' => [
        'password' => 'The provided password is incorrect'
    ]
]);
}

return view('sessions/create.view.php', [
    'errors' => [
        'password' => 'The provided credentials are incorrect'
    ]
]);

