function setCookie( cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = "UniProjekt" + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
     for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return " ";
}

function checkCookie() {
    //document.getElementById("cookieNotification").style.display = "none";
    if(getCookie("UniProjekt") == "" || getCookie.value != true){
        //dialog();
    }
}

function dialog() {
    var Eingabe;
    Eingabe=confirm ("Um unsere Webseite für Sie optimal zu gestalten und fortlaufend verbessern zu können, verwenden wir Cookies. Durch OK stimmen Sie der Verwendung von Cookies zu." +
        "Falls Sie weitere Informationen zu Cookies erfahren wollen klicken sie hier.");
    if (Eingabe==true) {
        //self.location.href="datenschutz.html";
        setCookie(true, 3);
    }
    else {}
}
