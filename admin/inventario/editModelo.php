<?php
include_once('../common/sesion2.php');
require('../../common/conexion.php');

#Recoleccion de caracteristicas
if (isset($_GET['idmodelo']) and !empty($_GET['idmodelo'])){
  $idmodelo=$_GET['idmodelo'];
  #lectura de producto
  $sql="SELECT * FROM MODELOS WHERE IDMODELO='$idmodelo'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
  // output data of each row
     while($row = $result->fetch_assoc()) {
       $idproducto=$row['IDPRODUCTO'];
       $color1=$row['COLOR1'];
       $color2=$row['COLOR2'];
      #$image=$row['IMAGEN'];
     }
  }
}

#consulta de la existencia de los post
if (isset($_POST['idmodelo'], $_POST['idproducto'], $_POST['color1'], $_POST['color2'])) {
//LECTURA DE VARIABLES
$idmodelo=$_POST['idmodelo'];
$idproducto = $_POST['idproducto'];
$color1 =  $_POST['color1'];
$color2= $_POST['color2'];
//ESCRIBE EL COMANDO SQL para actualizar
$sql="UPDATE `MODELOS` SET `IDPRODUCTO`=$idproducto,`COLOR1`=$color1,`COLOR2`=$color2 WHERE IDMODELO=$idmodelo";
if ($conn->query($sql) === TRUE) {
    #echo "<p>MODELO Modificado</p>";
    header('Location: ./modelo.php');
   }else {
  #   echo "Error: " . $sql . "<br>" . $conn->error;
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
                  <input type="hidden" name="idmodelo" value="<?php echo $idmodelo ;?>">
              <div class="row mt-3">
                <div class="input-group mb-3 col-6">
                  <div class="input-group-prepend">
                    <label class="input-group-text"><b>Seleccione el producto</b></label>
                  </div>
                  <select name="idproducto" class="custom-select text-secondary">
                    <?php
                       $sql="SELECT * FROM PRODUCTOS";
                       $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                          while($row = $result->fetch_assoc()) {
                            ?>
                    <option value="<?=$row['IDPRODUCTO']?>" <?php if($idproducto==$row['IDPRODUCTO']){ echo 'selected';} ?>><?=$row['NOMBRE_P']?></option>
                            <?php
                       }
                      }
                      ?>
                  </select>
                </div>
                <div class="input-group mb-3 col-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text"><b>Color principal</b></label>
                  </div>
                  <select name="color1" class="custom-select text-secondary">
                     <?php
                       $sql="SELECT * FROM COLOR";
                       $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                          while($row = $result->fetch_assoc()) {
                            ?>
                        <option value="<?=$row['IDCOLOR']?>"  <?php if($color1==$row['IDCOLOR']){ echo 'selected';} ?>><?=$row['COLOR']?></option>
                            <?php
                       }
                      }
                      ?>
                  </select>
                </div>
                <div class="input-group mb-3 col-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text"><b>Color secundario</b></label>
                  </div>
                  <select name="color2" class="custom-select text-secondary">
                     <?php
                       $sql="SELECT * FROM COLOR";
                       $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                          while($row = $result->fetch_assoc()){
                            ?>
                        <option value="<?=$row['IDCOLOR']?>"  <?php if($color2==$row['IDCOLOR']){ echo 'selected';} ?>><?=$row['COLOR']?></option>
                            <?php
                       }
                      }
                      ?>
                  </select>
                </div>
              </div>
              <div class="row justify-content-center mb-3 my-3" >
                <a class="btn btn-outline-danger col-auto m-2" href="modelo.php">Cancelar</a>
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
