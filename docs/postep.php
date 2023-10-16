<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/lux/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Postęp</title>
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
        <h1>Lista Postępów</h1>

        <form method="post" action="postep.php">
        <div class="form-group">
            <label for="wybierz_cel">Wybierz Cel:</label>
</div>
<div class="form-group">
            <select id="wybierz_cel" name="wybierz_cel" required class="custom-select input-medium">
    <option value="" disabled selected>Wybierz Cel:</option> 
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

            <button type="submit" class="btn btn-primary" name="submit">Wybierz Cel</button>
            <a href="dodaj_postep.php" class="btn btn-primary">Dodaj nowy postęp</a>
</div>
        </form>

        <?php
        if (isset($_POST['wybierz_cel'])) {
            $wybrany_cel_id = $_POST['wybierz_cel'];
            require('conn.php');

            $query = "SELECT p.postep_id, CONCAT(pr.imie, ' ', pr.nazwisko) AS pracownik, p.postep_ilosc 
                      FROM Postep p
                      JOIN Pracownicy pr ON p.pracownik_id = pr.pracownik_id
                      WHERE p.cel_id = $wybrany_cel_id";

            $result = mysqli_query($conn, $query);

            if (!$result) {
                die("Błąd zapytania: " . mysqli_error($conn));
            }

            echo "<table class='table table-bordered table-custom'>
            <tr>
            <th>Pracownik</th>
            <th>Postęp</th>
            <th>Akcje</th>
            </tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td class='hidden'>" . $row['postep_id'] . "</td>";
                echo "<td>" . $row['pracownik'] . "</td>";
                echo "<td>" . $row['postep_ilosc'] . "</td>";
                echo "<td><a href='edytuj_postep.php?postep_id=" . $row['postep_id'] . "'class='btn btn-custom-edit'><i class='fas fa-edit'></i></a></td>";
                echo "<td><a href='usun_postep.php?id=" . $row['postep_id'] . "' class='btn btn-custom-delete' onclick=\"return confirm('Czy na pewno chcesz usunąć ten postęp?')\"><i class='fas fa-trash'></i></a></td>";
                
                echo "</tr>";
            }

            echo "</table>";

            mysqli_free_result($result);

            mysqli_close($conn);
        }
        ?>
        
    </div>
</body>
</html>
