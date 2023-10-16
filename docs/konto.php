
<!DOCTYPE html>
<html>
<head>
    <title>Zmiana hasła</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/lux/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

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
<body>
<div class="container">

<?php
session_start();


if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

require_once('conn.php');

$login = $_SESSION['login'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stare_haslo = $_POST['stare_haslo'];
    $nowe_haslo = $_POST['nowe_haslo'];

    // Zabezpiecz dane przed SQL Injection
    $stare_haslo = mysqli_real_escape_string($conn, $stare_haslo);
    $nowe_haslo = mysqli_real_escape_string($conn, $nowe_haslo);

    //  czy stare hasło jest poprawne
    $query = "SELECT * FROM kierownicy WHERE login='$login' AND haslo=MD5('$stare_haslo')";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        //  aktualizuj hasło w bazie danych
        $query = "UPDATE kierownicy SET haslo=MD5('$nowe_haslo') WHERE login='$login'";
        
        if ($conn->query($query) === TRUE) {
            echo '<div class="alert alert-success">Pomyślnie zmieniono hasło.</div>';
        } else {
            echo "Błąd aktualizacji hasła: " . $conn->error;
        }
    } else {
        echo '<div class="alert alert-danger">Stare hasło jest nieprawidłowe.</div>';
    }
}

$conn->close();
?>

    <h2>Zmiana hasła</h2>
    <form method="POST" action="konto.php">
        Stare hasło: <input type="password" name="stare_haslo" required class="form-control input-medium"><br>
        Nowe hasło: <input type="password" name="nowe_haslo" required class="form-control input-medium"><br>
        <input type="submit" value="Zmień hasło" class="btn btn-primary"><br>
        <a href="pracownicy.php" class="btn btn-secondary">Anuluj</a>
    </form>
</div>
</body>
</html>