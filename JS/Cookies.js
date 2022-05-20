function GetCookie(CookieName) {
    let cookies = document.cookie.split(';');
    for (let x = 0; x<cookies.length; x++) {
        let c = ca[i];
        while (c.charAt(0) == " ") {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(CookieName.length, c.length);
        }
    }
    return null;
}

function SetCookies() {
    if (GetCookie("VisitingTime=") == null) {
        let date = Date.now();
        let today = new Date(date);
        document.cookie = `VisitingTime=${today.toUTCString()}`;
    }
    if (GetCookie("IP=") == null) {
        /* Add "https://api.ipify.org?format=json" statement
                 this will communicate with the ipify servers in
                 order to retrieve the IP address $.getJSON will
                 load JSON-encoded data from the server using a
                 GET HTTP request */
        $.getJSON("https://api.ipify.org?format=json", function(data) {
            document.cookie = `IP=${data.ip}`
        });
    }
}

function SetClickedPhotoURL(URL, ImageID) {
    //Check if item is already set
    if (window.sessionStorage.getItem(ImageID) != null) {
        console.log(window.sessionStorage.getItem(ImageID));
        console.log("Already set");
    } else {
        //Set session item
        window.sessionStorage.setItem(ImageID, URL);
    }
}
function GetClickedPhotoURL(ImageID) {
    let URL = window.sessionStorage.getItem(ImageID);
    return URL;
}
