var affiForma = document.getElementById('formationsSelection');

affiForma.addEventListener('change', function (e) {
    let httpRequest = new XMLHttpRequest();
    httpRequest.onreadystatechange = function(argument) {
        if (httpRequest.readyState === 4)
        document.getElementById('affichageResult').innerHTML = httpRequest.responseText;
    }
    httpRequest.open('GET', '../controleur/requeteAff.php?idFormation='+affiForma.value+'', true);
    httpRequest.send();
})