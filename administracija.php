<?php
session_start();
include 'connect.php';

function fetchArticles($dbc)
{
    $query = "SELECT * FROM vijest";
    $result = mysqli_query($dbc, $query);
    return $result;
}

if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $query = "DELETE FROM vijest WHERE id = $id";
    mysqli_query($dbc, $query);
}

$uspjesnaPrijava = false;
define('UPLPATH', 'uploads/');

if (isset($_POST['submit'])) {


    $prijavaImeKorisnika = $_POST['username'];
    $prijavaLozinkaKorisnika = $_POST['password'];
    $sql = "SELECT korisnicko_ime, lozinka, razina FROM korisnik WHERE korisnicko_ime = ?";
    $stmt = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $prijavaImeKorisnika);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        mysqli_stmt_bind_result($stmt, $imeKorisnika, $lozinkaKorisnika, $levelKorisnika);
        mysqli_stmt_fetch($stmt);
    }

    if (password_verify($_POST['password'], $lozinkaKorisnika) && mysqli_stmt_num_rows($stmt) > 0) {
        $uspjesnaPrijava = true;
        // Provjera da li je admin
        if ($levelKorisnika == 1) {
            $admin = true;
        } else {
            $admin = false;
        }
        // postavljanje session varijabli
        $_SESSION['username'] = $imeKorisnika;
        $_SESSION['level'] = $levelKorisnika;
    } else {
        $_SESSION['username'] = null;
        $_SESSION['level'] = null;
        $uspjesnaPrijava = false;
    }

    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8">
    <title>Kućni Ljubimci - Administracija</title>
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <header>
        <h1>Kućni Ljubimci</h1>
        <nav>
            <ul>
                <li><a href="index.php">Početna</a></li>
                <li><a href="kategorija.php?id=ljubimci">Ljubimci</a></li>
                <li><a href="kategorija.php?id=savjeti">Savjeti</a></li>
                <li><a href="kategorija.php?id=iskustva">Priče i iskustva</a></li>
                <li><a href="administracija.php">Administracija</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <?php
        if (($uspjesnaPrijava == true && $admin == true) ||
            (isset($_SESSION['username']) && $_SESSION['level'] == 1)
        ) {

            echo '<button class="unos-vijesti-btn" onclick="window.location.href=\'unos.php\'">Unos Nove Vijesti</button>';
            echo '<section class="ljubimci">';
            echo '<h2>Pregled svih vijesti</h2>';
            echo '<div class="ljubimci-container">';
            $articles = fetchArticles($dbc);
            while ($row = mysqli_fetch_array($articles)) {
                echo '<article>';
                echo '<div class="article">';
                echo '<div class="ljubimci_img">';
                echo '<img src="' . UPLPATH . $row['slika'] . '" alt="' . $row['naslov'] . '">';
                echo '</div>';
                echo '<div class="media_body">';
                echo '<h4 class="title">';
                echo '<a href="clanak.php?id=' . $row['id'] . '">';
                echo $row['naslov'];
                echo '</a></h4>';
                echo '<p class="sazetak">' . $row['sazetak'] . '</p>';
                echo '<div class="buttons">';
                echo '<button class="edit-btn" onclick="window.location.href=\'izmjena.php?id=' . $row['id'] . '\'">Izmijeni</button>';
                echo '<button class="delete-btn" onclick="confirmDelete(' . $row['id'] . ')">Izbriši</button>';
                echo '</div>';
                echo '</div></div>';
                echo '</article>';
            }
            echo '</div>';
            echo '</section>';
        } else if ($uspjesnaPrijava == true && $admin == false) {
            echo '<p>Bok ' . $imeKorisnika . '! Uspješno ste prijavljeni, ali niste administrator.</p>';
        } else if (isset($_SESSION['username']) && $_SESSION['level'] == 0) {
            echo '<p>Bok ' . $_SESSION['username'] . '! Uspješno ste prijavljeni, ali niste administrator.</p>';
        } else if ($uspjesnaPrijava == false) {
            echo "Korisnik ne postoji. <a href='registracija.php'>Registrirajte se ovdje.</a>";
            echo "<br>ili se <a href='login.php'>ponovno prijavite.</a>";
        }
        ?>
    </main>

    <footer>
        <p>&copy; 2024 Davor Jagnjić | Kontakt: djagnjic@tvz.hr |  <a href="login.php" style="color: white;">Login</a> |
         <a href="logout.php" style="color: white;">Logout</a></p>
    </footer>

    <script>
        function confirmDelete(id) {
            if (confirm('Jeste li sigurni da želite obrisati vijest?')) {
                window.location.href = 'administracija.php?delete_id=' + id;
            }
        }
    </script>
</body>

</html>