<?php
if(!isset($_SESSION)){ 
    session_start(); 
} 
@$_SESSION['url'] = $_POST['urlXml'];

//CONEXIÓN A LA BASE DE DATOS
include("configDB.php");
include("verificarUrl.php");

//LEER ARCHIVO XML Y GUARDAR EN UNA BASE DE DATOS
require_once 'autoloader.php';
$url = $_SESSION['url'];
$feed = new SimplePie();
$feed->set_feed_url($url);
$feed->init();
$itemQty = $feed->get_item_quantity();
$aux = Buscar_url($url);

if ($aux == 1){
    header("Location: index.php?err=0");
}else{
    $_GUARDAR_SQL = "INSERT INTO Urls (Link) VALUES ('$url')";
    mysqli_query($conexion, $_GUARDAR_SQL);

    for ($i = 0; $i < $itemQty; $i++) {
      $item = $feed->get_item($i);
      $Titulo = htmlspecialchars_decode($item->get_title());
      $Autor = htmlspecialchars_decode($item->get_author()->get_name());
      $Fecha = htmlspecialchars_decode($item->get_date('Y-m-d H:i:s'));
      $Descripcion = htmlspecialchars_decode($item->get_description());
      $Link = htmlspecialchars_decode($item->get_link());
      $_GUARDAR_SQL = "INSERT INTO entradas (Titulo,Autor,Fecha,Descripcion,Link) VALUES ('$Titulo','$Autor','$Fecha','$Descripcion','$Link')";    
      mysqli_query($conexion, $_GUARDAR_SQL);
    }
    @mysqli_close($conexion);
    session_destroy();
    header("Location: index.php");
}
    
?>