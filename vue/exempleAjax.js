var logo = document.getElementById('logo');

logo.addEventListener('click', function() // Lorque l'on clic ...
{
	var httpRequest = new XMLHttpRequest(); // Instancie un nouvel objet HttpRequest

	httpRequest.onreadystatechange = function (argument)
	{
		if (httpRequest.readyState === 4)
			document.getElementById('main').innerHTML = httpRequest.responseText;
	}

	httpRequest.open('GET', './Vue/main.php', true);
	httpRequest.send();

	setTimeout(function()
	{
		initGenerator();initRange();
	}, 500);
});