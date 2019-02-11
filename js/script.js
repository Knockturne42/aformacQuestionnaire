const ajouter = document.getElementById('ajout');

ajouter.addEventListener("click", function () {
    console.log('coucou');
    var makeInput = document.createElement('div');
    makeInput.setAttribute('class', "question");
    ajouter.appendChild(makeInput);
    makeInput.style.height = "150" + "px";
    makeInput.style.width = "150" + "px";
    makeInput.style.backgroundColor = "blue";
})