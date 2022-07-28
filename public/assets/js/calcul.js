let number1 = 1;
let number2 = 2;
let userInput = 0;
let result = 0;
let expression = '';
let level = 0;
let randomRange = 0;
let score = 0;
let counter = 0;

function setExpression(ex){
    expression = ex.value;
    startTestQuestion();
}

function setLevel(lev){
    level = lev.value;
    switch(level){
      case '1':
        randomRange = 11;
        break;
      case '2':
        randomRange = 101;
        break;
      case '3':
        randomRange = 1001;
        break;
    }
    startTestQuestion();
  }

function startTestQuestion(){
  if(expression != '' && level > 0){
    calculateTest();
  }
  showScoreInformation();
}

function showScoreInformation(){
    document.getElementById('score').innerHTML=`
    <p class="m-0">Question : ${counter+1}/10</p>
    <p class="m-0">Score : ${score}/10</p>
    <p class="m-0">Expression : ${expression} </p>
    <p class="m-0">Niveau : ${level}</p>
    
    `;
  }

  function calculateTest(){
 
    document.getElementById('result').innerHTML='';
   
    number1 = Math.floor(Math.random()*(randomRange));
    number2 = Math.floor(Math.random()*(randomRange));
   
    switch(expression){
      case '+':
        result = number1 + number2;
        break;
      case '-':
        result = number1 - number2;
        break;
      case 'x': 
        result = number1 * number2;
        break;
    };
    testQuestion();
  }

  function testQuestion(){
 
    //hide level and expression option
    document.getElementById('levelSetup').innerHTML='';
   
    //show math question
    document.getElementById('Calcul').innerHTML= `
    <div class="input-group input-group-lg p-5">
      <div class="input-group-prepend">
        <span class="input-group-text" style="font-size: 40px;">${number1} ${expression} ${number2} =</span>
      </div>
      <input type="number" id="playerInput" class="form-control" style="font-size: 40px;">
      <div class="input-group-append">
        <button class="btn btn-success" style="font-size: 30px;" onclick="setUserInput()">Valider</button>
        <button style="font-size: 30px;" onclick="location.reload()">Retour</button>

      </div>
    </div>
    `;
  }

  function setUserInput(){
    let inputUserResult = parseFloat(document.getElementById('playerInput').value);
    console.log(inputUserResult);
    if(!isNaN(inputUserResult)){
      userInput = inputUserResult;
      checkUserResult();
    }else{
      alert('Pas de nombre !')
    }
  }

function checkUserResult(){
document.getElementById('Calcul').innerHTML='';
if (userInput == result.toFixed(2)){
    document.getElementById('result').innerHTML=`
    <div class="p-5">
    <div class="p-3 text-center bg-success text-white" style="font-size: 40px;">${number1} ${expression} ${number2} = ${userInput} Bien joué !</div>
    </div>
    `;
    score++;
}else {
    document.getElementById('result').innerHTML=`
    <div class="p-5">
    <div class="p-3 text-center bg-danger text-white" style="font-size: 40px;">${number1} ${expression} ${number2} = ${userInput} est une mauvaise réponse, la bonne est ${result} !</div>
    </div>
    `;
}
counter++;
showScoreInformation();
if(counter < 10){
setTimeout(calculateTest,3000)
}else{
    document.getElementById('score').innerHTML='';
    document.getElementById('result').innerHTML=`
    <div class="p-5">
    <div class="p-3 text-center bg-warning text-white" style="font-size: 40px;">Test terminé : ton score est de ${score}/10</div>
    </div>
    `;
}
}