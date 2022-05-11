<!DOCTYPE html>
<html lang="en">

<?php include "connect.php";
session_start();
?>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

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
  <div class="page-heading products-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="text-content">
            <h4>
              <h2>Catalog</h2>
            </h4>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="products">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="filters">
            <ul>
              <!-- <input type="text" name="names" id="search" /> -->
            </ul>
            <ul>
            </ul>
            <ul>
              <li class="active" data-filter="*">All </li>
              <li data-filter=".movie">Movie</li>
              <li data-filter=".manga">manga</li>
              <li data-filter=".anime">anime</li>
              <li data-filter=".series">series</li>
              <li data-filter=".Korea">korea</li>
              <li data-filter=".Japan">japan</li>
              <li data-filter=".EN">EN</li>
              <li style="font-family: 'Kanit', sans-serif;" data-filter=".กำลังดู">กำลังดู</li>
              <li style="font-family: 'Kanit', sans-serif;" data-filter=".ดูแล้ว">ดูแล้ว</li>
              <li style="font-family: 'Kanit', sans-serif;" data-filter=".ยังไม่ดู">ยังไม่ดู</li>

            </ul>
          </div>
        </div>
        <div class="col-md-12">
          <div class="filters-content">
            <div class="row grid">


              <?php
              $stmt = $pdo->prepare("SELECT * FROM movie");
              $stmt->execute();
              while ($row = $stmt->fetch()) { ?>

                <div class="col-md-3 col-md-3 all <?= $row["type"] ?> <?= $row["status"] ?> <?= $row["contry"] ?>">
                  <div class="product-item">
                    <a href="detail.php?idm=<?= $row["idm"] ?>"><img src="https://image.tmdb.org/t/p/w500/9uICQr5NWmNW8ptTTC3EBacTEGn.jpg" alt=""></a>
                    <div class="down-content">
                      <a href="detail.php?idm=<?= $row["idm"] ?>">
                        <h4 class="col-10 " style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?= $row["name"] ?></h4>
                      </a>
                      <h6 style="font-family: 'Kanit', sans-serif;"><?= $row["status"] ?></h6>
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
              <?php } ?>


            </div>
          </div>
        </div>

        <!-- <div class="col-md-12">
          <ul class="pages">
            <li><a href="#">1</a></li>
            <li class="active"><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#"><i class="fa fa-angle-double-right"></i></a></li>
          </ul>
        </div> -->

      </div>
    </div>
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