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
  <meta name="desciption" content="Mavic es una nueva E-commerce Venezolana, creyente de la nueva era digital de venta por internet.">
  <meta name="keywords" content="Suminstros Mavic, Mavic, Mavic vzla">
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
<body style="background-color:#efefef;">
  <?php include 'common/menu.php'; include 'common/2domenu.php';?>
  <!--Corousel Library-->
  <div class="owl-carousel owl-theme" id="carousel">
    <div class="imagenPpal"><img class="d-block d-sm-none" src="imagen/ppal1-responsive.jpg" alt=""><img class="img-fluid d-none d-sm-block" src="imagen/principal1.jpg" alt=""></div>
    <div class="imagenPpal"><img class="d-block d-sm-none" src="imagen/ppal2-responsive.jpg" alt=""><img class="img-fluid d-none d-sm-block" src="imagen/principal3.jpg" alt=""></div>
    <div class="imagenPpal"><img class="d-block d-sm-none" src="imagen/ppal3-responsive.jpg" alt=""><img class="img-fluid d-none d-sm-block" src="imagen/principal2.jpg" alt=""></div>
  </div>
  <script>
    $('#carousel').owlCarousel({
      loop:true,
      dots:true,
      mouseDrag: false,
      //movimiento del carousel
      autoplay:true,
      autoplayHoverPause:true,
      autoplayTimeout:4000,
      smartSpeed:1000,
      margin:0,
      responsive:{0:{items:1}}
    })
  </script>
  <!-- Productos 1 -->
  <!--article class="container my-2 py-2">
    <h4 class="text-muted mb-4">Todo los relacionado con <strong>Routers</strong>.</h4>
    <div class="card-deck row justify-content-center">
      <?php
      /*$sql = "SELECT *, m.IMAGEN as IMA FROM MODELOS m
      INNER JOIN PRODUCTOS p ON p.IDPRODUCTO=m.IDPRODUCTO
      ORDER BY Rand() LIMIT 4";
      $result = $conn->query($sql);
      if($result->num_rows>0){
        while($row = $result->fetch_assoc()){
          */?>
          <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 ">
            <div class="card producto">
              <a href="compra/index.php?idproducto=<?php// echo $row['IDPRODUCTO']; ?>&idmodelo=<?php// echo $row['IDMODELO']; ?>">
                <img class="vitrina card-img-top img-fluid" src="imagen/modem2.webp<?php //echo $row['IMA']; ?>" alt="<?php// echo $row['NOMBRE_P']; ?>">
              </a>
              <div class="card-body">
                <h5 class="card-title"><?php //echo $row['NOMBRE_P'];?>Router</h5>
                <p class="card-text"><?php //echo $row['DESCRIPCION'];?>Generador de señal Wifi.</p>
                <p class="card-text"><small class="text-muted">Precio: <?php //echo number_format($row['PRECIO']*$tasa_usd*1.16, 2, ',', '.'); ?>59.777,00  Bs.</small></p>
              </div>
            </div>
          </div>
          <?php
        /*}
      } */?>
    </div>
  </article-->
  <!-- Otros Productos -->
  <div class="container mt-3">
    <h4 class="text-muted mb-2 lead">Todo los relacionado con <strong>Impresoras</strong>.</h4>
    <div class="owl-carousel owl-theme px-2 py-3 my-2" id="productoCarousel">
      <div class="item border-product mb-5">
        <a href="#">
          <div class="container-img-product">
            <img class="img-product" src="imagen/producto1.webp" alt="Impresora Multifuncional Epson L575 Red Usb Tinta Continua">
          </div>
          <div class="">
            <h5 class="pl-3 mb-0 pt-2">40.500,00 Bs.</h5>
            <div class="descrip-item pb-2">
            </div>
          </div>
        </a>
      </div>
      <div class="item border-product mb-5">
        <a href="#">
          <div class="container-img-product">
            <img class="img-product" src="imagen/producto2.webp" alt="Impresora Multifuncional Samsung Laser Nueva + Otro Toner">
          </div>
          <div class="">
            <h5 class="pl-3 mb-0 pt-2">40.500,00 Bs.</h5>
            <div class="descrip-item pb-2">
            </div>
          </div>
        </a>
      </div>
      <div class="item border-product mb-5">
        <a href="#">
          <div class="container-img-product">
            <img class="img-product" src="imagen/producto3.webp" alt="Impresora Multifuncional Canon Color Gris">
          </div>
          <h5 class="pl-3 mb-0 pt-2">40.500,00 Bs.</h5>
          <div class="descrip-item pb-2">
          </div>
        </a>
      </div>
      <div class="item border-product mb-5">
        <a href="#">
          <div class="container-img-product">
            <img class="img-product" src="imagen/producto4.webp" alt="Impresora Hp Laserjet M28w Multifuncional Monocromatica">
          </div>
          <h5 class="pl-3 mb-0 pt-2">40.500,00 Bs.</h5>
          <div class="descrip-item pb-2">
          </div>
        </a>
      </div>
      <div class="item border-product mb-5">
        <a href="#">
          <div class="container-img-product">
            <img class="img-product" src="imagen/producto5.webp" alt="Impresora Multifuncional Epson L575 Red Usb Tinta Continua">
          </div>
          <h5 class="pl-3 mb-0 pt-2">40.500,00 Bs.</h5>
          <div class="descrip-item pb-2">
          </div>
        </a>
      </div>
    </div>
  </div>
  <script>
    $('#productoCarousel').owlCarousel({
        loop:true,
        dots:false,
        mouseDrag: false,
        margin:15,
        responsive:{//pixeles de la pantalla
            0:{items:2},
            600:{items:3},
            1000:{items:5}
        }
    })
  </script>
  <!-- Otros Productos 2 -->
  <div class="container">
    <h4 class="text-muted mb-2 lead">Todo los relacionado con <strong>Routers</strong>.</h4>
    <div class="owl-carousel owl-theme px-2 py-3 my-2" id="productoCarousel2">
      <div class="item border-product mb-5">
        <a href="#">
          <div class="container-img-product">
            <img class="img-product" src="imagen/producto6.webp" alt="Router Inalambrico Wifi y Repetidor 300mbps Logan 3 Antenas">
          </div>
          <div class="">
            <h5 class="pl-3 mb-0 pt-2">40.500,00 Bs.</h5>
            <div class="descrip-item pb-2">
            </div>
          </div>
        </a>
      </div>
      <div class="item border-product mb-5">
        <a href="#">
          <div class="container-img-product">
            <img class="img-product" src="imagen/producto7.webp" alt="Router Modem Inalambrico Tp-Link Td-w8961n 300mbps Red Wifi">
          </div>
          <div class="">
            <h5 class="pl-3 mb-0 pt-2">40.500,00 Bs.</h5>
            <div class="descrip-item pb-2">
            </div>
          </div>
        </a>
      </div>
      <div class="item border-product mb-5">
        <a href="#">
          <div class="container-img-product">
            <img class="img-product" src="imagen/producto8.webp" alt="Router Inalambrico Tp-Link Tl-wr940n 450mbps Pc Lan Red Wifi">
          </div>
          <div class="">
            <h5 class="pl-3 mb-0 pt-2">40.500,00 Bs.</h5>
            <div class="descrip-item pb-2">
            </div>
          </div>
        </a>
      </div>
      <div class="item border-product mb-5">
        <a href="#">
          <div class="container-img-product">
            <img class="img-product" src="imagen/producto9.webp" alt="Router Wifi Tp Link Wr720n">
          </div>
          <div class="">
            <h5 class="pl-3 mb-0 pt-2">40.500,00 Bs.</h5>
            <div class="descrip-item pb-2">
            </div>
          </div>
        </a>
      </div>
      <div class="item border-product mb-5">
        <a href="#">
          <div class="container-img-product">
            <img class="img-product" src="imagen/producto10.webp" alt="Router Inalambrico Tp-Link 300mbps Wds Tl-wr840n Acme">
          </div>
          <div class="">
            <h5 class="pl-3 mb-0 pt-2">40.500,00 Bs.</h5>
            <div class="descrip-item pb-2">
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>
  <script>
    $('#productoCarousel2').owlCarousel({
        loop:true,
        dots:false,
        mouseDrag: false,
        margin:15,
        responsive:{
            0:{items:2},
            600:{items:3},
            1000:{items:5}
        }
    })
  </script>
  <!-- Instagrm 1-->
  <div class="container mt-1 mb-3">
    <h4 class="text-muted mb-2">Nuestras promociones de <strong>Instagram</strong>.</h4>
    <div class="owl-carousel owl-theme px-2 my-4">
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
        autoplayTimeout:2500,
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
  <!-- Banner -->
  <section class="container px-5 mb-4">
    <div class="row justify-content-center">
      <img class="img-fluid d-none d-sm-block" src="imagen/banner.jpg" style="height:40vh;width:100%;" alt="">
    </div>
  </section>
  <!-- Otros Productos 3 -->
  <div class="container">
    <h4 class="text-muted mb-2 lead">Todo los relacionado con <strong>Toners</strong>.</h4>
    <div class="owl-carousel owl-theme px-2 py-3 my-2" id="productoCarousel3">
      <div class="item border-product mb-5">
        <a href="#">
          <div class="container-img-product">
            <img class="img-product" src="imagen/producto19.webp" alt="Franela de Dama Casual para mujeres que necesitan ropa">
          </div>
          <div class="">
            <h5 class="pl-3 mb-0 pt-2">40.500,00 Bs.</h5>
            <div class="descrip-item pb-2">
            </div>
          </div>
        </a>
      </div>
      <div class="item border-product mb-5">
        <a href="#">
          <div class="container-img-product">
            <img class="img-product" src="imagen/producto18.webp" alt="Franela de Dama Casual para mujeres que necesitan ropa">
          </div>
          <div class="">
            <h5 class="pl-3 mb-0 pt-2">40.500,00 Bs.</h5>
            <div class="descrip-item pb-2">
            </div>
          </div>
        </a>
      </div>
      <div class="item border-product mb-5">
        <a href="#">
          <div class="container-img-product">
            <img class="img-product" src="imagen/producto17.webp" alt="Franela de Dama Casual para mujeres que necesitan ropa">
          </div>
          <div class="">
            <h5 class="pl-3 mb-0 pt-2">40.500,00 Bs.</h5>
            <div class="descrip-item pb-2">
            </div>
          </div>
        </a>
      </div>
      <div class="item border-product mb-5">
        <a href="#">
          <div class="container-img-product">
            <img class="img-product" src="imagen/producto16.webp" alt="Franela de Dama Casual para mujeres que necesitan ropa">
          </div>
          <div class="">
            <h5 class="pl-3 mb-0 pt-2">40.500,00 Bs.</h5>
            <div class="descrip-item pb-2">
            </div>
          </div>
        </a>
      </div>
      <div class="item border-product mb-5">
        <a href="#">
          <div class="container-img-product">
            <img class="img-product" src="imagen/producto20.webp" alt="Franela de Dama Casual para mujeres que necesitan ropa">
          </div>
          <div class="">
            <h5 class="pl-3 mb-0 pt-2">40.500,00 Bs.</h5>
            <div class="descrip-item pb-2">
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>
  <script>
    $('#productoCarousel3').owlCarousel({
        loop:true,
        dots:false,
        mouseDrag: false,
        margin:15,
        responsive:{
            0:{items:2},
            600:{items:3},
            1000:{items:5}
        }
    })
  </script>
  <!-- Otros Productos 4 -->
  <div class="container">
    <h4 class="text-muted mb-2 lead">Todo los relacionado con <strong>Cables</strong>.</h4>
    <div class="owl-carousel owl-theme px-2 py-1 my-2" id="productoCarousel4">
      <div class="item border-product mb-5">
        <a href="#">
          <div class="container-img-product">
            <img class="img-product" src="imagen/producto11.webp" alt="Franela de Dama Casual para mujeres que necesitan ropa">
          </div>
          <div class="">
            <h5 class="pl-3 mb-0 pt-2">40.500,00 Bs.</h5>
            <div class="descrip-item pb-2">
            </div>
          </div>
        </a>
      </div>
      <div class="item border-product mb-5">
        <a href="#">
          <div class="container-img-product">
            <img class="img-product" src="imagen/producto12.webp" alt="Franela de Dama Casual para mujeres que necesitan ropa">
          </div>
          <div class="">
            <h5 class="pl-3 mb-0 pt-2">40.500,00 Bs.</h5>
            <div class="descrip-item pb-2">
            </div>
          </div>
        </a>
      </div>
      <div class="item border-product mb-5">
        <a href="#">
          <div class="container-img-product">
            <img class="img-product" src="imagen/producto13.webp" alt="Franela de Dama Casual para mujeres que necesitan ropa">
          </div>
          <div class="">
            <h5 class="pl-3 mb-0 pt-2">40.500,00 Bs.</h5>
            <div class="descrip-item pb-2">
            </div>
          </div>
        </a>
      </div>
      <div class="item border-product mb-5">
        <a href="#">
          <div class="container-img-product">
            <img class="img-product" src="imagen/producto14.webp" alt="Franela de Dama Casual para mujeres que necesitan ropa">
          </div>
          <div class="">
            <h5 class="pl-3 mb-0 pt-2">40.500,00 Bs.</h5>
            <div class="descrip-item pb-2">
            </div>
          </div>
        </a>
      </div>
      <div class="item border-product mb-5">
        <a href="#">
          <div class="container-img-product">
            <img class="img-product" src="imagen/producto15.webp" alt="Franela de Dama Casual para mujeres que necesitan ropa">
          </div>
          <div class="">
            <h5 class="pl-3 mb-0 pt-2">40.500,00 Bs.</h5>
            <div class="descrip-item pb-2">
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>
  <script>
    $('#productoCarousel4').owlCarousel({
        loop:true,
        dots:false,
        mouseDrag: false,
        margin:15,
        responsive:{
            0:{items:2},
            600:{items:3},
            1000:{items:5}
        }
    })
  </script>
  <!-- Otros Productos 4 -->
  <div class="container">
    <h4 class="text-muted mb-2 mt-1 lead">Tambien te puede interesar.</h4>
    <div class="owl-carousel owl-theme px-2 py-3 my-2" id="productoCarousel5">
      <div class="item border-product mb-1">
        <a href="#">
          <div class="container-img-product-endpage">
            <img class="img-product-endpage" src="imagen/producto11.webp" alt="Franela de Dama Casual para mujeres que necesitan ropa">
          </div>
        </a>
      </div>
      <div class="item border-product mb-1">
        <a href="#">
          <div class="container-img-product-endpage">
            <img class="img-product-endpage" src="imagen/producto12.webp" alt="Franela de Dama Casual para mujeres que necesitan ropa">
          </div>
        </a>
      </div>
      <div class="item border-product mb-1">
        <a href="#">
          <div class="container-img-product-endpage">
            <img class="img-product-endpage" src="imagen/producto13.webp" alt="Franela de Dama Casual para mujeres que necesitan ropa">
          </div>
        </a>
      </div>
      <div class="item border-product mb-1">
        <a href="#">
          <div class="container-img-product-endpage">
            <img class="img-product-endpage" src="imagen/producto14.webp" alt="Franela de Dama Casual para mujeres que necesitan ropa">
          </div>
        </a>
      </div>
      <div class="item border-product mb-1">
        <a href="#">
          <div class="container-img-product-endpage">
            <img class="img-product-endpage" src="imagen/producto15.webp" alt="Franela de Dama Casual para mujeres que necesitan ropa">
          </div>
        </a>
      </div>
      <div class="item border-product mb-1">
        <a href="#">
          <div class="container-img-product-endpage">
            <img class="img-product-endpage" src="imagen/producto7.webp" alt="Franela de Dama Casual para mujeres que necesitan ropa">
          </div>
        </a>
      </div>
      <div class="item border-product mb-1">
        <a href="#">
          <div class="container-img-product-endpage">
            <img class="img-product-endpage" src="imagen/producto6.webp" alt="Franela de Dama Casual para mujeres que necesitan ropa">
          </div>
        </a>
      </div>
      <div class="item border-product mb-1">
        <a href="#">
          <div class="container-img-product-endpage">
            <img class="img-product-endpage" src="imagen/producto20.webp" alt="Franela de Dama Casual para mujeres que necesitan ropa">
          </div>
        </a>
      </div>
    </div>
  </div>
  <!-- Instagrm 2-->
  <div class="container mb-5">
    <div class="owl-carousel owl-theme px-2 my-2" id="car">
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
    $('#car').owlCarousel({
        loop:true,
        //movimiento del carousel
        autoplay:false,
        margin:40,
        responsive:{//pixeles de la pantalla
            0:{items:1},
            600:{items:2},
            1000:{items:3}
        }
    })
  </script>
  <!-- Maps -->
  <div class="m-0">
    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15708.03522624633!2d-68.005718!3d10.179939!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x1d47af71967d9a49!2sSuministros+Mavic%2C+C.A!5e0!3m2!1ses!2sve!4v1562178603833!5m2!1ses!2sve" width="100%" height="400px" frameborder="0" style="border:0" allowfullscreen></iframe>
  </div>
  <script>
    $('#productoCarousel5').owlCarousel({
        loop:true,
        dots:false,
        mouseDrag: false,
        margin:15,
        responsive:{
            0:{items:3},
            600:{items:5},
            1000:{items:8}
        }
    })
  </script>
  <?php include_once 'common/footer.php';?>
  <script>
    //Script para texto de descreipcion de los productos
    $(".item").hover(function(){
      var titulo=$(this).find("img").attr("alt");
      if(titulo.length>50){titulo=titulo.substr(0,50)+"...";}
      $(this).find(".descrip-item").append("<small class='text-muted px-3 pb-2 border-titulo-sombra' style='position:absolute;background-color:#fff;min-width:100%;'>"+titulo+"</small>");
      $(this).find("small").css("visibility","visible");
    },function(){
      $(this).find("small").css("visibility","hidden");
      $(this).find(".descrip-item").empty();
    });
  </script>
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
