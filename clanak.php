<?php
include 'connect.php';
?>

<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ljubimci - Članak</title>
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

    <?php
    $query = "SELECT * FROM vijest WHERE id = ?";
    $uppath = "uploads/";

    $stmt = $dbc->prepare($query);
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $datum, $naslov, $sazetak, $tekst, $slika, $kategorija, $arhiva);
    $stmt->fetch();
    ?>

    <main>
        <section role="main">

            <div class="row">
                <h2 class="category"><?php
                                        echo "<span>" . ucfirst($kategorija) . "</span>";
                                        ?></h2>
                <h1 class="title"><?php
                                    echo $naslov;
                                    ?></h1>
                <p>OBJAVLJENO: <?php
                                echo "<span>" . $datum . "</span>";
                                ?></p>
            </div>

            <section class="slika">
                <?php
                echo '<img src="' . $uppath . $slika . '">';
                ?>
            </section>

            <section class="about">
                <p>
                    <?php
                    echo "<i>" . $sazetak . "</i>";
                    ?>
                </p>
            </section>

            <section class="sadrzaj">
                <p><?php echo nl2br($tekst); ?></p>
            </section>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Davor Jagnjić | Kontakt: djagnjic@tvz.hr |  <a href="login.php" style="color: white;">Login</a> |
         <a href="logout.php" style="color: white;">Logout</a></p>
    </footer>
</body>

</html>