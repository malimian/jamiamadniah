// handcrafted-arts
var arts = document.getElementById("cards-section");

var handcraftedArts = document.getElementById("handcrafted-arts");
handcraftedArts.onclick = function() {
    handcraftedArts.style.color = "#B8860B";
    gift1.style.color = "grey";
    gift2.style.color = "grey";
    document.getElementById("cards-section"); 
}

var gift1 = document.getElementById("gifts1");
gift1.onclick = function() {
    gift1.style.color = "#B8860B";
    handcraftedArts.style.color = "grey";
    gift2.style.color = "grey";
    
}

var gift2 = document.getElementById("gifts-2");
gift2.onclick = function() {
    gift2.style.color = "#B8860B";
    gift1.style.color = "grey";
    handcraftedArts.style.color = "grey";
}







