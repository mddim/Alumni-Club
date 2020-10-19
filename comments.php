<?php

function setComments($conn) {
	if(isset($_POST['commentSubmit'])) {
		$user = $_POST['user'];
		$FN = $_POST['FN'];
		$event_id = $_POST['event_id'];
		$date = $_POST['date'];
		$comment = $_POST['comment'];
			
		$sql = "INSERT INTO comments (event_id, user, FN, date, comment) VALUES ('$event_id', '$user', '$FN', '$date', '$comment')";
		$query = $conn->query($sql) or die("failed!");
		
	}
}

function getComments($conn, $event_id, $FNsession) {
	$sql = "SELECT * FROM comments WHERE `event_id` = '$event_id' ORDER BY `date` DESC";
	$result = $conn->query($sql);
	while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
		echo "<div id='comment-box' class='comment-box'><p> <font color='#283593' size='5px'><a class='link' href=profile.php?FNuser={$row['FN']}&FNsession={$FNsession}>" . $row['user'] . "</a></font><br><br>";
		echo nl2br($row['comment']) . "<br><br>";
		echo "<font size='1px'>" . $row['date'] . "</font><br></p></div>";
	}
}