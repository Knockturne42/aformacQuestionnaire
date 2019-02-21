var affiForma = document.getElementById('formationsSelection');

affiForma.addEventListener('change', function (e) {
    let httpRequest = new XMLHttpRequest();
    httpRequest.onreadystatechange = function(argument) {
        if (httpRequest.readyState === 4)
        document.getElementById('affichageResult').innerHTML = httpRequest.responseText;
    }
    console.log(e.target.value);
    httpRequest.open('GET', '../vue/affichageResultats.php?'+e.target.value, true);
    httpRequest.send();
})