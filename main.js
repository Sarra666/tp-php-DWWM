

//fonction pour effacer l'affichage précédent des différentes fonctions
function effacer(){
    var body = document.getElementsByTagName("body")[0];
    while (body.firstChild) {
        body.removeChild(body.firstChild);
    }
    
}