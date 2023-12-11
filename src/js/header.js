var imgSet = false;
var imgIndex = 1;
var smallSizeToggle = false;
var largeSizeToggle = false;
function setRndBG(){
    if(!imgSet){ 
        imgIndex = Math.floor((Math.random() * 30) + 1);
        imgSet = true;

        if(imgIndex > 15){
            document.getElementById("headerTitle").style.color = "black";
        }else{
            document.getElementById("headerTitle").style.color = "white";
        }
    }

    if((largeSizeToggle || !smallSizeToggle) && window.innerWidth < 1000){
        document.getElementById("headerTitle").style.background = "url(../materials/img/sport" + imgIndex + ".jpg) no-repeat 50% 50% / 1000px";
        largeSizeToggle = false;
        smallSizeToggle = true;
    }else if((!largeSizeToggle || smallSizeToggle) && window.innerWidth >= 1000){
        document.getElementById("headerTitle").style.background = "url(../materials/img/sport" + imgIndex + ".jpg) no-repeat 50% 50% / 100%";
        largeSizeToggle = true;
        smallSizeToggle = false;
    }
}

var toggle = false;
function toggleBG(){
    if(!toggle){
        if(window.innerWidth < 1000){
            document.getElementById("headerTitle").style.padding = "80px 0 100px 0";
        }else{
            document.getElementById("headerTitle").style.padding = "200px 0 240px 0";
        }
        toggle = true;
    }else{
        if(window.innerWidth < 750){
            document.getElementById("headerTitle").style.padding = "0 0 20px 0";
        }else{
            document.getElementById("headerTitle").style.padding = "0 0 45px 0";
        }
        toggle = false;
    }
}