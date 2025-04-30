function estEmail(email){
    const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    return regex.test(email);
}


function visibilite(){
    let champ =  document.getElementsByClassName("champ");

    if (champ[0].type === "password"){
        champ[0].type = "text";
    }
    else{
        champ[0].type = "password";
    }
}

function verification(){

    let valid = true;

    let email = document.getElementsByName("email");
    let mdp = document.getElementsByName("password");

    let msg_vide = document.createTextNode("Le champ est vide.");
    let msg_mail = document.createTextNode("L'email n'est pas valide.");
    let msg_mdp = document.createTextNode("Le mot de passe doit contenir au moins 6 caractères.");

    let em = document.createElement("em");
    em.appendChild(msg_vide);
    em.appendChild(msg_mail);
    em.appendChild(msg_mdp);

    msg_vide.style.color = "red";
    msg_mail.style.color = "red";
    msg_mdp.style.color = "red";

    if (email[0].value.trim === ""){
        document.getElementsById("email").appendChild(msg_vide);
        valid = false;
    }
    if (!estEmail(email[0].value)){
        document.getElementsById("email").appendChild(msg_mail);
        valid = false;
    }

    if (mdp[0].value.length < 6){
        if (mdp[0].value.length == 0){
            document.getElementsById("mdp").appendChild(msg_vide);
            valid = false;
        }
        else{
            document.getElementsById("mdp").appendChild(msg_mdp);
            valid = false;
        }
    }
    return valid;
}