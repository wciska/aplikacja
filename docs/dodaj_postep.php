<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj Postęp</title>
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
            <h1>Dodaj nowy postęp</h1>

            <form method="post" action="" >
            <div class="form-group">
                <label for="pracownik_id">Pracownik:</label>
            </div>
    <div class="form-group">
        <select id="pracownik_id" name="pracownik_id" required class="custom-select input-medium">
        <option value="" disabled selected>Wybierz Pracownika:</option> <!-- Zablokowanie domyślnej opji -->
    </div>
    <?php
    require('conn.php');

    $query_pracownicy = "SELECT * FROM Pracownicy";
    $result_pracownicy = mysqli_query($conn, $query_pracownicy);

    if ($result_pracownicy) {
        while ($row_pracownik = mysqli_fetch_assoc($result_pracownicy)) {
            $imie = $row_pracownik['imie'];
            $nazwisko = $row_pracownik['nazwisko'];
            $pelne_imie_nazwisko = $imie . ' ' . $nazwisko;
            echo "<option value='" . $row_pracownik['pracownik_id'] . "'>" . $pelne_imie_nazwisko . "</option>";
        }
    }

    mysqli_free_result($result_pracownicy);
    mysqli_close($conn);
    ?>
        </select>
                <div class="form-group">
                <label for="cel_id">Cel:</label>
                </div>
                <div class="form-group">
                <select id="cel_id" name="cel_id" required class="custom-select input-medium">
                <option value="" disabled selected>Wybierz Cel:</option> <!-- Zablokowanie domyślnej opji -->
                </div>
                    <?php
                    require('conn.php');

                    $query_cele = "SELECT * FROM Cele";
                    $result_cele = mysqli_query($conn, $query_cele);

                    if ($result_cele) {
                        while ($row_cel = mysqli_fetch_assoc($result_cele)) {
                            echo "<option value='" . $row_cel['cel_id'] . "'>" . $row_cel['nazwa'] . "</option>";
                        }
                    }
                    ?>
                </select>
                <div class="form-group">
                <label for="postep_ilosc">Ilość Postępu:</label>
                <input type="number" id="postep_ilosc" name="postep_ilosc" step="0.01" required class="form-control input-short">
                </div>

                <button type="submit" name="dodaj_postep" class="btn btn-primary">Dodaj Postęp</button>
                <button type="button" onclick="window.location.href = 'postep.php';" class="btn btn-secondary">Anuluj</button>
            </form>

            <?php
            if (isset($_POST['dodaj_postep'])) {
                $pracownik_id = $_POST['pracownik_id'];
                $cel_id = $_POST['cel_id'];
                $postep_ilosc = $_POST['postep_ilosc'];


                require('conn.php');
                // Sprawdzenie, czy taki wpis już istnieje
                $query_check = "SELECT * FROM Postep WHERE pracownik_id = $pracownik_id AND cel_id = $cel_id";

                $result_check = mysqli_query($conn, $query_check);

                if (mysqli_num_rows($result_check) > 0) {
                    echo "Nie dodano nowego rekordu, ponieważ taki wpis już istnieje. Możesz go zaktualizować.";
                } else {
                $query_insert = "INSERT INTO Postep (pracownik_id, cel_id, postep_ilosc) VALUES (?, ?, ?)";
                $stmt = mysqli_prepare($conn, $query_insert);

                if ($stmt === false) {
                    die("Błąd przy przygotowywaniu zapytania: " . mysqli_error($conn));
                }

                mysqli_stmt_bind_param($stmt, 'iii', $pracownik_id, $cel_id, $postep_ilosc);

                $result = mysqli_stmt_execute($stmt);

                if ($result) {
                    echo "Postęp został dodany pomyślnie.";
                    header("Location: postep.php");
                } else {
                    echo "Błąd podczas dodawania postępu: " . mysqli_error($conn);
                }

                mysqli_stmt_close($stmt);
            }
                mysqli_close($conn);
            }
            ?>
        </div>
    </div>
</body>
</html>
