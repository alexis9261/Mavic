<?php
#Quitar el comentario para entrar en mantenimiento.
#header('Location: mantenimiento/');
session_start();
include 'common/conexion.php';
include 'common/TasaUSD.php';
if(isset($_GET['reset'])){session_destroy();}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta name="desciption" content="Mavic es una nueva E-commerce Venezolana, creyente de la nueva era digital de venta por internet, fabricante de ropa de alta calidad y confort, cumpliendo con los estándares de moda exigidos por nuestros clientes nacionales e internacionales.">
  <meta name="keywords" content="Suminstros Mavic, Mavic, Rouxa vzla, franelas, chemises, Tienda Virtual, Ecommerce venezuela, Ropa en venezuela, franelas comodas, Ropa venezuela">
  <meta name="author" content="Eutuxia, C.A.">
  <meta name="application-name" content="Suministros Mavic."/>
  <link rel="icon" type="image/jpg" sizes="16x16" href="imagen/favicon.png">
  <link rel="stylesheet" href="vendor/owlcarousel/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="vendor/owlcarousel/assets/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/new.css">
  <link href="admin/assets/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.11/css/all.css" integrity="sha384-p2jx59pefphTFIpeqCcISO9MdVfIm4pNnsL08A6v5vaQc4owkQqxMV8kg4Yvhaw/" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
  <script src="admin/assets/libs/jquery/dist/jquery.min.js"></script>
  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
  <script src="vendor/owlcarousel/owl.carousel.min.js"></script>
  <script>(adsbygoogle = window.adsbygoogle || []).push({google_ad_client: "ca-pub-8952175764108741",enable_page_level_ads: true});</script>
  <title>Suministros Mavic C.A.</title>
</head>
<body>
  <?php include 'common/menu.php'; include 'common/2domenu.php';?>
  <!--Corousel Library-->
  <div class="owl-carousel owl-theme principalaux" id="carousel">
    <!-- Imagenes grandes -->
    <div class="imagenPpal"><img class="d-block d-sm-none" src="imagen/ima1-responsive.jpeg" alt=""><img class="img-fluid d-none d-sm-block" src="imagen/ima1.jpeg" alt=""></div>
    <div class="imagenPpal"><img class="d-block d-sm-none" src="imagen/ima1-responsive.jpeg" alt=""><img class="img-fluid d-none d-sm-block" src="imagen/ima2.jpg" alt=""></div>
    <div class="imagenPpal"><img class="d-block d-sm-none" src="imagen/ima1-responsive.jpeg" alt=""><img class="img-fluid d-none d-sm-block" src="imagen/publicidad1.jpg" alt=""></div>
  </div>
  <script>
    $('#carousel').owlCarousel({
      loop:true,
      dots:false,
      //movimiento del carousel
      autoplay:true,
      autoplayTimeout:4000,
      autoplayHoverPause:true,
      smartSpeed:1000,
      margin:0,
      responsive:{0:{items:1}}
    })
  </script>
  <article class="container my-4">
    <div class="card-deck row">
      <div class="col-sm-12 col-md-6 col-lg-3 my-3 py-4">
        <div class="card" style="max-width: 100%; height: auto;">
          <a href="compra/index.php?idproducto=<?php// echo $row['IDPRODUCTO']; ?>&idmodelo=<?php// echo $row['IDMODELO']; ?>"><img class="vitrina card-img-top img-fluid" src="imagen/publicidad1.jpg<?php //echo $row['IMA']; ?>" alt="<?php// echo $row['NOMBRE_P']; ?>"></a>
          <div class="card-body">
            <h5 class="card-title"><?php //echo $row['NOMBRE_P'];?>Impresora Hp</h5>
            <p class="card-text"><?php //echo $row['DESCRIPCION'];?>Impresora Hp miltufuncional para oficina.</p>
            <p class="card-text"><small class="text-muted">Precio: <?php //echo number_format($row['PRECIO']*$tasa_usd*1.16, 2, ',', '.'); ?>59.777,00  Bs.</small></p>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-md-6 col-lg-3 my-3 py-4">
        <div class="card" style="max-width: 100%; height: auto;">
          <a href="compra/index.php?idproducto=<?php// echo $row['IDPRODUCTO']; ?>&idmodelo=<?php// echo $row['IDMODELO']; ?>"><img class="vitrina card-img-top img-fluid" src="imagen/publicidad1.jpg<?php //echo $row['IMA']; ?>" alt="<?php// echo $row['NOMBRE_P']; ?>"></a>
          <div class="card-body">
            <h5 class="card-title"><?php //echo $row['NOMBRE_P'];?>Impresora Hp</h5>
            <p class="card-text"><?php //echo $row['DESCRIPCION'];?>Impresora Hp miltufuncional para oficina.</p>
            <p class="card-text"><small class="text-muted">Precio: <?php //echo number_format($row['PRECIO']*$tasa_usd*1.16, 2, ',', '.'); ?>59.777,00  Bs.</small></p>
          </div>
        </div>
      </div>
      <div class="col-sm-12 col-md-6 col-lg-3 my-3 py-4">
        <div class="card" style="max-width: 100%; height: auto;">
          <a href="compra/index.php?idproducto=<?php// echo $row['IDPRODUCTO']; ?>&idmodelo=<?php// echo $row['IDMODELO']; ?>">
            <img class="vitrina card-img-top " src="imagen/publicidad1.jpg<?php //echo $row['IMA']; ?>" alt="<?php// echo $row['NOMBRE_P']; ?>">
          </a>
          <div class="card-body">
            <h5 class="card-title"><?php //echo $row['NOMBRE_P'];?>Impresora Hp</h5>
            <p class="card-text"><?php //echo $row['DESCRIPCION'];?>Impresora Hp miltufuncional para oficina.</p>
            <p class="card-text"><small class="text-muted">Precio: <?php //echo number_format($row['PRECIO']*$tasa_usd*1.16, 2, ',', '.'); ?>59.777,00  Bs.</small></p>
          </div>
        </div>
      </div>
      <?php
      /*$sql = "SELECT *, m.IMAGEN as IMA FROM MODELOS m
      INNER JOIN PRODUCTOS p ON p.IDPRODUCTO=m.IDPRODUCTO
      ORDER BY Rand() LIMIT 4";
      $result = $conn->query($sql);
      if($result->num_rows>0){
        while($row = $result->fetch_assoc()){
          */?>
          <div class="col-sm-12 col-md-6 col-lg-3 my-3 py-4">
            <div class="card" style="max-width: 100%; height: auto;">
              <a href="compra/index.php?idproducto=<?php// echo $row['IDPRODUCTO']; ?>&idmodelo=<?php// echo $row['IDMODELO']; ?>"><img class="vitrina card-img-top img-fluid" src="imagen/publicidad1.jpg<?php //echo $row['IMA']; ?>" alt="<?php// echo $row['NOMBRE_P']; ?>"></a>
              <div class="card-body">
                <h5 class="card-title"><?php //echo $row['NOMBRE_P'];?>Impresora Hp</h5>
                <p class="card-text"><?php //echo $row['DESCRIPCION'];?>Impresora Hp miltufuncional para oficina.</p>
                <p class="card-text"><small class="text-muted">Precio: <?php //echo number_format($row['PRECIO']*$tasa_usd*1.16, 2, ',', '.'); ?>59.777,00  Bs.</small></p>
              </div>
            </div>
          </div>
          <?php
        /*}
      } */?>
    </div>
  </article>
  <div class="container my-5">
    <div class="owl-carousel owl-theme px-2 my-5">
      <div class="item"><a href="#"><img class="img-fluid imagenInsta" src="imagen/publicidad1.jpg" alt=""></a></div>
      <div class="item"><a href="#"><img class="img-fluid imagenInsta" src="imagen/publicidad2.jpg" alt=""></a></div>
      <div class="item"><a href="#"><img class="img-fluid imagenInsta" src="imagen/publicidad3.jpg" alt=""></a></div>
      <div class="item"><a href="#"><img class="img-fluid imagenInsta" src="imagen/publicidad4.jpg" alt=""></a></div>
      <div class="item"><a href="#"><img class="img-fluid imagenInsta" src="imagen/publicidad5.jpg" alt=""></a></div>
      <div class="item"><a href="#"><img class="img-fluid imagenInsta" src="imagen/publicidad6.jpg" alt=""></a></div>
      <div class="item"><a href="#"><img class="img-fluid imagenInsta" src="imagen/publicidad7.jpg" alt=""></a></div>
      <div class="item"><a href="#"><img class="img-fluid imagenInsta" src="imagen/publicidad8.jpg" alt=""></a></div>
      <div class="item"><a href="#"><img class="img-fluid imagenInsta" src="imagen/publicidad9.jpg" alt=""></a></div>
    </div>
  </div>
  <script>
    $('.owl-carousel').owlCarousel({
        loop:true,
        //movimiento del carousel
        autoplay:true,
        autoplayTimeout:1500,
        autoplayHoverPause:true,
        smartSpeed:1000,


        margin:40,
        responsive:{//pixeles de la pantalla
            0:{items:1},
            600:{items:2},
            1000:{items:3}
        }
    })
    </script>

  <div class="jumbotron mb-0">
    <h1 class="display-4" style="font-family: 'Playfair Display', serif;">Suministros Mavic</h1>
    <p class="lead">Incluso la noche más oscura terminará con la salida del sol.</p>
    <hr>
    <div class="jumbotron bg-dark mb-0">
      <h1 class="display-5 text-muted">¡Disfruta de Nuestras Promociones!</h1>
      <hr class="my-4">
      <p class="lead text-white-50" style="font-family: 'Playfair Display', serif;">Enterate de todas las promociones a través de nuestras redes sociales. Envios gratis, precios al Mayor, Promociones Especiales y ¡Mucho más!</p>
      <a class="btn btn-outline-light btn-lg mt-3" href="https://www.instagram.com/suministros_mavic/" role="button" target="_blank">Siguenos en Instagram</a>
    </div>
  </div>
  <section class="principal2 container-fluid d-flex flex-column align-items-end justify-content-end pr-4 pb-3">
    <h5 class="display-4 lead text-light" style="font-family: 'Playfair Display', serif;">La familia es lo más importante</h5>
    <p class="font-italic text-muted h5">Creemos firmemente que tu familia es lo más importante para ti.</p>
  </section>
  <div class="jumbotron mb-0">
    <h1 class="display-4 mb-2" style="font-family: 'Playfair Display', serif;">Seguimiento de una compra</h1>
    <p class="lead mt-4">Una <strong>Llave digital</strong> es la herramienta para conocer el estatus de tu compra en Mavic.</p>
    <hr class="my-4">
    <small class="text-muted">La forma de usar la llave es insertandola en el seguidor de pedido que se encuetrará en el menu principal en "Compras". Podrás visualizar el estatus de un pedido, el número de guia
      (una vez que se envia el paquete) e información de la compra realizada. ¡La llave es enviada a su correo! <a href="faq/index.php">Ver más</a>
    </small>
  </div>
  <?php include_once 'common/footer.php';?>
  <script src="admin/assets/libs/popper.js/dist/umd/popper.min.js"></script>
  <script src="admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119925583-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-119925583-1');
  </script>
</body>
</html>
