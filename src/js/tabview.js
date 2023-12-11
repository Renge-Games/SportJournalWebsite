function hideAllUnactive(){
	var arr = document.getElementsByClassName("tabView")[0].getElementsByClassName("button");
	for (var i = 0; i < arr.length; i++){
		if(!arr[i].className.includes("selected")){
			var view = document.getElementsByClassName(arr[i].className.replace("button", '').replace(/\s+/g, ''));
			for (var j = 1; j < view.length; j++){
				view[j].style.display = "none";
			}
		}
	}
}

function makeTabActive(element){
	var currSel = document.getElementsByClassName("tabView")[0].getElementsByClassName("selected")[0];
	currSel.className = currSel.className.replace("selected", '');

	var viewName = currSel.className.replace("button", '').replace(/\s+/g, '');
	var view = document.getElementsByClassName(viewName);
	for (var i = 1; i < view.length; i++){
		view[i].style.display = "none";
	}

	viewName = element.className.replace("button", '').replace(/\s+/g, '');
	var view = document.getElementsByClassName(viewName);
	for (var i = 1; i < view.length; i++){
		view[i].style.display = "block";
	}

	if(element.className.includes("button")){
		element.className += " selected";
	}
}