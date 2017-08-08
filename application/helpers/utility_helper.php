<?php

function asset_url($folder = 'css'){
   return 'asset/' .$folder .'/';
}

function includeScripts(){
    return 
    '<script type="text/javascript" src="'.asset_url("js").'jquery.min.js"></script>
    <script src="'.asset_url("lib").'sweetalert/sweetalert.min.js"></script>';
}

function includeStylesheets(){
    return 
    '<link rel="stylesheet" type="text/css" href="'.asset_url("lib").'sweetalert/sweetalert.css">';
}

function validateActiveSession($session = NULL){
    if($session === NULL)
    {
        redirect(base_url());
    }
    return;
}