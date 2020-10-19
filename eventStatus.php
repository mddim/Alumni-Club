<?php
	date_default_timezone_set('Europe/Sofia');
	
	function changeStatusToEnded($conn) {
		$sql = "SELECT * FROM `events`";
		$query = $conn->query($sql) or die("failed!");
		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			if (date('Y-m-d H:i:s') > $row['date'] && time() > $row['end-time']) {
				$sql = "UPDATE `events` SET `status` = 'ended' WHERE `id` = " . $row['id'];
				$query = $conn->query($sql) or die("failed!");
			}
		}
	}
	
	function addAttendant($conn, $id) {
		$sql = "SELECT * FROM `events`";
		$query = $conn->query($sql) or die("failed!");
		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			if ($id == $row['id']) {
				$newValue = $row['going'] + 1;
				$sql = "UPDATE `events` SET `going` = '" . $newValue . "' WHERE `id` = " . $row['id'];
				$query = $conn->query($sql) or die("failed!");
			}
		}
	}
	
	function removeAttendant($conn, $id) {
		$sql = "SELECT * FROM `events`";
		$query = $conn->query($sql) or die("failed!");
		while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
			if ($id == $row['id']) {
				$newValue = $row['going'] - 1;
				if ($newValue > 1) {
					$sql = "UPDATE `events` SET `going` = '" . $newValue . "' WHERE `id` = " . $row['id'];
					$query = $conn->query($sql) or die("failed!");
				}
			}
		}
	}
?>