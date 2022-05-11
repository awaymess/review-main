<header class="">


  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css">

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">

  <style>
    #show-list {
      border-radius: 5px;
      position: absolute;
      align-content: center;
    }

    #show-list a {
      
      background: rgb(46, 46, 46);
      text-align: center;
      font-size: 12px;
      color: pink;
      align-content: center;

    }

    input[type=text] {
      background-color: [white];
      background-position: 10px 10px;
      background-repeat: no-repeat;
      padding-left: 10px;
      border-radius: 5px
      
      
    }
  </style>


  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <h2 style="font-family: 'Kanit', sans-serif;">นี่กูดู<span style="color: pink;">ยังวะ</span></h2>
        
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="catalog.php">Catalog</a>

          </li>
          <li class="nav-item">


            <div class="input">
              <input type="text" name="search" id="search" placeholder="Search..." autocomplete="off" required>
            </div>
            <div class="col-md-12">
              <ul id="show-list"></ul>
            </div>

            <!-- 
            <input type="text" name="names" id="search" />
            <ul class="col-md-12" id="show_up"></ul> -->
            <!-- <div id="show_up"></div> -->


            <!-- <a class="nav-link" href="manager\html\index.php">Add</a> -->
          </li>
        </ul>
      </div>





    </div>
  </nav>
</header>

<body>

  <script>
    $(document).ready(function(e) {
      $("#search").keyup(function() {
        $("#show_up").show();
        var text = $(this).val();
        $.ajax({
          type: 'GET',
          url: 'search.php',
          data: 'txt=' + text,
          success: function(data) {
            $("#show_up").html(data);
          }
        });
      })
    });
  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="search_check_ve\script.js"></script>

</body>