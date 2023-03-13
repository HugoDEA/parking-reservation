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
    <link rel="stylesheet" href="assets/css/style.css">

    <title>Réservation Parking</title>
</head>
<body>
<header>
<a href="index.html">
            <img src="assets/img/parking.png" alt="Logo" width="50px" ; height="50px" >
        </a>            <h2>Réservation Parking</h2>
            <a href="logout.php"  class="sedeconnecter">Se déconnecter</a>
    </header>
    <div class="titre">
   

 

        <?php

        #if(isset($_SESSION['username'])){
            #echo "<p>Bonjour, Vous êtes connecté en tant que " . $_SESSION['username'];
          #}
       # else{
            #echo "<p>Bonjour, veuillez-vous connecter</p>";

       # }


        ?><p id="message"></p>

        <script>
          window.onload = function() {
            updateTime();
          };
        
          function updateTime() {
            // Récupère la date actuelle
            var date = new Date();
        
            // Formate la date en chaîne de caractères
            var dateString = date.toLocaleDateString();
        
            // Récupère l'heure actuelle
            var time = date.toLocaleTimeString();
        
            // Affiche le message dans le paragraphe
            document.getElementById("message").innerHTML = "Bonjour <?php echo $_SESSION['username'] ?>, nous sommes le " + dateString + " et il est actuellement " + time + ".";
          }
        
          // Appelle la fonction updateTime toutes les 1000 milliseconds (1 seconde)
          setInterval(updateTime, 1000);
        </script>
        
</div>
    </div>

    <?php

// Connect to the database
$conn = mysqli_connect('localhost', 'root', 'Parking852!', 'parking');

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to select the date, starting_hour, and finishing_hour for all entries in the schedule table
$sql = "SELECT id, date, starting_hour, finishing_hour FROM schedule";

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if the query returned any data
if (mysqli_num_rows($result) > 0) {
    // Display the results in a table
    echo "<table>";
    echo "<tr>";
    echo "<th>Date</th>";
    echo "<th>Heure </th>";
    /*echo "<th>Heure de fin</th>";*/
    echo "</tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['date'] . "</td>";
        echo "<td>" . $row['starting_hour'] . "</td>";
        /*echo "<td>" . $row['finishing_hour'] . "</td>";*/
        echo "</tr>";
    }
    echo "</table>";
} else {
    // No data was returned
    echo "No data found.";
}

// Close the database connection
mysqli_close($conn);

?>

<script src="assets/js/script.js"></script>

</body>
</html>
