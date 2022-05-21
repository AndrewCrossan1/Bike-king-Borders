var images = [];

function GetCookie(CookieName) {
    let cookies = document.cookie.split(';');
    for (let x = 0; x<cookies.length; x++) {
        let c = cookies[x];
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
    let date = Date.now();
    let today = new Date(date);
    if (GetCookie("VisitingTime=") != today.toUTCString()) {
        document.cookie = `VisitingTime=${today.toUTCString()}`;
    }
    $.getJSON("https://api.ipify.org?format=json", function(data) {
        if (GetCookie("IP=") !=data.ip) {
            document.cookie = `IP=${data.ip}`;
        }
    });
}

function SetClickedPhotoURL(URL, ImageID) {
    //Check if item is already set
    for (let x = 0; x<images.length; x++) {
        if (images[x][0] == ImageID) {
            console.log("Image already added");
            //Cancel function
            return;
        }
    }
    images.push([ImageID, URL]);
    window.sessionStorage.setItem("images", JSON.stringify(images));
}

