<?php

use Core\App;
use Core\Database;
use Core\Validator;
use Http\Forms\LoginForm;


$db = App::resolve(Database::class); 

$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();
if (! $form->validate($email, $password)){
    return view('sessions/create.view.php', [
        'errors' => $for->errors()
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

//return view('sessions/create.view.php', [
//    'errors' => [
//        'password' => 'The provided credentials are incorrect'
//    ]
//]);

