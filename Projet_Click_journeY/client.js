function estEmail(email) {
    const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    return regex.test(email);
}

function estTelephone(tel){
    tel = tel.replace(/\s+/g, '');
    const regex = /^0[1-9]\d{8}$/;
    return regex.test(tel);
}

function visibilite() {
    let champ = document.getElementsByClassName("champ")[0];
    if (champ.type === "password"){
        champ.type = "text";
    }
    else{
        champ.type = "password";
    }
}

function supprimerMsg(name){
    name.forEach(function(em){em.remove();});
}

function afficherErreur(element, message) {
    let parent = element.parentNode;
    let anciens = parent.querySelectorAll("em");
    supprimerMsg(anciens);

    if (message){
        let em = document.createElement("em");
        em.style.color = "red";
        em.innerHTML = message;
        parent.appendChild(em);
    }
}

function verifierEmail() {
    let email = document.getElementsByName("email")[0];
    if (email.value.trim() === "") {
        afficherErreur(email, "<br>Le champ est vide.");
        return false;
    } else if (!estEmail(email.value)) {
        afficherErreur(email, "<br>L'email n'est pas valide.");
        return false;
    } else {
        afficherErreur(email, "");
        return true;
    }
}

function verifierMdp() {
    let mdp = document.getElementsByName("password")[0];
    if (mdp.value.trim() === "") {
        afficherErreur(mdp, "<br>Le champ est vide.");
        return false;
    } else if (mdp.value.length < 6) {
        afficherErreur(mdp, "<br>Le mot de passe doit contenir au moins 6 caractères.");
        return false;
    } else {
        afficherErreur(mdp, "");
        return true;
    }
}

function estVide(name){
    let elt = document.getElementsByName(name)[0];

    if (elt.value.trim() === ""){
        afficherErreur(elt, "<br>Le champ est vide.");
        return true;
    }
    afficherErreur(elt, "");
    return false;
}

const CoordonneesInitiales = {}

function ajouterAnnuler(parent, champ, bouton, champNom) {
    let button = document.createElement('button');
    button.textContent = "Annuler";
    button.type = "button";
    button.style.backgroundColor = "grey";
    parent.appendChild(button);

    button.addEventListener("click", function() {
        champ.value = CoordonneesInitiales[champNom];
        champ.readOnly = true;
        bouton.textContent = "Modifier";
        supprimerAnnuler(parent);
        supprimerMsg(parent.querySelectorAll("em"));
    });
}

function supprimerAnnuler(parent){
    let annuler = document.getElementsByTagName("button");
    for (let i = 0; i<annuler.length; i++){
        if (annuler[i].textContent === "Annuler"){
            annuler[i].remove();
        }
    }
}

function modifNom(bouton){
    let elt = document.getElementsByName("nom")[0];
    let parent = elt.parentNode;
    let msg = parent.querySelectorAll("em");

    if (elt.readOnly === false){
        if (elt.value.trim() === ""){
            afficherErreur(elt, "<br>Le champ est vide.");
        }
        else{
            supprimerAnnuler(parent);
            elt.readOnly = true;
            bouton.textContent = "Modifier";
            supprimerMsg(msg);
        }
    }
    else{
        CoordonneesInitiales["nom"] = elt.value;
        elt.readOnly = false;
        ajouterAnnuler(parent, elt, bouton, "nom");
        bouton.textContent = "Valider";
    }
}

function modifPrenom(bouton){
    let elt = document.getElementsByName("prenom")[0];
    let parent = elt.parentNode;
    let msg = parent.querySelectorAll("em");

    if (elt.readOnly === false){
        if (elt.value.trim() === ""){
            afficherErreur(elt, "<br>Le champ est vide.");
        }
        else{
            supprimerAnnuler(parent);
            elt.readOnly = true;
            bouton.textContent = "Modifier";
            supprimerMsg(msg);
        }
    }
    else{
        CoordonneesInitiales["prenom"] = elt.value;
        elt.readOnly = false;
        ajouterAnnuler(parent, elt, bouton, "prenom");
        bouton.textContent = "Valider";
    }
}

function modifTelephone(bouton){
    let elt = document.getElementsByName("telephone")[0];
    let parent = elt.parentNode;
    let msg = parent.querySelectorAll("em");

    if (elt.readOnly === false){
        if (elt.value.trim() === ""){
            afficherErreur(elt, "<br>Le champ est vide.");
        }
        else if (!estTelephone(elt.value)){
            afficherErreur(elt, "<br>Le format est incorrect (formats autorisés : 0X XX XX XX XX ou 0XXXXXXXXX).")
        }
        else{
            supprimerAnnuler(parent);
            elt.readOnly = true;
            bouton.textContent = "Modifier";
            supprimerMsg(msg);
        }
    }
    else{
        CoordonneesInitiales["telephone"] = elt.value;
        elt.readOnly = false;
        ajouterAnnuler(parent, elt, bouton, "telephone");
        bouton.textContent = "Valider";
    }
}

function modifEmail(bouton){
    let elt = document.getElementsByName("email")[0];
    let parent = elt.parentNode;
    let msg = parent.querySelectorAll("em");

    if (elt.readOnly === false){
        if (elt.value.trim() === ""){
            afficherErreur(elt, "<br>Le champ est vide.");
        }
        else if (elt.value.length < 6){
            afficherErreur(elt, "<br>Le mot de passe doit contenir au moins 6 caractères.")
        }
        else{
            supprimerAnnuler(parent);
            elt.readOnly = true;
            bouton.textContent = "Modifier";
            supprimerMsg(msg);
        }
    }
    else{
        CoordonneesInitiales["email"] = elt.value;
        elt.readOnly = false;
        ajouterAnnuler(parent, elt, bouton, "email");
        bouton.textContent = "Valider";
    }
}

function modifMdp(bouton){
    let elt = document.getElementsByName("password")[0];
    let parent = elt.parentNode;
    let msg = parent.querySelectorAll("em");

    if (elt.readOnly === false){
        if (elt.value.trim() === ""){
            afficherErreur(elt, "<br>Le champ est vide.");
        }
        else if (!estEmail(elt.value)){
            afficherErreur(elt, "<br>Mail Invalide.")
        }
        else{
            supprimerAnnuler(parent);
            elt.readOnly = true;
            bouton.textContent = "Modifier";
            supprimerMsg(msg);
        }
    }
    else{
        CoordonneesInitiales["password"] = elt.value;
        elt.readOnly = false;
        ajouterAnnuler(parent, elt, bouton, "password");
        bouton.textContent = "Valider";
    }
}


    document.getElementById("profil").addEventListener('submit', async function chargerPage(event){
        event.preventDefault();

        let nom= document.getElementsByName("nom")[0].value;
        let prenom= document.getElementsByName("prenom")[0].value;
        let telephone= document.getElementsByName("telephone")[0].value;
        let email= document.getElementsByName("email")[0].value;
        let password= document.getElementsByName("password")[0].value;

        const ancienneCoordonnees = {
            nom: nom,
            prenom: prenom,
            telephone: telephone,
            email: email,
            password: password
        }

        try{
            const coordonnees = {
                nom: nom,
                prenom: prenom,
                telephone: telephone,
                email: email,
                password: password
            };

            const envoie = await fetch("modif_profil.php", {
                method: "POST",
                headers: {"Content-Type" : "application/json"},
                body: JSON.stringify(coordonnees)
            });

            const res = await envoie.json();

            if (res.status === "success"){
                alert("Modification effectuée");

                nom = res.utilisateur.nom;
                prenom = res.utilisateur.prenom;
                telephone = res.utilisateur.telephone;
                email = res.utilisateur.email;
                password = res.utilisateur.password;

                document.getElementsByName("nom")[0].readOnly = true;
                document.getElementsByName("prenom")[0].readOnly = true;
                document.getElementsByName("telephone")[0].readOnly = true;
                document.getElementsByName("email")[0].readOnly = true;
                document.getElementsByName("password")[0].readOnly = true;

                document.querySelectorAll("form .zone button").forEach(btn => {
                    if (btn.textContent === "Valider") {
                        btn.textContent = "Modifier";
                    }
                });

                supprimerAnnuler(document);
            }
            else{
                alert("Aucune modification effectuée");
                nom = ancienneCoordonnees.nom;
                prenom = ancienneCoordonnees.prenom;
                telephone = ancienneCoordonnees.telephone;
                email = ancienneCoordonnees.email;
                password = ancienneCoordonnees.password;
            }
        }
        catch(e){
            console.error("Erreur de fetch");
        }
    })


