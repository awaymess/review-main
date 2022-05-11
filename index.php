<!DOCTYPE html>
<html lang="en">

<?php include "connect.php";
session_start();
?>

<script>
  // function(elem){
  //     var value = elem.value;
  //     var id    = elem.id;
  //     ...
  // }

  var getPoster = function(elem) {

    // var film = $('#term').val();

    var film = document.getElementById("term").value;

    if (film == '') {
      // $('#poster').html('<div class="alert"><strong>Oops!</strong> Try adding something into the search field.</div>');
      // $('#poster').html('<img src=\"http://image.tmdb.org/t/p/w500/9uICQr5NWmNW8ptTTC3EBacTEGn.jpg\" class=\"img-responsive\" >');
    } else {

      // $('#poster').html('<img src=\"http://image.tmdb.org/t/p/w500/9uICQr5NWmNW8ptTTC3EBacTEGn.jpg\" class=\"img-responsive\" >');

      $.getJSON("https://api.themoviedb.org/3/search/movie?api_key=15d2ea6d0dc1d476efbca3eba2b9bbfb&query=" + film + "&callback=?", function(json) {
        if (json != "Nothing found.") {
          // console.log(json);
          $('#poster').html('<img src=\"http://image.tmdb.org/t/p/w500/' + json.results[0].poster_path + '\" class=\"img-responsive\" >');
        } else {
          $.getJSON("https://api.themoviedb.org/3/search/movie?api_key=15d2ea6d0dc1d476efbca3eba2b9bbfb&query=goonies&callback=?", function(json) {
            // console.log(json);
            // $('#poster').html('<img src=\"http://image.tmdb.org/t/p/w500/9uICQr5NWmNW8ptTTC3EBacTEGn.jpg\" class=\"img-responsive\" >');
          });
        }
      });
    }
    console.log(film);

    return false;
  }
</script>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">

  <title>กูดูยังวะ</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="assets/css/fontawesome.css">
  <link rel="stylesheet" href="assets/css/templatemo-sixteen.css">
  <link rel="stylesheet" href="assets/css/owl.css">

</head>

<body>


  <!-- ***** Preloader Start ***** -->
  <div id="preloader">
    <div class="jumper">
      <div></div>
      <div></div>
      <div></div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <!-- Header -->
  <?php include "menu.php"; ?>

  <!-- Page Content -->

  <!-- Banner Starts Here -->
  <div class="banner header-text">
    <div class="owl-banner owl-carousel">

      <div class="banner-item-02">
        <div class="text-content">
          <h2 style="font-family: 'Kanit', sans-serif;">วันๆไม่ทำเหี้ยไรดูแต่ซี่รี่ย์</h2>
          <h2></h2>
        </div>
      </div>

      <div class="banner-item-03">
        <div class="text-content">
          <h2 style="font-family: 'Kanit', sans-serif;">กูทำเพื่อเตือนความจำตัวเองครับ</h2>
          <h2></h2>
        </div>
      </div>

    </div>
  </div>
  <!-- Banner Ends Here -->

  <!-- 
    <div class="content">
      <div id="fileContent">
        <?php include('php/custom.php') ?>
      </div>

      <div id="wrapper" style="margin: 20px">

        <div id="posters">

        </div>
      </div>
    </div> -->



  <div class="latest-products">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h2>Watching</h2>
            <a href="catalog.php">view all <i class="fa fa-angle-right"></i></a>
          </div>
        </div>

        <?php

        $stmt = $pdo->prepare("SELECT idm,name,type,comment,recom,contry,score,status FROM movie WHERE status='ดูแล้ว' ORDER BY idm DESC LIMIT 6 OFFSET 0 ");
        $stmt->execute();
        while ($row = $stmt->fetch()) {
          $namemovie = $row['name']

        ?>

          <div class="col-md-4">
            <div class="product-item">

              <a href="detail.php?idm=<?= $row["idm"] ?>">
                <div id="poster"></div>
                <!-- <img src="https://image.tmdb.org/t/p/w500/9uICQr5NWmNW8ptTTC3EBacTEGn.jpg" alt=""> -->
              </a>

              <div class="down-content">
                <input style="display: none;" type="text" id="term" value="<?= $namemovie ?>" />
                <a href="detail.php?idm=<?= $row["idm"] ?>">
                  <h4 class="col-10 " style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?= $row["name"] ?></h4>
                </a>
                <h6 style=" font-family: 'Kanit', sans-serif;"><?= $row["status"] ?></h6>
                <p style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-family: 'Kanit', sans-serif;"><?= $row["comment"] ?></p>
                <ul class="stars">
                  <?php
                  for ($x = 0; $x < $row["score"]; $x++) {
                    echo '<li><i class="fa fa-star"></i></li>';
                  }
                  ?>
                </ul>
                <span><?= $row["recom"] ?></span>
              </div>
            </div>
          </div>

          <script>
            getPoster();
          </script>


        <?php } ?>
      </div>




      <footer>
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="inner-content">
                <p>Copyright &copy; 2021 Memory my movie
              </div>
            </div>
          </div>
        </div>
      </footer>


      <!-- Bootstrap core JavaScript -->
      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


      <!-- Additional Scripts -->
      <script src="assets/js/custom.js"></script>
      <script src="assets/js/owl.js"></script>
      <script src="assets/js/slick.js"></script>
      <script src="assets/js/isotope.js"></script>
      <script src="assets/js/accordions.js"></script>

</body>


</html>