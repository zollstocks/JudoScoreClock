<!-- Settings.php -->
<!DOCTYPE html>
<html lang="de">
<head>
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700&amp;subset=latin-ext" rel="stylesheet">
  <link rel="stylesheet" href="css/Style.css">
  <meta name="viewport" content="width=device-width">
  <meta name="author" content="Felix Stoeckel">
  <meta name="keywords" content="">
  <title>JudoScoreClock</title>
  <script src="js/script.js"></script>
  <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.1.1.min.js"></script>
  <script>
    $(document).ready(function(){
      document.getElementById('settingsKampfzeit').innerHTML = kampfzeit;
    });
  </script>
</head>
<h1>Settings</h1>
<ul>
  <li>Kampfzeit: <span id="settingsKampfzeit"></span> Sekunden <button type="button" name=""></button></li>
</ul>
