<?php
    session_start();
    include '../common/conexion.php';
    include_once '../common/TasaUSD2.php';
if (isset($_SESSION['carrito'])){
      $arreglo=$_SESSION['carrito'];
      if(isset($_POST["id"], $_POST["cantidad"], $_POST["talla"] )){
        $cantidad=$_POST['cantidad'];
        $idinventario=$_POST["id"];
        $talla=$_POST["talla"];
        #consulta si el articulo se repite.
        $encontro=false;
        foreach($arreglo as &$a){
          if($a['Id']==$idinventario){
              if($a['Talla']==$talla){
              $encontro=true;
              $a['Cantidad']= $cantidad;
              }
          }
        }
        if($encontro==true){
            $_SESSION['carrito']=$arreglo;
        }else{
          $sql="SELECT  *, m.IMAGEN AS IMAGEN FROM INVENTARIO i
          INNER JOIN MODELOS m ON m.IDMODELO=i.IDMODELO
          INNER JOIN PRODUCTOS p ON  p.IDPRODUCTO=m.IDPRODUCTO
          WHERE IDINVENTARIO=$idinventario LIMIT 1";
            $res = $conn->query($sql);
            while($f = $res->fetch_assoc()){
                    $nombre=$f["NOMBRE_P"];
                    $precio=$f["PRECIO"]*$tasa_usd;
                    $imagen=$f["IMAGEN"];
                    $peso=$f["PESO"];
                }
            $newarreglo=array('Id'=>$idinventario,'Nombre'=>$nombre, 'Precio'=>$precio, 'Imagen'=> $imagen, 'Cantidad'=>$cantidad, 'Talla'=>$talla, 'Peso'=>$peso);
            array_push($arreglo,$newarreglo);
            $_SESSION['carrito']=$arreglo;
        }
      }
      if(isset($_GET['delete'],$_GET['talla']) and !empty($_GET['delete']) and !empty($_GET['talla'])){
          $iddelete=$_GET['delete'];
          $talladelete=$_GET['talla'];
          $i=0;
          foreach ($arreglo as $a) {
            if(($a['Id']==$iddelete) and ($a['Talla']==$talladelete)){
                $catch=$i;
            }
              $i++;
          }
          if(isset($catch)){
            unset($arreglo[$catch]);
            $arreglo= array_values($arreglo);
            $_SESSION['carrito']=$arreglo;
          }
          header('Location: carrito.php');
      }
}else {
    if (isset($_POST["id"], $_POST["cantidad"], $_POST["talla"] )){
        $idinventario=$_POST["id"];
        $cantidad=$_POST["cantidad"];
        $talla=$_POST["talla"];
        #llamado SQL
        $sql="SELECT  *, m.IMAGEN AS IMAGEN FROM INVENTARIO i
        INNER JOIN MODELOS m ON m.IDMODELO=i.IDMODELO
        INNER JOIN PRODUCTOS p ON  p.IDPRODUCTO=m.IDPRODUCTO
        WHERE IDINVENTARIO=$idinventario LIMIT 1";
        $res = $conn->query($sql);
        while($f = $res->fetch_assoc()){
                $nombre=$f["NOMBRE_P"];
                $precio=$f["PRECIO"]*$tasa_usd;
                $imagen=$f["IMAGEN"];
                $peso=$f["PESO"];
            }
        $arreglo[]=array('Id'=>$idinventario,'Nombre'=>$nombre, 'Precio'=>$precio, 'Imagen'=> $imagen, 'Cantidad'=>$cantidad, 'Talla'=>$talla, 'Peso'=>$peso);
        $_SESSION['carrito']=$arreglo;
    }
}
?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="desciption" content="Rouxa, Tienda virtual de Ropa para Damas, Caballeros y Niños.">
    <meta name="keywords" content="Rouxa, Ropa, Damas, Caballeros, Zapatos, Tienda Virtual">
    <meta name="author" content="Eutuxia, C.A.">
    <meta name="application-name" content="Tienda Virtual de Ropa, Rouxa."/>
    <link rel="icon" type="image/jpg" sizes="16x16" href="../imagen/favicon.jpg">
    <link rel="stylesheet" href="../css/style-main.css">
    <link rel="stylesheet" href="../css/new.css">
    <link href="../admin/assets/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.11/css/all.css" integrity="sha384-p2jx59pefphTFIpeqCcISO9MdVfIm4pNnsL08A6v5vaQc4owkQqxMV8kg4Yvhaw/" crossorigin="anonymous">
    <title>Rouxa-Carrrito de Compras</title>
  </head>
  <body>
  <?php include_once '../common/menu2.php';
        include_once '../common/2domenu2.php';
        if(isset($_SESSION['carrito']) and count($_SESSION['carrito'])>0 ){
              ?>
              <div class="container mt-3">
                <div class="row">
                  <div class="col-12 breadcrumb text-muted">
                    Realiza todas tus compras de manera segura, pagando via Mercado Pago.
                  </div>
                </div>
              </div>
              <div class="container">
                <div class="row justify-content-between">
                  <div class="col-sm-7 mt-2">
                    <div class="row justify-content-between bg-light py-2">
                      <div class="col-auto">
                        <h5 id="title"></h5>
                      </div>
                        <div class="col-auto">
                          <a href="../vitrina/index.php">Seguir Comprando</a>
                        </div>
                    </div>
                    <?php
                    $datos=$_SESSION['carrito'];
                    $subtotal=0;
                    $peso=0;
                    $cantidad_total=0;
                    $i=0;
                    foreach($datos as $d){
                        $i++;
                        $total_modelo=$d['Cantidad']*$d['Precio'];
                        $cantidad_total+=$d['Cantidad'];
                        $idinv=$d['Id'];
                        $sql="SELECT m.COLOR1, m.COLOR2, m.IDMODELO FROM INVENTARIO i
                        INNER JOIN MODELOS m ON m.IDMODELO=i.IDMODELO
                        WHERE i.IDINVENTARIO=$idinv";
                        $res = $conn->query($sql);
                        while($f = $res->fetch_assoc()){
                          $idcolor1=$f['COLOR1'];
                          $idcolor2=$f['COLOR2'];
                          $idmodelo=$f['IDMODELO'];
                        }
                        $sql="SELECT COLOR FROM COLOR WHERE IDCOLOR=$idcolor1";
                        $res = $conn->query($sql);
                        while($f = $res->fetch_assoc()){
                          $color1=$f['COLOR'];
                        }
                        $sql="SELECT COLOR FROM COLOR WHERE IDCOLOR=$idcolor2";
                        $res = $conn->query($sql);
                        while($f = $res->fetch_assoc()){
                          $color2=$f['COLOR'];
                        }
                      ?>
                    <div class="row">
                      <div class="col-3 text-center">
                        <img class="img-fluid" src="../imagen/<?php echo $d['Imagen']; ?>" width="100px" height="100px">
                      </div>
                      <div class="col-9 my-2">
                        <div class="row">
                            <small><a class="enlace2" href="index.php?idproducto=<?php echo $idinv;?>&idmodelo=<?php echo $idmodelo;?>" target="_blank"><?php echo $d['Nombre'];?></a></small>
                            <span class="ml-auto pr-4<?php echo number_format($total_modelo*1.16,2,',','.');?> Bs.S</span>
                        </div>
                        <div class="row">
                          <small>TALLA: <span class="text-muted"><?php echo " ".$d['Talla']?></span></small>
                        </div>
                        <div class="row">
                          <small>Color(es): <span class="text-muted"><?php echo $color1; ?> / <?php echo $color2; ?></span></small>
                        </div>
                        <div class="row">
                          <small>CANTIDAD: <span class="text-muted"><?php echo " ".$d['Cantidad'];?></span></small>
                        </div>
                        <div class="row mt-2">
                          <button type="button" class="enlace2 mr-4" href="javascript:void(0)" data-toggle="modal" data-target="#edit<?php echo $i;?>">Editar</button>
                          <button type="button" class="enlace2" href="javascript:void(0)" data-toggle="modal" data-target="#del<?php echo $i;?>">Eliminar</button>
                        </div>
                      </div>
                    </div>
                    <!-- Large modal -->
                    <div class="modal" id="del<?php echo $i;?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="closeSesionLabel">Eliminar Producto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            ¿Seguro que desea eliminar este articulo(s) del carrito?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                            <a href="carrito.php?delete=<?php echo $d['Id'];?>&talla=<?php echo $d['Talla'];?>" class="btn btn-outline-danger">Eliminar</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Large modal -->
                    <div class="modal fade bd-example-modal-lg" id="edit<?php echo $i;?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="closeSesionLabel">Editar Producto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="container-fluid">
                              <div class="row">
                                <div class="col-7 text-center">
                                  <img class="img-fluid" src="../imagen/<?php echo $d['Imagen']; ?>" width="300px" height="300px">
                                </div>
                                <div class="col-4">
                                  <div class="container-fluid">
                                    <div class="row">
                                      <div class="col-12">
                                        <p class="text-muted">Franela de Dama</p>
                                        <h2><b><?php echo $d['Nombre'];?></b></h2>
                                      </div>
                                      <div class="col-12 mb-4">
                                        <h3 class="lead"><?=number_format($d['Precio'],2,',','.').' BsS'?></h3>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-8 mb-2">
                                        Talla
                                      </div>
                                      <div class="col-4 mb-2">
                                        Cantidad
                                      </div>
                                    </div>
                                    <form class="" action="carrito.php" method="POST" onsubmit="return validacion()">
                                      <div class="row">
                                        <div class="col-5">
                                          <select class="lista-talla" name="talla" id="search" onchange="talla_dis()" required>
                                            <option value="<?=$d['Talla'];?>" selected>Talla <?=$d['Talla'];?></option>
                                          </select>
                                        </div>
                                        <div class="col-2 offset-3">
                                          <?php
                                          $sql= 'SELECT CANTIDAD FROM INVENTARIO  WHERE IDINVENTARIO='.$d['Id'].' LIMIT 1';
                                              $res= $conn->query($sql);
                                             if ($res->num_rows > 0){
                                              while($f=$res->fetch_assoc()){
                                                $max=$f['CANTIDAD'];
                                               }
                                             }
                                           ?>
                                          <input  type="number" max="<?=$max?>" min="1" maxlength="4" value="<?php echo $d['Cantidad']; ?>" name="cantidad"
                                           id="cant" required>
                                        </div>
                                      </div>
                                      <input type="hidden" name="id" value="<?php echo $d['Id'];?>">
                                      <div class="row mt-3">
                                        <div class="col-12">
                                          <button class="btn btn-outline-dark" type="submit">Actualizar artículo</button>
                                        </div>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <hr>
                    <?php
                    #MONTO
                    $subtotal=$d['Cantidad']*$d['Precio'] + $subtotal;
                    }
                    ?>
                    <div class="text-secondary text-center">
                      <form action="../index.php">
                        <input type="hidden" name="reset" value="">
                        <input class="enlace2" type="submit" value="Vaciar carrito">
                       </form>
                    </div>
                    <hr>
                  </div>
                  <div class="col-sm-4 mt-2">
                    <div class="container bg-dark">
                      <div class="row my-3 py-3 pl-2">
                        <h5 class="text-white">Resumen</h5>
                      </div>
                      <hr class="hr">
                      <div class="row text-white my-2 justify-content-between">
                        <p class="col-6"><b>SubTotal:</b></p>
                        <p class="col-auto"><b><?php echo number_format($subtotal,2,',','.');?> Bs.S</b></p>
                      </div>
                      <div class="row text-white mt-2 justify-content-between">
                        <p class="col-6"><b>IVA(16%):</b></p>
                        <p class="col-auto mb-0"><b><?php $iva=$subtotal*0.16; echo number_format($iva,2,',','.').' Bs.S' ?></b></p>
                        <p class="col-12 text-white-50"><small>El impuesto declarado por los productos corresponden a las leyes de la República Bolivariana de Venezuela.<br>  <a href="../faq/index.php?id=2" target="_blank">Ver más.</a> </small> </p>
                        <!--<p class="col-12 text-white-50"><small>Estos costos se basan en las agencias de encomiendas con las que trabajamos. <a href="../faq/index.php?id=2" target="_blank">Ver más.</a> </small> </p>-->
                      </div>
                      <hr class="hr">
                      <div class="row text-white my-2 justify-content-between">
                        <p class="col-6"><b>Total:</b></p>
                        <p class="col-auto"><b><?php $total=$subtotal+$iva; echo number_format($total,2,',','.');?> Bs.S</b></p>
                      </div>
                      <div class="row justify-content-center">
                        <form action="datos_compra.php">
                          <input class="btn btn-link btn-lg" type="submit" value="Comprar">
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
   <?php
            }else{
?>
            <div class="container mt-3">
              <div class="row">
                <div class="col-12 breadcrumb text-dark">
                  Realiza todas tus compras de manera segura, pagando via Mercado Pago.
                </div>
              </div>
            </div>
            <div class="container">
              <div class="row justify-content-between">
                <div class="col-7">
                  <div class="breadcrumb text-muted">
                    No tienes productos en el carrrito.
                  </div>
                  <div class="text-secondary text-center">
                    <p><small></small></p>
                  </div>
                  <hr>
                </div>
                <div class="col-4 bg-dark">
                  <div class="container">
                    <div class="row my-3">
                      <h5 class="text-white">Resumen</h5>
                    </div>
                    <hr class="hr">
                    <div class="row text-white my-2 justify-content-between">
                      <p class="col-6"><b>SubTotal:</b></p>
                      <p class="col-auto"><b>0,00 BsS</b></p>
                    </div>
                    <div class="row text-white mt-2 justify-content-between">
                      <p class="col-6"><b>IVA(16%):</b></p>
                      <p class="col-auto mb-0"><b>0,00 BsS</b></p>
                      <p class="col-12 text-white-50"><small>El impuesto declarado por los productos corresponden a las leyes de la República Bolivariana de Venezuela.<br> <a href="../faq/index.php?id=2" target="_blank">Ver más.</a> </small> </p>
                    <!--  <p class="col-12 text-white-50"><small>Estos costos se basan en las agencias de encomiendas con las que trabajamos. <a href="../faq/index.php?id=2">Ver más.</a> </small> </p>
                      <p class="col-6"><b>IVA:</b></p>
                      <p class="col-auto mb-0"><b>0,00$</b></p>
                      <p class="col-12 text-white-50"><small>Estos costos se basan en las agencias de encomiendas con las que trabajamos. <a href="../faq/index.php?id=2">Ver más.</a> </small> </p>
                  -->
                    </div>
                    <hr class="hr">
                    <div class="row text-white my-2 justify-content-between">
                      <p class="col-6"><b>Total:</b></p>
                      <p class="col-auto"><b>0,00$</b></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="text-center my-5">
              <a class="btn btn-outline-dark" href="../index.php">Seguir comprando</a>
            </div>
<?php
            }
            //</div>
    ?>
    <br class="my-5">
<?php include_once '../common/footer2.php';?>
<script type="text/javascript">
  var cantidad = <?php echo $cantidad_total; ?>;
  document.getElementById("title").innerHTML = "Tu Carrito ("+cantidad+")";
</script>
    <script src="../admin/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../admin/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
