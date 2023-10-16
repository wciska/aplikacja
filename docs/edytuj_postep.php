<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/lux/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">
    <title>Edytuj Postęp</title>
</head>
<body>
    <header>
    <nav class="navbar navbar-expand-lg navbar-custom">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link text-white" href="pracownicy.php">Pracownicy</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="cele.php">Cele</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="ranking.php">Rankingi</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="postep.php">Postęp</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="konto.php">Moje Konto</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="glowna.php">Wyloguj się</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <?php
        require('conn.php');


        if (isset($_GET['postep_id'])) {
            $postep_id = $_GET['postep_id'];

            $query = "SELECT p.postep_id, CONCAT(pr.imie, ' ', pr.nazwisko) AS pracownik, p.postep_ilosc 
                      FROM Postep p
                      JOIN Pracownicy pr ON p.pracownik_id = pr.pracownik_id
                      WHERE p.postep_id = $postep_id";

            $result = mysqli_query($conn, $query);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $pracownik = $row['pracownik'];
                $postep_ilosc = $row['postep_ilosc'];
            } else {
                die("Błąd zapytania: " . mysqli_error($conn));
            }
        } else {
            header("Location: postep.php");
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nowa_ilosc_postepu = $_POST['postep_ilosc'];

            $update_query = "UPDATE Postep SET postep_ilosc = $nowa_ilosc_postepu WHERE postep_id = $postep_id";

            if (mysqli_query($conn, $query)) {
                echo '<div class="alert alert-success">Dane postępu zostały zaktualizowane pomyślnie.</div>';
                echo '<script>
                setTimeout(function(){
                window.location.href = "postep.php";
                }, 3000); // Przekieruj po 3 sekundach 
                </script>';
            } else {
                echo "Błąd podczas aktualizacji danych: " . mysqli_error($conn);
            }
        }
        ?>

        <h2>Edytuj Postęp</h2>
        <form method="post" action="">
            <label for="pracownik">Pracownik:</label>
            <input type="text" id="pracownik" name="pracownik" value="<?php echo $pracownik; ?>" disabled class="form-control input-medium">

            <label for="postep_ilosc">Nowa Ilość Postępu:</label>
            <input type="number" id="postep_ilosc" name="postep_ilosc" step="0.01" value="<?php echo $postep_ilosc; ?>" required class="form-control input-medium">

            <button type="submit" class="btn btn-primary" name="edytuj_postep">Zapisz zmiany</button>
            <a href="postep.php" class="btn btn-secondary">Anuluj</a>
        </form>

        
    </div>

</body>
</html>
