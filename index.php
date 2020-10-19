<!DOCTYPE html>
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

<html>
    <head>
        <title>Алумни клуб на СУ</title>
        <link rel="stylesheet" href="css/stylesWelcomePage.css" type="text/css" />
        <meta charset="UTF-8">
    </head>


    <?php

        $credentialsErr  = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['facultyNumber']) && isset($_POST['email']))  {

            $fn = $_POST['facultyNumber'];
            $email = $_POST['email'];
            $correctCredentials = false;

            $sql = "SELECT * FROM `people` where `FN` = '$fn' && `email` = '$email'";
            $result = $conn->query($sql) or die("failed!");
			$row = $result->fetch(PDO::FETCH_ASSOC);
			if ($row != '') {
				if(session_id() == '' || !isset($_SESSION)) {
					session_start();
				}
				$_SESSION['FN'] = $fn;
				header("Location: profile.php?FN=".$fn."");
			}
			else {
				$credentialsErr = "Невярно потребителско име или парола!";
			}
        }
    ?>

    <body>
        <nav class = "navigation">
            <p>Софийски университет Климент Охридски</p>
        </nav>

        <img id="imgSU" src="img/purpleSU.jpg">
        
        <h1> ДОБРЕ ДОШЛИ В АЛУМНИ КЛУБ НА "СВ КЛИМЕНТ ОХРИДСКИ"! </h1>
        
        <form action="index.php" method="post">
            <div class="container">
                <p> За включване в клуба, моля регистрирайте се със следните данни: </p>
                <hr>

                <label for="username"> <b> Потребителско име</b> </label>
                <input type="text"  placeholder="Въведете факултетен номер" name="facultyNumber"></td>
            
                <label for="password"> <b> Парола</b> </label>
                <input type="password"  placeholder="Въведете имейл" name="email"></td>
                <span class="error"><?php echo $credentialsErr;?></span>

                <div class="clearfix">
                    <button type="submit" class="registerbtn" name="Register" value="Register"> Регистрация </button>
            
                </div>
            </div>
        </form>
    </body>
</html>