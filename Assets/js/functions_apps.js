document.addEventListener('DOMContentLoaded', function () {
    $('#tablaCategoriaLoad').load(base_url + "/Apps/getClipboard");

    if (document.querySelector("#formApp")) {
        let formApp = document.querySelector("#formApp");
        formApp.onsubmit = function (event) {
            event.preventDefault();

            checkTitle();
            checkText();

            let elementsValid = document.getElementsByClassName("valid");
            for (let i = 0; i < elementsValid.length; i++) {
                if (elementsValid[i].classList.contains('is-invalid')) {
                    alertify.error("All the fields are required!");
                    return false;
                }
            }

            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Apps/setClipboard';
            let formData = new FormData(formApp);

            request.open("POST", ajaxUrl, true);
            request.send(formData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status == 'created_message') {
                        $('#modalFormApp').modal("hide");
                        formApp.reset();
                        alertify.success(objData.message);
                        $('#tablaCategoriaLoad').load(base_url + "/Apps/getClipboard");
                    } else if (objData.status == 'updated_message') {
                        $('#modalFormApp').modal("hide");
                        formApp.reset();
                        alertify.success(objData.message);
                        $('#tablaCategoriaLoad').load(base_url + "/Apps/getClipboard");
                    } else if (objData.status == 'title_error_message') {
                        document.querySelector('#title').classList.add('is-invalid');
                        document.getElementById("title_error_message").innerHTML = "Title already exists!";
                    } else if (objData.status == 'error_message') {
                        alert(objData.message);
                    } else {
                        alert(objData.join("\n"));
                    }
                }
                return false;
            }
        }
    }

}, false);

function updateItem(clipboard_id) {
    removeErrorMessages();
    document.querySelector('#titleModal').innerHTML = "Update Item";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnText').innerHTML = "Update";

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url + '/Apps/getItem/' + clipboard_id;
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            if (objData.user_status) {
                document.querySelector("#id").value = objData.data.clipboard_id;
                document.querySelector("#title").value = objData.data.clipboard_title;
                document.querySelector("#text").value = objData.data.clipboard_text;
                $('#modalFormApp').modal('show');
            } else {
                alert(objData.message);
            }
        }
    }
}

function deleteText(clipboard_id) {
    alertify.confirm('Confirm Delete',
        'Are you sure you want to delete this item?', function () {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/Apps/deleteItem';
            let strData = "clipboard_id=" + clipboard_id;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objectData = JSON.parse(request.responseText);
                    if (objectData.user_status) {
                        alertify.success(objectData.message);
                        $('#tablaCategoriaLoad').load(base_url + "/Apps/getClipboard");
                    } else {
                        alert(objectData.message);
                    }
                }
            }
        }
        , '');
}

function openModal() {
    removeErrorMessages();
    document.querySelector('#id').value = "";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML = "Save";
    document.querySelector('#titleModal').innerHTML = "Add New Item";
    document.querySelector("#formApp").reset();
    $('#modalFormApp').modal('show');
}

// Remove form error messages.
function removeErrorMessages() {
    document.querySelector('#title').classList.remove('is-invalid');
    document.getElementById("title_error_message").innerHTML = "";

    document.querySelector('#text').classList.remove('is-invalid');
    document.getElementById("text_error_message").innerHTML = "";
}

// Copy text to the Clipboard.
function copyToClipboard(text) {
    var copy_text = text;
    var text_area = document.createElement('textarea');
    text_area.value = copy_text;

    document.body.appendChild(text_area);
    text_area.select();
    document.execCommand('copy');
    document.body.removeChild(text_area);

    alertify.success("Copied to clipboard.");
}
