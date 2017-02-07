<!-- index.php -->
<!DOCTYPE html>
<html lang="de">
<head>
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700&amp;subset=latin-ext" rel="stylesheet">
  <link rel="stylesheet" href="css/Style.css">
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
  <meta name="author" content="Felix Stoeckel">
  <meta name="keywords" content="">
  <title>JSC View</title>
  <script src="js/script.js"></script>
  <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.1.1.min.js"></script>

  <script>
    var x = y = 0;
    var gold = true;
    var op = opener;
    var secondWinTimer = setInterval(function(){
      // Zeiten übertragen
      $('#kampfzeitView').html(op.refreshKampfzeitDisplay());
      $('#haltegriffView').html(op.refreshHaltegriffDisplay());

      // Hintergrundfarben anpassen
      // Kampfzeit
      if (!op.kampfBegonnen) {
        $('#time').css('background-color', 'purple');
      } else if (op.kampfzeitPause) {
        $('#time').css('background-color', 'red');
      }

      if (!op.kampfzeitPause) {
        $('#time').css('background-color', 'green');
        if (op.inGoldenScore) {
          $('#time').css('background-color', 'gold');
        }
      }

      if (op.inGoldenScore) {
        $('#controllView').html('Golden Score');
        $('#kampfzeitCell').css('background-color', '');
      }

      if (!op.inGoldenScore) {
        $('#controllView').html('');
      }

      if (op.kampfzeitAbgelaufenStatus) {
        if (flash()) {
          $('#kampfzeitCell').css('background-color', 'gold');
        }

        if (!flash()) {
          if (!op.kampfzeitPause) {
            $('#kampfzeitCell').css('background-color', 'green');
          }
          if (op.kampfzeitPause) {
            $('#kampfzeitCell').css('background-color', 'red');
          }
        }
      }

      // Haltegriffe
      // Seite 1 == Weiss
      if (op.haltegriffSeite == 1) {
        $('#haltegriffCell').css('background-color', 'white');

        if (op.haltegriffAbgelaufenStatus) {
          if (flash()) {
            $('#haltegriffCell').css('background-color', 'gold');
          }
          if (!flash()) {
            $('#haltegriffCell').css('background-color', 'white');
          }
        }
      }

      // Seite 2 == Blau
      if (op.haltegriffSeite == 2) {
        $('#haltegriffCell').css('background-color', 'blue');

        if (op.haltegriffAbgelaufenStatus) {
          if (flash()) {
            $('#haltegriffCell').css('background-color', 'gold');
          }
          if (!flash()) {
            $('#haltegriffCell').css('background-color', 'blue');
          }
        }
      }

      // Seite 0 == None
      if (op.haltegriffSeite == 0){
        $('#haltegriffCell').css('background-color', '');

        if (op.haltegriffAbgelaufenStatus) {
          if (flash()) {
            $('#haltegriffCell').css('background-color', 'gold');
          }
          if (!flash()) {
            $('#haltegriffCell').css('background-color', '');
          }
        }
      }

      // Wertungen überragen
      $('#ipponWeissView').text(op.getPointView(op.ipponWeiss));
      $('#wazaAriWeissView').text(op.getPointView(op.wazaAriWeiss));
      $('#yukoWeissView').text(op.getPointView(op.yukoWeiss));
      $('#strafenWeissView').text(op.getPointView(op.strafenWeiss));
      $('#ipponBlauView').text(op.getPointView(op.ipponBlau));
      $('#wazaAriBlauView').text(op.getPointView(op.wazaAriBlau));
      $('#yukoBlauView').text(op.getPointView(op.yukoBlau));
      $('#strafenBlauView').text(op.getPointView(op.strafenBlau));
    }, 20);

    $(document).ready(function(){
      console.log("Window 2 geladen");
      loadSettings();

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
        <td><p>Matte <span id="mattennummer"></span></p></td>
        <td class="right"><span id="categoryHinweis">Kategorie/Info</span></td>
      </tr>
    </table>
  </nav>
  <!-- Kämpfer Weiss -->
  <div class="line kaempfer weiss" id="weiss">
    <table class="kaempferline">
      <tr>
        <td class="kaempfername" id="kaempferCellWeiss">
          <!-- Dynamic one day -->
          <h1>Stöckel, Felix</h1></br>
          <h2>Niedersachsen / Judo Crocodiles Osnabrück</h2>
        </td>
        <!-- Ippon -->
        <td class="punktwertung" id="ipponCellWeiss">
          <table class="wertung unselectable">
            <!-- PointHead -->
            <tr class="pointhead"><td class="pointhead">Ippon</td></tr>
            <!-- PointBottom -->
            <tr class="pointbottom" id="ipponBottomWeiss">
              <td class="pointbottom"><span id="ipponWeissView">0</span></td>
            </tr>
          </table>
        </td>
        <!-- Waza-Ari -->
        <td class="punktwertung" id="waza-ariCellWeiss">
          <table class="wertung unselectable">
            <!-- PointHead -->
            <tr class="pointhead"><td class="pointhead">Waza-Ari</td></tr>
            <!-- PointBottom -->
            <tr class="pointbottom" id="wazaAriBottomWeiss">
              <td class="pointbottom"><span id="wazaAriWeissView">0</span></td>
            </tr>
          </table>
        </td>
        <!-- Yuko -->
        <td class="punktwertung" id="yukoCellWeiss">
          <table class="wertung unselectable">
            <!-- PointHead -->
            <tr class="pointhead"><td class="pointhead">Yuko</td></tr>
            <!-- PointBottom -->
            <tr class="pointbottom" id="yukoBottomWeiss">
              <td class="pointbottom"><span id="yukoWeissView">0</span></td>
            </tr>
          </table>
        </td>
        <!-- Strafen -->
        <td class="punktwertung" id="strafenCellWeiss">
          <table class="wertung unselectable">
            <!-- PointHead -->
            <tr class="pointhead"><td class="pointhead">Strafen</td></tr>
            <!-- PointBottom -->
            <tr class="pointbottom" id="strafenBottomWeiss">
              <td class="pointbottom"><span id="strafenWeissView">0</span></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </div>
  <!-- Timeline -->
  <div class="smallline time" id="time">
    <table>
      <tr>
        <td id="kampfzeitCell">
          <span id="kampfzeitView">??</span>
        </td>
        <td id="steuerungCell">
          <span id="controllView">Ich bin eine leere ControllView.</span>
        </td>
        <td id="haltegriffCell">
          <span id="haltegriffView">??</span>
        </td>
      </tr>
    </table>
  </div>
  <!-- Kämpfer Blau -->
  <div class="line kaempfer blau" id="blau">
    <table class="kaempferline">
      <tr>
        <td class="kaempfername" id="kaempferCellBlau">
          <h1>Nachname, Vorname</h1></br>
          <h2>Nation / Verband / Verein</h2>
        </td>
        <!-- Ippon -->
        <td class="punktwertung" id="ipponCellBlau">
          <table class="wertung unselectable">
            <!-- PointHead -->
            <tr class="pointhead"><td class="pointhead">Ippon</td></tr>
            <!-- PointBottom -->
            <tr class="pointbottom" id="ipponBottomBlau">
              <td class="pointbottom"><span id="ipponBlauView">0</span></td>
            </tr>
          </table>
        </td>
        <!-- Waza-Ari -->
        <td class="punktwertung" id="waza-ariCellBlau">
          <table class="wertung unselectable">
            <!-- PointHead -->
            <tr class="pointhead"><td class="pointhead">Waza-Ari</td></tr>
            <!-- PointBottom -->
            <tr class="pointbottom" id="wazaAriBottomBlau">
              <td class="pointbottom"><span id="wazaAriBlauView">0</span></td>
            </tr>
          </table>
        </td>
        <!-- Yuko -->
        <td class="punktwertung" id="yukoCellBlau">
          <table class="wertung unselectable">
            <!-- PointHead -->
            <tr class="pointhead"><td class="pointhead">Yuko</td></tr>
            <!-- PointBottom -->
            <tr class="pointbottom" id="yukoBottomBlau">
              <td class="pointbottom"><span id="yukoBlauView">0</span></td>
            </tr>
          </table>
        </td>
        <!-- Strafen -->
        <td class="punktwertung" id="strafenCellBlau">
          <table class="wertung unselectable">
            <!-- PointHead -->
            <tr class="pointhead"><td class="pointhead">Strafen</td></tr>
            <!-- PointBottom -->
            <tr class="pointbottom" id="strafenBottomBlau">
              <td class="pointbottom"><span id="strafenBlauView">0</span></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
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
