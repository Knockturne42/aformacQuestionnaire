var questionPosee = document.getElementById("questions");
var xhr = new XMLHttpRequest();

xhr.onreadystatechange = function()
{
	if(this.readyState === 4 && this.status === 200)
	{
		questionPosee.innerHTML = this.responseText;
	}
	else if(this.readyState === 4 && this.status === 404)
	{
		alert("Erreur 404");
	}
};

xhr.open("GET", "../vue/questions.txt", true);
// xhr.responseType = "text";
xhr.send();

