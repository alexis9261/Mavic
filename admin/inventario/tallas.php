<?php
include_once('../common/sesion2.php');
require('../../common/conexion.php');
#Añadir elemento
if(isset($_POST['add'],$_POST['cant']) & !empty($_POST['add'])){
    $idinventario=$_POST['add'];
    $cantidad=$_POST['cant'];
    $sql = "UPDATE INVENTARIO SET CANTIDAD=CANTIDAD+$cantidad WHERE IDINVENTARIO = '$idinventario';";
                   if ($conn->query($sql) === TRUE) {
                        #echo '<script> alert("Inventario Actualizado"); </script>';
                        header('Location: ./tallas.php');
                      } else {
                      #   echo '<script> alert("Error:'. $sql . '<br>'. $conn->error.'"); </script>';
                        }
}
#eliminar elemento
if(isset($_GET['delete']) & !empty($_GET['delete'])){
    $idinventario=$_GET['delete'];
    $sql ="DELETE FROM INVENTARIO WHERE IDINVENTARIO='$idinventario'";
       if ($conn->query($sql) === TRUE) {
       }else{# echo '<script> alert("Error:'. $sql . '<br>'. $conn->error.'"); </script>';
       }
}
#paginacion de tallas bien aqui..
$perpage  = 5;
if(isset($_GET['page']) & !empty($_GET['page'])){
	$curpage = $_GET['page'];
}else{ $curpage = 1;}
$start = ($curpage * $perpage) - $perpage;
#necesito el total de elementos
$PageSql = "SELECT * FROM INVENTARIO";
$pageres = mysqli_query($conn, $PageSql);
$totalres = mysqli_num_rows($pageres);
$endpage = ceil($totalres/$perpage);
$startpage = 1;
$nextpage = $curpage + 1;
$previouspage = $curpage - 1;
if(isset($_POST['modelo'],$_POST['talla'],$_POST['cantidad'], $_POST['peso'])){
        $idmodelo=$_POST['modelo'];
        $talla=$_POST['talla'];
        $cantidad=$_POST['cantidad'];
        $peso=$_POST['peso'];
    if ($idmodelo!=NULL && $talla!=NULL && $cantidad!=NULL){
          $encontro=false;
          $sql="SELECT CANTIDAD, IDINVENTARIO FROM INVENTARIO WHERE IDMODELO='$idmodelo' AND TALLA='$talla' LIMIT 1;";
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
                      #  echo '<script> alert("Inventario Actualizado"); </script>';
                    }else{# echo '<script> alert("Error:'. $sql . '<br>'. $conn->error.'"); </script>';
                    }
              }else{
                  //ESCRIBE EL COMANDO SQL
                $sql = "INSERT INTO INVENTARIO (IDMODELO,TALLA, CANTIDAD, PESO)
                VALUES ('$idmodelo', '$talla', '$cantidad', '$peso')";
                    if ($conn->query($sql) === TRUE) {
                    #    echo '<script> alert("Inventario añadido"); </script>';
                  } else {#echo '<script> alert("Error:'. $sql . '<br>'. $conn->error.'"); </script>';
                  }
              }
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
                                Añadir/Eliminar Tallas
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
                <h3>Agregue tallas y cantidades por modelo</h3>
              </div>
              <form class="" action="" method="post">
              <div class="row mt-3">
                <div class="input-group mb-3 col-sm-6">
                  <div class="input-group-prepend">
                    <label class="input-group-text"><b>Seleccione el modelo</b></label>
                  </div>
                  <select name="modelo" class="custom-select text-secondary">
                    <?php
                      $sql="SELECT * FROM MODELOS m
                      INNER JOIN PRODUCTOS p ON p.IDPRODUCTO=m.IDPRODUCTO
                      ";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0){
                          while($row = $result->fetch_assoc()){
                            $idcolor1 = $row['COLOR1'];
                            $idcolor2 = $row['COLOR2'];
                            $sql1="SELECT * FROM COLOR WHERE IDCOLOR='$idcolor1' LIMIT 1";
                            $sql2="SELECT * FROM COLOR WHERE IDCOLOR='$idcolor2' LIMIT 1";
                            #color 1
                            $result1 = $conn->query($sql1);
                            if ($result1->num_rows > 0){
                                while($row1 = $result1->fetch_assoc()){
                                   $color1= $row1['COLOR'];
                                   $hex1=  $row1['HEX'];
                                }
                            }
                            #color 2
                            $result2 = $conn->query($sql2);
                            if($result2->num_rows > 0){
                                while($row2 = $result2->fetch_assoc()){
                                   $color2= $row2['COLOR'];
                                   $hex2=  $row2['HEX'];
                                }
                            }
                            switch($row['GENERO']){
                                case 1: $genero= 'Dama';
                                    break;
                                case 2: $genero= 'Caballero';
                                    break;
                                case 3: $genero= 'Niña';
                                    break;
                                case 4: $genero= 'Niño';
                                    break;
                                default: $genero= 'Unisex';
                                    break;
                            }
                            ?>
                    <option value="<?=$row['IDMODELO']?>"><?php echo $row['NOMBRE_P'].' '.$color1.'/'.$color2  ?></option>
                            <?php
                       }
                      }
                      ?>
                  </select>
                </div>
                <div class="input-group mb-3 col-sm-3">
                  <div class="input-group-append">
                    <span class="input-group-text"><b>Talla</b></span>
                  </div>
                  <select name="talla" id="talla" class="form-control text-secondary" required>
                        <option  value="" inactived>Seleccione una Talla</option>
                         <option value="XS">Talla XS</option>
                         <option value="S">Talla S</option>
                         <option value="M">Talla M</option>
                         <option value="L">Talla L</option>
                         <option value="XL">Talla XL</option>
                         <option value="XXL">Talla XXL</option>
                         <option value="U">Talla Unica</option>
                  </select>
                </div>
                <div class="input-group mb-3 col-sm-3">
                  <div class="input-group-append">
                    <span class="input-group-text"><b>Cantidad</b></span>
                  </div>
                  <input type="number" name="cantidad" class="form-control text-secondary" placeholder="Ingrese cantidad" min="1" required>
                </div>
                <div class="input-group mb-3 col-sm-3">
                  <div class="input-group-append">
                    <span class="input-group-text"><b>Peso (gr)</b></span>
                  </div>
                  <input type="number" name="peso" step="0.1" min="0.1" class="form-control text-secondary" placeholder="Ingrese el peso" required>
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
                      <h6 class="card-subtitle">Aca podras ver los productos que se encuentran en el inventario con sus tallas y cantidades.</h6>
                    </div>
                    <?php
                        $sql = "SELECT i.IDINVENTARIO, i.TALLA, i.CANTIDAD, m.IDMODELO, m.IMAGEN, m.COLOR1, m.COLOR2, p.NOMBRE_P, p.GENERO, p.TIPO, p.PRECIO, p.MARCA, i.PESO
                        FROM INVENTARIO i INNER JOIN MODELOS m ON m.IDMODELO=i.IDMODELO
                        INNER JOIN PRODUCTOS p ON p.IDPRODUCTO=m.IDPRODUCTO
                        LIMIT $start, $perpage";
                        $result = $conn->query($sql);
                        if($result->num_rows > 0){
                     ?>
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">Producto</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Talla</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio(Bs.)</th>
                            <th scope="col">Peso(gr)</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                         <?php
                                while($row = $result->fetch_assoc()){
                                    $idcolor1 = $row['COLOR1'];
                                    $idcolor2 = $row['COLOR2'];
                                    $sql1="SELECT * FROM COLOR WHERE IDCOLOR='$idcolor1' LIMIT 1";
                                    $sql2="SELECT * FROM COLOR WHERE IDCOLOR='$idcolor2' LIMIT 1";
                                    #color 1
                                    $result1 = $conn->query($sql1);
                                    if($result1->num_rows > 0){
                                        while($row1 = $result1->fetch_assoc()){
                                           $color1= $row1['COLOR'];
                                           $hex1=  $row1['HEX'];
                                        }
                                    }
                                    #color 2
                                    $result2 = $conn->query($sql2);
                                    if($result2->num_rows > 0){
                                        while($row2 = $result2->fetch_assoc()){
                                           $color2= $row2['COLOR'];
                                           $hex2=  $row2['HEX'];
                                        }
                                    }
                                     switch($row['GENERO']){
                                          case 1: $genero= 'Dama';
                                              break;
                                          case 2: $genero= 'Caballero';
                                              break;
                                          case 3: $genero= 'Niño';
                                              break;
                                          case 4: $genero= 'Niña';
                                              break;
                                          default: $genero= 'Otro';
                                              break;
                                      }
                                   ?>
                                  <tr>
                                    <td scope="row"><img src="../../imagen/<?php echo $row['IMAGEN'];?>" alt="" width="25px"/></td>
                                    <td><?php echo $row['NOMBRE_P'].' '.$color1.'/'.$color2 ;?></td>
                                    <td><?=$row['MARCA']?></td>
                                    <td><?=$row['TALLA']?></td>
                                    <td><?=$row['CANTIDAD']?></td>
                                    <td><?php echo number_format($row['PRECIO'], 2, ',', '.'); ?></td>
                                    <td><?=number_format($row['PESO'], 2,',', '.')?></td>
                                    <td><a href="javascript:void(0)" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#ag<?php echo $row['IDINVENTARIO'];?>">Modificar</a>
                                        <a href="javascript:void(0)" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#eli<?php echo $row['IDINVENTARIO'];?>">Eliminar</a></td>
                                  </tr>
                                  <div class="modal fade" id="ag<?php echo $row['IDINVENTARIO']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <form class="" action="" method="POST">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title">¿Desea Agregar o Sustraer cantidades de este modelo?</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          <div class="container">
                                            <div class="row">
                                            </div>
                                            <div class="row align-items-center">
                                              <div class="col-1">
                                                <img src="../../imagen/<?php echo $row['IMAGEN'];?>" alt="" width="25px"/>
                                              </div>
                                              <div class="col-5">
                                                <span>Cantidad en Talla <?=$row['TALLA']?></span>
                                              </div>
                                              <div class="col-2">
                                              </div>
                                              <div class="col-4">

                                                <input class="form-control" type="number" name="cant" value="0">
                                                <input type="hidden" name="add" value="<?=$row['IDINVENTARIO']?>">
                                              </div>
                                            </div>
                                          </div>
                                          <hr>
                                          <small>Si desea Añadir, la cantidad debe ser positiva (+). Si desea sustraer, la cantidad debe ser negativa (-).</small>
                                          <hr>
                                          Tenga en cuenta que se modifacará la cantidad de articulos de la talla seleccionada que se encuentran registrados en el sistema.</br>
                                          Consulte con su supervisor antes de realizar esta acción.
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                          <button type="submit"  class="btn btn-primary">Aceptar</a>
                                        </div>
                                      </div>
                                    </form>
                                    </div>
                                  </div>
                                  <div class="modal fade" id="eli<?php echo $row['IDINVENTARIO']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title">¿Desea eliminar todas las tallas de este modelo?</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          <div class="container">
                                            <div class="row align-items-center">
                                              <div class="col-2">
                                                <img src="../../imagen/<?php echo $row['IMAGEN'];?>" width="40px" alt="">
                                              </div>
                                              <div class="col-6">
                                                <?php echo $row['NOMBRE_P'].' '.$color1.'/'.$color2;?>
                                              </div>
                                              <div class="col-4">
                                                <?=ucwords($row['MARCA']);?>
                                              </div>
                                            </div>
                                            <div class="row">
                                              Eliminar las <?=$row['CANTIDAD']?> de la talla: <?=$row['TALLA']?>
                                            </div>
                                          </div>
                                        </br>
                                          Tenga en cuenta que se eliminarán todas las cantidadesde esta talla que se encuentran registrados en el sistema.</br>
                                          Consulte con su supervisor antes de realizar esta acción.
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                          <a href="tallas.php?delete=<?=$row['IDINVENTARIO']?>" class="btn btn-primary">Eliminar</a>
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
                          <?php }
                                 if($curpage >=2){ ?>
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
                          <h5>Sin Productos Con Tallas y Cantidades</h5>
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
