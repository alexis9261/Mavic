<?php
include_once('../common/sesion2.php');
require('../../common/conexion.php');
$perpage  = 5;
if(isset($_GET['page']) & !empty($_GET['page'])){
	$curpage = $_GET['page'];
}else{
	$curpage = 1;
}
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
                                    <li class="breadcrumb-item active" aria-current="page">Inventario</li>
                                </ol>
                            </nav>
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
                <div class="row mt-3">
                  <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Productos en Inventario</h4>
                      <h6 class="card-subtitle">Aca podras ver algunos de los productos que se encuentran en el inventario.</h6>
                    </div>
										<?php
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
                            <th scope="col">Genero</th>
														<th scope="col">Marca</th>
														<th scope="col">Tipo</th>
														<th scope="col">Material</th>
                            <th scope="col">Precio(Bs.)</th>
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
                                  <td class="text-center"><img src="../../imagen/<?php echo $row['IMAGEN']; ?>" width="30px" alt=""></td>
                                  <td><?php echo $row['NOMBRE_P']; ?></td>
                                  <td><?php switch($row['GENERO']){case '1': echo 'Dama'; break; case '2': echo 'Caballero'; break; default: echo 'Otro'; break; }?></td>
                                  <td><?=ucwords($row['MARCA'])?></td>
																	<td><?=ucwords($nombre)?></td>
																	<td><?=ucwords($row['MATERIAL'])?></td>
                                  <td><?php echo number_format($row['PRECIO'], 2, ',', '.'); ?></td>
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
										<?php
											} else{
												?>
												<div class="card">
													<div class="card-title text-center">
														<h5>Sin Productos en Inventario</h5>
													</div>
												</div>
												<?php
											}
										 ?>
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
