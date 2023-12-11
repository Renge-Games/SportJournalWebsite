var toggleTitle = false;
var toggleAuthor = false;
var toggleKat = false;
var toggleDate = false;
var toggleViews = false;

function toggleOrderByName(element){
    toggleTitle = !toggleTitle;
    toggleAuthor = false;
    toggleKat = false;
    toggleDate = false;
    toggleViews = false;
    //      <th>    <tr>            <tbody>     <table>
    var id = element.parentElement.parentElement.parentElement.id;
    if(toggleTitle){
        document.getElementById(id).getElementsByClassName("orderedListTitle")[0].innerHTML = "Titel <i class=\"fas fa-caret-down\"></i>";
        document.getElementById(id).getElementsByClassName("orderedListAuthor")[0].innerHTML = "Autor";
        document.getElementById(id).getElementsByClassName("orderedListKat")[0].innerHTML = "Kategorie";
        document.getElementById(id).getElementsByClassName("orderedListDate")[0].innerHTML = "Datum";
        document.getElementById(id).getElementsByClassName("orderedListViews")[0].innerHTML = "Views";
    }else{
        document.getElementById(id).getElementsByClassName("orderedListTitle")[0].innerHTML = "Titel <i class=\"fas fa-caret-up\"></i>";
        document.getElementById(id).getElementsByClassName("orderedListAuthor")[0].innerHTML = "Autor";
        document.getElementById(id).getElementsByClassName("orderedListKat")[0].innerHTML = "Kategorie";
        document.getElementById(id).getElementsByClassName("orderedListDate")[0].innerHTML = "Datum";
        document.getElementById(id).getElementsByClassName("orderedListViews")[0].innerHTML = "Views";
    }

    sortAlphabetically(0, id);
}

function toggleOrderByAuthor(element){
    toggleTitle = false;
    toggleAuthor = !toggleAuthor;
    toggleKat = false;
    toggleDate = false;
    toggleViews = false;
    //      <th>    <tr>            <tbody>     <table>
    var id = element.parentElement.parentElement.parentElement.id;
    if(toggleAuthor){
        document.getElementById(id).getElementsByClassName("orderedListTitle")[0].innerHTML = "Titel";
        document.getElementById(id).getElementsByClassName("orderedListAuthor")[0].innerHTML = "Autor <i class=\"fas fa-caret-down\"></i>";
        document.getElementById(id).getElementsByClassName("orderedListKat")[0].innerHTML = "Kategorie";
        document.getElementById(id).getElementsByClassName("orderedListDate")[0].innerHTML = "Datum";
        document.getElementById(id).getElementsByClassName("orderedListViews")[0].innerHTML = "Views";
    }else{
        document.getElementById(id).getElementsByClassName("orderedListTitle")[0].innerHTML = "Titel";
        document.getElementById(id).getElementsByClassName("orderedListAuthor")[0].innerHTML = "Autor <i class=\"fas fa-caret-up\"></i>";
        document.getElementById(id).getElementsByClassName("orderedListKat")[0].innerHTML = "Kategorie";
        document.getElementById(id).getElementsByClassName("orderedListDate")[0].innerHTML = "Datum";
        document.getElementById(id).getElementsByClassName("orderedListViews")[0].innerHTML = "Views";
    }

    sortAlphabetically(1, id);
}

function toggleOrderByKat(element){
    toggleTitle = false;
    toggleAuthor = false;
    toggleKat = !toggleKat;
    toggleDate = false;
    toggleViews = false;
    //      <th>    <tr>            <tbody>     <table>
    var id = element.parentElement.parentElement.parentElement.id;
    if(toggleKat){
        document.getElementById(id).getElementsByClassName("orderedListTitle")[0].innerHTML = "Titel";
        document.getElementById(id).getElementsByClassName("orderedListAuthor")[0].innerHTML = "Autor";
        document.getElementById(id).getElementsByClassName("orderedListKat")[0].innerHTML = "Kategorie <i class=\"fas fa-caret-down\"></i>";
        document.getElementById(id).getElementsByClassName("orderedListDate")[0].innerHTML = "Datum";
        document.getElementById(id).getElementsByClassName("orderedListViews")[0].innerHTML = "Views";
    }else{
        document.getElementById(id).getElementsByClassName("orderedListTitle")[0].innerHTML = "Titel";
        document.getElementById(id).getElementsByClassName("orderedListAuthor")[0].innerHTML = "Autor";
        document.getElementById(id).getElementsByClassName("orderedListKat")[0].innerHTML = "Kategorie <i class=\"fas fa-caret-up\"></i>";
        document.getElementById(id).getElementsByClassName("orderedListDate")[0].innerHTML = "Datum";
        document.getElementById(id).getElementsByClassName("orderedListViews")[0].innerHTML = "Views";
    }

    sortAlphabetically(2, id);
}

function toggleOrderByDate(element){
    toggleTitle = false;
    toggleAuthor = false;
    toggleKat = false;
    toggleDate = !toggleDate;
    toggleViews = false;
    //      <th>    <tr>            <tbody>     <table>
    var id = element.parentElement.parentElement.parentElement.id;
    if(toggleDate){
        document.getElementById(id).getElementsByClassName("orderedListTitle")[0].innerHTML = "Titel";
        document.getElementById(id).getElementsByClassName("orderedListAuthor")[0].innerHTML = "Autor";
        document.getElementById(id).getElementsByClassName("orderedListKat")[0].innerHTML = "Kategorie";
        document.getElementById(id).getElementsByClassName("orderedListDate")[0].innerHTML = "Datum <i class=\"fas fa-caret-down\"></i>";
        document.getElementById(id).getElementsByClassName("orderedListViews")[0].innerHTML = "Views";
    }else{
        document.getElementById(id).getElementsByClassName("orderedListTitle")[0].innerHTML = "Titel";
        document.getElementById(id).getElementsByClassName("orderedListAuthor")[0].innerHTML = "Autor";
        document.getElementById(id).getElementsByClassName("orderedListKat")[0].innerHTML = "Kategorie";
        document.getElementById(id).getElementsByClassName("orderedListDate")[0].innerHTML = "Datum <i class=\"fas fa-caret-up\"></i>";
        document.getElementById(id).getElementsByClassName("orderedListViews")[0].innerHTML = "Views";
    }

    sortAlphabetically(3, id);
}

function toggleOrderByViews(element){
    toggleTitle = false;
    toggleAuthor = false;
    toggleKat = false;
    toggleDate = false;
    toggleViews = !toggleViews;
    //      <th>    <tr>            <tbody>     <table>
    var id = element.parentElement.parentElement.parentElement.id;
    if(toggleViews){
        document.getElementById(id).getElementsByClassName("orderedListTitle")[0].innerHTML = "Titel";
        document.getElementById(id).getElementsByClassName("orderedListAuthor")[0].innerHTML = "Autor";
        document.getElementById(id).getElementsByClassName("orderedListKat")[0].innerHTML = "Kategorie";
        document.getElementById(id).getElementsByClassName("orderedListDate")[0].innerHTML = "Datum";
        document.getElementById(id).getElementsByClassName("orderedListViews")[0].innerHTML = "Views <i class=\"fas fa-caret-down\"></i>";
    }else{
        document.getElementById(id).getElementsByClassName("orderedListTitle")[0].innerHTML = "Titel";
        document.getElementById(id).getElementsByClassName("orderedListAuthor")[0].innerHTML = "Autor";
        document.getElementById(id).getElementsByClassName("orderedListKat")[0].innerHTML = "Kategorie";
        document.getElementById(id).getElementsByClassName("orderedListDate")[0].innerHTML = "Datum";
        document.getElementById(id).getElementsByClassName("orderedListViews")[0].innerHTML = "Views <i class=\"fas fa-caret-up\"></i>";
    }

    sortAlphabetically(4, id);
}

function toggleOrderByUsername(element){
    toggleTitle = !toggleTitle;
    toggleAuthor = false;
    toggleKat = false;
    //      <th>    <tr>            <tbody>     <table>
    var id = element.parentElement.parentElement.parentElement.id;
    if(toggleTitle){
        document.getElementById(id).getElementsByClassName("orderedListTitle")[0].innerHTML = "Nutzer Name <i class=\"fas fa-caret-down\"></i>";
        document.getElementById(id).getElementsByClassName("orderedListAuthor")[0].innerHTML = "Name";
        document.getElementById(id).getElementsByClassName("orderedListKat")[0].innerHTML = "Admin";
    }else{
        document.getElementById(id).getElementsByClassName("orderedListTitle")[0].innerHTML = "Nutzer Name <i class=\"fas fa-caret-up\"></i>";
        document.getElementById(id).getElementsByClassName("orderedListAuthor")[0].innerHTML = "Name";
        document.getElementById(id).getElementsByClassName("orderedListKat")[0].innerHTML = "Admin";
    }

    sortAlphabetically(0, id);
}

function toggleOrderByAuthorName(element){
    toggleTitle = false;
    toggleAuthor = !toggleAuthor;
    toggleKat = false;
    //      <th>    <tr>            <tbody>     <table>
    var id = element.parentElement.parentElement.parentElement.id;
    if(toggleAuthor){
        document.getElementById(id).getElementsByClassName("orderedListTitle")[0].innerHTML = "Nutzer Name";
        document.getElementById(id).getElementsByClassName("orderedListAuthor")[0].innerHTML = "Name <i class=\"fas fa-caret-down\"></i>";
        document.getElementById(id).getElementsByClassName("orderedListKat")[0].innerHTML = "Admin";
    }else{
        document.getElementById(id).getElementsByClassName("orderedListTitle")[0].innerHTML = "Nutzer Name";
        document.getElementById(id).getElementsByClassName("orderedListAuthor")[0].innerHTML = "Name <i class=\"fas fa-caret-up\"></i>";
        document.getElementById(id).getElementsByClassName("orderedListKat")[0].innerHTML = "Admin";
    }

    sortAlphabetically(1, id);
}

function toggleOrderByAdmin(element){
    toggleTitle = false;
    toggleAuthor = false;
    toggleKat = !toggleKat;
    //      <th>    <tr>            <tbody>     <table>
    var id = element.parentElement.parentElement.parentElement.id;
    if(toggleKat){
        document.getElementById(id).getElementsByClassName("orderedListTitle")[0].innerHTML = "Nutzer Name";
        document.getElementById(id).getElementsByClassName("orderedListAuthor")[0].innerHTML = "Name";
        document.getElementById(id).getElementsByClassName("orderedListKat")[0].innerHTML = "Admin <i class=\"fas fa-caret-down\"></i>";
    }else{
        document.getElementById(id).getElementsByClassName("orderedListTitle")[0].innerHTML = "Nutzer Name";
        document.getElementById(id).getElementsByClassName("orderedListAuthor")[0].innerHTML = "Name";
        document.getElementById(id).getElementsByClassName("orderedListKat")[0].innerHTML = "Admin <i class=\"fas fa-caret-up\"></i>";
    }

    sortAlphabetically(2, id);
}

function sortAlphabetically(column, id){
    var table, rows, switching, i, x, y, arrX, arrY, shouldSwitch;
    table = document.getElementById(id);
    switching = true;
    while(switching){
        switching = false;
        rows = table.getElementsByTagName("TR");
        for(i = 1; i < rows.length - 1; i++){
            shouldSwitch = false;
            
            arrX = rows[i].getElementsByTagName("TD")[column].getElementsByTagName("A");
            arrY = rows[i+1].getElementsByTagName("TD")[column].getElementsByTagName("A");
            if(arrX.length == 0 || arrY.length == 0){
                x = rows[i].getElementsByTagName("TD")[column].innerHTML;
                y = rows[i+1].getElementsByTagName("TD")[column].innerHTML;
            }else{
                x = arrX[0].innerHTML;
                y = arrY[0].innerHTML;
            }
            
            if(column == 0 || column == 2){//titel oder kategorie
                if((column == 0 && toggleTitle || column == 2 && toggleKat) && x.toLowerCase() > y.toLowerCase()){
                    shouldSwitch = true;
                    break;
                }else if((column == 0 && !toggleTitle || column == 2 && !toggleKat) && x.toLowerCase() < y.toLowerCase()){
                    shouldSwitch = true;
                    break;
                }
            }else if(column == 1){//autor -> nach nachname sortieren
                var arrX = x.split(" ");
                var arrY = y.split(" ");
                x = arrX[arrX.length - 1];
                y = arrY[arrY.length - 1];

                if(toggleAuthor && x.toLowerCase() > y.toLowerCase()){
                    shouldSwitch = true;
                    break;
                }else if(!toggleAuthor && x.toLowerCase() < y.toLowerCase()){
                    shouldSwitch = true;
                    break;
                }
            }else if(column == 3){//datum
                var arrX = x.split("-");
                var arrY = y.split("-");
                arrX[2] = arrX[2].split(" ")[0];
                arrY[2] = arrY[2].split(" ")[0];

                var timeArrX = x.split(" ")[1].split(":");
                var timeArrY = y.split(" ")[1].split(":");

                if(toggleDate){
                    if(Number(arrX[0]) > Number(arrY[0])){
                        shouldSwitch = true;
                        break;
                    }
                    else if(Number(arrX[0]) == Number(arrY[0]) && Number(arrX[1]) > Number(arrY[1])){
                        shouldSwitch = true;
                        break;
                    }
                    else if(Number(arrX[0]) == Number(arrY[0]) && Number(arrX[1]) == Number(arrY[1]) && Number(arrX[2]) > Number(arrY[2])){
                        shouldSwitch = true;
                        break;
                    }else if(Number(arrX[0]) == Number(arrY[0]) && Number(arrX[1]) == Number(arrY[1]) && Number(arrX[2]) == Number(arrY[2]) && 
                            Number(timeArrX[0]) > Number(timeArrY[0])){
                        shouldSwitch = true;
                        break;
                    }else if(Number(arrX[0]) == Number(arrY[0]) && Number(arrX[1]) == Number(arrY[1]) && Number(arrX[2]) == Number(arrY[2]) && 
                            Number(timeArrX[0]) == Number(timeArrY[0]) && Number(timeArrX[1]) > Number(timeArrY[1])){
                        shouldSwitch = true;
                        break;
                    }
                }else{
                    if(Number(arrX[0]) < Number(arrY[0])){
                        shouldSwitch = true;
                        break;
                    }
                    else if(Number(arrX[0]) == Number(arrY[0]) && Number(arrX[1]) < Number(arrY[1])){
                        shouldSwitch = true;
                        break;
                    }
                    else if(Number(arrX[0]) == Number(arrY[0]) && Number(arrX[1]) == Number(arrY[1]) && Number(arrX[2]) < Number(arrY[2])){
                        shouldSwitch = true;
                        break;
                    }else if(Number(arrX[0]) == Number(arrY[0]) && Number(arrX[1]) == Number(arrY[1]) && Number(arrX[2]) == Number(arrY[2]) && 
                            Number(timeArrX[0]) < Number(timeArrY[0])){
                        shouldSwitch = true;
                        break;
                    }else if(Number(arrX[0]) == Number(arrY[0]) && Number(arrX[1]) == Number(arrY[1]) && Number(arrX[2]) == Number(arrY[2]) && 
                            Number(timeArrX[0]) == Number(timeArrY[0]) && Number(timeArrX[1]) < Number(timeArrY[1])){
                        shouldSwitch = true;
                        break;
                    }
                }
            }else if(column == 4){//Views
                if(toggleViews){
                    if(Number(x) > Number(y)){
                        shouldSwitch = true;
                        break;
                    }
                }else{
                    if(Number(x) < Number(y)){
                        shouldSwitch = true;
                        break;
                    }
                }
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
        }
    }
}