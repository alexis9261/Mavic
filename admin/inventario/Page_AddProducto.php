 <?php
        session_start();
   ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
    <?php
        if(isset($_SESSION['ACCESO'])){
            if ($_SESSION['ACCESO']==TRUE){
        ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <link rel="stylesheet" href="../css/Stile.css">
    <link rel="stylesheet" href="../css/estilo1.css">
    <body>
        <div class="container">
         <h1 id="letra1">
         Nuevo Producto
         </h1>
           <form action="AddProducto.php" method="POST" enctype="multipart/form-data">
            <p><input id="text" type="text" name="nombre_p" placeholder="Nombre del producto" autocomplete="off"></p>
           <p><textarea name="descripcion" id="descripcion" cols="30" rows="10" placeholder="Descripcion" maxlength="250"></textarea></p>
            <p>
                <select name="genero" id="text">
                    <option value="1">Femenino</option>
                    <option value="2">Masculino</option>
                    <option value="3">Unisex</option>
                    <option value="4">Mayor</option>
                </select>
            </p>
            <p>
                <select name="tipo" id="text">
                    <option value="franela">Franela</option>
                    <option value="chemise">Chemise</option>
                    <option value="pantalon">Pantalon</option>
                    <option value="zapatos">Zapatos</option>
                </select>
            </p>
           <p><input id="text" type="number" name="precio" placeholder="Precio [USD]"></p>
           <p>Imagen Principal (Menor a 500 kbyte) <input type="file" name="archivo" ></p>
           <p><input id="boton" type="submit" value="Añadir"></p>
        </form>
        </div>
    </body>
</html>
<?php
      }
            }else{
            include('index.php');
        }
        ?>
