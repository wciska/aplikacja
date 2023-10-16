<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona Cele</title>
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

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_pracownik_id'])) {
            $pracownik_id = $_POST['edit_pracownik_id'];
            $imie = $_POST['imie'];
            $nazwisko = $_POST['nazwisko'];
            $stanowisko = $_POST['stanowisko'];
            $ulica = $_POST['ulica'];
            $ulica_numer = $_POST['ulica_numer'];
            $kod_pocztowy = $_POST['kod_pocztowy'];
            $miasto = $_POST['miasto'];
            $telefon = $_POST['telefon'];

            if (strlen($imie) < 2) {
                $errors[] = "Imię jest za krótkie (minimum 2 znaki).";
            }
            if (strlen($nazwisko) < 2) {
                $errors[] = "Nazwisko jest za krótkie (minimum 2 znaki).";
            }

            if (!preg_match('/^\d{2}-\d{3}$/', $kod_pocztowy)) {
                $errors[] = "Nieprawidłowy format kodu pocztowego (np. 00-000).";
            }

            if (!preg_match('/^\d{9,11}$/', $telefon)) {
                $errors[] = "Nieprawidłowy numer telefonu (9-11 cyfr).";
            }
            
            if (empty($errors)) {
                $query = "UPDATE Pracownicy SET imie='$imie', nazwisko='$nazwisko', stanowisko='$stanowisko', ulica='$ulica', ulica_numer='$ulica_numer', kod_pocztowy='$kod_pocztowy', miasto='$miasto', telefon='$telefon' WHERE pracownik_id=$pracownik_id";

                if (mysqli_query($conn, $query)) {
                    echo '<div class="alert alert-success">Dane pracownika zostały zaktualizowane pomyślnie.</div>';
                    echo '<script>
                    setTimeout(function(){
                    window.location.href = "pracownicy.php";
                    }, 3000); // Przekieruj po 3 sekundach 
                    </script>';
                } else {
                    echo "Błąd podczas aktualizowania pracownika: " . mysqli_error($conn);
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
        }

        if (isset($_GET['id'])) {
            $pracownik_id = $_GET['id'];
            $query = "SELECT * FROM Pracownicy WHERE pracownik_id = $pracownik_id";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                die("Błąd zapytania: " . mysqli_error($conn));
            }

            $row = mysqli_fetch_assoc($result);

            if ($row) {
                $imie = $row['imie'];
                $nazwisko = $row['nazwisko'];
                $stanowisko = $row['stanowisko'];
                $ulica = $row['ulica'];
                $ulica_numer = $row['ulica_numer'];
                $kod_pocztowy = $row['kod_pocztowy'];
                $miasto = $row['miasto'];
                $telefon = $row['telefon'];
            } else {
                echo "Nie znaleziono pracownika o podanym ID.";
            }
        } else {
            echo "Brak podanego ID pracownika do edycji.";
        }

        mysqli_free_result($result);
        ?>
        <h2>Edytuj pracownika</h2>
            <form method="POST" action="" class="form-container">
                
                <input type="hidden" name="edit_pracownik_id" value="<?php echo $pracownik_id; ?>">
                <div class="form-column">
                    <label for="imie">Imię:</label>
                    <input type="text" name="imie" value="<?php echo $imie; ?>" required class="form-control"><br>

                    <label for="nazwisko">Nazwisko:</label>
                    <input type="text" name="nazwisko" value="<?php echo $nazwisko; ?>" required class="form-control"><br>

                    <label for="stanowisko">Stanowisko:</label>
                    <input type="text" name="stanowisko" value="<?php echo $stanowisko; ?>" required class="form-control"><br>

                    <label for="ulica">Ulica:</label>
                    <input type="text" name="ulica" value="<?php echo $ulica; ?>" required class="form-control"><br>
                </div>

                <div class="form-column">
                    <label for="ulica_numer">Numer ulicy:</label>
                    <input type="text" name="ulica_numer" value="<?php echo $ulica_numer; ?>" required class="form-control"><br>

                    <label for="kod_pocztowy">Kod pocztowy:</label>
                    <input type="text" name="kod_pocztowy" value="<?php echo $kod_pocztowy; ?>" required class="form-control"><br>

                    <label for="miasto">Miasto:</label>
                    <input type="text" name="miasto" value="<?php echo $miasto; ?>" required class="form-control"><br>

                    <label for="telefon">Telefon:</label>
                    <input type="text" name="telefon" value="<?php echo $telefon; ?>" required class="form-control"><br>
                </div>
                <input type="submit" class="btn btn-primary" value="Zaktualizuj pracownika">
                <button type="button" class="btn btn-secondary" onclick="window.location.href = 'pracownicy.php';">Anuluj</button>
            </form>
        

        <?php
        mysqli_close($conn);
        ?>
    </div>
</body>
</html>
