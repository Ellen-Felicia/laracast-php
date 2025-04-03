<?php

namespace Http\Forms;
use Core\Validator;
use Core\ValidationException;


class LoginForm{

protected $errors = [];

public function __construct(public array $attributes){
        

if(! Validator::email($attributes['email'])){
    $this->errors['email'] = 'The email is not valid';
}

if (! Validator::string($attributes['password'])) {
    $this->errors['password'] = 'The password is not valid';
}
}
public static function validate($attributes)
     {
         $instance = new static($attributes);
 
         return $instance->failed() ? $instance->throw() : $instance;
     }

     public function throw()
     {
         ValidationException::throw($this->errors(), $this->attributes);
     }
 
     public function failed()
     {
         return count($this->errors);
     }

public function errors(){
    return $this->errors;
}

public function error($field, $mensage){
    $this->errors[$field] = $mensage;
    return $this;
}
}