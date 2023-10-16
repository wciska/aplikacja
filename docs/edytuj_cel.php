

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/lux/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">
    <title>Edytuj Cel</title>
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

if (isset($_GET['id'])) {
    $cel_id = $_GET['id'];

    $query = "SELECT * FROM Cele WHERE cel_id = $cel_id";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Błąd zapytania: " . mysqli_error($conn));
    }

    $row = mysqli_fetch_assoc($result);

    if (isset($_POST['edytuj_cel'])) {
        $nazwa = $_POST["nazwa"];
        $cel_ilosc = $_POST["cel_ilosc"];

        $query = "UPDATE Cele SET nazwa = '$nazwa', cel_ilosc = $cel_ilosc WHERE cel_id = $cel_id";

        if (mysqli_query($conn, $query)) {
            echo '<div class="alert alert-success">Dane celu zostały zaktualizowane pomyślnie.</div>';
            echo '<script>
            setTimeout(function(){
            window.location.href = "cele.php";
            }, 3000); // Przekieruj po 3 sekundach (możesz dostosować czas oczekiwania)
            </script>';
        } else {
            echo "Błąd podczas aktualizacji celu: " . mysqli_error($conn);
        }
    }

    mysqli_free_result($result);

    mysqli_close($conn);
}
?>

        <div class="content">
            <h1>Edytuj Cel</h1>

            <form method="post" action="">
                <label for="nazwa">Nazwa Celu:</label>
                <input type="text" id="nazwa" name="nazwa" value="<?php echo $row['nazwa']; ?>" required class="form-control input-medium">
                <label for="cel_ilosc">Ilość Docelowa:</label>
                <input type="number" id="cel_ilosc" name="cel_ilosc" value="<?php echo $row['cel_ilosc']; ?>" required class="form-control input-short">
                <button type="submit" class="btn btn-primary" name="edytuj_cel">Zapisz zmiany</button>
                <button type="button" class="btn btn-secondary" onclick="window.location.href = 'cele.php';">Anuluj</button>
            </form>
        </div>
    </div>
</body>
</html>
