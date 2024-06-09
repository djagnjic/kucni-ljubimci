<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM vijest WHERE id = $id";
    $result = mysqli_query($dbc, $query);
    $article = mysqli_fetch_array($result);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Izmjena Vijesti</title>
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
        <h2>Izmjena Vijesti</h2>
        <form action="azurirajBazu.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $article['id']; ?>">
            <div class="form-item">
                <span id="porukaTitle" class="bojaPoruke"></span>
                <label for="title">Naslov vijesti</label>
                <input type="text" name="title" id="title" class="form-field-textual" value="<?php echo $article['naslov']; ?>">
            </div>
            <div class="form-item">
                <span id="porukaAbout" class="bojaPoruke"></span>
                <label for="about">Kratki sadržaj vijesti (do 50 znakova)</label>
                <textarea name="about" id="about" cols="30" rows="2" class="form-field-textual" maxlength="50"><?php echo $article['sazetak']; ?></textarea>
            </div>
            <div class="form-item">
                <span id="porukaContent" class="bojaPoruke"></span>
                <label for="content">Sadržaj vijesti</label>
                <textarea name="content" id="content" cols="30" rows="10" class="form-field-textual"><?php echo $article['tekst']; ?></textarea>
            </div>
            <div class="form-item">
                <label for="current-image">Trenutna slika:</label>
                <div class="current-image">
                    <img src="uploads/<?php echo $article['slika']; ?>" alt="Trenutna slika" style="width: 100px;">
                </div>
            </div>
            <div class="form-item">
                <label for="photo">Slika</label>
                <input type="file" accept="image/jpg,image/gif,image/png,image/jpeg," name="photo" id="photo">
            </div>
            <div class="form-item">
                <span id="porukaKategorija" class="bojaPoruke"></span>
                <label for="category">Kategorija vijesti</label>
                <select name="category" id="category" class="form-field-textual" ?>" >
                    <option value="" disabled selected>--- Izaberite Kategoriju ---</option>
                    <option value="ljubimci" <?php if ($article['kategorija'] == 'ljubimci') echo 'selected'; ?>>Ljubimci</option>
                    <option value="savjeti" <?php if ($article['kategorija'] == 'savjeti') echo 'selected'; ?>>Savjeti</option>
                    <option value="iskustva" <?php if ($article['kategorija'] == 'iskustva') echo 'selected'; ?>>Priče i iskustva</option>
                </select>
            </div>
            <div class="form-item">
                <label>
                    Spremiti u arhivu
                    <input type="checkbox" name="archive" <?php if ($article['arhiva']) echo 'checked'; ?>>
                </label>
            </div>
            <div class="form-item">
                <button type="reset">Poništi</button>
                <button type="submit" id="update">Izmijeni</button>
            </div>
        </form><br>
    </main>

    <footer>
        <p>&copy; 2024 Davor Jagnjić | Kontakt: djagnjic@tvz.hr |  <a href="login.php" style="color: white;">Login</a> |
         <a href="logout.php" style="color: white;">Logout</a></p>
    </footer>

    <script type="text/javascript">
        // Provjera forme prije slanja
        document.getElementById("update").onclick = function(event) {

            var slanjeForme = true;

            // Naslov vjesti (5-30 znakova)
            var poljeTitle = document.getElementById("title");
            var title = document.getElementById("title").value;
            if (title.length < 5 || title.length > 30) {
                slanjeForme = false;
                poljeTitle.style.border = "1px dashed red";
                document.getElementById("porukaTitle").innerHTML = "Naslov vijesti mora imati između 5 i 30 znakova!";
            } else {
                poljeTitle.style.border = "1px solid green";
                document.getElementById("porukaTitle").innerHTML = "";
            }

            // Kratki sadržaj (10-100 znakova)
            var poljeAbout = document.getElementById("about");
            var about = document.getElementById("about").value;
            if (about.length < 10 || about.length > 100) {
                slanjeForme = false;
                poljeAbout.style.border = "1px dashed red";
                document.getElementById("porukaAbout").innerHTML = "Kratki sadržaj mora imati između 10 i 100 znakova!";
            } else {
                poljeAbout.style.border = "1px solid green";
                document.getElementById("porukaAbout").innerHTML = "";
            }
            // Sadržaj mora biti unesen
            var poljeContent = document.getElementById("content");
            var content = document.getElementById("content").value;
            if (content.length == 0) {
                slanjeForme = false;
                poljeContent.style.border = "1px dashed red";
                document.getElementById("porukaContent").innerHTML = "Sadržaj mora biti unesen! < br > ";
            } else {
                poljeContent.style.border = "1px solid green";
                10
                document.getElementById("porukaContent").innerHTML = "";
            }
            // Kategorija mora biti odabrana
            var poljeCategory = document.getElementById("category");
            if (document.getElementById("category").selectedIndex == 0) {
                slanjeForme = false;
                poljeCategory.style.border = "1px dashed red";

                document.getElementById("porukaKategorija").innerHTML = "Kategorija mora biti odabrana! < br > ";
            } else {
                poljeCategory.style.border = "1px solid green";
                document.getElementById("porukaKategorija").innerHTML = "";
            }

            if (slanjeForme != true) {
                event.preventDefault();
            }

        };
    </script>

</body>

</html>