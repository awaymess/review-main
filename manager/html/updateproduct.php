<?php include "../../connect.php" ?>
<?php
$stmt = $pdo->prepare("UPDATE movie SET name=?,score=?,status=?,type=?,comment=?,recom=?,linkweb=?,contry=?  WHERE idm=? ");

$stmt->bindParam(1, $_POST["name"]);
$stmt->bindParam(2, $_POST["score"]);
$stmt->bindParam(3, $_POST["status"]);
$stmt->bindParam(4, $_POST["type"]);
$stmt->bindParam(5, $_POST["comment"]);
$stmt->bindParam(6, $_POST["recom"]);
$stmt->bindParam(7, $_POST["linkweb"]);
$stmt->bindParam(8, $_POST["contry"]);
$stmt->bindParam(9, $_POST["idm"]);
if ($stmt->execute()) 
    header("location: updateproduct1.php");

?>