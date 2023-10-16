<?php
require('conn.php');

if (isset($_GET['id'])) {
    $cel_id = $_GET['id'];

    // Usuń powiązane rekordy
    $query_delete_progress = "DELETE FROM Postep WHERE cel_id = $cel_id";

    if (mysqli_query($conn, $query_delete_progress)) {
        $query_delete_cel = "DELETE FROM Cele WHERE cel_id = $cel_id";

        if (mysqli_query($conn, $query_delete_cel)) {
            echo "Cel został usunięty pomyślnie wraz z powiązanymi rekordami w tabeli Postęp.";
            header("Location:cele.php");
        } else {
            echo "Błąd podczas usuwania celu: " . mysqli_error($conn);
        }
    } else {
        echo "Błąd podczas usuwania rekordów w tabeli Postęp: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>