<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
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

    <main class="login-body">


        <section class="login-section">
            <h2>Prijava</h2>
            <form action="administracija.php" method="post" class="login-form">
                <label for="username">Korisničko ime:</label>
                <input type="text" id="username" name="username" required>
                <span id="usernameError" style="color: red;"></span>

                <label for="password">Lozinka:</label>
                <input type="password" id="password" name="password" required>
                <span id="passwordError" style="color: red;"></span>

                <button type="submit" name="submit">Prijava</button>
            </form>


        </section>

    </main>

    <footer>
        <p>&copy; 2024 Davor Jagnjić | Kontakt: djagnjic@tvz.hr |  <a href="login.php" style="color: white;">Login</a> |
         <a href="logout.php" style="color: white;">Logout</a></p>
    </footer>

</body>

</html>