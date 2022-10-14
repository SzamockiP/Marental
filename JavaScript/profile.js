function load () {
    document.getElementById("mainSection").style.height = "100%";
    document.querySelector("main").style.height = "1000px";
}

function btn1_onclick () {
    document.querySelectorAll("article")[0].style.display = "block";
    document.querySelectorAll("article")[1].style.display = "none";
    document.querySelectorAll("article")[2].style.display = "none";

    document.querySelectorAll("li")[21].style.background = "#f35a7a";
    document.querySelectorAll("li")[22].style.background = "#fff";
    document.querySelectorAll("li")[23].style.background = "#fff";

    document.getElementById("mainSection").style.height = "auto";
    document.querySelector("main").style.height = "1000px";
}

function btn2_onclick () {
    document.querySelectorAll("article")[0].style.display = "none";
    document.querySelectorAll("article")[1].style.display = "flex";
    document.querySelectorAll("article")[2].style.display = "none";

    document.querySelectorAll("li")[21].style.background = "#fff";
    document.querySelectorAll("li")[22].style.background = "#f35a7a";
    document.querySelectorAll("li")[23].style.background = "#fff";

    document.getElementById("mainSection").style.height = "auto";
    document.querySelector("main").style.height = "auto";
}

function btn3_onclick () {
    document.querySelectorAll("article")[0].style.display = "none";
    document.querySelectorAll("article")[1].style.display = "none";
    document.querySelectorAll("article")[2].style.display = "block";

    document.querySelectorAll("li")[21].style.background = "#fff";
    document.querySelectorAll("li")[22].style.background = "#fff";
    document.querySelectorAll("li")[23].style.background = "#f35a7a";

    document.getElementById("mainSection").style.height = "auto";
    document.querySelector("main").style.height = "1100px";
}