<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/lux/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">
    <title>Strona Cele</title>
</head>
<body>
    <header>
    <nav class="navbar navbar-expand-lg navbar-custom">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link text-white" href="glowna.php">Strona Główna</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="pracownik_cele.php">Cele</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="pracownik_ranking.php">Rankingi</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="logowanie.php">Zaloguj się</a></li>
            </ul>
        </nav>
    </header>
    
    <div class="container">
        <h1>Ranking</h1>
        <form method="post" action="">
    <div class="form-group">
        <label for="cel">Wybierz cel:</label>
    </div>
    <div class="form-group">
        <select name="cel" required id="cel" class="custom-select input-medium">
            <option value="" disabled selected>Wybierz cel:</option> 
                <?php
                require('conn.php');

                $query = "SELECT nazwa FROM Cele";
                $result = mysqli_query($conn, $query);

                if (!$result) {
                    die("Błąd zapytania: " . mysqli_error($conn));
                }

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['nazwa'] . "'>" . $row['nazwa'] . "</option>";
                }

                mysqli_free_result($result);
                mysqli_close($conn);
                ?>
            </select>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="submit" value="Sprawdź Postęp">
    </div>
</form>

        <?php
        if (isset($_POST['submit'])) {
            $selectedGoal = $_POST['cel'];

            echo "<h2>$selectedGoal</h2>";

            require('conn.php');

            $query = "SELECT Pracownicy.imie, Pracownicy.nazwisko, Postep.postep_ilosc
                      FROM Pracownicy
                      LEFT JOIN Postep ON Pracownicy.pracownik_id = Postep.pracownik_id
                      LEFT JOIN Cele ON Postep.cel_id = Cele.cel_id
                      WHERE Cele.nazwa = '$selectedGoal'
                      ORDER BY Postep.postep_ilosc DESC";

            $result = mysqli_query($conn, $query);

            if (!$result) {
                die("Błąd zapytania: " . mysqli_error($conn));
            }

            echo "<table class='table table-bordered table-custom'>
            <tr>
            <th>Miejsce</th>
            <th>Imię</th>
            <th>Nazwisko</th>
            <th>Postęp</th>
            </tr>";

            $position = 1; // licznik pozycji

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $position . "</td>"; // Wyświetl liczbę porządkową
                echo "<td>" . $row['imie'] . "</td>";
                echo "<td>" . $row['nazwisko'] . "</td>";
                echo "<td>" . $row['postep_ilosc'] . "</td>";
                echo "</tr>";

                $position++; // Zwiększ licznik pozycji
            }

            echo "</table>";

            mysqli_free_result($result);
            mysqli_close($conn);
        }
        ?>
    </div>

</body>
</html>