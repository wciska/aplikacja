<?php
require('conn.php');

if (isset($_GET['id'])) {
    $pracownik_id = $_GET['id'];

    $delete_related_records_query = "DELETE FROM Postep WHERE pracownik_id = $pracownik_id";
    
    if (mysqli_query($conn, $delete_related_records_query)) {
        $delete_pracownik_query = "DELETE FROM Pracownicy WHERE pracownik_id = $pracownik_id";

        if (mysqli_query($conn, $delete_pracownik_query)) {
            header("Location: pracownicy.php");
            exit();
        } else {
            echo "Błąd: " . mysqli_error($conn);
        }
    } else {
        echo "Błąd: " . mysqli_error($conn);
    }
} else {
    echo "Brak podanego ID pracownika do usunięcia.";
}

mysqli_close($conn);
?>