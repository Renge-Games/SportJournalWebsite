var months = ["Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember"];

function setMonthOnTopList(){
    var d = new Date();
    var m = d.getMonth() - 1; //der letzte monat
    if(m < 0) m = 11;
    document.getElementById("topText").innerHTML = "Vom " + months[m];
}

function setThisActive(element){
    element = element.parentElement.parentElement;
    if(element.className.includes("col-lg-9"))
        return;
    
    var other = document.getElementsByClassName("col-lg-9")[0];
    other.className = "col-12 col-lg-3";
    element.className = "col-12 col-lg-9";
}
