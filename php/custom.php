<?php
$stmt = $pdo->prepare("SELECT * FROM movie WHERE status='กำลังดู' ORDER BY idm DESC LIMIT 6 OFFSET 0 ");
$stmt->execute();
while ($row = $stmt->fetch()) {
?>
    <h4 type="hidden"><?= $row["name"] ?></h4>

<?php } ?>