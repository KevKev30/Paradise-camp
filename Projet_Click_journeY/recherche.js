function optionSelectionnee(name){
    let dest = document.getElementsById(name);
    return dest.value;
}

function filtrerRecherches(liste_voyages){
    let dest = optionSelectionnee("destination");
    let arrivee = optionSelectionnee("arrivee");
    let depart = optionSelectionnee("depart");
    let personnes = perseInt(optionSelectionnee("personnes"));
    let hebergement = optionSelectionnee("hebergement");
    let prix = parseInt(optionSelectionnee("prix"));

    if (arrivee == ""){
        arrivee = "2025-06-01";
    }
    if (depart == ""){
        depart = "2025-08-31";
    }

    let d1 = new Date(arrivee);

    liste_voyages.voyages.forEach(
        voyage => {
            if (

            )
        }
    )
}