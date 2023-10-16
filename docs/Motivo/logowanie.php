<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/lux/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Strona Cele</title>
</head>
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
<body>
<div class="container">
    <div class="content">
        <div class="login-form">
            <h2>Logowanie</h2>
            <?php
            session_start();
            require_once('conn.php');

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $login = $_POST['login'];
                $haslo = $_POST['haslo'];

                // Zabezpiecz dane przed SQL Injection
                $login = mysqli_real_escape_string($conn, $login);
                $haslo = mysqli_real_escape_string($conn, $haslo);

                $query = "SELECT * FROM kierownicy WHERE login='$login' AND haslo=MD5('$haslo')";
                $result = $conn->query($query);

                if ($result->num_rows == 1) {
                    // czy uzytkownik istnieje
                    $_SESSION['login'] = $login;
                    header("Location: pracownicy.php"); 
                } else {
                    echo '<div class="alert alert-danger">Błąd logowania. Spróbuj ponownie.</div>';
                }

                $conn->close();
            }
            ?>
            <form method="post">
                <label for="login">Login:</label>
                <input type="text" id="login" name="login" required class="form-control input-medium">

                <label for="haslo">Hasło:</label>
                <input type="password" id="haslo" name="haslo" required class="form-control input-medium">

                <button type="submit" class="btn btn-primary" name="login_button">Zaloguj</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
