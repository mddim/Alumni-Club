<?php
		include 'connection.php';
		include 'eventStatus.php';
				
			try {
				$connObj = new Connection();
				$conn = $connObj->getConnection();
			} catch (PDOException $e) {
					echo "Error: " . $e->getMessage();
			}
			
		changeStatusToEnded($conn);
	?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Таблица със събития</title>
	<script src='js/photos.js'></script>
	<link rel="stylesheet" href="css/style.css">
</head>
<body onload="startTimer()">
	<div id="header" class="header">
		<img id="img" src="img/lights1.jpg"/>
		<button type="button" id="header-button" onclick="displayPreviousImage()">&lt; Предишна</button>
		<button type="button" id="header-button" onclick="displayNextImage()">Следваща > </button>
	</div>
	<?php
		$FN = $_GET['FN'];
		//$FN = 81536;
		$sql = "SELECT `name` FROM `people` WHERE `FN` = '$FN'";
		$query = $conn->query($sql) or die("failed!");	
		$row = $query->fetch(PDO::FETCH_ASSOC);
		$name = $row['name'];
		echo "<div id='intro'> $name, присъедини се и се забавлявай!</div>";
	?>
	
	<div id="search" class="search">
		<form action="" method="post" id="search-form">
			<div id="event-search">Търси събития</div>
			Тип на събитието: <select name="type" id="type-select">
				<option value=""></option>
				<option value="meeting">Среща</option>
				<option value="seminar">Семинар</option>
				<option value="sports event">Спортно събитие</option>
			</select>
			Дата: <input type="date" name="date" value="">
			<button id="search-button" type='submit' name='submit'>Търсене</button>
		</form>
		<?php
		if ($_SERVER['REQUEST_METHOD'] === 'POST' && (isset($_POST['type']) || isset($_POST['date']))) {	
		
				$type = $_POST['type'];
				$date = $_POST['date'];
				
				echo "<table class=\"search-table\" id=\"search-table\">";
				
				$sql="";
				
				if ($type != "" && $date != "") {
					$sql = "SELECT `id`, `date`, `start-time`, `end-time`, `name`, `description`, `type` FROM `events` WHERE `type` = '".$type."' AND `date` = '".$date."' ORDER BY `date`";
				} else if ($type == "" && $date != "") {
					$sql = "SELECT `id`, `date`, `start-time`, `end-time`, `name`, `description`, `type` FROM `events` WHERE `date` = '".$date."' ORDER BY `date`";
				} else if ($type != "" && $date == "") {
					$sql = "SELECT `id`, `date`, `start-time`, `end-time`, `name`, `description`, `type` FROM `events` WHERE `type` = '".$type."' ORDER BY `date`";
				} else {
					$sql = "SELECT `id`, `date`, `start-time`, `end-time`, `name`, `description`, `type` FROM `events` ORDER BY `date`";
				}
				$query = $conn->query($sql) or die("failed!");
				while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
					$id = $row["id"];
					echo "<tr><td><a href=eventPage.php?id={$id}&FN={$FN}>" . $row["name"]. "</a></td><td>" . $row["date"] . "</td><td>" . $row["start-time"]. "</td><td>" . $row["end-time"]. "</td><td>" . $row["description"] . "</td><td>". $row["type"]. "</td></tr>";
					}
				echo "</table>";
		} 
		?>
	</div>
	<div id="table-header">
		Предстоящи събития
	</div>
	<div id="table-scroll" class="table-scroll">
		<div id="faux-table" class="faux-table" aria="hidden"></div>
		<div class="table-wrap">
			<table id="main-table" class="main-table">
				<thead>
					<tr>
						<th scope="col">Събитие</th>
						<th scope="col" width="90">Дата</th>
						<th scope="col">Начало</th>
						<th scope="col">Край</th>
						<th scope="col">Описание</th>
						<th scope="col">Тип</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$conn->query("UPDATE `events` SET `status` = 'ended' WHERE `date` < CURDATE()");
					$sql = "SELECT `id`, `date`, `start-time`, `end-time`, `name`, `description`, `type` FROM `events` WHERE `status` = 'pending' ORDER BY `date`;";
					$query = $conn->query($sql) or die("failed!");
					while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
						$id = $row["id"];
						echo "<tr><td><a href=eventPage.php?id={$id}&FN={$FN}>" . $row["name"]. "</a></td><td>" . $row["date"] . "</td><td>" . $row["start-time"]. "</td><td>" . $row["end-time"]. "</td><td>" . $row["description"] . "</td><td>". $row["type"]. "</td></tr>";
					}
					echo "</table>";
					?>
				</tbody>
			</table>
		</div>
	</div>
	<div id="table-header">
		Минали събития
	</div>
	<div id="table-scroll" class="table-scroll">
		<div id="faux-table" class="faux-table" aria="hidden"></div>
		<div class="table-wrap">
			<table id="main-table" class="main-table">
				<thead>
					<tr>
						<th scope="col">Събитие</th>
						<th scope="col" width="90">Дата</th>
						<th scope="col">Начало</th>
						<th scope="col">Край</th>
						<th scope="col">Описание</th>
						<th scope="col">Тип</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$sql = "SELECT `id`, `date`, `start-time`, `end-time`, `name`, `description`, `type` FROM `events` WHERE `status` = 'ended' ORDER BY `date`";
					$query = $conn->query($sql) or die("failed!");
					while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
						$id = $row["id"];
						echo "<tr><td><a href=eventPage.php?id={$id}&FN={$FN}>" . $row["name"]. "</a></td><td>" . $row["date"] . "</td><td>" . $row["start-time"]. "</td><td>" . $row["end-time"]. "</td><td>" . $row["description"] . "</td><td>". $row["type"]. "</td></tr>";
					}
					echo "</table>";
					?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>