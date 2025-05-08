<?php
    ini_set("display_errors" , "1");
    ini_set("display_startup_errors", "1");
    error_reporting(E_ALL);
    include("core/inc/functions.inc.php");
    include("core/secure/ips.php");
    $archivo = "./logs/log.log";
    $ip = ip_in_ranges($_SERVER["REMOTE_ADDR"],$rango);

?>
<!DOCTYPE html>
<html lang = "es-SV">
    <head>
        <tittle> Inicio de sesion: RAUL ANTONIO BENITEZ VASQUEZ</tittle>
        <metaa charset = "UTF-8">
        <meta name="viewport" content = "width = device-with, initial-scale=1.0" />
        <link rel = "stylesheet" href = "css/bootstrap.css" />
        <link href = "fonts/fontawesome/css/all.css" rel= "stylesheet" />
        <script type= "text/javascript" src = "js/jquery-3.7.1.min.js"></script>
        <script type= "text/javascript" src = "js/bootstrap.js"></script>
        <script type= "text/javascript" src = "js/sweetalert.all.js"></script>
        <script type= "text/javascript" src = "fonts/fontawesome/js/all.js"></script>
    </head>

    <body>

    ﻿  <div class="alert alert-warning" role="alert"> 
            <b></b>
        </div>



    <div class="form-row">
        <div class="form-group col-md-5 text-center">
            <img src="media/logo/logo_corporativo.png" class="mx-auto d-block" id="img" width="65%" height="auto" /> 
        </div>
        <div class="form-group col-md-5 ml-4 mr-4 justify-content-center align-self-center"> 
            <h1>Diseñando Estrategias para la Recuperación y Migración de Base de Datos (RBKO)</h1> 
            <form name="frm_iniciar_sesion" id="frm_iniciar_sesion" action="core/process.php" method = "post" >
                <div class = "form-group">
                <label for = "txt:user"> Usuario:</label>
                <input type = "text" class = "form-control" id = "txt_pass" name= "txt_pass aria" aria-describedby = "txt_passHelp" maxlenght = "10" required >
                <small id = "txt_passHelp" class ="form-text text-muted">Digite un usuario Obligatorio</small>
        </div>  
        <div class = "form-group">
                <label for = "txt:user"> Contraseña:</label>
                <input type = "text" class = "form-control" id = "txt_pass" name= "txt_pass aria" aria-describedby = "txt_passHelp" maxlenght = "10" required >
                <small id = "txt_passHelp" class ="form-text text-muted"> La contraseña es obligatoria</small>
        </div>  
        <button type = "submit" ></button>



            </form>
    </div>
    </div>





    </body>
</html>