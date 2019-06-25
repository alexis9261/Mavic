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
        $name_archivo=md5($C).'.'.$archivo;
        $archivo=$ruta.$name_archivo;
         if(!file_exists($ruta)){ mkdir($ruta); }
         if(!file_exists($archivo)){
             $resultado=move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivo);
             if ($resultado){
                # echo '<script> alert("Modelo Agregado"); </script>';
                 $iscreated=true;
             }else{ #echo '<script> alert("Error al guardar el archivo"); </script>';
              }
         }else{ #echo '<script> alert("Archivo ya existe"); </script>';
          }
     }else{ #echo '<script> alert("El archivo excede de tamaño."); </script>';
      }
 }
}
if ($iscreated and isset($_POST['producto'], $_POST['color1'], $_POST['color2'])){
//LECTURA DE VARIABLES
$idproducto = $_POST['producto'];
$color1 =  $_POST['color1'];
$color2= $_POST['color2'];
//ESCRIBE EL COMANDO SQL

$sql = "INSERT INTO `MODELOS`(`IDPRODUCTO`, `COLOR1`, `COLOR2`, `IMAGEN`) VALUES ('$idproducto','$color1','$color2','$name_archivo')";

if ($conn->query($sql) === TRUE) {
#    echo "<p>Nuevo MODELO registrado</p>";
    header('Location: modelo.php');
   } else { echo "Error: " . $sql . "<br>" . $conn->error;}
}else{ echo 'producto no registrado, ocurrio un error';}
$conn->close();
