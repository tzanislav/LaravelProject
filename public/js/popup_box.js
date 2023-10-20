function ShowDeleteBox(id, name) {
    var box = document.getElementsByClassName('delete')[0];
    box.style.display = 'block';
    var nameElement = document.getElementById('delete_name');
    nameElement.innerHTML = name;
    var idElement = document.getElementById('item_Id');
    idElement.innerHTML = id;
    var deleteForm = document.getElementById('delete_form');
    deleteForm.action = '/delete/' + id;
}

function HideDeleteBox () {
    var box = document.getElementsByClassName('delete')[0]
    box.style.display = 'none'
    console.log('hide')
}