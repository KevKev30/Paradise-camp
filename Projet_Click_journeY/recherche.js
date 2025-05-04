function pagination(page){
    var voyages = document.getElementById("resultats").children;
    var destination = Array.from(voyages);
    for (var i = 0; i < destination.length - 1; i++){
        if ((i >= (page-1) * 5) && (i < page * 5)){
            destination[i].hidden = false;
        }
        else{
            destination[i].hidden = true;
        }
    }
    document.getElementById("pagi").dataset.extra = page;
    var pagination = Array.from(document.getElementById("pagi").children);

    for (i = 0; i<pagination.length; i++){
        if (i+1 == page){
            pagination[i].classList.add("page_actuelle");
        }
        else if (pagination[i].classList.contains("page_actuelle")){
            pagination[i].classList.remove("page_actuelle");
        }
    }
}

function triFiltres (){
    var filtres = document.getElementById("filtres");
    if (filtres.value == "vide"){
        return;
    }
    var voyages = document.getElementById("resultats").children;
    var destination = Array.from(voyages);
    for (var i = 0; i<destination.length-1; i++){
        for (var j = i; j<destination.length-1; j++){
            if (filtres.value == "prix"){
                var data = destination[i].dataset.extra;
                var data2 = destination[j].dataset.extra;
            }
            else if (filtres.value == "duree"){
                var data = destination[i].dataset.extra2;
                var data2 = destination[j].dataset.extra2;
            }
            else{
                var data = destination[i].dataset.extra3;
                var data2 = destination[j].dataset.extra3;
            }
            if (data > data2){
                var tmp = destination[i];
                destination[i] = destination[j];
                destination[j] = tmp;
            }

        }
    }
    for (var k = 0; k< destination.length; k++){
        document.getElementById("resultats").appendChild(destination[k]);
    }
    pagination(document.getElementById("pagi").dataset.extra);
}