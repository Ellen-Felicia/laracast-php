<?php


use Http\Forms\LoginForm;
use Core\Authenticator;

$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();

if ($form->validate($email, $password)){

    $auth = new Authenticator();

    if ($auth -> attempt($email, $password)){
        redirect('/');
    } else {
        // OLHAR AQUI
        $form ->error('email', 'The provided email is incorrect');
        $form ->error('password', 'The provided password is incorrect');
      } 

}
return view('sessions/create.view.php', [
    'errors' => $form->errors()
]);





    
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

