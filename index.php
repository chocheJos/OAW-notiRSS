<?php 
//Enlaces 
//https://www.jqueryscript.net/social-media/Tiny-jQuery-Based-RSS-Reader-Custom-Template-RSS-js.html
//https://www.jqueryscript.net/demo/Tiny-jQuery-Based-RSS-Reader-Custom-Template-RSS-js/
//Para guiarme https://demo.themeregion.com/newshub/
 ?>
 <!DOCTYPE html>
 <html>
 <head>
    
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poppins" />

 <body style="background:#83736F;
">
  <header class="cabecera">
    <div class="row">
      <div class="col-xl-5 col-lg-5 title_img">
        <img src="img/rss_logo.svg" class="logo_img" >
        <h1 class="h1_logo">Noticias RSS</h1>
      </div>
    </div>
    
    
  </header>
  
    <main class="row">
      
        <section class="col-lg-1"></section>
        
          <section class="col-lg-10">
            <img src="img/fondo.jpg" height="380px" width="100%">
          </section>
          
       
        
      
    </main> 
    <main class="row">
      <div class="col-lg-1"></div>
      <section class="col-lg-5 secMain">
        <h2 class="h2_form">Agregar nuevo sitio de noticias</h2>
        
        <h4>Introduce nuevo link XML</h4>
        <form action="save.php" method="post" class="forma">
          
            <input name="urlXml" type="search" class="contactus" placeholder="Pon link">
          
          <br>
          <input type="submit" value="Agregar" class="send">
        </form>
      </section>
      
      <section class="col-lg-5 secMain">
        <form action="search.php" method="post">
          <h2 class="h2_form">Buscar noticias   
          </h2>
          <h4>Introduzca su búsqueda</h4>
          <input type="text" name="palabra" id="busqueda" class="contactus" placeholder="Buscar coincidencias">
          <input class="send" type="submit" value="Buscar">
        </form>
      </section>
      <div class="col-lg-1"></div>
    </main>

    <div class="row">
      <div class="col-lg-1"></div>
      <section class="col-lg-3 secMain">
        <h4 class="marginH">Ordenar por fecha</h4>
        <nav class="menuDesp">
          <ul>
              <li><span class="op-categorias">Año</span>
                  <ul class="op-oculta">
                      <li><a href="#">2021</a></li>
                      <li><a href="#">2020</a></li>
                  </ul>
              </li>
              <li><span class="op-etiquetas">Mes</span>
                  <ul class="op-oculta">
                      <li><a href="#">Enero</a></li>
                      <li><a href="#">Marzo</a></li>
                      <li><a href="#">Abril</a></li>
                      <li><a href="#">Mayo</a></li>
                  </ul>
              </li>
              <li><span class="op-categorias">Día</span>
                  <ul class="op-oculta">
                      <li><a href="#">01</a></li>
                      <li><a href="#">02</a></li>
                  </ul>
              </li>
          </ul>    
        </nav>
      </section>
      <section class="col-lg-7 secMain"></section>
    </div>
 </body>
 <script src="js/jquery-1.11.3.min.js"></script>
  <script src="js/functions.js"></script>

 </html>

 <?php
function imprimir($parametros){
  include("configDB.php");  
  $consulta = 'SELECT * FROM entradas '.$parametros;
    $respuesta = mysqli_query( $conexion, $consulta ) or die ( "Algo ha ido mal en la consulta a la base de datos");
    $i=0;   
  while ($columna = mysqli_fetch_array( $respuesta ) and $i<10)
    {
        echo '<div class="jumbotron noticia"><h3><a target="_blank" href='.$columna['Link'].'>'.$columna['Titulo'] . '</a></h3><hr>' .
    $columna['Autor'].'<br>'.$columna['Descripcion'] . '<br><br>'.$columna['Fecha'].
    '</div><br/><br/>';
        $i++;
    } 
}
function autoCom(){
  include("configDB.php");
  $result = mysqli_query($conexion, "SELECT * FROM entradas");
  $array = array();
  if($result){
    while ($row = mysqli_fetch_array($result)) {
      $titulo = $row['Titulo'];
      array_push($array, $titulo);
    }
  } 
  echo json_encode($array);
} 
?> 