<!DOCTYPE html>
<html>
<?php
require_once('functions.php');
require_once('_header.php');
?>

<head>
  <link rel="stylesheet" href="style/pagedacc.css">

  <style>
    .title {
      background-color: white;
      color: #000;
      padding: 10px;
      text-align: center;
      font-family: Arial, sans-serif;
      font-size: 30px;
      letter-spacing: 2px;
      text-transform: uppercase;
      border-radius: 5px;
      cursor: pointer;
    }

    .title h1 {
      margin: 0;
      padding: 0;
      line-height: 1;
    }
    #about {
    background-color: #f1f1f1;
    padding: 20px;
  }

  #about .container {
    max-width: 800px;
    margin: 0 auto;
    text-align: justify;
  }

  #about h2 {
    text-align: center;
    font-size: 24px;
    margin-bottom: 20px;
  }

  #about p {
    margin-bottom: 10px;
  }
  </style>
</head>

<body>
  <header>
    <div class="videoHeader">
      <video src="video/video2.mp4" autoplay muted loop></video>
    </div>
    <div id="overlay">
      <h1>𝚃𝙷𝙴 𝙸𝙼𝙰𝙶𝙸𝙽𝙰𝚁𝚈 𝙼𝚄𝚂𝙴𝚄𝙼</h1>
      <?php
   
      if (!isset($_SESSION['user'])) {
      echo '<a href="login.php" id="btn">Explore</a>'; // Redirige vers login.php
    } else {
      echo '<a href="Exposition.php" id="btn">Explore</a>'; // Redirige vers Exposition.php
    }
    ?>
    </div>
  </header>
  <section class="title">
    <h1>HIGHLIGHTS</h1>
  </section>

  <section>
    <?php
    require_once('highlight.php');
    ?>
  </section>

  <section id="about">
    <div class="container">
      <h2>Qui sommes-nous</h2>
      <p>
        Bienvenue au musée en ligne "The Imaginary Museum". Nous sommes passionnés par l'art et la créativité, et notre mission est de vous offrir une expérience unique en explorant des œuvres d'art imaginaires.
      </p>
      <p>
        Notre musée présente une collection diversifiée d'œuvres fictives créées par des artistes renommés du monde entier. Chaque pièce d'art est soigneusement conçue pour vous transporter dans un univers fantastique et vous inspirer.
      </p>
      <p>
        En parcourant notre musée en ligne, vous aurez l'occasion de découvrir des peintures, des sculptures, des photographies et bien plus encore, toutes imaginées pour stimuler votre imagination et éveiller votre curiosité.
      </p>
      <p>
        Nous croyons en l'importance de l'art comme moyen d'expression, de réflexion et de dialogue. C'est pourquoi nous encourageons les visiteurs à partager leurs réflexions et leurs interprétations des œuvres exposées, créant ainsi une communauté d'amoureux de l'art qui partagent une passion commune.
      </p>
      <p>
        Nous espérons que votre visite virtuelle au musée "The Imaginary Museum" sera une expérience enrichissante et inspirante. Profitez de votre exploration et laissez votre imagination s'épanouir !
      </p>
    </div>
  </section>

  <section>
    <?php
    require_once('abonnement.php');
    ?>
  </section>

  <section>
    <?php
    require_once('partenariat.php');
    ?>
  </section>

  <?php
  require_once('_footer.php');
  ?>
</body>

</html>
