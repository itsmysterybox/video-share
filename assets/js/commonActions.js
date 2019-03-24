$(document).ready(function() {

	$(".navShowHide").on("click", function() {

		var main = $("#mainSectionContainer");
		var nav = $("#sideNavContainer");

		if (main.hasClass("leftPadding")) {
			nav.hide();
		} else {
			nav.show();
		}

		main.toggleClass("leftPadding");

	});

});

function notSignedIn() {
	alert("You must be signed in to perform this action");
}

function createCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name,"",-1);
}

document.addEventListener('DOMContentLoaded',function(){

    if(readCookie('css')){
        var e = document.getElementById('themeMode');
        e.href = readCookie('css');
    }

    var themeModeText = document.getElementById('toggleTheme');
    themeModeText.addEventListener('click', function (event) {
        
        if (e.href.match("assets/css/style.css")) {
            e.href = "assets/css/dark.css";
            themeModeText.textContent = "LIGHT";
        }
        else {
            e.href = "assets/css/style.css";
            themeModeText.textContent = "DARK";
        }
        
        if(readCookie('css')){  
            eraseCookie('css');     
        }
        createCookie('css',e.href,365); 
        event.preventDefault(); 
    }, false);
})