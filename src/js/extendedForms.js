function squDropdown(id){
    var parentArr, parent, dropdown;
    parentArr = document.getElementsByClassName("formDropdownElement" + id);
    
    for(var i = 0; i < parentArr.length; i++){
        parent = parentArr[i];
        dropdown = parent.getElementsByClassName("formInput")[0];
        parent.setAttribute("style", "border-radius: 10px 10px 5px 10px;");
        dropdown.setAttribute("style", "border-radius: 5px 0 0 0;");
        
    }
}

function rndDropdown(id){
    var parentArr, parent, dropdown;
    parentArr = document.getElementsByClassName("formDropdownElement" + id);
    
    for(var i = 0; i < parentArr.length; i++){
        parent = parentArr[i];
        dropdown = parent.getElementsByClassName("formInput")[0];
        parent.setAttribute("style", "border-radius: 10px 10px 10px 10px;");
        dropdown.setAttribute("style", "border-radius: 5px 0 0 5px;");
        
    }
}