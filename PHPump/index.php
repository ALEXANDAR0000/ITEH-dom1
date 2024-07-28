<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
     <form action="login.php" method="post">
     	<h2>LOGIN - PHPump Gym</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
     	<label>Korisnicko ime</label>
     	<input type="text" name="uname" placeholder="Korisnicko ime"><br>

     	<label>Lozinka</label>
     	<input type="password" name="password" placeholder="Lozinka"><br>

     	<button type="submit">Uloguj se</button>
     </form>
</body>
</html>