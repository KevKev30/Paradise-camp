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

    return false;
}

function modifNom(bouton){
    let elt = document.getElementsByName("nom")[0];
    let parent = elt.parentNode;
    let msg = parent.querySelectorAll("em");

    if (elt.disabled === false){
        if (elt.value.trim() === ""){
            afficherErreur(elt, "<br>Le champ est vide.");
        }
        else{
            elt.disabled = true;
            bouton.textContent = "Modifier";
            supprimerMsg(msg);
        }
    }
    else{
        elt.disabled = false;
        bouton.textContent = "Valider";
    }
}

function modifPrenom(bouton){
    let elt = document.getElementsByName("prenom")[0];
    let parent = elt.parentNode;
    let msg = parent.querySelectorAll("em");

    if (elt.disabled === false){
        if (elt.value.trim() === ""){
            afficherErreur(elt, "<br>Le champ est vide.");
        }
        else{
            elt.disabled = true;
            bouton.textContent = "Modifier";
            supprimerMsg(msg);
        }
    }
    else{
        elt.disabled = false;
        bouton.textContent = "Valider";
    }
}

function modifTelephone(bouton){
    let elt = document.getElementsByName("telephone")[0];
    let parent = elt.parentNode;
    let msg = parent.querySelectorAll("em");

    if (elt.disabled === false){
        if (elt.value.trim() === ""){
            afficherErreur(elt, "<br>Le champ est vide.");
        }
        else if (!estTelephone(elt.value)){
            afficherErreur(elt, "<br>Le format est incorrect (formats autorisés : 0X XX XX XX XX ou 0XXXXXXXXX).")
        }
        else{
            elt.disabled = true;
            bouton.textContent = "Modifier";
            supprimerMsg(msg);
        }
    }
    else{
        elt.disabled = false;
        bouton.textContent = "Valider";
    }
}

function modifEmail(bouton){
    let elt = document.getElementsByName("email")[0];
    let parent = elt.parentNode;
    let msg = parent.querySelectorAll("em");

    if (elt.disabled === false){
        if (elt.value.trim() === ""){
            afficherErreur(elt, "<br>Le champ est vide.");
        }
        else if (!estEmail(elt.value)){
            afficherErreur(elt, "<br>Mail Invalide.")
        }
        else{
            elt.disabled = true;
            bouton.textContent = "Modifier";
            supprimerMsg(msg);
        }
    }
    else{
        elt.disabled = false;
        bouton.textContent = "Valider";
    }
}

function modifMdp(bouton){
    let elt = document.getElementsByName("password")[0];
    let parent = elt.parentNode;
    let msg = parent.querySelectorAll("em");

    if (elt.disabled === false){
        if (elt.value.trim() === ""){
            afficherErreur(elt, "<br>Le champ est vide.");
        }
        else if (!estEmail(elt.value)){
            afficherErreur(elt, "<br>Mail Invalide.")
        }
        else{
            elt.disabled = true;
            bouton.textContent = "Modifier";
            supprimerMsg(msg);
        }
    }
    else{
        elt.disabled = false;
        bouton.textContent = "Valider";
    }
}