<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona Cele</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/lux/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
            <h1>Lista Celów</h1>

            <?php
            require('conn.php');

            $query = "SELECT * FROM Cele";

            $result = mysqli_query($conn, $query);

            if (!$result) {
                die("Błąd zapytania: " . mysqli_error($conn));
            }

            echo "<table class='table table-bordered table-custom'>
            <tr>
            <th>Nazwa</th>
            <th>Ilość docelowa</th>
            </tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td class='hidden'>". $row['cel_id'] . "</td>";
                echo "<td>" . $row['nazwa'] . "</td>";
                echo "<td>" . $row['cel_ilosc'] . "</td>";
                echo "<td><a href='edytuj_cel.php?id=" . $row['cel_id'] . "'class='btn btn-custom-edit'><i class='fas fa-edit'></i></a></td>";
                echo "<td><a href='usun_cel.php?id=" . $row['cel_id'] . "' class='btn btn-custom-delete' onclick=\"return confirm('Czy na pewno chcesz usunąć ten cel?')\"><i class='fas fa-trash'></i></a></td>";
                echo "</tr>";
            }

            echo "</table>";

            mysqli_free_result($result);

            mysqli_close($conn);
            ?>

            <a href="dodaj_cel.php" class="btn btn-primary">Dodaj nowy cel</a>
        </div>
    </div>
</body>
</html>
