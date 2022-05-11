<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>ล็อคอินสำเร็จ</title>

</head>

<body>
  <?php
  include "../connect.php";
  session_start();


  $stmt = $pdo->prepare("SELECT * FROM admin WHERE user = ? AND password = ?");
  $stmt->bindParam(1, $_POST["user"]);
  $stmt->bindParam(2, $_POST["password"]);
  $stmt->execute();
  $row = $stmt->fetch();

  echo $_POST['user'];
  echo $_POST['user'];
  $_SESSION['fullname'] = $row['user'];

  if (!empty($row)) {
    $_SESSION["fullname"] = $row["user"];
    $_SESSION["user"] = $row["user"];
    header("Location:../manager/html");
  } else {
    header("Location:index.php");
  }

  ?>

</body>

</html>