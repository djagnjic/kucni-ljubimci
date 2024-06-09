<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST['title'];
    $about = $_POST['about'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $archive = isset($_POST['archive']) ? 1 : 0;
    $date = date('d.m.Y.');


    $image = '';
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $image = basename($_FILES["photo"]["name"]);
        $target_dir = "uploads/";
        $target_file = $target_dir . $image;

        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) { //Ako je uspio upload, umetni zapise

            $query = "INSERT INTO vijest (datum, naslov, sazetak, tekst, slika, kategorija,
                arhiva ) VALUES ('$date', '$title', '$about', '$content', '$image',
                '$category', '$archive')";

            $result = mysqli_query($dbc, $query) or die('Error querying databese.');
            mysqli_close($dbc);
            header("Location: administracija.php");
        } else {
            echo "<p>Došlo je do pogreške prilikom upload-a slike.</p>";
        }
    } else {
        echo "<p>Datoteka nije slika ili je došlo do pogreške.</p>";
    }
}
