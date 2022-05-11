<?php
  require_once 'config.php';

  if (isset($_POST['query'])) {
    $inpText = $_POST['query'];
    $sql = "SELECT * FROM movie WHERE name LIKE concat('%', :name, '%') limit 6";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['name' => '%' . $inpText . '%']);
    $result = $stmt->fetchAll();



    if ($result) {
      foreach ($result as $row) {
        // echo '<a href="detail.php?idm=52" class="list-group-item list-group-item-action border-1">' . $row['name'] .$row['idm']. '</a>';
        echo  "<a href= detail.php?idm=".$row['idm']." class='list-group-item list-group-item-action border-1'>". $row['name']. "</a>";
        
      }
    } else {
      echo '<p class="list-group-item border-1">No Record</p>';
    }
  }
?>