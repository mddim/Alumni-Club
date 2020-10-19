<html>


    <head> 
        <link rel="stylesheet" href="css/stylesProfile.css" type="text/css" />
        <script src="https://kit.fontawesome.com/7ff7e6ca5e.js" crossorigin="anonymous"></script>
        <meta charset="UTF-8">
    </head>

    <?php
		$sessionFN = 0;
		$fn = 0;
		if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['FNuser']) && isset($_GET['FNsession'])) {
			$fn = $_GET['FNuser'];
			$sessionFN = $_GET['FNsession'];

		} else {
			if(session_id() == '' || !isset($_SESSION)) {
				session_start();
			}
			$fn = $_SESSION['FN'];
			$sessionFN = $fn;
		}

        $names = $facultyNumber = $permGPS = $tempGPS = $phone = $visGroup = $links = "-";

        $user = 'root';
        $pass = '';
        $db='alumniclubdb';
        $conn = new mysqli('localhost', $user, $pass, $db) or die("Sad");

        $sql = "SELECT * FROM people";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          
          while($row = $result->fetch_assoc()) {
                if ($row["FN"] == $fn) {
                    $names=$row["Name"];
                    $facultyNumber=$row["FN"];
                    $email=$row["email"];
                    $permGPS=$row["GPSCoord"];
                    $tempGPS=$row["TmpGPSCoord"];
                    $phone=$row["PhoneNumber"];
                    $visGroup=$row["VisabilityGroup"];
                    $links=$row["Sites"];
					$links=str_replace(";", " ", $links);
                }
				if ($tempGPS == "") {
					$tempGPS = '-';
				}
          }
        }
    ?>

    <body>

        <h2 id="mainHead"> Профил </h2>

        <div class="main-container">
            <div class="container">
                <h3> Обща информация: </h3>
                <p> <i class="fas fa-user"></i> <?php echo $names;?> </p>
                <p> <i class="fas fa-id-badge"></i> <?php echo $facultyNumber;?>  </p>
                <p> <i class="fas fa-map-pin"></i> <?php echo $permGPS;?> </p>
                <p> <i class="fas fa-map-marker-alt"></i> <?php echo $tempGPS;?> </p>
                <p><i class="fas fa-users"></i> <?php echo $visGroup;?> </p>
            </div>

            <div class="links-box">
                <div id="links">
                    <h3> Връзки: </h3>
                    <p> <i class="fas fa-phone-volume"></i> <?php echo $phone;?> </p>
                    <p> <i class="fas fa-link"></i> <?php echo $links;?> </p>
                </div>
                
                <div id="button-box">
					<form method="POST" action="events.php?FN=<?php echo $sessionFN;?>">
						<button type="submit" id="btn">Към събитията на клуба</button>
					</form>
                </div>
            </div>

        </div>
        
    </body>



</html>
