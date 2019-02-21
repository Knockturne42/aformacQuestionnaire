
var selectVille = document.getElementById("selectVille");

selectVille.addEventListener("change", function(){
	let httpRequest = new XMLHttpRequest();
	httpRequest.onreadystatechange = function(){
		if (httpRequest.readyState == 4)
		document.getElementById('afficheSelect').innerHTML = httpRequest.responseText;
	}

httpRequest.open('GET', '../vue/select.php?idVille='+ selectVille.value +'' , true);
httpRequest.send();


setTimeout(function(){
var afficheApprenant = document.getElementById("select");
afficheApprenant.addEventListener("change", function(){
	let httpRequest = new XMLHttpRequest();
	httpRequest.onreadystatechange = function(){
		if (httpRequest.readyState == 4)
		document.getElementById('afficheResultatApprenant').innerHTML = httpRequest.responseText;
	}

httpRequest.open('GET', '../vue/afficheApprenant.php?idSelectFormation='+ afficheApprenant.value +'' , true);
httpRequest.send();

});
}, 500); });