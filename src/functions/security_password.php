<?php

function encryptPassword($password)
{
    return password_hash($password, PASSWORD_DEFAULT);
}

function comparePassword($password, $hashPassword)
{
    return password_verify($password, $hashPassword);
}
?>
