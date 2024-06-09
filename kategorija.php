<?php
include 'connect.php';
?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kućni Ljubimci - Kategorija</title>
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
        <section class="ljubimci">
            <?php $kategorija = $_GET['id']; ?>
            <h2><?php echo $kategorija; ?></h2>

            <div class="ljubimci-container">
                <?php
                $query = "SELECT * FROM vijest WHERE arhiva=0 AND kategorija='$kategorija'";
                $result = mysqli_query($dbc, $query);
                $uppath = "uploads/";

                while ($row = mysqli_fetch_array($result)) {
                    echo '<article>';
                    echo '<div class="article">';
                    echo '<div class="ljubimci_img">';
                    echo '<img src="' . $uppath . $row['slika'] . '" alt="' . $row['naslov'] . '">';
                    echo '</div>';
                    echo '<div class="media_body">';
                    echo '<h4 class="title">';
                    echo '<a href="clanak.php?id=' . $row['id'] . '">';
                    echo $row['naslov'];
                    echo '</a></h4>';
                    echo '<p class="sazetak">' . $row['sazetak'] . '</p>';
                    echo '</div></div>';
                    echo '</article>';
                }
                ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Davor Jagnjić | Kontakt: djagnjic@tvz.hr |  <a href="login.php" style="color: white;">Login</a> |
         <a href="logout.php" style="color: white;">Logout</a></p>
    </footer>
</body>

</html>