<?php
// create a new function
function search($text){
	
	
	// connection to the Ddatabase
    
	$db = new PDO("mysql:host=localhost;dbname=review;charset=utf8", "root", "");
    // $db = new PDO("mysql:host=localhost;dbname=id16127075_review", 'id16127075_away', 'Qy2vvcU_G_[UhMlU');
	// let's filter the data that comes in
	$text = htmlspecialchars($text);
	// prepare the mysql query to select the users 
	$get_name = $db->prepare("SELECT name FROM movie WHERE name LIKE concat('%', :name, '%') limit 6");
	// execute the query
	$get_name -> execute(array('name' => $text));
	// show the users on the page
	while($names = $get_name->fetch(PDO::FETCH_ASSOC)){
		// show each user as a link
		if ($text == "" ) {
		}else {
			echo '<a href="">'.$names['name'].'</a>';
		}
		
		
	}
}
// call the search function with the data sent from Ajax
search($_GET['txt']);
?>