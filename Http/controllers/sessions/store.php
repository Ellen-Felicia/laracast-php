<?php


use Http\Forms\LoginForm;
use Core\Authenticator;
use Core\Session;

$form = LoginForm::validate($attributes = [
    'email' => $_POST['email'],
    'password' => $_POST['password']
]);

$signedIn = (new Authenticator)->attempt(
    $attributes['email'], $attributes['password']
); if (!$signedIn) {
    $form->error(
        'email', 'No matching account found for that email address and password.'
    )->throw();

}
redirect('/');





    
        // 'errors' => [
        //     'email' => 'The provided email is incorrect',
        //     'password' => 'The provided password is incorrect'
        // ]

    //else {
    //         return view('sessions/create.view.php', [
    //             'errors' => [
    //             'password' => 'The provided password is incorrect'
    //             ]
    //         ]);
    //     }











// $user = $db->query('select * from users where email = :email', [
//     'email' => $email
// ])->find();

// if (!$user){
//     return view('sessions/create.view.php', [
//         'errors' => [
//             'email' => 'The provided email is incorrect'
//         ]
//     ]);
// }

// if(password_verify($password, $user['password'])){
    
//     $this->login([
//         'email' => $email
//     ]);
    
//     header('location: /');
//     exit();
     
// } else {return view('sessions/create.view.php', [
//     'errors' => [
//         'password' => 'The provided password is incorrect'
//     ]
// ]);
// }

//return view('sessions/create.view.php', [
//    'errors' => [
//        'password' => 'The provided credentials are incorrect'
//    ]
//]);

