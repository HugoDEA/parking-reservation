<?php
if(!isset($_SERVER['HTTP_REFERER'])){
    header('location:login.php');
    exit;
}
?>
<?php
// Démarrer la session
setlocale(LC_TIME, 'fra_FRa');
$ajd=strftime('%A %e %B');
$ajd = ucfirst($ajd); // met la première lettre en majuscule
$ajdplusun = strftime('%A %e %B', strtotime('+1 day'));
$ajdplusun = ucfirst($ajdplusun); 
$ajdplusdeux = strftime('%A %e %B', strtotime('+2 day'));
$ajdplusdeux = ucfirst($ajdplusdeux); 
$ajdplustrois = strftime('%A %e %B', strtotime('+3 day'));
$ajdplustrois = ucfirst($ajdplustrois); 
$ajdplusquatre = strftime('%A %e %B', strtotime('+4 day'));
$ajdplusquatre = ucfirst($ajdplusquatre); 
$ajdpluscinq = strftime('%A %e %B', strtotime('+5 day'));
$ajdpluscinq = ucfirst($ajdpluscinq); 
$ajdplussix = strftime('%A %e %B', strtotime('+6 day'));
$ajdplussix = ucfirst($ajdplussix); 
$rfid = $_SESSION['rfid'];
$today = date("Y-m-d");
$todayplusun = date("Y-m-d", strtotime('+1 day'));
$todayplusdeux = date("Y-m-d", strtotime('+2 day'));
$todayplustrois = date("Y-m-d", strtotime('+3 day'));
$todayplusquatre = date("Y-m-d", strtotime('+4 day'));
$todaypluscinq = date("Y-m-d", strtotime('+5 day'));
$todayplussix = date("Y-m-d", strtotime('+6 day'));
$todayplussept= date("Y-m-d", strtotime('+7 day'));
// Vérifier si le formulaire a été soumis
  // Connexion à la base de données
  $host = "localhost";
  $username = "root";
  $password = "Parking852!";
  $dbname = "parking";
  $conn = mysqli_connect($host, $username, $password, $dbname);
  
  if (!$conn) {
    die('Erreur de connexion à la base de données : ' . mysqli_connect_error());
  }
  $class = ""; if (isset($_POST['submit'])) {
    $valeur = $_POST['submit'];
    switch($valeur) {
        case 'bouton1':
        // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
        $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '08:00:00' AND finishing_hour = '10:00:00' and DATE = '$today'";
        $check_result = mysqli_query($conn, $check_sql);
        $check_row = mysqli_fetch_assoc($check_result);
        $num_reservations = $check_row['num_reservations'];

        if ($num_reservations >= 7) {
            // La plage horaire est complète
            echo "<script>alert(\"La plage horaire 08:00 à 10:00 est complète.\");</script>";
        } else {
            // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '08:00:00' AND finishing_hour = '10:00:00' AND DATE = '$today'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations > 0) {
                // L'utilisateur a déjà une réservation de 10h à 12h
                echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
            } else {
                // Insérer la réservation dans la base de données
                $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$today','08:00:00','10:00:00')";
                mysqli_query($conn, $sql);

                // Afficher le message de réussite dans le navigateur
                $ajd_json = json_encode($ajd);
                echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 08:00 à 10:00.');</script>";
            }
        }
        break;

        case 'bouton2':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '10:00:00' AND finishing_hour = '12:00:00' and DATE = '$today'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 10:00 à 12:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '10:00:00' AND finishing_hour = '12:00:00' AND DATE = '$today'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$today','10:00:00','12:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajd);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 10:00 à 12:00.');</script>";
                }
            }
            break;


        case 'bouton3':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '12:00:00' AND finishing_hour = '14:00:00' and DATE = '$today'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 12:00 à 14:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '12:00:00' AND finishing_hour = '14:00:00' AND DATE = '$today'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$today','12:00:00','14:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajd);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 12:00 à 14:00.');</script>";
                }
            }
            break;



        case 'bouton4':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '14:00:00' AND finishing_hour = '16:00:00' and DATE = '$today'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 14:00 à 16:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '14:00:00' AND finishing_hour = '16:00:00' AND DATE = '$today'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$today','14:00:00','16:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajd);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 14:00 à 16:00.');</script>";
                }
            }
            break;

        case 'bouton5':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '16:00:00' AND finishing_hour = '18:00:00' and DATE = '$today'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 16:00 à 18:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '16:00:00' AND finishing_hour = '18:00:00' AND DATE = '$today'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$today','16:00:00','18:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajd);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 16:00 à 18:00.');</script>";
                }
            }
            break;


        case 'bouton6':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '18:00:00' AND finishing_hour = '20:00:00' and DATE = '$today'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 18:00 à 20:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '18:00:00' AND finishing_hour = '20:00:00' AND DATE = '$today'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$today','18:00:00','20:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajd);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 18:00 à 20:00.');</script>";
                }
            }
            break;


        case 'bouton7':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '20:00:00' AND finishing_hour = '22:00:00' and DATE = '$today'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 20:00 à 22:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '20:00:00' AND finishing_hour = '22:00:00' AND DATE = '$today'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$today','20:00:00','22:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajd);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 20:00 à 22:00.');</script>";
                }
            }
            break;

        case 'bouton8':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '08:00:00' AND finishing_hour = '10:00:00' and DATE = '$todayplusun'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 08:00 à 10:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '08:00:00' AND finishing_hour = '10:00:00' AND DATE = '$todayplusun'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusun','08:00:00','10:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdplusun);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 08:00 à 10:00.');</script>";
                }
            }
            break;

        case 'bouton9':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '10:00:00' AND finishing_hour = '12:00:00' and DATE = '$todayplusun'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 10:00 à 12:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '10:00:00' AND finishing_hour = '12:00:00' AND DATE = '$todayplusun'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusun','10:00:00','12:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdplusun);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 10:00 à 12:00.');</script>";
                }
            }
            break;
        case 'bouton10':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '12:00:00' AND finishing_hour = '14:00:00' and DATE = '$todayplusun'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 12:00 à 14:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '12:00:00' AND finishing_hour = '14:00:00' AND DATE = '$todayplusun'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusun','12:00:00','14:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdplusun);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 12:00 à 14:00.');</script>";
                }
            }
            break;
        case 'bouton11':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '14:00:00' AND finishing_hour = '16:00:00' and DATE = '$todayplusun'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 14:00 à 16:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '14:00:00' AND finishing_hour = '16:00:00' AND DATE = '$todayplusun'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusun','14:00:00','16:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdplusun);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 14:00 à 16:00.');</script>";
                }
            }
            break;
        case 'bouton12':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '16:00:00' AND finishing_hour = '18:00:00' and DATE = '$todayplusun'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 16:00 à 18:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '16:00:00' AND finishing_hour = '18:00:00' AND DATE = '$todayplusun'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusun','16:00:00','18:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdplusun);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 16:00 à 18:00.');</script>";
                }
            }
            break;
        case 'bouton13':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '18:00:00' AND finishing_hour = '20:00:00' and DATE = '$todayplusun'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 18:00 à 20:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '18:00:00' AND finishing_hour = '20:00:00' AND DATE = '$todayplusun'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusun','18:00:00','20:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdplusun);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 18:00 à 20:00.');</script>";
                }
            }
            break;
        case 'bouton14':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '20:00:00' AND finishing_hour = '22:00:00' and DATE = '$todayplusun'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 20:00 à 22:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '20:00:00' AND finishing_hour = '22:00:00' AND DATE = '$todayplusun'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusun','20:00:00','22:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdplusun);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 20:00 à 22:00.');</script>";
                }
            }
            break;
        case 'bouton15':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '08:00:00' AND finishing_hour = '10:00:00' and DATE = '$todayplusdeux'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 08:00 à 10:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '08:00:00' AND finishing_hour = '10:00:00' AND DATE = '$todayplusdeux'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusdeux','08:00:00','10:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdplusdeux);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 08:00 à 10:00.');</script>";
                }
            }
            break;
        case 'bouton16':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '10:00:00' AND finishing_hour = '12:00:00' and DATE = '$todayplusdeux'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 10:00 à 12:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '10:00:00' AND finishing_hour = '12:00:00' AND DATE = '$todayplusdeux'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusdeux','10:00:00','12:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdplusdeux);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 10:00 à 12:00.');</script>";
                }
            }
            break;
        case 'bouton17':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '12:00:00' AND finishing_hour = '14:00:00' and DATE = '$todayplusdeux'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 12:00 à 14:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '12:00:00' AND finishing_hour = '14:00:00' AND DATE = '$todayplusdeux'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusdeux','12:00:00','14:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdplusdeux);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 12:00 à 14:00.');</script>";
                }
            }
            break;
        case 'bouton18':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '14:00:00' AND finishing_hour = '16:00:00' and DATE = '$todayplusdeux'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 14:00 à 16:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '14:00:00' AND finishing_hour = '16:00:00' AND DATE = '$todayplusdeux'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusdeux','14:00:00','16:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdplusdeux);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 14:00 à 16:00.');</script>";
                }
            }
            break;
        case 'bouton19':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '16:00:00' AND finishing_hour = '18:00:00' and DATE = '$todayplusdeux'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 16:00 à 18:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '16:00:00' AND finishing_hour = '18:00:00' AND DATE = '$todayplusdeux'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusdeux','16:00:00','18:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdplusdeux);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 16:00 à 18:00.');</script>";
                }
            }
            break;
        case 'bouton20':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '18:00:00' AND finishing_hour = '20:00:00' and DATE = '$todayplusdeux'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 18:00 à 20:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '18:00:00' AND finishing_hour = '20:00:00' AND DATE = '$todayplusdeux'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusdeux','18:00:00','20:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdplusdeux);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 18:00 à 20:00.');</script>";
                }
            }
            break;
        case 'bouton21':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '20:00:00' AND finishing_hour = '22:00:00' and DATE = '$todayplusdeux'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 20:00 à 22:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '20:00:00' AND finishing_hour = '22:00:00' AND DATE = '$todayplusdeux'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusdeux','20:00:00','22:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdplusdeux);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 20:00 à 22:00.');</script>";
                }
            }
            break;
        case 'bouton22':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '08:00:00' AND finishing_hour = '10:00:00' and DATE = '$todayplustrois'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 08:00 à 10:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '08:00:00' AND finishing_hour = '10:00:00' AND DATE = '$todayplustrois'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplustrois','08:00:00','10:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdplustrois);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 08:00 à 10:00.');</script>";
                }
            }
            break;
        case 'bouton23':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '10:00:00' AND finishing_hour = '12:00:00' and DATE = '$todayplustrois'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 10:00 à 12:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '10:00:00' AND finishing_hour = '12:00:00' AND DATE = '$todayplustrois'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplustrois','10:00:00','12:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdplustrois);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 10:00 à 12:00.');</script>";
                }
            }
            break;
        case 'bouton24':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '12:00:00' AND finishing_hour = '14:00:00' and DATE = '$todayplustrois'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 12:00 à 14:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '12:00:00' AND finishing_hour = '14:00:00' AND DATE = '$todayplustrois'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplustrois','12:00:00','14:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdplustrois);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 12:00 à 14:00.');</script>";
                }
            }
            break;
        case 'bouton25':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '14:00:00' AND finishing_hour = '16:00:00' and DATE = '$todayplustrois'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 12:00 à 14:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '14:00:00' AND finishing_hour = '16:00:00' AND DATE = '$todayplustrois'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplustrois','14:00:00','16:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdplustrois);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 14:00 à 16:00.');</script>";
                }
            }
            break;
        case 'bouton26':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '16:00:00' AND finishing_hour = '18:00:00' and DATE = '$todayplustrois'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 16:00 à 18:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '16:00:00' AND finishing_hour = '18:00:00' AND DATE = '$todayplustrois'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplustrois','16:00:00','18:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdplustrois);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 16:00 à 18:00.');</script>";
                }
            }
            break;
        case 'bouton27':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '18:00:00' AND finishing_hour = '20:00:00' and DATE = '$todayplustrois'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 18:00 à 20:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '18:00:00' AND finishing_hour = '20:00:00' AND DATE = '$todayplustrois'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplustrois','18:00:00','20:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdplustrois);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 18:00 à 20:00.');</script>";
                }
            }
            break;
        case 'bouton28':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '20:00:00' AND finishing_hour = '22:00:00' and DATE = '$todayplustrois'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 20:00 à 22:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '20:00:00' AND finishing_hour = '22:00:00' AND DATE = '$todayplustrois'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplustrois','20:00:00','22:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdplustrois);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 20:00 à 22:00.');</script>";
                }
            }
            break;
        case 'bouton29':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '08:00:00' AND finishing_hour = '10:00:00' and DATE = '$todayplusquatre'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 08:00 à 10:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '08:00:00' AND finishing_hour = '10:00:00' AND DATE = '$todayplusquatre'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusquatre','08:00:00','10:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdplusquatre);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 08:00 à 10:00.');</script>";
                }
            }
            break;
        case 'bouton30':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '10:00:00' AND finishing_hour = '12:00:00' and DATE = '$todayplusquatre'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 10:00 à 12:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '10:00:00' AND finishing_hour = '12:00:00' AND DATE = '$todayplusquatre'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusquatre','10:00:00','12:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdplusquatre);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 10:00 à 12:00.');</script>";
                }
            }
            break;
        case 'bouton31':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '12:00:00' AND finishing_hour = '14:00:00' and DATE = '$todayplusquatre'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 12:00 à 14:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '12:00:00' AND finishing_hour = '14:00:00' AND DATE = '$todayplusquatre'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusquatre','12:00:00','14:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdplusquatre);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 12:00 à 14:00.');</script>";
                }
            }
            break;
        case 'bouton32':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '14:00:00' AND finishing_hour = '16:00:00' and DATE = '$todayplusquatre'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 14:00 à 16:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '14:00:00' AND finishing_hour = '16:00:00' AND DATE = '$todayplusquatre'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusquatre','14:00:00','16:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdplusquatre);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 14:00 à 16:00.');</script>";
                }
            }
            break;
        case 'bouton33':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '16:00:00' AND finishing_hour = '18:00:00' and DATE = '$todayplusquatre'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 16:00 à 18:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '16:00:00' AND finishing_hour = '18:00:00' AND DATE = '$todayplusquatre'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusquatre','16:00:00','18:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdplusquatre);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 16:00 à 18:00.');</script>";
                }
            }
            break;
        case 'bouton34':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '18:00:00' AND finishing_hour = '20:00:00' and DATE = '$todayplusquatre'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 18:00 à 12:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '18:00:00' AND finishing_hour = '20:00:00' AND DATE = '$todayplusquatre'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusquatre','18:00:00','20:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdplusquatre);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 18:00 à 20:00.');</script>";
                }
            }
            break;
        case 'bouton35':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '20:00:00' AND finishing_hour = '22:00:00' and DATE = '$todayplusquatre'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 20:00 à 22:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '20:00:00' AND finishing_hour = '22:00:00' AND DATE = '$todayplusquatre'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplusquatre','20:00:00','22:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdplusquatre);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 20:00 à 22:00.');</script>";
                }
            }
            break;
        case 'bouton36':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '08:00:00' AND finishing_hour = '10:00:00' and DATE = '$todaypluscinq'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 08:00 à 10:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '08:00:00' AND finishing_hour = '10:00:00' AND DATE = '$todaypluscinq'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todaypluscinq','08:00:00','10:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdpluscinq);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 08:00 à 10:00.');</script>";
                }
            }
            break;
        case 'bouton37':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '10:00:00' AND finishing_hour = '12:00:00' and DATE = '$todaypluscinq'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 10:00 à 12:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '10:00:00' AND finishing_hour = '12:00:00' AND DATE = '$todaypluscinq'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todaypluscinq','10:00:00','12:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdpluscinq);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 10:00 à 12:00.');</script>";
                }
            }
            break;
        case 'bouton38':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '12:00:00' AND finishing_hour = '14:00:00' and DATE = '$todaypluscinq'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 12:00 à 14:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '12:00:00' AND finishing_hour = '14:00:00' AND DATE = '$todaypluscinq'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todaypluscinq','12:00:00','14:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdpluscinq);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 12:00 à 14:00.');</script>";
                }
            }
            break;
        case 'bouton39':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '14:00:00' AND finishing_hour = '16:00:00' and DATE = '$todaypluscinq'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 14:00 à 16:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '14:00:00' AND finishing_hour = '16:00:00' AND DATE = '$todaypluscinq'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todaypluscinq','14:00:00','16:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdpluscinq);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 14:00 à 16:00.');</script>";
                }
            }
            break;
        case 'bouton40':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '16:00:00' AND finishing_hour = '18:00:00' and DATE = '$todaypluscinq'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 16:00 à 18:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '16:00:00' AND finishing_hour = '18:00:00' AND DATE = '$todaypluscinq'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todaypluscinq','16:00:00','18:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdpluscinq);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 16:00 à 18:00.');</script>";
                }
            }
            break;
        case 'bouton41':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '18:00:00' AND finishing_hour = '20:00:00' and DATE = '$todaypluscinq'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 18:00 à 20:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '18:00:00' AND finishing_hour = '20:00:00' AND DATE = '$todaypluscinq'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todaypluscinq','18:00:00','20:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdpluscinq);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 18:00 à 20:00.');</script>";
                }
            }
            break;
        case 'bouton42':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '20:00:00' AND finishing_hour = '22:00:00' and DATE = '$todaypluscinq'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 20:00 à 22:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '20:00:00' AND finishing_hour = '22:00:00' AND DATE = '$todaypluscinq'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todaypluscinq','20:00:00','22:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdpluscinq);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 20:00 à 22:00.');</script>";
                }
            }
            break;
        case 'bouton43':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '08:00:00' AND finishing_hour = '10:00:00' and DATE = '$todayplussix'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 08:00 à 10:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '08:00:00' AND finishing_hour = '10:00:00' AND DATE = '$todayplussix'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplussix','08:00:00','10:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdplussix);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 08:00 à 10:00.');</script>";
                }
            }
            break;
        case 'bouton44':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '10:00:00' AND finishing_hour = '12:00:00' and DATE = '$todayplussix'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 10:00 à 12:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '10:00:00' AND finishing_hour = '12:00:00' AND DATE = '$todayplussix'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplussix','10:00:00','12:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdplussix);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 10:00 à 12:00.');</script>";
                }
            }
            break;
        case 'bouton45':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '12:00:00' AND finishing_hour = '14:00:00' and DATE = '$todayplussix'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 12:00 à 14:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '12:00:00' AND finishing_hour = '14:00:00' AND DATE = '$todayplussix'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplussix','12:00:00','14:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdplussix);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 12:00 à 14:00.');</script>";
                }
            }
            break;
        case 'bouton46':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '14:00:00' AND finishing_hour = '16:00:00' and DATE = '$todayplussix'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 14:00 à 16:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '14:00:00' AND finishing_hour = '16:00:00' AND DATE = '$todayplussix'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplussix','14:00:00','16:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdplussix);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 14:00 à 16:00.');</script>";
                }
            }
            break;
        case 'bouton47':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '16:00:00' AND finishing_hour = '18:00:00' and DATE = '$todayplussix'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 16:00 à 18:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '16:00:00' AND finishing_hour = '18:00:00' AND DATE = '$todayplussix'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplussix','16:00:00','18:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdplussix);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 16:00 à 18:00.');</script>";
                }
            }
            break;
        case 'bouton48':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '18:00:00' AND finishing_hour = '20:00:00' and DATE = '$todayplussix'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 18:00 à 20:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '18:00:00' AND finishing_hour = '20:00:00' AND DATE = '$todayplussix'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplussix','18:00:00','20:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdplussix);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 18:00 à 20:00.');</script>";
                }
            }
            break;
        case 'bouton49':
            // Vérifier le nombre de réservations dans la plage horaire 08:00-10:00
            $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE starting_hour = '20:00:00' AND finishing_hour = '22:00:00' and DATE = '$todayplussix'";
            $check_result = mysqli_query($conn, $check_sql);
            $check_row = mysqli_fetch_assoc($check_result);
            $num_reservations = $check_row['num_reservations'];

            if ($num_reservations >= 7) {
                // La plage horaire est complète
                echo "<script>alert(\"La plage horaire 20:00 à 22:00 est complète.\");</script>";
            } else {
                // Vérifier si l'utilisateur a déjà une réservation de 10h à 12h
                $check_sql = "SELECT COUNT(*) as num_reservations FROM reservation WHERE RFID = '$rfid' AND starting_hour = '20:00:00' AND finishing_hour = '22:00:00' AND DATE = '$todayplussix'";
                $check_result = mysqli_query($conn, $check_sql);
                $check_row = mysqli_fetch_assoc($check_result);
                $num_reservations = $check_row['num_reservations'];

                if ($num_reservations > 0) {
                    // L'utilisateur a déjà une réservation de 10h à 12h
                    echo "<script>alert(\"Vous avez déjà réservé pour cette heure.\");</script>";
                } else {
                    // Insérer la réservation dans la base de données
                    $sql = "INSERT INTO reservation (RFID, date, starting_hour, finishing_hour) VALUES ('$rfid','$todayplussix','20:00:00','22:00:00')";
                    mysqli_query($conn, $sql);

                    // Afficher le message de réussite dans le navigateur
                    $ajd_json = json_encode($ajdplussix);
                    echo "<script>var ajd = JSON.parse('$ajd_json'); alert('Vous avez réservé avec succès un créneau horaire le ' + ajd + ' de 20:00 à 22:00.');</script>";
                }
            }
            break;
        default:
            echo "Erreur : valeur inconnue.";
            break;
    }

    // Requête SQL à exécuter

}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="assets\img\parking.png">
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
            <a href="index.html"  class="sedeconnecter">Déconnexion</a>
    </header>
    <div class="titre">
    <p id="message"></p>
    <script>window.onload = function() {
  updateTime();
};

function updateTime() {
// Récupère la date actuelle
var date = new Date();

// Options pour formater la date en français
var options = { weekday: 'long', day: 'numeric', month: 'long' };

// Formate la date en chaîne de caractères en français
var dateString = date.toLocaleDateString('fr-FR', options);

// Récupère l'heure actuelle
var time = date.toLocaleTimeString();

// Affiche le message dans le paragraphe
document.getElementById("message").innerHTML = "Bonjour <?php echo $_SESSION['username'] ?>, nous sommes " + dateString + " et il est actuellement " + time + "";
}

// Appelle la fonction updateTime toutes les 1000 milliseconds (1 seconde)
setInterval(updateTime, 1000);
</script>
</div>
    </div>

    <table class="bjr">
        <tr>
            <th><?php echo $ajd;?></th>
            <th><?php echo $ajdplusun?></th>
            <th><?php echo $ajdplusdeux?></th>
            <th><?php echo $ajdplustrois?></th>
            <th><?php echo $ajdplusquatre?></th>
            <th><?php echo $ajdpluscinq?></th>
            <th><?php echo $ajdplussix?></th>
        </tr>
        <tr>                <form method="post">
            <td>
          
                <button name="submit" type="submit" value="bouton1">
                    08:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton8" >
                    08:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton15">
                    08:00
                </button>
            </td>
            <td><button name="submit" type="submit" value="bouton22">
                    08:00
                </button>
            </td>
            <td><button name="submit" type="submit" value="bouton29">
                    08:00
                </button>
            </td>
            <td><button name="submit" type="submit" value="bouton36">
                    08:00
                </button></td>
            <td><button name="submit" type="submit" value="bouton43">
                    08:00
                </button>
        </tr>
        <tr>            
            <td>
                <button name="submit" type="submit" value="bouton2">
                    10:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton9">
                    10:00
                </button>
            </td>
            <td><button name="submit" type="submit" value="bouton16">
                    10:00
                </button>
            </td>
            <td><button name="submit" type="submit" value="bouton23">
                    10:00
                </button></td>
            <td><button name="submit" type="submit" value="bouton30">
                    10:00
                </button></td>
            <td><button name="submit" type="submit" value="bouton37">
                    10:00
                </button></td>
            <td><button name="submit" type="submit" value="bouton44">
                    10:00
                </button></td>
        </tr>
        <tr>
            <td>
                <button name="submit" type="submit" value="bouton3" >
                    12:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton10">
                    12:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton17">
                    12:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton24">
                    12:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton31">
                    12:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton38">
                    12:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton45">
                    12:00
                </button>
            </td>
        </tr>
        <tr>
            <td>
                    <button name="submit" type="submit" value="bouton4">
                    14:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton11">
                    14:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton18">
                    14:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton25">
                    14:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton32">
                    14:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton39">
                    14:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton46">
                    14:00
                </button>
            </td>
        </tr>
        <tr>
            <td>
                <button name="submit" type="submit" value="bouton5">
                    16:00
                </button>
            </td>
            <td><button name="submit" type="submit" value="bouton12">
                    16:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton19">
                    16:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton26">
                    16:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton33">
                    16:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton40">
                    16:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton47">
                    16:00
                </button>
            </td>
        </tr>
        <tr>
            <td>
                <button name="submit" type="submit" value="bouton6" >
                    18:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton13">
                    18:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton20">
                    18:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton27">
                    18:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton34">
                    18:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton41">
                    18:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton48">
                    18:00
                </button>
            </td>
        </tr>
        <tr>         
            <td>
                <button name="submit" type="submit" value="bouton7" >
                    20:00
                </button>
            </td>
            <td><button name="submit" type="submit" value="bouton14">
                    20:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton21">
                    20:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton28">
                    20:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton35">
                    20:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton42">
                    20:00
                </button>
            </td>
            <td>
                <button name="submit" type="submit" value="bouton49">
                    20:00
                </button>
            </td>
            </form>
        </tr>
    </table>
</body>
<script src="assets\js\script.js"></script>
</html>