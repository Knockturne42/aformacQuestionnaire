var	checkbox = document.getElementById('checkFormation');

checkbox.addEventListener('click', function(e){
	let httpRequest = new XMLHttpRequest();
	httpRequest.onreadystatechange = function(argument) {
		if (httpRequest.readyState === 4)
			document.getElementById('formation').innerHTML = httpRequest.responseText;
	}
	httpRequest.open('GET', '../controleur/test.php?formation='++'', true);
	httpRequest.send();
});