// method to fill the Table
function fillAcceptTable(){
    var table = document.getElementById("neueBeitraege");
    var array = getData();

    var i,j;            
    while(table.rows.length > 1){
        table.doleteRow(1);
    }
    for(i = 0; i < array.length; i++)
    {
        // create a new row <tr>
        var newRow = table.insertRow(table.length);
        for(j = 0; j < array[i].length; j++)
        {
            // create a new cell <td>
            var cell = newRow.insertCell(j);
            if(j == 0){/*Titel */
                cell.setAttribute("width", "40%");   
            }else if(j == 2){/*Kategorie */
                cell.setAttribute("width", "10%"); 
            }else if(j == 3){/*Datum */
                cell.setAttribute("width", "10%");
            }
            // add value to the cell
            cell.innerHTML = array[i][j];
        }
        // creates an acception button on the penultimate place of the row
        var acpCell = newRow.insertCell(j);
        acpCell.setAttribute("width", "5%");
        acpCell.innerHTML = "<form><input type=\"submit\" class=\"neueBeitrCheck\"><i class=\"fa fa-check\"></i></button></form>";
        
        // creates a delete button at the end of the row
        var delCell = newRow.insertCell(j+1);
        delCell.setAttribute("width", "5%");
        delCell.innerHTML = "<button onclick=\"deleteBeitrag(" + i + ")\" class=\"neueBeitrDel\"><i class=\"fa fa-times\"></i></button>";
    }
}

// Akzeptiert den Beitrag und fügt ihn der Datenbank hinzu
function acceptBeitrag(row){
    //TODO: beitrag annehmen
    
    fillAcceptTable();

}

// Löscht den Beitrag. 
//Evtl. noch benachrichtigung an den Nutzer das der Beitrag verworfen wurde.
function deleteBeitrag(row){
    //TODO: beitrag löschen
    
    fillAcceptTable();
}

// method to fill the table from suchergebnis.html
function fillSearchResultTable(){
    // select the table to fill
    var table = document.getElementById("searchResult");
    // array of data
    var array = getData();

    // counter for the for-loop
    var i,j;            

    for(i = 0; i < array.length; i++)
    {
        // create a new row <tr>
        var newRow = table.insertRow(table.length);
        for(j = 0; j < array[i].length; j++)
        {
            // create a new cell <td>
            var cell = newRow.insertCell(j);
            if(j == 0){/*Titel */
                cell.setAttribute("width", "45%");   
            }else if(j == 2){/*Kategorie */
                cell.setAttribute("width", "10%"); 
            }else if(j == 3){/*Datum */
                cell.setAttribute("width", "10%");
            }
            // add value to the cell
            cell.innerHTML = array[i][j];
        }
    }
}

// Get Data from Database
// TODO Diese function muss die Daten aus einer Datenbank ziehen und dann returnen
function getData(){
    var data = [["<a href=\"beitrag.html\">Ambulanz</a>","<a href=\"nutzerProfil.html\">Dr. Gretel Dingens</a>","<a href=\"basketball.html\">Basketball</a>","<a href=\"archiv.html\">12.05.2018</a>"],
                ["<a href=\"beitrag.html\">Beitrag</a>","<a href=\"nutzerProfil.html\">Dr. Max Bustermann</a>","<a href=\"fussball.html\">Fußball</a>","<a href=\"archiv.html\">22.05.2018</a>"]]
    return data;
}