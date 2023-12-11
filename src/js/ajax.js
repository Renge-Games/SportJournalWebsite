function adminRefresh(){
    var element = document.getElementsByClassName("selected")[0];
    var xhttp = new XMLHttpRequest();

    checkItemCount(element, xhttp);

    setInterval(function(){
        checkItemCount(element, xhttp);
        
    }, 5000);

    xhttp.onreadystatechange = function(){
        if(xhttp.readyState == 4 && this.status == 200){
            if(xhttp.responseText == "updateRequired"){
                element.innerHTML = element.id + " <i class=\"fas fa-sync-alt\" style=\"font-size:0.8em;\"></i>";
            }else{
                element.innerHTML = element.id;
            }
        }
    };
}

function checkItemCount(element, xhttp){
    if(element.className.includes("view1")){
        //document.write("../php/checkItemCount.php?from=1&count=" + (document.getElementById("neueBeitraege").getElementsByTagName("TR").length - 1));
        xhttp.open("GET", "../php/checkItemCount.php?from=1&count=" + (document.getElementById("neueBeitraege").getElementsByTagName("TR").length - 1), true);
        xhttp.send();
    }else if(element.className.includes("view2")){
        //document.write((document.getElementById("akzeptierteBeitraege").getElementsByTagName("TR").length - 1));
        xhttp.open("GET", "../php/checkItemCount.php?from=2&count=" + (document.getElementById("akzeptierteBeitraege").getElementsByTagName("TR").length - 1), true);
        xhttp.send();
    }else if(element.className.includes("view3")){
        //document.write((document.getElementById("alleNutzer").getElementsByTagName("TR").length - 1));
        xhttp.open("GET", "../php/checkItemCount.php?from=3&count=" + (document.getElementById("alleNutzer").getElementsByTagName("TR").length - 1), true);
        xhttp.send();
    }
}

function includeHTML() {
	var z, i, elmnt, file, xhttp;
	/*loop through a collection of all HTML elements:*/
	z = document.getElementsByTagName("*");
	for (i = 0; i < z.length; i++) {
		elmnt = z[i];
		/*search for elements with a certain atrribute:*/
		file = elmnt.getAttribute("it-include-html");
		if (file) {
			/*make an HTTP request using the attribute value as the file name:*/
			xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function () {
				if (this.readyState == 4) {
					if (this.status == 200) { elmnt.innerHTML = this.responseText; }
					if (this.status == 404) { elmnt.innerHTML = "HTML nicht gefunden."; }
					/*remove the attribute, and call this function once more:*/
					elmnt.removeAttribute("it-include-html");
					includeHTML();
				}
			}
			xhttp.open("GET", file, true);
			xhttp.send();
			/*exit the function:*/
			return;
		}
	}
}