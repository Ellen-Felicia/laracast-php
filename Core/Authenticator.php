<?php

namespace Core;

use Core\App;
use Core\Database;

class Authenticator{

    public function attempt($email, $password){

    $db = App::resolve(Database::class); 

    $email = $_POST['email'];
    $password = $_POST['password'];

$user = $db->query('select * from users where email = :email', [
    'email' => $email
])->find();

if ($user)
{

    if(password_verify($password, $user['password']))
    {
        
        $this->login([
            'email' => $email
        ]);
        
        return true;
        
    }     
}

    return false;

}
    
public function login($user)
{
    $_SESSION['user'] = [
        'email' => $user['email']
    ]; 

    session_regenerate_id(true);
}

public function logout()
{
    
    $_SESSION = [];
    session_destroy();

    $params = session_get_cookie_params();
    setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['segure'], $params['httponly']);
}

}