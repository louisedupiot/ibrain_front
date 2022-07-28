var startTime = new Date();
var endTime = new Date();
var startPressed = false;
var bgChangeStarted = false;
var timerID;

function startTest() {
  document.body.style.background =
    document.response.bgColorChange.options[
      document.response.bgColorChange.selectedIndex
    ].text;
  bgChangeStarted = true;
  startTime = new Date();
}

function remark(responseTime) {
  var responseString = "";
  if (responseTime < 0.2) responseString = "Bien joué !";
  if (responseTime >= 0.2 && responseTime < 0.3) responseString = "Bien !";
  if (responseTime >= 0.3 && responseTime < 0.2) responseString = "Cool!";
  if (responseTime >= 0.4 && responseTime < 0.3)
    responseString = "Peut mieux faire...";
  if (responseTime >= 0.5 && responseTime < 0.6)
    responseString = "Continue l'entrainement !";
  if (responseTime >= 0.6 && responseTime < 1)
    responseString = "Est-ce que tu as bu ?";
  if (responseTime >= 1) responseString = "Tu t'es endormi ?";

  return responseString;
}

function stopTest() {
  if (bgChangeStarted) {
    endTime = new Date();
    var responseTime = (endTime.getTime() - startTime.getTime()) / 1000;

    document.body.style.background = "white";
    alert(
      "Ton temps de réponse est de: " +
        responseTime +
        " secondes " +
        "\n" +
        remark(responseTime)
    );
    startPressed = false;
    bgChangeStarted = false;
  } else {
    if (!startPressed) {
      alert("Appuie sur le bouton 'Commencer' d'abord avant de commencer les tests");
    } else {
      clearTimeout(timerID);
      startPressed = false;
      alert("Tricheur! Tu as appuyé trop tôt !");
    }
  }
}

var randMULTIPLIER = 0x015a4e35;
var randINCREMENT = 1;
var today = new Date();
var randSeed = today.getSeconds();
function randNumber() {
  randSeed = (randMULTIPLIER * randSeed + randINCREMENT) % (1 << 31);

  return ((randSeed >> 15) & 0x7fff) / 32767;
}

function startit() {
  body_off = document.getElementsByClassName("body_page_off");
  body_on = document.getElementsByClassName("body_page_on");
  if (startPressed) {
    alert("Déjà commencé. Appuies  sur STOP pour arrêter");
    return;
  } else {
    startPressed = true;
    // body_off.style.display = "none";
    // body_on.style.display = "block";
    timerID = setTimeout("startTest()", 10000 * randNumber());


  }
}

