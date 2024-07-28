<?php 
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
 ?>
 
<!DOCTYPE html>
<html>
<head>
	<title>PHPump gym</title>
	<link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
     <header>
        <h1>PHPump Gym</h1>
        <h3>Dobro došao, <?php echo $_SESSION['name']; ?></h3>
        <nav>
            <ul>
                <li><a href="#" id="list-clanovi">Prikaz članova</a></li>
                <li><a href="#" id="add-clan">Dodaj člana</a></li>
                <li><a href="#" id="list-clanarine">Prikaz članarina</a></li>
                <li><a href="#" id="add-clanarina">Dodaj članarinu</a></li>
                <li><a href="urediClanove.php" id="uredi-clanove">Uredi članove</a></li>
                <li><a href="urediClanarine.php" id="uredi-clanarine">Uredi članarine</a></li>
                <li> <a href="logout.php" id="odjava">Odjavi se</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div id="content">
          
        </div>
    </main>
    <script>
        $(document).ready(function() {
            $('#list-clanovi').click(function() {
                $.get('ajax/list_clanovi.php', function(data) {
                    let clanovi = JSON.parse(data);
                    let output = '<h2>Lista članova</h2><ul>';
                    clanovi.forEach(function(clan) {
                        output += `<li>ID: ${clan.id} - Ime: ${clan.ime} - Prezime: ${clan.prezime}</li>`;
                    });
                    output += '</ul>';
                    $('#content').html(output);
                });
            });

            $('#add-clan').click(function() {
                let form = `
                    <h2>Dodaj novog člana</h2>
                    <form id="add-clan-form">
                        <label for="ime">Ime:</label>
                        <input type="text" id="ime" name="ime"><br>
                        <label for="prezime">Prezime:</label>
                        <input type="text" id="prezime" name="prezime"><br>
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email"><br>
                        <label for="telefon">Telefon:</label>
                        <input type="text" id="telefon" name="telefon"><br>
                        <label for="datum_rodjenja">Datum rođenja:</label>
                        <input type="date" id="datum_rodjenja" name="datum_rodjenja"><br>
                        <button type="submit">Dodaj člana</button>
                    </form>
                `;
                $('#content').html(form);

                $('#add-clan-form').submit(function(event) {
                    event.preventDefault();
                    let clanData = {
                        ime: $('#ime').val(),
                        prezime: $('#prezime').val(),
                        email: $('#email').val(),
                        telefon: $('#telefon').val(),
                        datum_rodjenja: $('#datum_rodjenja').val()
                    };

                    $.ajax({
                        url: 'ajax/add_clan.php',
                        method: 'POST',
                        contentType: 'application/json',
                        data: JSON.stringify(clanData),
                        success: function(response) {
                            let res = JSON.parse(response);
                            alert(res.message);
                            $('#list-clanovi').click();
                        }
                    });
                });
            });

            $('#list-clanarine').click(function() {
                $.get('ajax/list_clanarine.php', function(data) {
                    let clanarine = JSON.parse(data);
                    let output = '<h2>Lista članarina</h2><ul>';
                    clanarine.forEach(function(clanarina) {
                        output += `<li>ID: ${clanarina.id} - Član ID: ${clanarina.clan_id} - Datum početka: ${clanarina.datum_pocetka} - Datum kraja: ${clanarina.datum_kraja} - Status: ${clanarina.status}</li>`;
                    });
                    output += '</ul>';
                    $('#content').html(output);
                });
            });

            $('#add-clanarina').click(function() {
                let form = `
                    <h2>Dodaj novu članarinu</h2>
                    <form id="add-clanarina-form">
                        <label for="clan_id">ID člana:</label>
                        <input type="number" id="clan_id" name="clan_id"><br>
                        <label for="datum_pocetka">Datum početka:</label>
                        <input type="date" id="datum_pocetka" name="datum_pocetka"><br>
                        <label for="datum_kraja">Datum kraja:</label>
                        <input type="date" id="datum_kraja" name="datum_kraja"><br>
                        <label for="status">Status:</label>
                        <select id="status" name="status">
                            <option value="aktivan">Aktivan</option>
                            <option value="istekao">Istekao</option>
                        </select><br>
                        <button type="submit">Dodaj članarinu</button>
                    </form>
                `;
                $('#content').html(form);

                $('#add-clanarina-form').submit(function(event) {
                    event.preventDefault();
                    let clanarinaData = {
                        clan_id: $('#clan_id').val(),
                        datum_pocetka: $('#datum_pocetka').val(),
                        datum_kraja: $('#datum_kraja').val(),
                        status: $('#status').val()
                    };

                    $.ajax({
                        url: 'ajax/add_clanarina.php',
                        method: 'POST',
                        contentType: 'application/json',
                        data: JSON.stringify(clanarinaData),
                        success: function(response) {
                            let res = JSON.parse(response);
                            alert(res.message);
                            $('#list-clanarine').click();
                        }
                    });
                });
            });
        });
    </script>

</body>
</html>

<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>
