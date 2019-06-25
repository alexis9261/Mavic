<?php
  include '../common/conexion.php';
  include '../common/TasaUSD2.php';
    $lista_tallas='';
if(isset($_GET['idproducto'], $_GET['idmodelo'])){
        $idproducto=$_GET['idproducto'];
        $idmodelo=$_GET['idmodelo'];
        $sql= 'SELECT * FROM INVENTARIO i
        INNER JOIN MODELOS m ON m.IDMODELO=i.IDMODELO
        WHERE i.IDMODELO='.$idmodelo;
            $res= $conn->query($sql);
            $arreglo[] = array();
            unset($arreglo[0]);
           if($res->num_rows > 0){
            #unset($arreglo[0]);
           if ($res->num_rows > 0){
            while($f=$res->fetch_assoc()){
              $lista_tallas=$lista_tallas.'<option value="'.$f['TALLA'].'">'.$f['TALLA'].'</option>';
              $newarreglo=array('Talla'=>$f['TALLA'], 'Cantidad'=> $f['CANTIDAD'], 'Idinventario'=>$f['IDINVENTARIO'], 'Peso'=>$f['PESO']);
              array_push($arreglo,$newarreglo);
              }
           }else{
              $lista_tallas='<option value="N/D">N/D</option>';
              $newarreglo=array('Talla'=>'N/D', 'Cantidad'=>'0', 'Idinventario'=>'-1', 'Peso'=>'No disponible');
              array_push($arreglo,$newarreglo);
            }
        $sql ="SELECT p.NOMBRE_P, p.PRECIO, p.TIPO, p.GENERO, p.DESCRIPCION, m.IMAGEN ,p.MANGA, p.CUELLO,p.MATERIAL FROM MODELOS m
        INNER JOIN PRODUCTOS p ON p.IDPRODUCTO=m.IDPRODUCTO
        WHERE m.IDMODELO=$idmodelo";
        $res= $conn->query($sql);
        if($res->num_rows > 0){
         while($f=$res->fetch_assoc()){
           $nombre_p=$f['NOMBRE_P'];
           $precio=$f['PRECIO'];
           $tipo=$f['TIPO'];
           $sql2="SELECT NOMBRE FROM CATEGORIAS WHERE IDCATEGORIA=$tipo";
           $result2 = $conn->query($sql2);
           if($result2->num_rows > 0){
               while($row2 = $result2->fetch_assoc()){ $tipo = $row2['NOMBRE']; }
           }
           $genero=$f['GENERO'];
           $descripcion=$f['DESCRIPCION'];
           $imagen= $f['IMAGEN'];
           $material=$f['MATERIAL'];
           switch ($f['CUELLO']){
             case '1': $cuello='Redondo';
              break;
             case '2': $cuello='En V';
              break;
              case '3': $cuello='Mao';
               break;
               case '4': $cuello='Chemise';
               break;
               default: $cuello='No Aplica';
                break;
             }
           switch ($f['MANGA']){
               case '1': $manga='Corta';
                break;
               case '2': $manga='3/4';
                break;
                case '3': $manga='Larga';
                 break;
                 case '4': $manga='Sin Manga';
                 break;
                 default: $manga='No Aplica';
                  break;
             }
         }
        }
        }
}else{
  header('Location: ../vitrina/');
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="es">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="desciption" content="Rouxa, Tienda virtual de Ropa para Damas, Caballeros y Niños.">
    <meta name="keywords" content="Rouxa, Ropa, Damas, Caballeros, Zapatos, Tienda Virtual">
    <meta name="author" content="Eutuxia, C.A.">
    <meta name="application-name" content="Tienda Virtual de Ropa, Rouxa."/>
    <link rel="icon" type="image/jpg" sizes="16x16" href="../imagen/favicon.jpg">
    <link rel="stylesheet" href="../css/new.css">
    <link href="../admin/assets/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.11/css/all.css" integrity="sha384-p2jx59pefphTFIpeqCcISO9MdVfIm4pNnsL08A6v5vaQc4owkQqxMV8kg4Yvhaw/" crossorigin="anonymous">
    <script>
    function talla_dis(){
        var talla = document.getElementById('search').value;
        switch(talla){
             <?php
              for($i=1; $i<count($arreglo);$i++){ ?>
                 case '<?php echo $arreglo[$i]['Talla'];?>':
                    /*Segundo objetivo - cantidad max ajustadas*/
                    if(<?php echo $arreglo[$i]['Cantidad'];?> <11){
                            document.getElementById('cant').max='<?php echo $arreglo[$i]['Cantidad'];?>';
                    }else{ document.getElementById('cant').max='10'; }
                    /*Segundo objetivo - modificar Idinv*/
                    document.getElementById('idinv').value='<?php echo $arreglo[$i]['Idinventario'];?>';
                break;
                <?php } ?>
            }
    }
    </script>
    <title>Rouxa</title>
    </head>
    <body>
     <?php
      include_once '../common/menu2.php';
      include_once '../common/2domenu2.php';
      $sql= 'select * FROM PRODUCTOS WHERE IDPRODUCTO='.$idproducto;
      $res= $conn->query($sql);
      while($f=$res->fetch_assoc()){
    ?>
    <div class="container-fluid my-5">
      <div class="row mt-5">
        <div class="col-1">
          <div class="row justify-content-center">
            <div class="col-12">
            </div>
          </div>
        </div>
        <div class="col-sm-6 text-center">
            <div class="row">
                <div class="col-12 text-center">
            <img src="../imagen/<?=$imagen?>" class="container-imagen img-fluid" id="myimage"/>
            <!--<div class="text-block">
              <div id="myresult" class="img-zoom-result"></div>
            </div>-->
            </div>
            </div>
        </div>
        <div class="col-sm-4">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <p class="text-muted"><?=ucfirst($tipo)?> de <?php
                switch ($genero) {
                  case '1':
                    echo 'Dama';
                    break;
                    case '2':
                      echo 'Caballero';
                      break;
                      case '3':
                        echo 'Niña';
                        break;
                        case '4':
                          echo 'Niño';
                          break;
                  default:
                    echo 'Otro';
                    break;
                }?></p>
                <h2><b><?=$nombre_p?></b></h2>
              </div>
              <div class="col-12 mb-4">
                <h3 class="lead"><?=number_format($precio*$tasa_usd*1.16, '2', ',', '.')?> Bs.S</h3>
              </div>
            </div>
            <div class="row">
              <div class="col-8 mb-2">
                Selecciona la Talla
              </div>
              <div class="col-4 mb-2">
                Cantidad
              </div>
            </div>
            <form class="" action="carrito.php" method="post" onsubmit="return validacion()">
              <div class="row">
                <div class="col-5">
                  <select class="lista-talla" name="talla" id="search" onchange="talla_dis()" required>
                    <?php echo $lista_tallas;?>
                  </select>
                </div>
                <div class="col-2 offset-3">
                  <input  type="number" max="<?php
                      if($arreglo[1]['Cantidad']<11){
                        echo $arreglo[1]['Cantidad'];
                      }else{
                        echo '10';
                      }
                    ?>" min="1" maxlength="4" value="1" name="cantidad"
                   id="cant" required>
                </div>
              </div>
              <input type="hidden" name="id" id='idinv' value="<?php echo $arreglo[1]['Idinventario'];?>">
              <div class="row mt-3">
                <div class="col-12">
                  <button class="btn btn-outline-dark" type="submit" >AÑADIR AL CARRITO</button>
                </div>
              </div>
            </form>
            <hr>
            <div class="row">
              <div class="col-12">
                <small class="text-muted"><span class="text-dark">¿Deseas comprar mas de 12 piezas?</span><br>
                  Ponte en <a href="../contacto/atencion.php" target="_blank">contacto</a> con nosotros, y obtén las mejores ofertas.</small>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-12">
                <small class="text-muted"><span class="text-dark">¿No encuentras las tallas que deseas?</span><br>
                  Ponte en <a href="../contacto/atencion.php" target="_blank">contacto</a> con nosotros, y consulta por las otras tallas.</small>
              </div>
            </div>
            <hr class="my-3">
            <div class="row mt-3">
              <div class="col-12">
                <small class="text-muted"><b>¿Como hacemos los envíos?</b> <br>
                  Los Envíos lo hacemos mediante agencias de encomiendas. <a href="../faq/index.php?id=2" target="_blank">Ver más</a></small>
              </div>
            </div>
            <hr class="mt-3">
            <div class="row">
              <div class="container mt-4">
                 <h5 class="text-white text-center bg-dark py-3 lead">
                   Detalles del Producto
                 </h5>
              </div>
              <div class="container">
                <div class="row justify-content-center">
                  <div class="col-12 text-center">
                    <div class="accordion" id="accordionExample">
                   <div class="card">
                     <div class="card-header container-fluid bg-dark" id="hone">
                       <h5 class="mb-0">
                         <button class="btn btn-link text-white" type="button" data-toggle="collapse" data-target="#one" aria-expanded="true" aria-controls="collapseOne">
                           Descripción
                         </button>
                       </h5>
                     </div>
                     <div id="one" class="collapse" aria-labelledby="hone" data-parent="#accordionExample">
                       <div class="card-body">
                         <div class="container-fluid">
                           <div class="row">
                             <div class="col-12 text-left">
                               <small>
                                 <?=$descripcion?>
                             </div>
                           </div>
                         </div>
                       </div>
                     </div>
                   </div>
                   <div class="card">
                     <div class="card-header bg-dark" id="htwo">
                       <h5 class="mb-0">
                         <button class="btn btn-link collapsed text-white" type="button" data-toggle="collapse" data-target="#two" aria-expanded="false" aria-controls="collapseTwo">
                           Características
                         </button>
                       </h5>
                     </div>
                     <div id="two" class="collapse" aria-labelledby="htwo" data-parent="#accordionExample">
                       <div class="card-body">
                         <div class="container-fluid">
                           <div class="row">
                             <div class="col-12 text-left">
                               <p>
                                <b>Prenda: </b><?=ucfirst ($tipo)?>,  <b>Manga: </b><?=ucfirst ($manga)?>,  <b>Cuello: </b><?=ucfirst($cuello)?><br>
                                <b>Material: </b><?=$material?> <br>
                                <br>
                                <!--<b>Peso de la franela:</b>-->
                                <?php
                                /*if ($arreglo[1]['Talla']!='N/D') {
                                  foreach ($arreglo as $key) {
                                      echo 'Talla: '.$key["Talla"].' ('.$key["Peso"].' gr) ';
                                  }
                                }else{ echo 'No disponible'; }*/
                                 ?>
                                </p>
                             </div>
                           </div>
                         </div>
                       </div>
                     </div>
                   </div>
                  </div>
                  </div>
               </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include_once '../common/footer2.php'; ?>
  <?php } ?>
    <script type="text/javascript">
    function imageZoom(imgID, resultID) {
    var img, lens, result, cx, cy;
    img = document.getElementById(imgID);
    result = document.getElementById(resultID);
    lens = document.createElement("DIV");
    lens.setAttribute("class", "img-zoom-lens");
    img.parentElement.insertBefore(lens, img);
    cx = result.offsetWidth / lens.offsetWidth;
    cy = result.offsetHeight / lens.offsetHeight;
    result.style.backgroundImage = "url('" + img.src + "')";
    result.style.backgroundSize = (img.width * cx) + "px " + (img.height * cy) + "px";
    lens.addEventListener("mousemove", moveLens);
    img.addEventListener("mousemove", moveLens);
    lens.addEventListener("touchmove", moveLens);
    img.addEventListener("touchmove", moveLens);
    function moveLens(e) {
      var pos, x, y;
      e.preventDefault();
      pos = getCursorPos(e);
      x = pos.x - (lens.offsetWidth / 2);
      y = pos.y - (lens.offsetHeight / 2);
      if (x > img.width - lens.offsetWidth) {x = img.width - lens.offsetWidth;}
      if (x < 0) {x = 0;}
      if (y > img.height - lens.offsetHeight) {y = img.height - lens.offsetHeight;}
      if (y < 0) {y = 0;}
      lens.style.left = x + "px";
      lens.style.top = y + "px";
      result.style.backgroundPosition = "-" + (x * cx) + "px -" + (y * cy) + "px";
    }
    function getCursorPos(e) {
      var a, x = 0, y = 0;
      e = e || window.event;
      a = img.getBoundingClientRect();
      x = e.pageX - a.left;
      y = e.pageY - a.top;
      x = x - window.pageXOffset;
      y = y - window.pageYOffset;
      return {x : x, y : y};
    }
    }
    imageZoom("myimage", "myresult");
    </script>
    <script src="../admin/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../admin/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
