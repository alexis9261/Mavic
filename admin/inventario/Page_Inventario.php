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
 include('../Common/conexion.php');

if(isset($_SESSION['ACCESO'])){
    if ($_SESSION['ACCESO']==TRUE){
        

if(isset($_POST['nombre_p'],$_POST['talla'],$cantidad=$_POST['cantidad'] )){
        $nombre_p=$_POST['nombre_p'];
        $talla=$_POST['talla'];
        $cantidad=$_POST['cantidad'];
        
    if ($nombre_p!=NULL && $talla!=NULL  && $cantidad!=NULL ){
       
        
          $result = $conn->query("SELECT IDPRODUCTO FROM PRODUCTO WHERE NOMBRE_P='$nombre_p'");
          if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
              $idproducto=$row['IDPRODUCTO'];
           }
          
          $encontro=false;
          $sql="SELECT CANTIDAD,IDINVENTARIO FROM INVENTARIO WHERE IDPRODUCTO='$idproducto' AND TALLA='$talla';";
            $result = $conn->query($sql);
              
          if ($result->num_rows > 0) {
          // output data of each row
              $encontro=true;
          while($row = $result->fetch_assoc()) {
              $cantidad=$row['CANTIDAD'] + $cantidad;
              $idinventario=$row['IDINVENTARIO'];
           }
          }
              if ($encontro){
                  
                  $sql = "UPDATE INVENTARIO SET CANTIDAD='$cantidad' WHERE IDINVENTARIO = '$idinventario';";
                  
                   if ($conn->query($sql) === TRUE) {
                        echo '<script> alert("Inventario Actualizado"); </script>';
                       } else {
                         echo '<script> alert("Error:'. $sql . '<br>'. $conn->error.'"); </script>';
                    }

              }else{
                                //ESCRIBE EL COMANDO SQL
                    $sql = "INSERT INTO INVENTARIO (IDPRODUCTO,TALLA, CANTIDAD) 
                VALUES ('$idproducto', '$talla', '$cantidad')";

            //        
                    if ($conn->query($sql) === TRUE) {
                        echo '<script> alert("Inventario añadido"); </script>';
                       } else {
                         echo '<script> alert("Error:'. $sql . '<br>'. $conn->error.'"); </script>';
                    }
                  
              }
         
               } 
            
           
        } else{
         echo '<script> alert("Faltan datos para añadir inventario"); </script>';
    }
}
?>

<?php ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
     <link rel="stylesheet" href="../css/Stile.css">
    </head>
    <body>
     <div class="container">
         <h1 id="letra1">
       Modificar inventario [Añadir | Remover]
         </h1>
         
           <form action="Page_Inventario.php" method="POST"  autocomplete="off" >
           <ul id="linea-inventario">
               <li>
                  <input list="productos" name="nombre_p" placeholder="Producto" type="search" id="search">
                    <datalist id="productos">
                          <?php 
                        $sql = "SELECT * FROM PRODUCTO";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                         // output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo '<option value="'.$row['NOMBRE_P'].'"></option>';
                             }
                    } else {
                        echo '<option value="No hay productos"></option>';  
                    }
                    
                     echo '';
                             
                            ?>
                          
                    </datalist>      
               </li>
               <li>
                    <input  list="tallas" name="talla" placeholder="Talla" maxlength="3" type="search" id="search" >
                   <datalist id="tallas">
                         <option value="S"></option>
                         <option value="M"></option>
                         <option value="L"></option>
                         <option value="XL"></option>
                         <option value="XXL"></option>
                         <option value="Variado"></option>
                   </datalist>
               </li>
               <li>
                   <input  type="number" name="cantidad" placeholder="N° de piezas">  
               </li>
               <li>
                   <input id="boton" type="submit" value="Añadir">
               </li>
           </ul>
           
        </form>
          
        </div>
                 
         <div class="container">
              <h1 id="letra1">
       Inventario
         </h1>
              <form action="#" autocomplete="off">
               <ul id="linea-busqueda" >
                 <li id="main">
                  <input list="productos" name="search" placeholder="Producto" type="search" id="search" >
                  </li>
                 <li>
                   <input id="boton" type="submit" value="Buscar">
               </li>
               </ul>
           </form>  
             
              <form action="Page_Inventario.php" >
        <ul class="carrito-compras">
            <li>
                <ul id="linea-main">
                <li>...</li>
                <li>Producto</li>
                <li>IDproducto</li>
                <li>Talla</li>
                <li>Cantidad</li>
                <li>...</li>
                </ul>
            </li>
            <?php
            
            if (isset($_GET['search'])){
                $nombre_p=$_GET['search'];
                if($nombre_p<>NULL){
                    
                      $encontro=false;
                      $result = $conn->query("SELECT IDPRODUCTO FROM PRODUCTO WHERE NOMBRE_P='$nombre_p'");
                      if ($result->num_rows > 0) {
                      // output data of each row
                      while($row = $result->fetch_assoc()) {
                          $idproducto=$row['IDPRODUCTO'];
                       }
                          $encontro=true;
                      }
                    if ($encontro){
                        
                        $sql= "select PRODUCTO.NOMBRE_P,INVENTARIO.CANTIDAD,PRODUCTO.IMAGEN,INVENTARIO.TALLA,INVENTARIO.IDPRODUCTO from INVENTARIO INNER JOIN PRODUCTO ON INVENTARIO.IDPRODUCTO=PRODUCTO.IDPRODUCTO WHERE INVENTARIO.IDPRODUCTO=$idproducto;" ;
                        
                         $res = $conn->query($sql);
                        while($f = $res->fetch_assoc()){

                                $nombre_p=$f["NOMBRE_P"];
                                $cantidad=$f["CANTIDAD"];
                                $imagen=$f["IMAGEN"];
                                $talla=$f["TALLA"];
                                $idproducto=$f["IDPRODUCTO"];
        
                            ?>
                               <li>
                                    <ul id="linea-articulo">
                                           <li>
                                           <div id="imagen-lista">
                                           <img src="../<?php echo $imagen; ?>" >    
                                           </div>
                                           </li>
                                            <li><?php echo $nombre_p; ?></li>
                                            <li><?php echo $idproducto; ?></li>
                                            <li><?php echo $talla; ?></li>
                                            <li><?php echo $cantidad; ?></li>
                                            <li>  <input type="checkbox" id="checkbox" checked="on"></li>
                                    </ul>
                                </li>
                            
                            <?PHP
                            
                            
                        }
                        
                        
                    }
                     
                    
                }
                
                
                
            }else{
                
                
            
            
                 $sql= "select PRODUCTO.NOMBRE_P,INVENTARIO.CANTIDAD,PRODUCTO.IMAGEN,INVENTARIO.TALLA,INVENTARIO.IDPRODUCTO from INVENTARIO INNER JOIN PRODUCTO ON INVENTARIO.IDPRODUCTO=PRODUCTO.IDPRODUCTO;" ;
            
                 $res = $conn->query($sql);
        while($f = $res->fetch_assoc()){

                $nombre_p=$f["NOMBRE_P"];
                $cantidad=$f["CANTIDAD"];
                $imagen=$f["IMAGEN"];
                $talla=$f["TALLA"];
                $idproducto=$f["IDPRODUCTO"];
            
            ?>
            
            
            
            
            
            
            <li>
                <ul id="linea-articulo">
                       <li>
                       <div id="imagen-lista">
                       <img src="<?php echo $imagen; ?>" >    
                       </div>
                       </li>
                        <li><?php echo $nombre_p; ?></li>
                        <li><?php echo $idproducto; ?></li>
                        <li><?php echo $talla; ?></li>
                        <li><?php echo $cantidad; ?></li>
                        <li>  <input type="checkbox" id="checkbox" checked="on"></li>
                </ul>
            </li>
            
         <?php }}
            $conn->close();
            ?>
          
        </ul>
        <ul class="ok-cancel">
            <li>
                 <input id="boton2" type="submit" value="Actualizar inventario">
            </li>
            <li>
             <a href="../index.php" id = "boton2">vitrina</a>    
            </li>
            
        </ul>
                                
        </form>
             
         </div>
          
    
</body>
</html>

 <?php       
    }
}
else {
   include('index.php');
}
?>

