<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/lux/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Strona Pracownicy</title>
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
    <h1>Lista Pracowników</h1>
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

            $query = "UPDATE Pracownicy SET imie='$imie', nazwisko='$nazwisko', stanowisko='$stanowisko', ulica='$ulica', ulica_numer='$ulica_numer', kod_pocztowy='$kod_pocztowy', miasto='$miasto', telefon='$telefon' WHERE pracownik_id=$pracownik_id";

            if (mysqli_query($conn, $query)) {
                echo "Dane pracownika zostały zaktualizowane pomyślnie.";
            } else {
                echo "Błąd: " . mysqli_error($conn);
            }
        }

        $query = "SELECT * FROM Pracownicy";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Błąd zapytania: " . mysqli_error($conn));
        }

        echo "<table class='table table-bordered table-custom'>
        <tr>
        <th>Imię</th>
        <th>Nazwisko</th>
        <th>Stanowisko</th>
        <th>Ulica</th>
        <th>Numer ulicy</th>
        <th>Kod pocztowy</th>
        <th>Miasto</th>
        <th>Telefon</th>
        </tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td class='hidden'>" . $row['pracownik_id'] . "</td>";
            echo "<td>" . $row['imie'] . "</td>";
            echo "<td>" . $row['nazwisko'] . "</td>";
            echo "<td>" . $row['stanowisko'] . "</td>";
            echo "<td>" . $row['ulica'] . "</td>";
            echo "<td>" . $row['ulica_numer'] . "</td>";
            echo "<td>" . $row['kod_pocztowy'] . "</td>";
            echo "<td>" . $row['miasto'] . "</td>";
            echo "<td>" . $row['telefon'] . "</td>";
            echo "<td> <a href='edit_pracownik.php?id=" . $row['pracownik_id'] . "' class='btn btn-custom-edit'><i class='fas fa-edit'></i></a></td>";
            echo "<td> <a href='delete_pracownik.php?id=" . $row['pracownik_id'] . "' class='btn btn-custom-delete' onclick=\"return confirm('Czy na pewno chcesz usunąć tego pracownika?')\"><i class='fas fa-trash'></i></a></td>";

            echo "</tr>";
        }

        echo "</table>";

        mysqli_free_result($result);
        ?>
        
        <a href="dodaj_pracownika.php" class="btn btn-primary">Dodaj nowego pracownika</a>
    </div>
</body>
</html>