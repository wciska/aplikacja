<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Strona Główna</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Allura&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <style>
    body {
      font: 400 15px/1.8 Lato, sans-serif;
      color: #fff;
      background-color: #2d2d30;
      margin: 0;
      overflow: hidden; /* Wyłączenie przewijania strony */
    }
    
    /* obraz */
    .carousel-inner img {
      -webkit-filter: grayscale(90%);
      filter: grayscale(90%);
      width: 100%;
      margin: auto;
    }
    
    /* nagłówek */
    .carousel-caption h3 {
      color: #fff !important;
    }
    
    header.navbar {
      background-color: transparent; 
      border: none; 
      padding: 0;
    }

    /* Styl dla sekcji z linkami w prawym górnym rogu */
    header.navbar .top-links {
      display: flex;
      justify-content: flex-end;
      padding: 20px;
      position: absolute;
      top: 0;
      right: 0;
      background-color: transparent; 
    }

    header.navbar .top-links a {
      color: #fff;
      text-decoration: none;
      margin-left: 20px;
      font-size: 18px;
      transition: transform 0.3s ease, color 0.3s ease; 
      position: relative;
    }

    /* Efekt powiększenia i zmiany koloru  */
    header.navbar .top-links a:hover {
      transform: scale(1.05);
      color: white; 
      text-decoration: none;
    }

    /* Styl dla podkreślenia linków p*/
    header.navbar .top-links a::before {
      content: "";
      position: absolute;
      left: 0;
      bottom: -2px;
      width: 100%;
      height: 2px;
      background-color: #f1b340;
      transform: scaleX(0);
      transform-origin: right;
      transition: transform 0.3s ease;
    }

    header.navbar .top-links a:hover::before {
      transform: scaleX(1);
      transform-origin: left;
    }

    /* Styl dla sekcji z cytatem */
    .quote-section {
      text-align: center;
      padding: 50px;
      background-color: rgba(0, 0, 0, 0.7); /* Tło z efektem przeźroczystości */
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
    }

    .quote-section h3 {
      color: #fff;
      font-size: 24px;
      margin-bottom: 20px;
    }

    .quote-section p {
      color: #fff;
      font-size: 20px;
    }
  </style>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">

<header class="navbar">
  <div class="top-links">
    <a href="pracownik_ranking.php">Rankingi</a>
    <a href="pracownik_cele.php">Cele</a>
    <a href="logowanie.php">Zaloguj się</a>
  </div>
</header>

<div class="carousel-inner" role="listbox">
  <div class="item active">
    <img src="photo/tlo.jpg" alt="New York" width="1200" height="700">     
  </div>
</div>

<!-- Sekcja z cytatem -->
<div class="quote-section">
<p style="font-family: 'Kalam', cursive; color: white;">Dziś zrób to czego innym się nie chce, a jutro będziesz miał to czego inni pragną.</p>
</div>

</body>
</html>
