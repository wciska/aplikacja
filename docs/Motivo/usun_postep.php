<?php
require('conn.php');

if (isset($_GET['id'])) {
    $postep_id = $_GET['id'];

    $query = "DELETE FROM Postep WHERE postep_id = $postep_id";

    if (mysqli_query($conn, $query)) {
        header("Location: postep.php");
        exit();
    } else {
        echo "Błąd: " . mysqli_error($conn);
    }
} else {
    echo "Brak podanego ID postępu do usunięcia.";
}

mysqli_close($conn);
?>