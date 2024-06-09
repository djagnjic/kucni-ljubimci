<?php
    include 'connect.php';

    $title = $_POST['title'];
    $about = $_POST['about'];
    $id = $_POST['id'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $archive = isset($_POST['archive']) ? 1 : 0;
    $image = basename($_FILES["photo"]["name"]);

    if(empty($image)){
        $query = "UPDATE vijest SET naslov='$title', sazetak='$about', tekst='$content', kategorija='$category', arhiva='$archive' WHERE id=$id ";
    } else {
        $target_dir = "uploads/";
        $target_file = $target_dir . $image;
        move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
        $query = "UPDATE vijest SET naslov='$title', sazetak='$about', tekst='$content', slika='$image', kategorija='$category', arhiva='$archive' WHERE id=$id ";
    }

    $result = mysqli_query($dbc, $query);
    header("Location: administracija.php");
?>