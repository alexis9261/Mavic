<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
                  <link rel="stylesheet" href="../css/Stile.css">
    </head>
    <body>
        <?php
        // put your code here
        ?>
           <h1 id="top">Fabrica de Ropa</h1>
      
        <div class="buscador">
            <p>
             <input id="text" type="text" >
             <input id="boton" type="submit" value="Buscar">
            </p>
         </div>
         
        <div class="container">
           <h1 id="letra1">
        Eliminar producto
     </h1>
         
      
         
         <form action="AddProducto.php" method="POST">
            <p>Nombre_X |Fecha de publicacion_x <input type="checkbox" id="checkbox"></p>
            <p>Nombre_X |Fecha de publicacion_x <input type="checkbox" id="checkbox"></p>
            <p>Nombre_X |Fecha de publicacion_x <input id="checkbox" type="checkbox"></p>
            <p>Nombre_X |Fecha de publicacion_x <input id="checkbox" type="checkbox"></p>
                                
            <p><input id="boton2" type="submit" value="Eliminar productos"></p>
        </form>
          
        </div>
        
    </body>
</html>
