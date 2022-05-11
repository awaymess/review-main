<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <?php

    session_start();
    include "../../connect.php";
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->prepare("INSERT INTO movie VALUES ('',?,?,?,?,?,?,?,?)");
    $stmt->bindParam(1, $_POST["name"]);
    $stmt->bindParam(2, $_POST["score"]);
    $stmt->bindParam(3, $_POST["status"]);
    $stmt->bindParam(4, $_POST["type"]);
    $stmt->bindParam(5, $_POST["comment"]);
    $stmt->bindParam(6, $_POST["recom"]);
    $stmt->bindParam(7, $_POST["linkweb"]);
    $stmt->bindParam(8, $_POST["contry"]);
    if ($stmt->execute())
        header("location: insartproduct.php");

    ?>
</body>

</html>