<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../../common/conexion.php';
$iscreated=false;
$archivo = "N_Imagen.txt";
$C = 0;
$fp = fopen($archivo,"r");
$C = fgets($fp, 26);
fclose($fp);
++$C;
$fp = fopen($archivo,"w+");
fwrite($fp, $C, 26);
fclose($fp);
/*El contador C sera usado para darle nombre a las imagenes de los productos*/
if(isset($_FILES['archivo'])){
          // put your code here
 if($_FILES["archivo"]["error"]>0){ echo "error al cargar alchivo"; }
 else{
     $limite_kb = 500;
     if ($_FILES["archivo"]["size"]<= $limite_kb*1024){
         $ruta='../../imagen/';
         $archivo = substr(strrchr($_FILES["archivo"]["name"], "."), 1);
        $name_archivo=md5($C.$archivo).'.'.$archivo;
        $archivo=$ruta.$name_archivo;
         if(!file_exists($ruta)){ mkdir($ruta); }
         if(!file_exists($archivo)){
             $resultado=move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivo);
             if ($resultado){
                # echo '<script> alert("Producto Agregado"); </script>';
                 $iscreated=true;
             }else{ #echo '<script> alert("Error al guardar el archivo"); </script>';
              }
         }else{ #echo '<script> alert("Archivo ya existe"); </script>';
         }
     }else{ #echo '<script> alert("El archivo excede de tamaño."); </script>';
      }
 }
}
if ($iscreated and isset($_POST['nombre_p'], $_POST['descripcion'], $_POST['genero'], $_POST['tipo'], $_POST['precio'], $_POST['cuello'], $_POST['manga'], $_POST['material'], $_POST['marca'])){
//LECTURA DE VARIABLES
$nombre_p = $_POST['nombre_p'];
$descripcion =  $_POST['descripcion'];
$genero= $_POST['genero'];
$tipo=$_POST['tipo'];
$precio =  $_POST['precio']; //double
/*Tipos de cuello
(0) - No aplica
(1) - Redondo
(2) - En V
(3) - Mao
(4) - Chemise
*/
$cuello=$_POST['cuello']; //entero
/*Tipo de manga
(0) - No aplica
(1) - Corta
(2) - Tres Cuarto
(3) - Larga
(4) - Sin Manga
*/
$manga=$_POST['manga']; //Entero
$material=$_POST['material'];
$marca=$_POST['marca'];
//ESCRIBE EL COMANDO SQL
$sql = "INSERT INTO `PRODUCTOS`(`NOMBRE_P`, `DESCRIPCION`, `GENERO`, `TIPO`, `PRECIO`, `IMAGEN`,`CUELLO`, `MANGA`, `MATERIAL`, `MARCA`) VALUES ('$nombre_p','$descripcion','$genero','$tipo','$precio',
  '$name_archivo', '$cuello', '$manga', '$material' ,'$marca')";
if ($conn->query($sql) === TRUE) {
    #echo '<p>Nuevo PRODUCTO registrado</p>' ;
    header('Location: producto.php') ;
   } else { echo "Error: " . $sql . "<br>" . $conn->error;}
}else{ echo 'producto no registrado, ocurrio un error';}
$conn->close();
