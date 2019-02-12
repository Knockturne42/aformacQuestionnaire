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
    plus(repPlus, zonePlus);
});



function plus (target, parents) {
    target.addEventListener("click", function () {
        var reponse = document.createElement('div');
        reponse.setAttribute('class', "reponse");
        parents.insertBefore(reponse, target);
    });
};