var sPath = window.location.pathname;
var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);

switch(sPage) {
    case "index.php":
        document.getElementById("nav-index").classList.add('active');
        break;
    case "gasten.php":
        document.getElementById("nav-gasten").classList.add('active');
        break;
    case "herbergen.php":
        document.getElementById("nav-herbergen").classList.add('active');
        break;
    case "restaurants.php":
        document.getElementById("nav-restaurants").classList.add('active');
        break;
    case "tochten.php":
        document.getElementById("nav-tochten").classList.add('active');
        break;
    case "status.php":
        document.getElementById("nav-statussen").classList.add('active');
        break;
}