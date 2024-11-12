<?php
declare(strict_types = 1);

function is_password(string $password): bool{
    if(strlen($password) >= 8
        and preg_match("/[A-Z]/",$password)
        and preg_match("/[a-z]/",$password)
        and preg_match("/[0-9]/",$password)
    ){
    return true;
    }
return false;
}