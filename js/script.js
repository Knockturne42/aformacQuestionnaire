const repPlus = document.getElementsByClassName("repPlus");
var rep = document.getElementsByClassName('reponse');
var test = document.getElementById("toto");
const zoneQuestPlus = document.getElementsByClassName('zoneQuestPlus');
const zoneQuestRep = document.getElementById('zoneQuestRep');
plus(repPlus[0], test);

zoneQuestPlus[0].addEventListener("click", function () {
    var zonePlus = document.createElement('div');
    zonePlus.setAttribute('id', "toto");
    zoneQuestRep.insertBefore(zonePlus, null);

    var question = document.createElement('div');
    question.setAttribute('class', "question");
    zonePlus.appendChild(question);

    var reponse = document.createElement('div');
    reponse.setAttribute('class', "reponse");
    zonePlus.appendChild(reponse);

    var repPlus = document.createElement('div');
    repPlus.setAttribute('class', "repPlus");
    zonePlus.appendChild(repPlus);
    repPlus.innerHTML = '+';
    plus(repPlus, zonePlus);
});



function plus (target, parents) {
    target.addEventListener("click", function () {
        var reponse = document.createElement('div');
        reponse.setAttribute('class', "reponse");
        parents.insertBefore(reponse, target);
    });
};

question.addEventListener('click', function(e){
    var httpRequest = new XMLHttpRequest();
    httpRequest.onreadystatechange = function (argument) {
        if (httpRequest.readyState === 4)
            document.getElementById('objetContent').innerHTML = httpRequest.responseText;
    }
    httpRequest.open('GET', './vue/question.php?askDiv=question', true);
    httpRequest.send();
});

zonePlus.addEventListener('click', function(e){
    var httpRequest = new XMLHttpRequest();
    httpRequest.onreadystatechange = function (argument) {
        if (httpRequest.readyState === 4)
            document.getElementById('objetContent').innerHTML = httpRequest.responseText;
    }
    httpRequest.open('GET', './vue/question.php?askDiv=reponses&typeInp=', true);
    httpRequest.send();
});