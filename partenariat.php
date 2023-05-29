<!DOCTYPE html>
<html>
<head>
  <title>Our Partners</title>
  <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

  <style>
    h2 {
      text-align: center;
      padding: 20px;
    }
    .container {
      margin-top: 20px;
      margin-bottom: 20px;}
    /* Slider */
    .slick-slide {
      margin: 0px 20px;
    }

    .slick-slide img {
      width: 100%;
    }

    .slick-slider {
      position: relative;
      display: block;
      box-sizing: border-box;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
      -webkit-touch-callout: none;
      -khtml-user-select: none;
      -ms-touch-action: pan-y;
      touch-action: pan-y;
      -webkit-tap-highlight-color: transparent;
    }

    .slick-list {
      position: relative;
      display: block;
      overflow: hidden;
      margin: 0;
      padding: 0;
    }

    .slick-list:focus {
      outline: none;
    }

    .slick-list.dragging {
      cursor: pointer;
      cursor: hand;
    }

    .slick-slider .slick-track,
    .slick-slider .slick-list {
      -webkit-transform: translate3d(0, 0, 0);
      -moz-transform: translate3d(0, 0, 0);
      -ms-transform: translate3d(0, 0, 0);
      -o-transform: translate3d(0, 0, 0);
      transform: translate3d(0, 0, 0);
    }

    .slick-track {
      position: relative;
      top: 0;
      left: 0;
      display: block;
    }

    .slick-track:before,
    .slick-track:after {
      display: table;
      content: '';
    }

    .slick-track:after {
      clear: both;
    }

    .slick-loading .slick-track {
      visibility: hidden;
    }

    .slick-slide {
      display: none;
      float: left;
      height: 100%;
      min-height: 1px;
    }

    [dir='rtl'] .slick-slide {
      float: right;
    }

    .slick-slide img {
      display: block;
    }

    .slick-slide.slick-loading img {
      display: none;
    }

    .slick-slide.dragging img {
      pointer-events: none;
    }

    .slick-initialized .slick-slide {
      display: block;
    }

    .slick-loading .slick-slide {
      visibility: hidden;
    }

    .slick-vertical .slick-slide {
      display: block;
      height: auto;
      border: 1px solid transparent;
    }

    .slick-arrow.slick-hidden {
      display: none;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Our Partners</h2>
    <section class="customer-logos slider">
      <div class="slide"><img src="https://upload.wikimedia.org/wikipedia/fr/e/e8/Shell_logo.svg"></div>
      <div class="slide"><img src="https://play-lh.googleusercontent.com/HJ6MQsjz-6msAPfMwN5zk1vV_A8cg46yQm_B2FGY7UfDkSittNbbhxFggFIVfxKkgw=w240-h480-rw"></div>
      <div class="slide"><img src="https://www.marques-de-france.fr/wp-content/uploads/2020/01/logo-Entreprise-du-Patrimoine-Vivant-EPV-2000-2000-768x770.jpg.webp"></div>
      <div class="slide"><img src="https://upload.wikimedia.org/wikipedia/commons/c/cd/Facebook_logo_%28square%29.png"></div>
      <div class="slide"><img src="https://upload.wikimedia.org/wikipedia/commons/4/4f/ECE_Paris_Lyon.jpg"></div>
      <div class="slide"><img src="https://upload.wikimedia.org/wikipedia/commons/0/09/YouTube_full-color_icon_%282017%29.svg"></div>
      <div class="slide"><img src="https://upload.wikimedia.org/wikipedia/fr/0/01/RATP.svg"></div>
    </section>
  </div>

  <script>
    $(document).ready(function(){
      $('.customer-logos').slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        arrows: false,
        dots: false,
        pauseOnHover: false,
        responsive: [
          {
            breakpoint: 768,
            settings: {
              slidesToShow: 4
            }
          },
          {
            breakpoint: 520,
            settings: {
              slidesToShow: 3
            }
          }
        ]
      });
    });
  </script>
</body>
</html>
