<?php
include_once('../common/sesion2.php');
require('../../common/conexion.php');
#Recoleccion de caracteristicas
if (isset($_GET['idproducto']) and !empty($_GET['idproducto'])){
  $idproducto=$_GET['idproducto'];
  #lectura de producto
  $sql="SELECT * FROM PRODUCTOS WHERE IDPRODUCTO='$idproducto'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
  // output data of each row
     while($row = $result->fetch_assoc()) {
       $nombre_p=$row['NOMBRE_P'];
       $prenda=$row['TIPO'];
       $genero=$row['GENERO'];
       $marca=$row['MARCA'];
       $material=$row['MATERIAL'];
       $cuello=$row['CUELLO'];
       $manga=$row['MANGA'];
       $precio=$row['PRECIO'];
       $descripcion=$row['DESCRIPCION'];
       $image=$row['IMAGEN'];
     }
  }
}

#consulta de la existencia de los post
if (isset($_POST['idproducto'], $_POST['nombre_p'], $_POST['descripcion'], $_POST['genero'], $_POST['tipo'], $_POST['precio'], $_POST['cuello'], $_POST['manga'], $_POST['material'], $_POST['marca'])){
//LECTURA DE VARIABLES
$idproducto=$_POST['idproducto'];
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
//ESCRIBE EL COMANDO SQL para actualizar
$sql="UPDATE `PRODUCTOS` SET `NOMBRE_P`='$nombre_p',`DESCRIPCION`='$descripcion',`GENERO`=$genero,`TIPO`='$tipo',`PRECIO`='$precio',`MATERIAL`='$material',`MARCA`='$marca',`MANGA`=$manga,`CUELLO`=$cuello WHERE IDPRODUCTO=$idproducto";
if ($conn->query($sql) === TRUE) {
    #echo "<p>PRODUCTO Modificado</p>";
    header('Location: ./producto.php');
   } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
 ?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Administración de la E-Comerce Rouxa.">
    <meta name="author" content="Eutuxia Web, C.A.">
    <link rel="icon" type="image/jpg" sizes="16x16" href="../../imagen/favicon.jpg">
    <title>Rouxa - Administración</title>
    <link href="../dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-navbarbg="skin6" data-theme="light" data-layout="vertical" data-sidebartype="full" data-boxed-layout="full">
        <?php include('../common/navbar2.php'); ?>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Inventario</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="../principal.php">Inicio</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="index.php">Inventario</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="index.php">Añadir/Eliminar Producto</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Modificar Producto</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
              <div class="row justify-content-center mt-1 bg-white py-2">
                <h3>Modifique las caracteristicas</h3>
              </div>
              <form class="" action="" method="POST">
                <input type="hidden" name="idproducto" value="<?=$idproducto?>">
              <div class="row mt-3">
                <div class="input-group mb-3 col-6">
                  <div class="input-group-append">
                    <span class="input-group-text"><b>Nombre del Producto</b></span>
                  </div>
                  <input type="text" name="nombre_p" class="form-control text-secondary" placeholder="Ingrese el nombre" value="<?=$nombre_p?>">
                </div>
                <div class="input-group mb-3 col-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text"><b>Prenda</b></label>
                  </div>
                  <select name="tipo" class="custom-select text-secondary">
                    <?PHP
                      $sql="SELECT IDCATEGORIA,NOMBRE FROM CATEGORIAS WHERE PADRE=0";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                          while($row = $result->fetch_assoc()) {
                              if ($prenda==$row['IDCATEGORIA']){
                                ?>
                                <option value="<?=$row['IDCATEGORIA']?>" selected><?=$row['NOMBRE']?></option>
                                <?php
                              }else{
                                ?>
                                <option value="<?=$row['IDCATEGORIA']?>"><?=$row['NOMBRE']?></option>
                                <?php
                              }
                          }
                        }
                    ?>
                  </select>
                </div>
                <div class="input-group mb-3 col-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text"><b>Genero</b></label>
                  </div>
                  <select name="genero" class="custom-select text-secondary">
                    <?php
                    #dama
                    if ($genero=='1'){
                      echo '<option value="1" selected>Dama</option>';
                    }else{
                      echo '<option value="1">Dama</option>';
                    }
                    #Caballero
                    if($genero=='2'){
                      echo '<option value="2" selected>Caballero</option>';
                    }else{
                      echo '<option value="2">Caballero</option>';
                    }
                    #niño
                    if($genero=='3'){
                      echo '<option value="3" selected>Niño</option>';
                    }else{
                      echo '<option value="3">Niño</option>';
                    }
                    #niña
                    if($genero=='4'){
                      echo '<option value="4" selected>Niña</option>';
                    }else{
                      echo '<option value="4">Niña</option>';
                    }
                  ?>
                  </select>
                </div>
                <div class="input-group mb-3 col-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text"><b>Marca</b></label>
                  </div>
                  <select class="custom-select text-secondary" name="marca">
                    <?php
                    #rouxa
                    if ($marca=='Rouxa'){
                      echo '<option value="Rouxa" selected>Rouxa</option>';
                    }else{
                      echo '<option value="Rouxa">Rouxa</option>';
                    }
                    #nike
                    if($marca=='Nike'){
                      echo '  <option value="Nike" selected>Nike</option>';
                    }else{
                      echo '  <option value="Nike">Nike</option>';
                    }
                    #Polo
                    if($marca=='Polo'){
                      echo '<option value="Polo" selected>Polo</option>';
                    }else{
                      echo '<option value="Polo">Polo</option>';
                    }
                    if($marca=='Adidas'){
                      echo '<option value="Adidas" selected>Adidas</option>';
                    }else{
                      echo '<option value="Adidas">Adidas</option>';
                    }
                     ?>
                  </select>
                </div>
                <div class="input-group mb-3 col-3">
                  <div class="input-group-append">
                    <span class="input-group-text"><b>Material</b></span>
                  </div>
                  <input type="text" name="material" class="form-control text-secondary" placeholder="Ej: Algodon" value="<?=$material?>">
                </div>
                <div class="input-group mb-3 col-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text"><b>Cuello</b></label>
                  </div>
                  <select name="cuello" class="custom-select text-secondary">
                    <?php
                      if ($cuello=='0') {
                        echo '<option value="0" selected>No Aplica</option>';
                      }else{
                        echo '<option value="0">No Aplica</option>';
                      }
                      if($cuello=='1'){
                        echo '<option value="1" selected>Redondo</option>';
                      }else{
                        echo '<option value="1">Redondo</option>';
                      }
                      if($cuello=='2'){
                        echo '<option value="2" selected>En V</option>';
                      }else{
                        echo '<option value="2">En V</option>';
                      }
                      if($cuello=='3'){
                        echo ' <option value="3" selected>Mao</option>';
                      }else{
                        echo ' <option value="3">Mao</option>';
                      }
                      if($cuello=='4'){
                        echo '<option value="4" selected>Chemise</option>';
                      }else{
                        echo '<option value="4">Chemise</option>';
                      }
                     ?>
                  </select>
                </div>
                <div class="input-group mb-3 col-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text"><b>Manga</b></label>
                  </div>
                  <select name="manga" class="custom-select text-secondary">
                    <?php
                      if ($manga=='0') {
                        echo '<option value="0" selected>No Aplica</option>';
                      }else{
                        echo '<option value="0">No Aplica</option>';
                      }
                      if($manga=='1'){
                        echo '<option value="1" selected>Corta</option>';
                      }else{
                        echo '<option value="1">Corta</option>';
                      }
                      if($manga=='2'){
                        echo '<option value="2" selected>3/4</option>';
                      }else{
                        echo '<option value="2">3/4</option>';
                      }
                      if($manga=='3'){
                        echo ' <option value="3" selected>Larga</option>';
                      }else{
                        echo ' <option value="3">Larga</option>';
                      }
                      if($manga=='4'){
                        echo '<option value="4" selected>Sin Manga</option>';
                      }else{
                        echo '<option value="4">Sin Manga</option>';
                      }
                     ?>
                  </select>
                </div>
                <div class="input-group mb-3 col-3">
                  <div class="input-group-append">
                    <span class="input-group-text"><b>Precio</b></span>
                  </div>
                  <input type="number" name="precio" class="form-control text-secondary" placeholder="Precio al detal" value="<?=$precio?>">
                </div>
                <div class="input-group mb-3 col-9">
                  <div class="input-group-append">
                    <span class="input-group-text"><b>Descripción</b></span>
                  </div>
                  <input type="text" name="descripcion" class="form-control text-secondary" placeholder="Describa el producto, esta descripcion será visible por el cliente" value="<?=$descripcion?>">
                </div>
              </div>
              <div class="row justify-content-center mb-3 my-3" >
                <a class="btn btn-outline-danger col-auto m-2" href="producto.php">Cancelar</a>
                <button type="submit" class="btn btn-outline-primary col-auto m-2">Modificar</button>
              </div>
              </form>
            </div>
            <?php include('../common/footer.php'); ?>
        </div>
    </div>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../assets/extra-libs/sparkline/sparkline.js"></script>
    <script src="../dist/js/waves.js"></script>
    <script src="../dist/js/sidebarmenu.js"></script>
    <script src="../dist/js/custom.min.js"></script>
</body>
</html>
<?php
$conn->close();
?>
