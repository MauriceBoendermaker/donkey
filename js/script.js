    var sPath = window.location.pathname;
    var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);

    if(sPage === "index.php") {
    document.getElementById("nav-index").classList.add('active');
}
    else if(sPage === "gasten.php") {
    document.getElementById("nav-gasten").classList.add('active');
}
    else if(sPage === "herbergen.php") {
    document.getElementById("nav-herbergen").classList.add('active');
}
    else if(sPage === "restaurants.php") {
    document.getElementById("nav-restaurants").classList.add('active');
}
    else if(sPage === "tochten.php") {
    document.getElementById("nav-tochten").classList.add('active');
}
    else if(sPage === "status.php") {
    document.getElementById("nav-statussen").classList.add('active');
}