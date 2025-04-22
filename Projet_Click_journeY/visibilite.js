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
    let email = document.getElementsByName("email");

}