<?php
include_once('../common/sesion2.php');
if($_SESSION['nivel']==6 || $_SESSION['nivel']==1){
}else{ header('Location: ../principal.php'); }
require('../../common/conexion.php');
if(isset($_GET['color'],$_GET['color_hex'] )){
        $color=$_GET['color'];
        $hex=$_GET['color_hex'];

         $sql = "INSERT INTO `COLOR`(`HEX`, `COLOR`) VALUES ('$hex','$color')";

        if ($conn->query($sql) === TRUE) {
            echo "<center>Nuevo COLOR registrado</center>";
            header('Location: ./colores.php');
           } else { //echo "Error: " . $sql . "<br>" . $conn->error;
                    echo '<script>alert("Error: Color Ya existe")</script>';
                    }
}
#paginacion y eliinacion de productos
if(isset($_GET['delete']) & !empty($_GET['delete'])){
    $idcolor=$_GET['delete'];
    #eliminar USURIO
    $sql ="DELETE FROM COLOR WHERE IDCOLOR='$idcolor'";
       if ($conn->query($sql) === TRUE) {
           } else {
             echo '<script> alert("Error:'. $sql . '<br>'. $conn->error.'"); </script>';
        }
}
$perpage  = 5;
if(isset($_GET['page']) & !empty($_GET['page'])){
	$curpage = $_GET['page'];
}else{
	$curpage = 1;
}
$start = ($curpage * $perpage) - $perpage;
#necesito el total de elementos
$PageSql = "SELECT * FROM COLOR";
$pageres = mysqli_query($conn, $PageSql);
$totalres = mysqli_num_rows($pageres);
$endpage = ceil($totalres/$perpage);
$startpage = 1;
$nextpage = $curpage + 1;
$previouspage = $curpage - 1;
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
    <link href="../../css/new.css" rel="stylesheet">
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
                        <h4 class="page-title">Desarrollo</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="../principal.php">Inicio</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="index.php">Desarrollo</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Colores</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
              <div class="row justify-content-around">
                  <div class="col-sm-4 text-center">
                    <a class="btn btn-link text-success" href="usuarios.php">Agregar/Eliminar Usuario</a>
                  </div>
                  <div class="col-sm-4 text-center">
                    <a class="btn btn-link text-success" href="categoria.php">Agregar/Eliminar Categoria</a>
                  </div>
                  <div class="col-sm-4 text-center">
                    <a class="btn btn-link text-success" href="colores.php">Agregar/Eliminar Color</a>
                  </div>
              </div>
                <div class="row mt-3">
                  <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Colores en Base de Datos</h4>
                      <h6 class="card-subtitle">Estos colores serán usados para filtrar las busquedas en la página web.</h6>
                    </div>
                    <div class="row justify-content-center mt-1 bg-white py-2">
                      <h3>Agregar el Nuevo Color</h3>
                    </div>
                    <form class="" action="" method="GET">
                    <div class="row mt-3 justify-content-center">
                      <div class="input-group mb-3 col-6">
                        <div class="input-group-append">
                          <span class="input-group-text"><b>Nombre del Color</b></span>
                        </div>
                        <input type="text" name="color" class="form-control text-secondary" placeholder="Ingrese el nombre del color" required>
                      </div>
                      <div class="input-group mb-3 col-1">
                        <input type="color" name="color_hex"  style="background:#fff; border: #ddd solid 1px;  " required>
                      </div>
                    </div>
                    <div class="row justify-content-center mb-3">
                      <button type="submit" class="btn btn-outline-primary">Agregar</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
              <?php
                $sql = "SELECT * FROM COLOR LIMIT $start, $perpage";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                ?>
                <div class="row mt-3 justify-content-center">
                  <div class="col-10">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Colores en Base de Datos</h4>
                      <h6 class="card-subtitle">Estos colores serviran de filtro en las busquedas de la página</h6>
                    </div>
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead class="thead-light">
                          <tr  class="text-center">
                            <th scope="col">Color</th>
                            <th scope="col">Nombre</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                             <?php
                                while($row = $result->fetch_assoc()){
                                   ?>
                                      <tr class="text-center">
                                        <td><span class="dot3" style="background-color:<?=$row['HEX']?>"></span></td>
                                        <td><?=$row['COLOR']?></td>
                                        <td><a href="javascript:void(0)" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#eli<?php echo $row['IDCOLOR']; ?>">Eliminar</a></td>
                                    </tr>
                                    <div class="modal fade" id="eli<?php echo $row['IDCOLOR']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title">¿Desea eliminar el producto?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            <div class="container">
                                              <div class="row justify-content-around">
                                                <div class="col-auto">
                                                  <?=$row['COLOR']?>
                                                </div>
                                                <div class="col-auto">
                                                  <span class="dot3" style="background-color:<?=$row['HEX']?>"></span>
                                                </div>
                                              </div>
                                            </div>
                                          </br>
                                            Tenga en cuenta no se podrá filtrar en la pagina por este color.</br>
                                            Consulte con su supervisor antes de realizar esta acción.
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <a href="?delete=<?=$row['IDCOLOR']?>" class="btn btn-primary">Eliminar</a>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                      </tr>
                                <?php
                                    }
                               ?>
                        </tbody>
                      </table>
                      <center>
                        <nav aria-label="Page navigation example">
                          <ul class="pagination justify-content-center">
                            <?php if($curpage != $startpage){ ?>
                              <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $startpage ?>" tabindex="-1" aria-label="Previous">
                                  <span aria-hidden="true">&laquo;</span>
                                  <span class="sr-only">firts</span>
                                </a>
                              </li>
                              <?php }
                          if($curpage >=2){ ?>
                            <li class="page-item"><a class="page-link" href="?page=<?php echo $previouspage ?>"><?php echo $previouspage ?></a></li>
                            <?php }  ?>
                            <li class="page-item active"><a class="page-link" href="?page=<?php echo $curpage ?>"><?php echo $curpage ?></a></li>
                            <?php if($curpage != $endpage){ ?>
                            <li class="page-item"><a class="page-link" href="?page=<?php echo $nextpage ?>"><?php echo $nextpage ?></a></li>
                        <?php }
                         if($curpage != $endpage){ ?>
                        <li class="page-item">
                          <a class="page-link" href="?page=<?php echo $endpage ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Last</span>
                          </a>
                        </li>
                        <?php } ?>
                          </ul>
                        </nav>
                     </center>
                    </div>
                  </div>
                </div>
                </div>
                <?php   }else{
                  ?>
                  <    <h4 class="card-title text-center">Sin Colores en Base de Datos</h4>
                  <?php
                } ?>
            </div>
            <?php include('../common/footer.php'); ?>
        </div>
    </div>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../dist/js/custom.min.js"></script>
</body>
</html>
