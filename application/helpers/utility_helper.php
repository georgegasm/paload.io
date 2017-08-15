<?php

function asset_url($folder = 'css'){
   return 'asset/' .$folder .'/';
}

function includeScripts(){
    return 
    '<script type="text/javascript" src="'.asset_url("js").'jquery.min.js"></script>
     <script type="text/javascript" src="'.asset_url("js").'helper.js"></script>
     <script src="'.asset_url("lib").'sweetalert/sweetalert.min.js"></script>
     <script src="'.asset_url("lib").'bootstrap/bootstrap.min.js"></script>
     <script src="'.asset_url("lib").'datatables/datatables.min.js"></script>';
}

function includeStylesheets(){
    return 
    '<link rel="shortcut icon" href="'.asset_url("img").'favicon.ico" type="image/x-icon"/>
     <link rel="stylesheet" type="text/css" href="'.asset_url("lib").'sweetalert/sweetalert.css">
     <link rel="stylesheet" type="text/css" href="'.asset_url("lib").'bootstrap/bootstrap.min.css">
     <link rel="stylesheet" type="text/css" href="'.asset_url("lib").'datatables/datatables.css">';
}

function validateActiveSession($session = NULL){
    if($session === NULL)
    {
        redirect(base_url());
    }
    return;
}