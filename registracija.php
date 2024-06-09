<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8">
    <title>Registracija</title>
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
                <li><a href="login.php">Administracija</a></li>
            </ul>
        </nav>
    </header>
    <main class="registration-body">
        <section class="registration-section">
            <h2>Registracija</h2>
            <form action="registracija.php" method="post" class="registration-form">
                <label for="ime">Ime:</label>
                <input type="text" id="ime" name="ime" required>

                <label for="prezime">Prezime:</label>
                <input type="text" id="prezime" name="prezime" required>

                <label for="korisnicko_ime">Korisničko ime:</label>
                <input type="text" id="korisnicko_ime" name="korisnicko_ime" required>

                <label for="lozinka">Lozinka:</label>
                <input type="password" id="lozinka" name="lozinka" required>

                <label for="ponovljena_lozinka">Ponovite lozinku:</label>
                <input type="password" id="ponovljena_lozinka" name="ponovljena_lozinka" required>

                <button type="submit" name="submit">Registracija</button>
            </form>
        </section>


        <?php

        if (isset($_POST['submit'])) {
            include 'connect.php';

            $ime = $_POST['ime'];
            $prezime = $_POST['prezime'];
            $korisnicko_ime = $_POST['korisnicko_ime'];
            $lozinka = $_POST['lozinka'];
            $ponovljena_lozinka = $_POST['ponovljena_lozinka'];

            $query = "SELECT * FROM korisnik WHERE korisnicko_ime = ?";
            $stmt = mysqli_prepare($dbc, $query);
            mysqli_stmt_bind_param($stmt, 's', $korisnicko_ime);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) > 0) {
                echo "<p style='color: red;'>Korisničko ime već postoji. Pokušajte ponovno s drugim korisničkim imenom.</p>";
            } else {
                if ($lozinka === $ponovljena_lozinka) {
                    $hash_lozinka = password_hash($lozinka, CRYPT_BLOWFISH);

                    $query = "INSERT INTO korisnik (ime, prezime, korisnicko_ime, lozinka, razina) VALUES (?, ?, ?, ?, 0)";
                    $stmt = mysqli_prepare($dbc, $query);
                    mysqli_stmt_bind_param($stmt, 'ssss', $ime, $prezime, $korisnicko_ime, $hash_lozinka);
                    mysqli_stmt_execute($stmt);

                    if (mysqli_stmt_affected_rows($stmt) > 0) {
                        echo "<br><p style='color: green;'>Registracija uspješna. <a href='login.php'>Prijavite se ovdje.</a></p>";
                    } else {
                        echo "<p style='color: red;'>Greška pri registraciji. Pokušajte ponovno.</p>";
                    }
                } else {
                    echo "<p style='color: red;'>Lozinke se ne podudaraju.</p>";
                }
            }

            mysqli_stmt_close($stmt);
            mysqli_close($dbc);
        }
        ?>
    </main>
    <footer>
        <p>&copy; 2024 Davor Jagnjić | Kontakt: djagnjic@tvz.hr |  <a href="login.php" style="color: white;">Login</a> |
         <a href="logout.php" style="color: white;">Logout</a></p>
    </footer>
</body>

</html>