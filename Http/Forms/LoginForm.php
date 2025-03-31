<?php

namespace Http\Forms;
use Core\Validator;


class LoginForm{

protected $errors = [];

public function validate($email, $password){
        

if(! Validator::email($email)){
    $this->errors['email'] = 'The email is not valid';
}

if (! Validator::string($password, 7, 255)) {
    $this->errors['password'] = 'The password is not valid';
}

    return empty($this->errors);

    }

public function errors(){
    return $this->errors;
}

}