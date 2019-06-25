<?php
include_once('../common/sesion2.php');
require('../../common/conexion.php');
#eliminar elemento
if(isset($_GET['delete']) & !empty($_GET['delete'])){
    $idproducto=$_GET['delete'];
    #eliminar image
        #consigue direcion de imagen de producto
        $sql="SELECT IMAGEN FROM PRODUCTOS WHERE IDPRODUCTO='$idproducto' LIMIT 1";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
              $imagen=$row['IMAGEN'];
               #elimina archivo
              unlink('../imagen/productos/'.$imagen);

           }
          }
    #eliminar producto
    $sql ="DELETE FROM PRODUCTOS WHERE IDPRODUCTO='$idproducto'";
       if ($conn->query($sql) === TRUE) {
           } else { echo '<script> alert("Error:'. $sql . '<br>'. $conn->error.'"); </script>'; }
}
#paginacion
$perpage  = 5;
if(isset($_GET['page']) & !empty($_GET['page'])){
	$curpage = $_GET['page'];
}else{$curpage = 1;}
$start = ($curpage * $perpage) - $perpage;
#necesito el total de elementos
$PageSql = "SELECT * FROM PRODUCTOS";
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
                    <div class="col-auto align-self-center">
                        <h4 class="page-title">Inventario</h4>
                    </div>
                    <div class="col-auto align-self-center ml-auto">
                        <div class="d-flex align-items-center justify-content-end">
                          <div class="container">
                            <div class="row">
                              <div class="col-auto">
                                <a href="../principal.php">Inicio</a>
                              </div>
                              <div class="col-auto">
                                <a href="index.php">Inventario</a>
                              </div>
                              <div class="col-auto">
                                Añadir/Eliminar Producto
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
              <div class="row">
                  <div class="col-sm-4 text-center">
                    <a class="btn btn-link text-success" href="producto.php">Agregar/Eliminar Producto</a>
                  </div>
                  <div class="col-sm-4 text-center">
                    <a class="btn btn-link text-success" href="modelo.php">Agregar/Eliminar Modelo</a>
                  </div>
                  <div class="col-sm-4 text-center">
                    <a class="btn btn-link text-success" href="tallas.php">Agregar/Eliminar Talla</a>
                  </div>
              </div>
              <div class="row justify-content-center mt-1 bg-white py-2">
                <h3>Agregue las caracteristicas del producto</h3>
              </div>
              <form class="" action="addProducto.php" method="POST" enctype="multipart/form-data">
                <div class="row mt-3">
                <div class="input-group mb-3 col-sm-6">
                  <div class="input-group-append">
                    <span class="input-group-text"><b>Nombre del Producto</b></span>
                  </div>
                  <input type="text" name="nombre_p" class="form-control text-secondary" placeholder="Ingrese el nombre" required>
                </div>
                <div class="input-group mb-3 col-sm-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text"><b>Prenda</b></label>
                  </div>
                  <select name="tipo" class="custom-select text-secondary">
                  <?php
                  $sql="SELECT IDCATEGORIA, NOMBRE FROM CATEGORIAS WHERE PADRE=0";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {
                        $id=$row['IDCATEGORIA'];
                        $nombre=$row['NOMBRE'];
                        ?>
                          <option value="<?php echo $id; ?>"><?php echo $nombre; ?></option>
                        <?php
                      }
                  }
                   ?>
                  </select>
                </div>
                <div class="input-group mb-3 col-sm-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text"><b>Genero</b></label>
                  </div>
                  <select name="genero" class="custom-select text-secondary">
                    <option value="1">Dama</option>
                    <option value="2">Caballero</option>
                    <option value="3">Niño</option>
                    <option value="4">Niña</option>
                  </select>
                </div>
                <div class="input-group mb-3 col-sm-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text"><b>Marca</b></label>
                  </div>
                  <select class="custom-select text-secondary" name="marca">
                    <option value="Rouxa">Rouxa</option>
                    <option value="Nike">Nike</option>
                    <option value="Polo">Polo</option>
                    <option value="Adidas">Adidas</option>
                  </select>
                </div>
                <div class="input-group mb-3 col-sm-3">
                  <div class="input-group-append">
                    <span class="input-group-text"><b>Material</b></span>
                  </div>
                  <input type="text" name="material" class="form-control text-secondary" placeholder="Ej: Algodon" required>
                </div>
                <div class="input-group mb-3 col-sm-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text"><b>Cuello</b></label>
                  </div>
                  <select name="cuello" class="custom-select text-secondary">
                    <option value="0">No Aplica</option>
                    <option value="1">Redondo</option>
                    <option value="2">En V</option>
                    <option value="3">Mao</option>
                    <option value="4">Chemise</option>
                  </select>
                </div>
                <div class="input-group mb-3 col-sm-3">
                  <div class="input-group-prepend">
                    <label class="input-group-text"><b>Manga</b></label>
                  </div>
                  <select name="manga" class="custom-select text-secondary">
                     <option value="0">No Aplica</option>
                    <option value="1">Corta</option>
                    <option value="2">3/4</option>
                    <option value="3">Larga</option>
                    <option value="4">Sin Manga</option>
                  </select>
                </div>
                <div class="input-group mb-3 col-sm-3">
                  <div class="input-group-append">
                    <span class="input-group-text"><b>Precio</b></span>
                  </div>
                  <input type="number" name="precio" class="form-control text-secondary" placeholder="Precio al detal" required>
                </div>
                <div class="input-group mb-3 col-sm-9">
                  <div class="input-group-append">
                    <span class="input-group-text"><b>Descripción</b></span>
                  </div>
                  <input type="text" name="descripcion" class="form-control text-secondary" placeholder="Describa el producto, esta descripcion será visible por el cliente" required>
                </div>
                <div class="col-12">
                  <input class="form-group" name="archivo" type="file"/ required>
                </div>
              </div>
                <div class="row justify-content-center mb-3">
                  <button type="submit" class="btn btn-outline-primary">Agregar</button>
                </div>
              </form>
                <div class="row mt-3">
                  <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Productos en Inventario</h4>
                      <h6 class="card-subtitle">Aca podras ver los productos que se encuentran en el inventario.</h6>
                    </div><?php
                    $sql = "SELECT * FROM PRODUCTOS  LIMIT $start, $perpage";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                   ?>
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">Producto</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Prenda</th>
                            <th scope="col">Genero</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Material</th>
                            <th scope="col">Precio</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                                while($row = $result->fetch_assoc()) {
                                  $IDCAT=$row['TIPO'];
                                  $sql2="SELECT NOMBRE FROM CATEGORIAS WHERE IDCATEGORIA=$IDCAT";
                                  $result2 = $conn->query($sql2);
                                  if ($result2->num_rows > 0) {
                                      while($row2 = $result2->fetch_assoc()) {
                                        $nombre=$row2['NOMBRE'];
                                      }
                                  }
                                   ?>
                                   <tr>
                                    <td class="text-center"><img src="../../imagen/<?php echo $row['IMAGEN']; ?>" width="20px" alt=""></td>
                                    <td><?php echo $row['NOMBRE_P']; ?></td>
                                    <td><?=ucwords($nombre);?></td>
                                    <td><?php switch($row['GENERO']){
                                      case '1': echo 'Dama';
                                       break;
                                      case '2': echo 'Caballero';
                                       break;
                                       case '3': echo 'Niño';
                                        break;
                                        case '4': echo 'Niña';
                                        break;
                                        default: echo 'Otro'; break; }?></td>
                                    <td><?=ucwords($row['MARCA'])?></td>
                                    <td><?=ucwords($row['MATERIAL']);?></td>
                                    <td><?php echo number_format($row['PRECIO'], 2, ',', '.'); ?></td>
                                    <td><a href="editProducto.php?idproducto=<?=$row['IDPRODUCTO']?>" class="btn btn-outline-success btn-sm">Editar</a>
                                      <a href="javascript:void(0)" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#eli<?=$row['IDPRODUCTO']?>">Eliminar</a>
                                    </td>
                                  </tr>
                                  <div class="modal fade" id="eli<?=$row['IDPRODUCTO']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            <div class="row">
                                              <div class="col-2">
                                                <img src="../../imagen/<?php echo $row['IMAGEN'];?>" width="20px" alt="">
                                              </div>
                                              <div class="col-6">
                                                <?php echo $row['NOMBRE_P'];?>
                                              </div>
                                              <div class="col-4">
                                                <?=ucwords($row['MARCA']);?>
                                              </div>
                                            </div>
                                          </div>
                                        </br>
                                          Tenga en cuenta que se eliminarán todos los modelos, y tallas que se encuentran registrados en el sistema.</br>
                                          Consulte con su supervisor antes de realizar esta acción.
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                          <a href="producto.php?delete=<?=$row['IDPRODUCTO']?>" class="btn btn-primary">Eliminar</a>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
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
                    <?php } ?>
                          <?php if($curpage >=2){ ?>
                            <li class="page-item"><a class="page-link" href="?page=<?php echo $previouspage ?>"><?php echo $previouspage ?></a></li>
                            <?php }  ?>

                            <li class="page-item active"><a class="page-link" href="?page=<?php echo $curpage ?>"><?php echo $curpage ?></a></li>

                            <?php if($curpage != $endpage){ ?>
                            <li class="page-item"><a class="page-link" href="?page=<?php echo $nextpage ?>"><?php echo $nextpage ?></a></li>
                        <?php } ?>
                         <?php if($curpage != $endpage){ ?>
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
                  <?php }else{
                    ?>
                    <div class="card">
                      <div class="card-title text-center">
                        <h5>Sin Productos en Inventario</h5>
                      </div>
                    </div>
                    <?php
                     }  ?>
                  </div>
                </div>
                </div>
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
