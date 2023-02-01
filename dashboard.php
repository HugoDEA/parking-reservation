<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    header('location:login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Réservation Parking</title>
</head>
<body>
<header>
            <img src="parking.png" alt="Logo"  width="50px"; height="50px" >
            <h2>Réservation Parking</h2>
            <a href="logout.php"  class="boutongauche">Se déconnecter</a>
    </header>
    <div class="titre">
        <?php

        if(isset($_SESSION['username'])){
            echo "<p>Bonjour, Vous êtes connecté en tant que " . $_SESSION['username'];
          }
        else{
            echo "<p>Bonjour, veuillez-vous connecter</p>";

        }


        ?>

    </div>

    <table>
        <tr>
            <th>Lundi 16 mai</th>
            <th>Mardi 17 mai</th>
            <th>Mercredi 18 mai</th>
            <th>Jeudi 19 mai</th>
            <th>Vendredi 20 mai</th>
            <th>Samedi 21 mai</th>
            <th>Dimanche 22 mai</th>
        </tr>
        <tr>
            <td>08:00</td>
            <td>08:00</td>
            <td>08:00</td>
            <td>08:00</td>
            <td>08:00</td>
            <td>08:00</td>
            <td>08:00</td>
        </tr>
        <tr>            
            <td>10:00</td>
            <td>10:00</td>
            <td>10:00</td>
            <td>10:00</td>
            <td>10:00</td>
            <td>10:00</td>
            <td>10:00</td>
        </tr>
        <tr>
            <td>12:00</td>
            <td>12:00</td>
            <td>12:00</td>
            <td>12:00</td>
            <td>12:00</td>
            <td>12:00</td>
            <td>12:00</td>
        </tr>
        <tr>
            <td>14:00</td>
            <td>14:00</td>
            <td>14:00</td>
            <td>14:00</td>
            <td>14:00</td>
            <td>14:00</td>
            <td>14:00</td>
        </tr>
        <tr>
            <td>16:00</td>
            <td>16:00</td>
            <td>16:00</td>
            <td>16:00</td>
            <td>16:00</td>
            <td>16:00</td>
            <td>16:00</td>
        </tr>
        <tr>
            <td>18:00</td>
            <td>18:00</td>
            <td>18:00</td>
            <td>18:00</td>
            <td>18:00</td>
            <td>18:00</td>
            <td>18:00</td>
        </tr>
        <tr>         
            <td>20:00</td>
            <td>20:00</td>
            <td>20:00</td>
            <td>20:00</td>
            <td>20:00</td>
            <td>20:00</td>
            <td>20:00</td>
        </tr>
    </table>
  

</body>
</html>
