<!-- index.php -->
<!DOCTYPE html>
<html lang="de">
<head>
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700&amp;subset=latin-ext" rel="stylesheet">
  <link rel="stylesheet" href="css/Style.css">
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
  <meta name="author" content="Felix Stoeckel">
  <meta name="keywords" content="">
  <title>JudoScoreClock Controller</title>
  <script src="js/script.js"></script>
  <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.1.1.min.js"></script>
  <script>
    $(document).ready(function(){
      loadSettings();
      disableHaltegriffButton();
      refreshKampfzeitDisplay();
      refreshHaltegriffDisplay();

      if (!settings.settingYuko) {
        $('#yukoCellWeiss').hide();
        $('#yukoCellBlau').hide();
      }

      if (!settings.names) {
        $('#kaempferCellWeiss').hide(); //keampfer muss TYOP! ToFix!
        $('#kaempferCellBlau').hide();
      }

      if (!settings.topbar) {
        //$('nav').hide();
        $('nav').css({"background-color": "white", "color": "white"});
      }

      // out of ORDER!
      if (!settings.bottombar) {
        //$('footer').hide();
        $('footer').css({"background-color": "blue", "color": "blue"});
      }
    });
  </script>
</head>
<!-- BODY -->
<body>
  <nav class="navigation">
    <table>
      <tr>
        <td class="left">
          Osnabrück - Crocodiles Cup 2018
        </td>
        <td><button type="button" name="secondaryWindowButton" onclick="openSecondaryWindow()">2. Fesnter öffnen</button><p>Matte <span id="mattennummer"></span></p></td>
        <td class="right"><span id="categoryHinweis">Kategorie/Info: </span><button id="categoryButton" onclick="buttonPromt()">eingeben...</button></td>
      </tr>
    </table>
  </nav>
  <div class="line kaempfer weiss" id="weiss">
    <?php include 'kaempferweiss.php'; ?>
  </div>
  <div class="smallline time" id="time">
    <table>
      <tr>
        <td id="kampfzeitCell">
          <span id="kampfzeit">Load...</span>
        </td>
        <td id="steuerungCell">
          <table id="controllTable">
            <tr>
              <td colspan="2"><button class="importantButton" id="kampfzeitButtonToggle" onclick="toggleKampfzeit()"><b>Kampfzeit START</b></button></td>
            </tr>
            <tr>
              <td><button class="importantButton" id="haltegriffButtonToggle" onclick="toggleHaltegriff()">Haltegriff LOS</button></td>
              <td><button class="importantButton" id="haltegriffReset" onclick="haltegriffReset()"> >> Haltegriff RESET + STOP</button></td>
            </tr>
            <tr>
              <td><button id="haltegriffButtonWeiss" onclick="haltegriffWeiss()"> >> Haltegriff weiss (starten)</button></td>
              <td><button id="haltegriffButtonBlau" onclick="haltegriffBlau()"> >> Haltegriff blau (starten)</button></td>
            </tr>
            <tr>
              <td><button id="setKampfzeitButton" onclick="setKampfzeit()">Setzte Kampfzeit</button></td>
              <td><button id="setHaltegriffzeitButton" onclick="setHaltegriffzeit()">Setzte Haltegriffzeit</button></td>
            </tr>
            <tr>
              <td><button id="settingsButton" onclick="">Einstellungen [TODO]</button></td>
              <td><button class="importantButton" id="nextFightButton" onclick="nextFight()">Nächster Kampf</button></td>
            </tr>
          </table>
        </td>
        <td id="haltegriffCell">
          <span id="haltegriff">Load...</span>
        </td>
      </tr>
    </table>
  </div>
  <div class="line kaempfer blau" id="blau">
    <?php include 'kaempferblau.php'; ?>
  </div>

  <!-- Aktuell rausgenommen, da dynamische Namen noch nicht funktionieren
    7vh auf per hardcode in style.scss auf die .line und .smallline verteilt -->
  <!-- <footer class="navigation">
    <table>
      <tr>
        <td class="prepare left">Vorbereiten: <span class="prepareName1">KämferNextWeiß</span> gegen <span class="prepareName2">KämpferNextBlau</span></td>
        <td class="prepareCategory">Vorbereiten in 2. Runde - U21 M&auml;nnlich -66kg</td>
        <td class="right" id="uhrzeit">Uhrzeit</td>
      </tr>
    </table>
  </footer> -->
</body>
</html>
<HTML>
