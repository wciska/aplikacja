<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj Cel</title>
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
        <div class="content">
            <h1>Dodaj nowy cel</h1>

            <!-- Formularz do dodawania celu -->
            <form method="post" action="" >
                <label for="nazwa">Nazwa Celu:</label>
                <input type="text" id="nazwa" name="nazwa" required class="form-control input-medium">
                <label for="cel_ilosc">Ilość Docelowa:</label>
                <input type="number" id="cel_ilosc" name="cel_ilosc" required class="form-control input-short">
                <button type="submit" name="dodaj_cel" class="btn btn-primary">Dodaj Cel</button>
                <button type="button" onclick="window.location.href = 'cele.php';" class="btn btn-secondary">Anuluj</button>
            </form>

            <?php
            require('conn.php');

            // Obsługa formularza dodawania celu
            if (isset($_POST['dodaj_cel'])) {
                $nazwa = $_POST["nazwa"];
                $cel_ilosc = $_POST["cel_ilosc"];

                $query = "INSERT INTO Cele (nazwa, cel_ilosc) VALUES ('$nazwa', $cel_ilosc)";

                if (mysqli_query($conn, $query)) {
                    echo "Dodano nowy cel pomyślnie.";
                    header("Location: cele.php");
                } else {
                    echo "Błąd podczas dodawania celu: " . mysqli_error($conn);
                }
            }

            mysqli_close($conn);
            ?>
        </div>
    </div>
</body>
</html>
