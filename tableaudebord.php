<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Réservation Parking</title>
    <script src="assets/js/script.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body id="test">
    <header>
        <a href="index.html">
            <img src="assets/img/parking.png" alt="Logo" width="50px" ; height="50px" >
        </a>
        <h2>Réservation Parking</h2>
        <a href="index.html"  class="sedeconnecter">Se deconnecter</a>
</header>
    <div class="titre">
        <p id="message"></p>
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
</body>
</html>