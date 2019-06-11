<?php

function debug($data){
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die();
}

function sanitize($input){
    return htmlentities($input, ENT_QUOTES, 'UTF-8');
}