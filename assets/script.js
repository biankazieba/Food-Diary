
window.onscroll = function () { scrollFunction() };

function scrollFunction() {
    if (document.body.scrollTop > 60 || document.documentElement.scrollTop > 60) {
        document.getElementById("navbar").style.padding = "10px 10px";
        document.getElementById("navbar").style.boxShadow = "0px 1px 15px -4px #000000";
        document.getElementById("logo").style.fontSize = "5px";
    } else {
        document.getElementById("navbar").style.padding = " 25px 10px";
        document.getElementById("navbar").style.boxShadow = "none";
        document.getElementById("logo").style.fontSize = "15px";
    }
}
