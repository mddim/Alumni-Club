<?php
	date_default_timezone_set('Europe/Sofia');
	include 'comments.php';
	include 'connection.php';
	include 'eventStatus.php';
	
	try {
		$connObj = new Connection();
		$conn = $connObj->getConnection();
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Comments section</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/commentStyle.css">
	<link rel="stylesheet" href="css/goingButton.css">
	<script src='js/photos.js'></script>
</head>
<body onload="startTimer()">
	<div id="header" class="header">
		<img id="img" src="img/lights1.jpg"/>
		<button type="button" id="header-button" onclick="displayPreviousImage()">&lt; Предишнa</button>
		<button type="button" id="header-button" onclick="displayNextImage()">Следваща > </button><br>
	</div>
	<?php
	$id = $_GET['id'];
	$FN = $_GET['FN'];
	
	$sql = "SELECT `name` FROM `people` WHERE `FN` = '$FN'";
	$query = $conn->query($sql) or die("failed!");	
	$row = $query->fetch(PDO::FETCH_ASSOC);
	$name = $row['name'];
	
	$sql = "SELECT * FROM `events` WHERE `id` = '$id'";
	$query = $conn->query($sql) or die("failed!");	
	$row = $query->fetch(PDO::FETCH_ASSOC);
    $newDate = date("d.m.Y", strtotime($row['date'])); 
	$newStartTime = date("H:i", strtotime($row['start-time']));
	$newEndTime = date("H:i", strtotime($row['end-time']));
	echo "<form method='POST' action='events.php?FN=$FN'>
		<button type='submit' id='back-to-events-button'>Назад към събития</button>
	</form>";
	echo "<div class='event-table-wrap'>
			<table id='event-table' class='event-table'>
				<tr>
					<th>Събитие</th>
					<td>". $row['name'] ."</td>
				</tr>
				<tr>
					<th>Описание</th>
					<td>". $row['description'] ."</td>
				</tr>
				<tr>
					<th>Кога?</th>
					<td>на " . $newDate . " от " . $newStartTime . " до " . $newEndTime . "</td>
				</tr>
				<tr>
					<th>Ще присъстват</th>
					<td>". $row['going'] ."</td>
				</tr>
			</table>
		</div>";
	?>
	<!-- yes/no radio button -->
	<p style="text-align: center; margin: 15px; margin-bottom: 5px; font-size: 50px;" >Ще дойдеш ли?</p><div style="text-align: center; color: #ddd; font-size: 20px;">с мен</div>
	<div class="normal-container">
	<div class="smile-rating-container">
		<div class="smile-rating-toggle-container">
			<form class="submit-rating" action="" method="post">
				<div class="radio-button">
					<input id="meh"  name="going" type="radio" value="no" checked="checked"/> 
					<input id="fun" name="going" type="radio" value="yes" /> 
					<label for="meh" class="rating-label rating-label-meh">Не</label>
					<div class="smile-rating-toggle"></div>
					
					<div class="rating-eye rating-eye-left"></div>
					<div class="rating-eye rating-eye-right"></div>
					
					<div class="mouth rating-eye-bad-mouth"></div>
						<div id="toggle-rating-pill" class="toggle-rating-pill"></div>
					<label for="fun" class="rating-label rating-label-fun">Да</label>	
				</div><br>
				<div class="attendance-button-container">
					<button id="attendance-button" type="submit" name="attendance-button"/>Потвърди</button>
				</div>
			</form>
		</div>
	</div> 
	</div> 
	<div style="font-size: 30px; margin-left: 20px; margin-top: 10px;">Коментари</div>
	
	<?php
	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['going'])) {	
		$going = $_POST['going'];
		if ($going == 'yes') {
			addAttendant($conn, $id);
		} else if ($going == 'no') {
			removeAttendant($conn, $id);
		}
		echo "echo \"<meta http-equiv='refresh' content='0'>\";
		<script>
		if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
		}
		</script>";
	}
	
	echo "<form method='POST' action'". setComments($conn) ."'>
		<input type='hidden' name='event_id' value='$id'>
		<input type='hidden' name='user' value='$name'>
		<input type='hidden' name='FN' value='$FN'>
		<input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
		<textarea name='comment'></textarea><br>
		<button type='submit' name='commentSubmit' id='submit-button'>Добави</button>
	</form>
	<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
	</script>";
	
	getComments($conn, $id, $FN);
	
	?>
</table>
</body>
</html>