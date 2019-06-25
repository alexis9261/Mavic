<?php
 if(!isset($_SESSION)){
   session_start();
 }
  ?>
<?php
//Requiere de que el comando de inicio de session haya sido llamado.
include_once '../common/conexion.php';
//LECTURA DE VARIABLES
$nombre_cliente =$_SESSION['nombre-cliente'];
$docid_cliente= $_SESSION['type-identidad-cliente'].'-'.$_SESSION['doc-identidad-cliente'];
$telf_cliente=$_SESSION['telf-cliente'];
$email_cliente=$_SESSION['email-cliente'];
$monto =  $_SESSION['total'];
#PESO
$pesot=$_SESSION['peso'];

if(isset($_POST['isfacture'])){
    $razon=$_SESSION['razon-social'];
    $identidad=$_SESSION['type-identidad'].'-'.$_SESSION['doc-identidad'];
    $dir_fiscal=$_SESSION['dir-fiscal'];
}else{
    $razon='';
    $identidad='';
    $dir_fiscal='';
}
$STATUS_START=0;
//AÑADIR VARIABLE SOLICITADA
$sqla="SELECT `VALUE` FROM  VARIABLES WHERE `NOMBRE`='CS'";
$result = $conn->query($sqla);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       $CS = $row["VALUE"];
    }
}
$CS=$CS+1;
$sqlb="UPDATE `VARIABLES` SET `VALUE`=$CS WHERE `NOMBRE`='CS';";
  if ($conn->query($sqlb) === TRUE) {
   }else{
     echo "Error: " . $sql0 . "<br>" . $conn->error;
  }

$sqlc="SELECT `IDPEDIDO` FROM `PEDIDOS` WHERE `EMAIL`='$email_cliente' AND `ESTATUS`='$STATUS_START'";
$result = $conn->query($sqlc);
if ($result->num_rows > 0) {
    //Elimina Los Pedidos Repetidos
    while($row = $result->fetch_assoc()) {
      #ID PEDIDO.
     $id=$row['IDPEDIDO'];
     #devolver INVENTARIO
     $sql_devolucion1="SELECT * FROM ITEMS WHERE IDPEDIDO='$id'";
     $result_d = $conn->query($sql_devolucion1);
     if ($result_d->num_rows > 0) {
       while($row_d = $result_d->fetch_assoc()) {
         #conseguir Id de inventario
         $idinv=$row_d['IDINVENTARIO'];
         #cantidad de inventario
         $cantidad= $row_d['CANTIDAD'];
         #Añadir INVENTARIO
         $sql ="UPDATE INVENTARIO SET CANTIDAD=CANTIDAD+$cantidad WHERE IDINVENTARIO='$idinv'";
         if($conn->query($sql) === TRUE){
           #PRODUCTO AÑADIDO
         }
         else{
           #echo '<script> alert("Error:'. $sql . '<br>'. $conn->error.'"); </script>';
         }

       }
     }
     #Eliminar Todo el pedido.
        $sqld="
        DELETE p,c,i,e
        FROM PEDIDOS p
          LEFT JOIN COMPRAS c
          ON c.idpedido=p.idpedido
          LEFT JOIN ITEMS i
          ON i.idpedido=p.idpedido
           LEFT JOIN ENVIOS e
          ON e.idpedido=p.idpedido
        WHERE p.idpedido = '$id';";
          if ($conn->query($sqld) === TRUE) {
            #Pedido ELiminado.
              }else{
                #  echo "Error: " . $sqld . "<br>" . $conn->error;
              }
      }
}

#Llave Digital
$Ncadena=6;
$Llave=substr(md5($CS), 0, $Ncadena);
#echo $Llave;
$md5=$Llave.$docid_cliente;
#$md5= md5($CS);
$sql1 = "INSERT INTO PEDIDOS (IDPEDIDO,CLIENTE,DOCID,TELEFONO,EMAIL,ESTATUS, FECHAPEDIDO) VALUES ( MD5('$md5'),'$nombre_cliente','$docid_cliente', '$telf_cliente', '$email_cliente', '$STATUS_START',  NOW());";
  if ($conn->query($sql1) === TRUE) {
   } else {
     echo "Error: " . $sql1 . "<br>" . $conn->error;
    }
   $sql2="INSERT INTO `COMPRAS`( `IDPEDIDO`, `MONTO`, `PESO` ,  `RAZONSOCIAL`, `RIFCI`, `DIRFISCAL`) VALUES (MD5('$md5'), '$monto','$pesot',  '$razon',' $identidad','$dir_fiscal');";
  if ($conn->query($sql2) === TRUE) {

   } else {
     echo "Error: " . $sql0 . "<br>" . $conn->error;
   }
   if(isset($_SESSION['carrito'])){
        $datos=$_SESSION['carrito'];
        foreach ($datos as $d){
          $id_item=  $d['Id'];
          $cantidad_item=  $d['Cantidad'];
          $precio_item=  $d['Precio'];
          #insercion
          $sql_item="INSERT INTO `ITEMS`(`IDPEDIDO`, `IDINVENTARIO`, `CANTIDAD`, `PRECIO`) VALUES (MD5('$md5'),'$id_item' ,'$cantidad_item', '$precio_item')";
          if ($conn->query($sql_item) == TRUE) {
            #good
              } else {
               echo "Error: " . $sql4 . "<br>" . $conn->error;
             }
        }
   }
    $receptor=$_SESSION['receptor'];
    $receptor_ci = $_SESSION['type-identidad-receptor'].'-'.$_SESSION['doc-identidad-receptor'] ;
    $receptor_tel=$_SESSION['telf-receptor'];
    //direccion
    $pais=$_SESSION['pais'];
    $estado=$_SESSION['estado'];
    $ciudad=$_SESSION['ciudad'];
    $municipio=$_SESSION['municipio'];
    $parroquia=$_SESSION['parroquia'];
    if(!empty($_POST['ref'])){
      $direccion = $_SESSION['direccion'].', '.$_POST['ref'];
    }else{
      $direccion = $_SESSION['direccion'];
    }

    $codigo_postal=$_SESSION['codigo-postal'];
    $encomienda=$_SESSION['encomienda'];
    $observaciones=$_SESSION['observaciones'];
    $sql="INSERT INTO `ENVIOS`( `IDPEDIDO`, `PAIS`, `ESTADO`, `CIUDAD`, `MUNICIPIO`, `PARROQUIA`, `DIRECCION`, `CODIGOPOSTAL`, `RECEPTOR`, `CIRECEPTOR`, `TELFRECEPTOR`,`ENCOMIENDA`, `OBSERVACIONES`, `GUIA`)
     VALUES (MD5('$md5'),'$pais','$estado','$ciudad','$municipio','$parroquia','$direccion', '$codigo_postal','$receptor', '$receptor_ci' , '$receptor_tel','$encomienda','$observaciones', NULL)";
 if ($conn->query($sql) === TRUE) {
       } else {
        echo "Error: " .$sql. "<br>" . $conn->error;
    }

#restar inventario
$datos=$_SESSION['carrito'];
for($i=0;$i<count($datos);$i++){
    #conseguir Id de inventario
    $idinv=$datos[$i]['Id'];
    #cantidad de inventario
    $cantidad= $datos[$i]['Cantidad'];
    #REstar INVENTARIO
    $sql ="UPDATE INVENTARIO SET CANTIDAD=CANTIDAD-$cantidad WHERE IDINVENTARIO=$idinv";
    if($conn->query($sql) === TRUE){
    }
    else{
      #echo '<script> alert("Error:'. $sql . '<br>'. $conn->error.'"); </script>';
    }
}
$conn->close();


/**
<?php
 if(!isset($_SESSION)){
   session_start();
 }
  ?>
<?php
//Requiere de que el comando de inicio de session haya sido llamado.
include_once '../common/conexion.php';
//LECTURA DE VARIABLES
$nombre_cliente =$_SESSION['nombre-cliente'];
$docid_cliente= $_SESSION['type-identidad-cliente'].'-'.$_SESSION['doc-identidad-cliente'];
$telf_cliente=$_SESSION['telf-cliente'];
$email_cliente=$_SESSION['email-cliente'];
$monto =  $_SESSION['total'];
#PESO
$pesot=$_SESSION['peso'];

if(isset($_POST['isfacture'])){
    $razon=$_SESSION['razon-social'];
    $identidad=$_SESSION['type-identidad'].'-'.$_SESSION['doc-identidad'];
    $dir_fiscal=$_SESSION['dir-fiscal'];
}else{
    $razon='';
    $identidad='';
    $dir_fiscal='';
}
$STATUS_START=0;
//AÑADIR VARIABLE SOLICITADA
$sqla="SELECT `VALUE` FROM  VARIABLES WHERE `NOMBRE`='CS'";
$result = $conn->query($sqla);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       $CS = $row["VALUE"];
    }
}
$CS=$CS+1;
$sqlb="UPDATE `VARIABLES` SET `VALUE`='$CS' WHERE `NOMBRE`='CS';";
if ($conn->query($sqlb) === TRUE) {
   }else{
       echo "Error: " . $sql0 . "<br>" . $conn->error;
       }
$sqlc="SELECT `IDPEDIDO` FROM `PEDIDOS` WHERE `EMAIL`='$email_cliente' AND `ESTATUS`='$STATUS_START'";
$result = $conn->query($sqlc);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
     $id=$row['IDPEDIDO'];
        $sqld="
        DELETE p,c,i,e
        FROM PEDIDOS p
          LEFT JOIN COMPRAS c
          ON c.idpedido=p.idpedido
          LEFT JOIN ITEMS i
          ON i.idpedido=p.idpedido
           LEFT JOIN ENVIOS e
          ON e.idpedido=p.idpedido
        WHERE p.idpedido = '$id';";
          if ($conn->query($sqld) === TRUE) {
               }else{ echo "Error: " . $sqld . "<br>" . $conn->error; }
        }
    }
#Evitar repeticion de actualizacion
$sql0="DELETE FROM PEDIDOS WHERE ESTATUS=0 AND EMAIL='$email_cliente' ";
if ($conn->query($sql0) == TRUE) {
  #Eliminado
  #Añadir inventario
  $datos=$_SESSION['carrito'];
    for($i=0;$i<count($datos);$i++){
        #conseguir Id de inventario
        $idinv=$datos[$i]['Id'];
        #cantidad de inventario
        $cantidad= $datos[$i]['Cantidad'];
        #Añadir INVENTARIO
        $sql ="UPDATE INVENTARIO SET CANTIDAD=CANTIDAD+$cantidad WHERE IDINVENTARIO='$idinv'";
        if($conn->query($sql) === TRUE){
        }
        else{
          #echo '<script> alert("Error:'. $sql . '<br>'. $conn->error.'"); </script>';
        }
    }
   }else {
  #  echo "Error: " . $sql0 . "<br>" . $conn->error;
}
#Llave Digital
$Ncadena=6;
$Llave=substr(md5($CS), 0, $Ncadena);
#echo $Llave;
$md5=$Llave.$docid_cliente;
#$md5= md5($CS);
$sql1 = "INSERT INTO PEDIDOS (IDPEDIDO,CLIENTE,DOCID,TELEFONO,EMAIL,ESTATUS, FECHAPEDIDO) VALUES ( MD5('$md5'),'$nombre_cliente','$docid_cliente', '$telf_cliente', '$email_cliente', '$STATUS_START', CURRENT_DATE());";

if ($conn->query($sql1) === TRUE) {
   } else { echo "Error: " . $sql1 . "<br>" . $conn->error; }
$sql2="INSERT INTO `COMPRAS`( `IDPEDIDO`, `MONTO`, `PESO` ,  `RAZONSOCIAL`, `RIFCI`, `DIRFISCAL`) VALUES (MD5('$md5'), '$monto','$pesot',  '$razon',' $identidad','$dir_fiscal');";
if ($conn->query($sql2) === TRUE) {
   } else { echo "Error: " . $sql0 . "<br>" . $conn->error; }
   if(isset($_SESSION['carrito'])){
        $datos=$_SESSION['carrito'];
        foreach ($datos as $d){
          $id_item=  $d['Id'];
          $cantidad_item=  $d['Cantidad'];
          $precio_item=  $d['Precio'];
          #insercion
          $sql_item="INSERT INTO `ITEMS`(`IDPEDIDO`, `IDINVENTARIO`, `CANTIDAD`, `PRECIO`) VALUES (MD5('$md5'),'$id_item' ,'$cantidad_item', '$precio_item')";
          if ($conn->query($sql_item) == TRUE) {
            #good
              } else {
               echo "Error: " . $sql4 . "<br>" . $conn->error;
             }
        }
   }
    $receptor=$_SESSION['receptor'];
    $receptor_ci = $_SESSION['type-identidad-receptor'].'-'.$_SESSION['doc-identidad-receptor'] ;
    $receptor_tel=$_SESSION['telf-receptor'];
    //direccion
    $pais=$_SESSION['pais'];
    $estado=$_SESSION['estado'];
    $ciudad=$_SESSION['ciudad'];
    $municipio=$_SESSION['municipio'];
    $parroquia=$_SESSION['parroquia'];
    if(!empty($_POST['ref'])){
      $direccion = $_SESSION['direccion'].', '.$_POST['ref'];
    }else{
      $direccion = $_SESSION['direccion'];
    }

    $codigo_postal=$_SESSION['codigo-postal'];
    $encomienda=$_SESSION['encomienda'];
    $observaciones=$_SESSION['observaciones'];
    $sql="INSERT INTO `ENVIOS`( `IDPEDIDO`, `PAIS`, `ESTADO`, `CIUDAD`, `MUNICIPIO`, `PARROQUIA`, `DIRECCION`, `CODIGOPOSTAL`, `RECEPTOR`, `CIRECEPTOR`, `TELFRECEPTOR`,`ENCOMIENDA`, `OBSERVACIONES`, `GUIA`)
     VALUES (MD5('$md5'),'$pais','$estado','$ciudad','$municipio','$parroquia','$direccion', '$codigo_postal','$receptor', '$receptor_ci' , '$receptor_tel','$encomienda','$observaciones', NULL)";
 if ($conn->query($sql) === TRUE) {
       } else {
        echo "Error: " .$sql. "<br>" . $conn->error;
    }
$conn->close();
?>
**/
?>
