// document.addEventListener("click", function (event) {
//     console.log(event.target.classList)
//     if (event.target.classList.contains("editButton")) {
//         return;
//     }
//     if (!event.target.classList.contains("editBox")) {
//         HideBox();
//     }
// });


function ShowEditBox(item) {
    HideAddBox ();
    var box = document.getElementsByClassName('editBox')[0];
    box.style.display = 'block';
    var encodedData = item;
    // Decode HTML entities (e.g., &quot; to ")
    var decodedData = encodedData.replace(/&quot;/g, '"');
    // Parse the JSON string into a JavaScript object
    var productData = JSON.parse(decodedData);
    // Now, you have the data as a JavaScript object
    

    var keys = Object.keys(productData);

    for (var i = 0; i < keys.length; i++) {
        console.log(keys[i] + " = " + productData[keys[i]]);
        var key = keys[i];
        var value = productData[key];
        var element = document.getElementById("editItem_" + key);
        if (element) {
            //element.innerHTML = value; 
            element.value = value;
        }
    }

    var updateForm = document.getElementById("update_form");
    updateForm.action = "/update/" + productData.id;
    var updateForm = document.getElementById("delete_form");
    updateForm.action = "/delete/" + productData.id;

}

function HideBox () {
    var box = document.getElementsByClassName('editBox')[0]
    box.style.display = 'none'
    console.log('hide')
}

function ShowAddBox() {
    HideBox ();
    var box = document.getElementsByClassName('addBox')[0];
    box.style.display = 'block';
}

function HideAddBox () {
    var box = document.getElementsByClassName('addBox')[0]
    box.style.display = 'none'
    console.log('hide')
}

