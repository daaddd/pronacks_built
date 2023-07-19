<?php 
ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);
define('PREPEND_PATH', '');
$home_dir = dirname(__FILE__);
include(PREPEND_PATH . "defaultLang.php");
include(PREPEND_PATH . "language.php");
include(PREPEND_PATH . "lib.php");
$mi = getMemberInfo();
?>
<script src="nocache.js?v='+new Date.getTime();"></script>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<title>Fitbook - Receitas Fitness</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="HandheldFriendly" content="True">
<link rel="icon" href="favicon.ico" type="image/x-icon">

<!-- Bootstrap v4.3.1 CSS -->
<link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
<!-- Custom CSS -->
<link rel="stylesheet" href="css/normalize.css">
<link rel="stylesheet" href="css/theme.css">
<link rel="stylesheet" href="css/theme/themelibrary.css">
<!-- Slick CSS -->
<link rel="stylesheet" type="text/css" href="lib/slick/slick/slick.css">
<link rel="stylesheet" type="text/css" href="lib/slick/slick/slick-theme.css">
<!-- Magnific Popup core CSS file -->
<link rel="stylesheet" href="lib/Magnific-Popup-master/dist/magnific-popup.css">
<!-- Font Awesome Free 5.10.2 JS -->
<script defer src="lib/fontawesome-free-5.10.2-web/js/brands.js"></script>
<script defer src="lib/fontawesome-free-5.10.2-web/js/solid.js"></script>
<script defer src="lib/fontawesome-free-5.10.2-web/js/fontawesome.js"></script>

</head>
<body class="foodkuy-green-leaf">
  
<!-- Preloading -->
<div class="preloading">
  <div class="wrap-preload">
    <div class="cssload-loader"></div>
  </div>
</div>
<!-- .Preloading -->

<div class="wrapper">
  <!-- Sidebar left -->
  <script src="sidebarleft.js?v='+new Date.getTime();"></script>
  <!-- .Sidebar left -->
  <!-- Sidebar right -->
  <script src="sidebarright.js?v='+new Date.getTime();"></script>
  <!-- .Sidebar right-->
  <!-- Page content  -->
  <div id="content">
    <!-- Header  -->
    <nav class="navbar navbar-expand-lg navbar-light bg-header">
    <div class="container-fluid">
      <button type="button" id="sidebarleftbutton" class="btn">
      <i class="fas fa-align-left"></i>
      </button>
      <div class="logo">Fitbook - Receitas Fitness</div>
      <button type="button" id="sidebarrightbutton" class="btn">
      <i class="fas fa-search"></i>
      </button>
    </div>
    </nav>
    <!-- .Header  -->
    <!-- Content Wrap  -->
    <div class="content-wrap"><?php $mi['username'];?>
    <div style="min-height: 570px; max-height: 571px; border-radius: 20px; width: 100%;" class="img-hero">
        <div style="height: 570px; background: url('img/5d4e0aa9502c3ee82.jpg') no-repeat center top / cover;"></div>
        <div style="height: 570px; background: url('img/1fd36cc0d4ae3695e.png') no-repeat center center / cover;"></div>
        <div style="height: 570px; background: url('img/049fb4a62ed0b864a.png') no-repeat center top / cover;"></div>
        <div style="height: 570px; background: url('img/3ccf43b716de00077.jpeg') no-repeat center center / cover;"></div>
        <div style="height: 570px; background: url('img/783398cbeb23ba867.png') no-repeat center top / cover;"></div> 
    </div>
      <div class="section-home you-might-like">
        <div class="heading-section">
          <div class="sa-title popcat">Melhores Receitas</div>
          <div class="clear"></div>
        </div>
        <div class="yml-carousel">
        <?php
        include('../../config.php');
        $conn  = mysqli_connect($dbServer, $dbUsername, $dbPassword);
        mysqli_select_db($conn ,$dbDatabase);
        $sqlStr = "
        SELECT DISTINCT *
        FROM snacks
        LIMIT 10;";
        $resp = sql($sqlStr, $eo);
        $index = 1;
        while($row = db_fetch_assoc($resp)) {
        ?>
          <div style="cursor:pointer;" class="yml-box">
            <div class="yml-img">
              <img style="height:150px;width:150px;object-fit: cover;" src="<?php echo $row['Illustration']; ?>" alt="you might like">
            </div>
            <div style="font-weight:bold;" class="yml-food-text">
            <span style="color:#2e8843;font-size:20px;" class="index-tag">
            <?php echo '#'.$index; ?></span><br>
            </span>
            <span style="font-size:16px;" class="recipe-name">
            <?php echo $row['name']; ?>
            </span>
            </div>
          </div>
        <?php
        $index++;
        }
        ?>
        </div>
      </div>
      <style>
       .button-effect {
          transition: all 0.1s ease-in-out !important;
        }

        .button-effect:active {
          box-shadow: inset 0 0 15px rgba(0,0,0,0.7) !important;
          transform: scale(0.98) !important;
        }
      </style>
      <div style="width:90%;" class="section-home s-category">
        <div class="heading-section">
          <div class="sa-title popcat">Categories</div>
          <div class="clear"></div>
        </div>
        <div class="home-category-list">
          <div style="cursor:pointer !important;" class="home-box-category button-effect">
            <div class="home-text-category">
              <div class="bc-text">Appetizers</div>
            </div>
            <div class="home-image-category">
              <img src="img/food1.jpg" alt="image-category">
            </div>
          </div>
          <div style="cursor:pointer !important;" class="home-box-category button-effect">
            <div class="home-text-category">
              <div class="bc-text">Salads</div>
            </div>
            <div class="home-image-category">
              <img src="img/food2.jpg" alt="image-category">
            </div>
          </div>
          <div style="cursor:pointer !important;" class="home-box-category button-effect">
            <div class="home-text-category">
              <div class="bc-text">Smoothies & Shakes</div>
            </div>
            <div class="home-image-category">
              <img src="img/food3.jpg" alt="image-category">
            </div>
          </div>
          <div style="cursor:pointer !important;" class="home-box-category button-effect">
            <div class="home-text-category">
              <div class="bc-text">Entrees</div>
            </div>
            <div class="home-image-category">
              <img src="img/food6.jpg" alt="image-category">
            </div>
          </div>
          <div style="cursor:pointer !important;" class="home-box-category button-effect">
            <div class="home-text-category">
              <div class="bc-text">Desserts</div>
            </div>
            <div class="home-image-category">
              <img src="img/food5.jpg" alt="image-category">
            </div>
          </div>
          <div style="cursor:pointer !important;" class="home-box-category button-effect">
            <div class="home-text-category">
              <div class="bc-text">Sides</div>
            </div>
            <div class="home-image-category">
              <img src="img/food6.jpg" alt="image-category">
            </div>
          </div>
          <div class="clear"></div>
          <div style="width:100%;cursor:pointer !important;" class="home-box-category button-effect">
            <div class="home-text-category">
              <div class="bc-text">All Recipes</div>
            </div>
            <div class="home-image-category">
              <img src="img/food6.jpg" alt="image-category">
            </div>
          </div>
        </div>
      </div>
      <div style="width:70%;" class="section-home s-category">
        <div class="heading-section">
          <div class="sa-title popcat">Smart Filter Section</div>
          <div class="clear"></div>
          <div style="text-align:center;margin:0 auto;" class=" more-category">
          <div class="theme-button mcbutton">Full Screen View</div>
          </div>
        </div>
        <iframe src="http://localhost:9090/pronacks_built/snacks_view.php?pagination=6" style="border-radius:10px;width:100%;height:900px;border:none;"></iframe>

        <div class="home-category-list">
          <div class="clear"></div>
        </div>
      </div>
      <!--<div class="section-home home-banner">
        <img src="img/banner.jpg">
      </div>--> 
      <div class="section-home home-news">
        <div class="heading-section">
         <div class="sa-title popcat">News & Tips</div> 
          <div class="clear"></div>
        </div>
        <span style="background-color: black;color:white;">this should be dinamically populated by a SQL query ordering by date published descending</span>
        <div class="home-news-wrap">
          <div class="news-item">
            <div class="news-content">
              <div class="hnw-img">
                <img src="img/news.jpg" alt="news">
              </div>
              <div class="hnw-desc">
                <div class="hnw-title">15 Totally Healthy Grilling Recipes</div>
                <div class="hnw-text">
                  Lorem ipsum dolor sit amet, adipiscing elit... <a href="news.html" class="more">Read More</a>
                </div>
              </div>
            </div>
          </div>
          <div class="news-item">
            <div class="news-content">
              <div class="hnw-img">
                <img src="img/news2.jpg" alt="news">
              </div>
              <div class="hnw-desc">
                <div class="hnw-title">Foods That Are Super Healthy</div>
                <div class="hnw-text">
                  dolor sit amet, Lorem ipsum adipiscing elit... <a href="news.html" class="more">Read More</a>
                </div>
              </div>
            </div>
          </div>
          <div class="news-item">
            <div class="news-content">
              <div class="hnw-img">
                <img src="img/news3.jpg" alt="news">
              </div>
              <div class="hnw-desc">
                <div class="hnw-title">17 Authentic local food in Yogyakarta</div>
                <div class="hnw-text">
                  Lorem ipsum dolor adipiscing elit... <a href="news.html" class="more">Read More</a>
                </div>
              </div>
            </div>
          </div>
          <div class=" more-category">
            <a href="news_list.html"><div class="theme-button mcbutton">More News
          </div>
        </div>
        <br>
      </div>

      <!-- SUBSCRIBE -->
<div class="section-subscribe">
  <div class="subcontainer">
    <div class="subrow">
      <div class="subcol">
        <div class="section-title">SUBSCRIBE</div>
        <p class="textsub">Get news and food recipes every day</p>
        <div class="mail-subscribe-box">
          <form name="subsribe">
          <input class="form-control" name="user-email" placeholder="Enter email address" value="" type="email">
          <button type="submit" class="submitsub"> <i class="fa fa-angle-right"></i></button>
        </form>
        </div>
      </div>
    </div>
  </div>
  <div class="bg-subscribe">
    <img src="img/food4.jpg" alt="banner">
  </div>
</div>
<!-- END SUBSCRIBE -->

    </div>
    <!-- .Content wrap  -->
    <!-- Footer  -->
    <div class="footer">
      <div class="footer-heading">Follow Us</div>
      <div class="socmed">
    <div class="socmed-line">       
        <div class="socmed-item">
          <a href="#" class="si-icon"> <i class="fab fa-facebook-f"></i></a>
        </div>
      </div>

    <div class="socmed-line">
        <div class="socmed-item">
          <a href="#" class="si-icon"><i class="fab fa-instagram"></i></a>
        </div>
      </div>

    <div class="socmed-line">
        <div class="socmed-item">
          <a href="#" class="si-icon"><i class="fab fa-twitter"></i></a>
        </div>
      </div>

    <div class="socmed-line">
        <div class="socmed-item">
          <a href="#" class="si-icon"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
      </div>
    </div>
    <!-- .Footer  -->
  </div>
  <!-- .Page content  -->
  <div class="overlay"></div>
  <!-- Optional JavaScript -->
  <!-- jQuery v3.4.1 -->
  <script src="lib/jquery/jquery-3.4.1.min.js"></script>
  <!--  Bootstrap v4.3.1 JS -->
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <!-- Magnific Popup core JS file -->
  <script src="lib/Magnific-Popup-master/dist/jquery.magnific-popup.js"></script>
  <!-- Slick JS -->
  <script src="lib/slick/slick/slick.min.js"></script>
  <!--  Custom JS -->
  <script src="js/theme.js"></script>
</div>
</body>
</html>