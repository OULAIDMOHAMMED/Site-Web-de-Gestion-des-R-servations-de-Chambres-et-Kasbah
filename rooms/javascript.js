function suivant(id) {
    var pro2 = document.getElementById(`room-infos${id}`);
    var pro3 = document.getElementById(`room-reserve${id}`);
    pro2.style.left='-100%';
    pro3.style.left='0%';
    
}

function prec(id) {
    var pro2 = document.getElementById(`room-infos${id}`);
    var pro3 = document.getElementById(`room-reserve${id}`);
    pro2.style.left='0%';
    pro3.style.left='100%';
    
}

function show_room(id) {
    document.getElementById(`Prop_id${id}`).style.display="flex";
    document.body.classList.add('darken');

}


// ________________CALCULATE PRICE
