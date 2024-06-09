<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ljubimci - Unos Vijesti</title>
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
        <h2>Unos Vijesti</h2>
        <form name="forma" action="insert.php" method="POST" enctype="multipart/form-data">
            <div class="form-item">
                <span id="porukaTitle" class="bojaPoruke"></span>
                <label for="title">Naslov vijesti</label>
                <input type="text" name="title" id="title" class="form-field-textual">
            </div>
            <div class="form-item">
                <span id="porukaAbout" class="bojaPoruke"></span>
                <label for="about">Kratki sadržaj vijesti</label>
                <textarea name="about" id="about" cols="30" rows="2" class="form-field-textual"></textarea>
            </div>
            <div class="form-item">
                <span id="porukaContent" class="bojaPoruke"></span>
                <label for="content">Sadržaj vijesti</label>
                <textarea name="content" id="content" cols="30" rows="10" class="form-field-textual"></textarea>
            </div>
            <div class="form-item">
                <span id="porukaSlika" class="bojaPoruke"></span>
                <label for="photo">Slika</label>
                <input type="file" accept="image/jpg,image/gif,image/png,image/jpeg," name="photo" id="photo">
            </div>
            <div class="form-item">
                <span id="porukaKategorija" class="bojaPoruke"></span>
                <label for="category">Kategorija vijesti</label>
                <select name="category" id="category" class="form-field-textual">
                    <option value="" disabled selected>--- Izaberite Kategoriju ---</option>
                    <option value="ljubimci">Ljubimci</option>
                    <option value="savjeti">Savjeti</option>
                    <option value="iskustva">Priče i iskustva</option>
                </select>
            </div>
            <div class="form-item">
                <label>
                    Spremiti u arhivu
                    <input type="checkbox" name="archive">
                </label>
            </div>
            <div class="form-item">
                <button type="reset">Poništi</button>
                <button type="submit" name="submit" id="slanje">Prihvati</button>
            </div>
        </form><br>
    </main>

    <footer>
        <p>&copy; 2024 Davor Jagnjić | Kontakt: djagnjic@tvz.hr | <a href="login.php" style="color: white;">Login</a> |
            <a href="logout.php" style="color: white;">Logout</a>
        </p>
    </footer>

    <script type="text/javascript">
        // Provjera forme prije slanja
        document.getElementById("slanje").onclick = function(event) {

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
                document.getElementById("porukaContent").innerHTML = "Sadržaj mora biti unesen!";
            } else {
                poljeContent.style.border = "1px solid green";
                document.getElementById("porukaContent").innerHTML = "";
            }

            // Slika mora biti unesena
            var poljeSlika = document.getElementById("photo");
            var pphoto = document.getElementById("photo").value;
            if (pphoto.length == 0) {
                slanjeForme = false;
                poljeSlika.style.border = "1px dashed red";
                document.getElementById("porukaSlika").innerHTML = "Slika mora biti unesena!";
            } else {
                poljeSlika.style.border = "1px solid green";
                document.getElementById("porukaSlika").innerHTML = "";
            }

            // Kategorija mora biti odabrana
            var poljeCategory = document.getElementById("category");
            if (document.getElementById("category").selectedIndex == 0) {
                slanjeForme = false;
                poljeCategory.style.border = "1px dashed red";
                document.getElementById("porukaKategorija").innerHTML = "Kategorija mora biti odabrana!";
            } else {
                poljeCategory.style.border = "1px solid green";
                document.getElementById("porukaKategorija").innerHTML = "";
            }

            // Ako forma nije valjana, spriječi slanje
            if (!slanjeForme) {
                event.preventDefault();
            }
        };
    </script>

</body>

</html>