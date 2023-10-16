<!DOCTYPE html>
<html>
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
                <li class="nav-item"><a class="nav-link text-white" href="glowna.php">Strona Główna</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="pracownik_cele.php">Cele</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="pracownik_ranking.php">Rankingi</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="logowanie.php">Zaloguj się</a></li>
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
                echo "</tr>";
            }

            echo "</table>";

            mysqli_free_result($result);

            mysqli_close($conn);
            ?>
        </div>
    </div>
</body>
</html>
