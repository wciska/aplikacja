<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj Pracownika</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/lux/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
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

        $errors = [];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $imie = $_POST["imie"];
            $nazwisko = $_POST["nazwisko"];
            $stanowisko = $_POST["stanowisko"];
            $ulica = $_POST["ulica"];
            $ulica_numer = $_POST["ulica_numer"];
            $kod_pocztowy = $_POST["kod_pocztowy"];
            $miasto = $_POST["miasto"];
            $telefon = $_POST["telefon"];

            // Walidacja imienia i nazwiska - co najmniej 2 znaki
            if (strlen($imie) < 2) {
                $errors[] = "Imię jest za krótkie (minimum 2 znaki).";
            }
            if (strlen($nazwisko) < 2) {
                $errors[] = "Nazwisko jest za krótkie (minimum 2 znaki).";
            }

            // Walidacja kodu pocztowego - format XX-XXX
            if (!preg_match('/^\d{2}-\d{3}$/', $kod_pocztowy)) {
                $errors[] = "Nieprawidłowy format kodu pocztowego (np. 00-000).";
            }

            // Walidacja numeru telefonu -  musi zawierać tylko cyfry i mieć 9 lub 11 znaków
            if (!preg_match('/^\d{9,11}$/', $telefon)) {
                $errors[] = "Nieprawidłowy numer telefonu (9-11 cyfr).";
            }

            if (empty($errors)) {
                $query = "INSERT INTO Pracownicy (imie, nazwisko, stanowisko, ulica, ulica_numer, kod_pocztowy, miasto, telefon) 
                          VALUES ('$imie', '$nazwisko', '$stanowisko', '$ulica', '$ulica_numer', '$kod_pocztowy', '$miasto', '$telefon')";

                if (mysqli_query($conn, $query)) {
                    echo "Nowy pracownik został dodany pomyślnie.";
                    header("Location: pracownicy.php");
                    exit;
                } else {
                    echo "Błąd podczas dodawania pracownika: " . mysqli_error($conn);
                }
            } else {
                echo '<div class="alert alert-danger">Proszę popraw następujące błędy:';
                echo "<ul>";
                foreach ($errors as $error) {
                    echo "<li>$error</li>";
                }
                echo "</ul>";
                echo '</div>';
            }

            mysqli_close($conn);
        }
        ?>

    <div class="content">
        <h2>Dodaj nowego pracownika</h2>
        <form method="POST" action="dodaj_pracownika.php" class="form-container">
            <div class="form-column">
                <label for="imie">Imię:</label>
                <input type="text" name="imie" required class="form-control"><br>

                <label for="nazwisko">Nazwisko:</label>
                <input type="text" name="nazwisko" required class="form-control"><br>

                <label for="stanowisko">Stanowisko:</label>
                <input type="text" name="stanowisko" required class="form-control"><br>

                <label for="ulica">Ulica:</label>
                <input type="text" name="ulica" required class="form-control"><br>
            </div>

            <div class="form-column">
                <label for="ulica_numer">Numer ulicy:</label>
                <input type="text" name="ulica_numer" required class="form-control"><br>

                <label for="kod_pocztowy">Kod pocztowy:</label>
                <input type="text" name="kod_pocztowy" required class="form-control"><br>

                <label for="miasto">Miasto:</label>
                <input type="text" name="miasto" required class="form-control"><br>

                <label for="telefon">Telefon:</label>
                <input type="text" name="telefon" required class="form-control"><br>
            </div>

            <input type="submit" value="Dodaj pracownika" class="btn btn-primary">
            <button type="button" onclick="window.location.href = 'pracownicy.php';" class="btn btn-secondary">Anuluj</button>
        </form>
    </div>
    </div>
</body>
</html>
