<!DOCTYPE html>
<html lang="en">
<?php include "connect.php";
session_start();
?>

<script>
  var getPoster = function(elem) {

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
            console.log(json);
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
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

  <title>กูดูยังวะ</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--

TemplateMo 546 Sixteen Clothing

https://templatemo.com/tm-546-sixteen-clothing

-->

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
  <div class="page-heading about-heading header-text">
  </div>

  <?php
  $stmt = $pdo->prepare("SELECT * FROM movie WHERE idm=? ");
  $stmt->bindParam(1, $_GET["idm"]);
  $stmt->execute();

  ?>
  <?php while ($row = $stmt->fetch()) {

// $namemovie = $row["name"];
$namemovie = "Let's go JETS";

  ?>

    <div class="best-features about-features">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2><?= $row["name"] ?></h2>
            </div>
          </div>
          <div class="col-md-6">
            <div class="right-image">
              <input style="display: none;" type="text" id="term" value="<?= $namemovie ?>" />
              <img src="https://image.tmdb.org/t/p/w500<?= $posterf['picture'] ?>" alt="">
              <!-- <img src="https://image.tmdb.org/t/p/w500/9uICQr5NWmNW8ptTTC3EBacTEGn.jpg" alt=""> -->
            </div>
          </div>

          <div class="col-md-6">
            <div class="left-content">
              <ul class="stars">
                <?php
                for ($x = 0; $x < $row["score"]; $x++) {
                  echo '<i class="fa fa-star"></i>';
                }
                ?>
              </ul>
              <h4>Type : <?= $row["type"] ?></h4>
              <h4>Recomment : <?= $row["recom"] ?></h4>
              <h4 style="font-family: 'Kanit', sans-serif;">Status : <?= $row["status"] ?></h4>
              <h4>Country : <?= $row["contry"] ?></h4>
              <h4>Link : <?= $row["linkweb"] ?></h4>
              <h5 style="font-family: 'Kanit', sans-serif;"><?= $row["comment"] ?></h5>
            </div>
          </div>

        </div>
      </div>
    </div>

  <?php } ?>

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


  <script language="text/Javascript">
    cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
    function clearField(t) { //declaring the array outside of the
      if (!cleared[t.id]) { // function makes it static and global
        cleared[t.id] = 1; // you could use true and false, but that's more typing
        t.value = ''; // with more chance of typos
        t.style.color = '#fff';
      }
    }
  </script>

</body>

</html>