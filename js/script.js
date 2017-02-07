// script.js

// SETTINGS
var settings = {
  mattennummer: '1',
  settingKampfzeit: 240,
  settingHaltegriffzeit: 20,
  settingYuko: false,
  maxStafen: 2, // legt die maximale Anzahl an Strafen fest
  names: true,
  topbar: true, // sollte noch angepasst/verbessert werden
  bottombar: true, // sollte noch angepasst/verbessert werden // Zur zeit rausgenommen!!!
  goldenScore: true, // false derzeit nicht möglich
  goldenScoreLimit: 0, // 0, wenn kein Limit (OpenEnd)
  category: 'U21 Männlich -66kg'
};

// var ak = "u12";
// var settings = {
//   mattennummer: '1',
//   names: false,
//   topbar: true, // sollte noch angepasst/verbessert werden
//   bottombar: true, // sollte noch angepasst/verbessert werden // Zur zeit rausgenommen!!!
//   "u12": {
//     settingKampfzeit: 240,
//     settingHaltegriffzeit: 20,
//     settingYuko: false,
//     maxStafen: 2, // legt die maximale Anzahl an Strafen fest
//     goldenScore: true, // false derzeit nicht möglich
//     goldenScoreLimit: 0 // 0, wenn kein Limit (OpenEnd)
//     //category: 'U21 Männlich -66kg'
//   },
//   "u15": {
//     settingKampfzeit: 240,
//     settingHaltegriffzeit: 20,
//     settingYuko: true,
//     maxStafen: 2, // legt die maximale Anzahl an Strafen fest
//     goldenScore: true, // false derzeit nicht möglich
//     goldenScoreLimit: 0 // 0, wenn kein Limit (OpenEnd)
//     //category: 'U21 Männlich -66kg'
//   }
// };

var win2;
function openSecondaryWindow() {
  return win2 = window.open('scoreboardView.php','secondary','width=400,height=200');
}

function loadSettings() {
  document.getElementById('mattennummer').innerHTML = settings.mattennummer;
  //document.getElementById('category').innerHTML = settings.category;
}


// Disable Buttons functions
function disableNextFightButton() {
  document.getElementById('nextFightButton').disabled = true;
}

function enableNextFightButton() {
  document.getElementById('nextFightButton').disabled = false;
}

function disableHaltegriffButton() {
  document.getElementById('haltegriffButtonToggle').disabled = true;
  document.getElementById('haltegriffButtonWeiss').disabled = true;
  document.getElementById('haltegriffButtonBlau').disabled = true;
}

function enableHaltegriffButton() {
  document.getElementById('haltegriffButtonToggle').disabled = false;
  document.getElementById('haltegriffButtonWeiss').disabled = false;
  document.getElementById('haltegriffButtonBlau').disabled = false;
}

function disableSetTimeButton() {
  document.getElementById('setKampfzeitButton').disabled = true;
  document.getElementById('setHaltegriffzeitButton').disabled = true;
}

function enableSetTimeButton() {
  document.getElementById('setKampfzeitButton').disabled = false;
  document.getElementById('setHaltegriffzeitButton').disabled = false;
}

function disableInput() {
  $('#categoryButton').attr('disabled','disabled');
}

function enableInput() {
  $('#categoryButton').removeAttr('disabled');
}

// PUNKTE
var ipponWeiss = wazaAriWeiss = yukoWeiss = strafenWeiss = ipponBlau = wazaAriBlau = yukoBlau = strafenBlau = 0;

function refreshPointView(name, wert) {
  // console.log('refreshPointView: ' + name + ' auf Wert: ' + wert);
  document.getElementById(name).innerHTML = wert;
  return wert;
}

function addPoint(wertung) {
  switch (wertung) {
    case 'ipponWeiss':
        if (ipponWeiss < 1) {
          refreshPointView('ipponWeiss', ++ipponWeiss);
        }
      break;
    case 'wazaAriWeiss':
        refreshPointView('wazaAriWeiss', ++wazaAriWeiss);
      break;
    case 'yukoWeiss':
        refreshPointView('yukoWeiss', ++yukoWeiss);
      break;
    case 'strafenWeiss':
      if (strafenWeiss < settings.maxStafen) {
        refreshPointView('strafenWeiss', ++strafenWeiss);
      }
      break;
    case 'ipponBlau':
      if (ipponBlau < 1) {
        refreshPointView('ipponBlau', ++ipponBlau);
      }
      break;
    case 'wazaAriBlau':
        refreshPointView('wazaAriBlau', ++wazaAriBlau);
      break;
    case 'yukoBlau':
        refreshPointView('yukoBlau', ++yukoBlau);
      break;
    case 'strafenBlau':
      if (strafenBlau < settings.maxStafen) {
        refreshPointView('strafenBlau', ++strafenBlau);
      }
      break;
    default: console.error("Fehler bei addPoint!");
  }
}

function remPoint(wertung) {
  switch (wertung) {
    case 'ipponWeiss':
        if (ipponWeiss != 0) {refreshPointView('ipponWeiss', --ipponWeiss)}
      break;
    case 'wazaAriWeiss':
        if (wazaAriWeiss != 0) {refreshPointView('wazaAriWeiss', --wazaAriWeiss)}
      break;
    case 'yukoWeiss':
        if (yukoWeiss != 0) {refreshPointView('yukoWeiss', --yukoWeiss)}
      break;
    case 'strafenWeiss':
        if (strafenWeiss != 0) {refreshPointView('strafenWeiss', --strafenWeiss)}
      break;
    case 'ipponBlau':
        if (ipponBlau != 0) {refreshPointView('ipponBlau', --ipponBlau)}
      break;
    case 'wazaAriBlau':
        if (wazaAriBlau != 0) {refreshPointView('wazaAriBlau', --wazaAriBlau)}
      break;
    case 'yukoBlau':
        if (yukoBlau != 0) {refreshPointView('yukoBlau', --yukoBlau)}
      break;
    case 'strafenBlau':
        if (strafenBlau != 0) {refreshPointView('strafenBlau', --strafenBlau)}
      break;
    default: console.error("Fehler bei remPoint!");
  }
}

function getPointView(wertung) {
  return wertung;
}

function addColor(fieldID) {
  document.getElementById(fieldID).style.color = "green";
}

function remColor(fieldID) {
  document.getElementById(fieldID).style.color = "red";
}

function restoreColor(fieldID) {
  document.getElementById(fieldID).style.color = "black";
}

function resetScoreboard() {
  ipponWeiss = wazaAriWeiss = yukoWeiss = strafenWeiss = ipponBlau = wazaAriBlau = yukoBlau = strafenBlau = 0;

  // Wertungen zurücksetzten
  var punkte = ['ipponWeiss', 'wazaAriWeiss', 'yukoWeiss', 'strafenWeiss', 'ipponBlau', 'wazaAriBlau', 'yukoBlau', 'strafenBlau']

  for (item of punkte) {
    refreshPointView(item, 0);
  }
}

// TIMER
var kmpftimer = setInterval(function(){ uhrzeitTimer(), kampftimer(), haltegrifftimer() }, 1000);

var divtimer = setInterval(function(){ kampfzeitAbgelaufen() }, 500);

function uhrzeitTimer() {
  var d = new Date();
  var t = d.toLocaleTimeString();
  // rausgenommen, da Bottombar zur Zeit rausgenommen
  // document.getElementById("uhrzeit").innerHTML = t;
  return t;
}

// Some functions
function oddNumber() {
  var k = uhrzeitTimer(), a = k.length;
  k = k.charAt(--a);
  if (k % 2 == 0) {
    return false;
  } else {
    return true;
  }
}

function flash() {
  var d = Date.now();
  if ((d / 500) % 2 < 1) {
    return true;
  } else {
    return false;
  }
}

// Kampfzeit
var kampfzeit = settings.settingKampfzeit;
var kampfBegonnen = false;
var kampfzeitPause = true;
var kampfzeitAbgelaufenStatus = false;
var inGoldenScore = false;
var goldenScoreTime = 0;  // Für die Zukunft


function refreshKampfzeitDisplay() {

  var showKampfzeit;
  var minuten = parseInt(kampfzeit / 60);
  var sekunden = kampfzeit % 60;

  // minuten = minuten < 10 ? "0" + minuten : minuten;
  sekunden = sekunden < 10 ? "0" + sekunden : sekunden;

  showKampfzeit = minuten + ":" + sekunden;
  // $('#kampfzeit').html(showKampfzeit);
  return showKampfzeit;
}

function startClock() {
  kampfBegonnen = true;
  kampfzeitPause = false;
  if (!inGoldenScore) {
    document.getElementById('kampfzeitButtonToggle').innerHTML = "Kampfzeit PAUSIEREN";
  } else {
    document.getElementById('kampfzeitButtonToggle').innerHTML = "Golden Score PAUSIEREN";
  }
}

function pauseClock() {
  kampfzeitPause = true;
  if (!inGoldenScore) {
    document.getElementById('kampfzeitButtonToggle').innerHTML = "Kampfzeit WEITER";
  } else {
    document.getElementById('kampfzeitButtonToggle').innerHTML = "Golden Score WEITER";
  }
}

function resetClock() {
  kampfzeit = settings.settingKampfzeit;
  inGoldenScore = false;
  kampfzeitAbgelaufenStatus = false;
  kampfzeitPause = true;
  kampfBegonnen = false;
  document.getElementById('kampfzeitButtonToggle').innerHTML = "Zeit SARTEN";
}

function toggleKampfzeit() {
  if (kampfzeitPause) {
    if (kampfzeitAbgelaufenStatus) {
      inGoldenScore = true;
      kampfzeitAbgelaufenStatus = false;
    }
    startClock();
    disableNextFightButton();
    enableHaltegriffButton();
    disableSetTimeButton();
    disableInput();
  } else {
    pauseClock();
    enableNextFightButton();
    disableHaltegriffButton();
    enableSetTimeButton();
    enableInput();
  }
}

function kampfzeitAbgelaufen() {
  if (kampfzeitAbgelaufenStatus) {
    if (kampfzeitPause) {
      // GoldenScore starten in KampfzeitToggleButton
      document.getElementById("kampfzeitButtonToggle").innerHTML = "Golden Score STARTEN";
    } else {
      document.getElementById("kampfzeitButtonToggle").innerHTML = "Reguläre Kampfzeit Beenden";
    }
  }
}

function kampftimer() {

  if (!inGoldenScore) {
    if (kampfzeit != 0 && kampfzeitPause != true) {
      kampfzeit--;
    }

    if (kampfzeit == 0) {
      var abgelaufen = true;
    }

    if (abgelaufen) {
      kampfzeitAbgelaufenStatus = true;
    }
  } else {
    if (!kampfzeitPause) {
      kampfzeit++;
    }
  }
  refreshKampfzeitDisplay();
}

function setKampfzeit(){
  var setKT = prompt("Auf welche Zeit soll gesetzt werden?\nBitte in Sekunden.\n1 Minute = 60 Sek.\n2 Minute = 120 Sek.\n3 Minute = 180 Sek.\n4 Minute = 240 Sek.");
  // TODO: Kampfzeit soll auch in MM:SS eingegeben werden können.
  kampfzeit = Number(setKT);
  refreshKampfzeitDisplay();
}

// Haltegriff
var haltegriffzeit = 0;
var showHaltegriff;
var haltegriffSeite = 0;
var haltegriffAbgelaufenStatus = false;
var haltegriffPause = true;
var haltegriffResetStatus = true;

// nicht mehr benötigt?
var blinkstatus = 0;

function refreshHaltegriffDisplay(){
  showHaltegriff = haltegriffzeit;
  if (haltegriffzeit < 10) { showHaltegriff = '0' + haltegriffzeit }
  $('#haltegriff').html(showHaltegriff);
  return showHaltegriff;
}

function haltegrifftimer() {
  if (!kampfzeitPause && !haltegriffPause) {
    if (haltegriffzeit < settings.settingHaltegriffzeit) {
      haltegriffzeit++;
      refreshHaltegriffDisplay();
    } else {
      haltegriffAbgelaufenStatus = true;
    }
  }
}

function toggleHaltegriff() {
  if (!kampfzeitPause) {
    // Nicht sicher ob das so die sinnvollste Lösung ist.
    if (haltegriffPause) {
      haltegriffResetStatus = false;
      haltegriffPause = false;
      document.getElementById('haltegriffButtonToggle').innerHTML = "Haltegriff STOP";
      document.getElementById('haltegriffButtonWeiss').innerHTML = "Haltegriff Weiß (Nur Farbe)";
      document.getElementById('haltegriffButtonBlau').innerHTML = "Haltegriff Blau (Nur Farbe)";
    } else {
      haltegriffPause = true;
      document.getElementById('haltegriffButtonToggle').innerHTML = "Haltegriff LOS";
    }
  } else {
    haltegriffPause = true;
    document.getElementById('haltegriffButtonToggle').innerHTML = "Haltegriff LOS";
  }
}

function haltegriffWeiss() {
  if (haltegriffPause) { toggleHaltegriff(); }
  haltegriffSeite = 1;
}

function haltegriffBlau() {
  if (haltegriffPause) { toggleHaltegriff(); }
  haltegriffSeite = 2;
}

function haltegriffReset() {
  if (!haltegriffPause) { toggleHaltegriff(); }

  haltegriffzeit = 0;
  haltegriffSeite = 0;

  haltegriffAbgelaufenStatus = false;
  haltegriffResetStatus = true;
}

function setHaltegriffzeit(){
  var setHTime = prompt("Auf welche Zeit soll gesetzt werden? In Sekunden.");
  setHTime = Number(setHTime);
  haltegriffzeit = setHTime;
  if (setHTime < settings.settingHaltegriffzeit) {
    haltegriffAbgelaufenStatus = false;
  }
  refreshHaltegriffDisplay();
}

// Nächster Kampfzeit
function nextFight() {

  /* FÜR TESTZWECKE AUSSER BETRIEB
  var x = confirm("Wirklich nächsten Kampf starten?\nScoreboard wird zurückgesetzt.")

  if (!x) {return}
  */

  // Zeiten zurücksetzten
  kampfBegonnen = false;
  resetClock();
  haltegriffReset();
  resetScoreboard();
}

// KEY EVENT LISTENER

document.addEventListener('keydown', KeyCheck);

function KeyCheck(event) {

 var KeyID = event.keyCode;
 switch(KeyID)
 {
  case 32: //leertaste
    toggleKampfzeit(); break;
  case 46: //entfernen
    alert("delete"); break;
  case 72: //h
    toggleHaltegriff(); break;
  default:
    break;
 }
}
