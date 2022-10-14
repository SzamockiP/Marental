function login () {
    document.getElementById("login").style.display = "grid";
    document.getElementById("dark").style.display = "block";
}

function register () {
    document.getElementById("register").style.display = "grid";
    document.getElementById("dark").style.display = "block";
}

function dark_onclick () {
    document.getElementById("login").style.display = "none";
    document.getElementById("register").style.display = "none";
    document.getElementById("dark").style.display = "none";
    document.getElementById("menu").style.transform = "translateX(-100%)";
}

function dark_onclick_profile () {
    document.getElementById("dark").style.display = "none";
    document.getElementById("menu").style.transform = "translateX(-100%)";
}

function menu () {
    document.getElementById("menu").style.transform = "translateX(0%)";
    document.getElementById("dark").style.display = "block";
}