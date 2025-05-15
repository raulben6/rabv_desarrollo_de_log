<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
include('inc/funciones.inc.php');
include('secure/ips.php');

$metodo_permitido = "POST";
$archivo = "../logs/log.log";
$dominio_autorizado = "localhost";
$ip = ip_in_ranges($_SERVER["REMOTE_ADDR"], $rango);
$txt_usuario_autorizado = "admin";
$txt_password_autorizado = "admin";

// Verifica que exista HTTP_REFERER
if(array_key_exists("HTTP_REFERER", $_SERVER)) {
    if(strpos($_SERVER["HTTP_REFERER"], $dominio_autorizado) !== false) {
        if($ip === true) {
            if($_SERVER["REQUEST_METHOD"] === $metodo_permitido) {

                $valor_campo_usuario = (array_key_exists("txt_user", $_POST)) ? htmlspecialchars(stripslashes(trim($_POST["txt_user"])), ENT_QUOTES) : "";
                $valor_campo_password = (array_key_exists("txt_pass", $_POST)) ? htmlspecialchars(stripslashes(trim($_POST["txt_pass"])), ENT_QUOTES) : "";

                if($valor_campo_usuario != "" && $valor_campo_password != "") {
                    $usuario = preg_match('/^[a-zA-Z0-9]{1,10}$/', $valor_campo_usuario);
                    $password = preg_match('/^[a-zA-Z0-9]{1,10}$/', $valor_campo_password);

                    if($usuario === 1 && $password === 1) {
                        if($valor_campo_usuario === $txt_usuario_autorizado && $valor_campo_password === $txt_password_autorizado) {
                            echo("HOLA MUNDO");
                            crear_editar_log($archivo, "EL CLIENTE INICIO SESION SATISFACTORIAMENTE", 1, $_SERVER["REMOTE_ADDR"], $_SERVER["HTTP_REFERER"], $_SERVER["HTTP_USER_AGENT"]);
                        } else {
                            crear_editar_log($archivo, "CREDENCIALES INCORRECTAS ENVIADAS HACIA // ".$_SERVER["HTTP_HOST"]." ".$_SERVER["REQUEST_URI"], 2, $_SERVER["REMOTE_ADDR"], $_SERVER["HTTP_REFERER"], $_SERVER["HTTP_USER_AGENT"]);
                            header ("HTTP/1.1 301 Moved Permanently");
                            header("Location: ../?status=7");
                        }
                    } else {
                        crear_editar_log($archivo, "ENVIO DE DATOS DE FORMULARIO CON DATOS NO ACEPTADOS", 3, $_SERVER["REMOTE_ADDR"], $_SERVER["HTTP_REFERER"], $_SERVER["HTTP_USER_AGENT"]);
                        header ("HTTP/1.1 301 Moved Permanently");
                        header("Location: ../?status=6");
                    }
                } else {
                    crear_editar_log($archivo, "ENVIO DE CAMPOS VACIOS AL SERVIDOR", 3, $_SERVER["REMOTE_ADDR"], $_SERVER["HTTP_REFERER"], $_SERVER["HTTP_USER_AGENT"]);
                    header ("HTTP/1.1 301 Moved Permanently");
                    header("Location: ../?status=5");
                }
            } else {
                crear_editar_log($archivo, "ENVIO DE METODO NO AUTORIZADO", 3, $_SERVER["REMOTE_ADDR"], $_SERVER["HTTP_REFERER"], $_SERVER["HTTP_USER_AGENT"]);
                header ("HTTP/1.1 301 Moved Permanently");
                header("Location: ../?status=4");
            }
        } else {
            crear_editar_log($archivo, "LA DIRECCION IP NO ESTA AUTORIZADA", 3, $_SERVER["REMOTE_ADDR"], $_SERVER["HTTP_REFERER"], $_SERVER["HTTP_USER_AGENT"]);
            header ("HTTP/1.1 301 Moved Permanently");
            header("Location: ../?status=3");
        }
    } else {
        crear_editar_log($archivo, "DOMINIO NO AUTORIZADO", 3, $_SERVER["REMOTE_ADDR"], $_SERVER["HTTP_REFERER"], $_SERVER["HTTP_USER_AGENT"]);
        header ("HTTP/1.1 301 Moved Permanently");
        header("Location: ../?status=2");
    }
} else {
    crear_editar_log($archivo, "NO SE DETECTA REFERER", 3, $_SERVER["REMOTE_ADDR"], "NO_REFERER", $_SERVER["HTTP_USER_AGENT"]);
    header ("HTTP/1.1 301 Moved Permanently");
    header("Location: ../?status=1");
}
?>
