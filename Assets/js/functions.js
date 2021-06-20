// Validate title field.
function checkTitle() {
    var title = document.querySelector('#title').value;
    if (title == '') {
        document.querySelector('#title').classList.add('is-invalid');
        document.getElementById("title_error_message").innerHTML = "Title is a required field.";
        return false;
    } else if (title.length < 1 || title.length > 100) {
        document.querySelector('#title').classList.add('is-invalid');
        document.getElementById("title_error_message").innerHTML = "Title must be between 1 and 100 characters.";
        return false;
    } else {
        document.querySelector('#title').classList.remove('is-invalid');
        document.getElementById("title_error_message").innerHTML = "";
        return false;
    }
}

// Validate text field.
function checkText() {
    var text = document.querySelector('#text').value;
    if (text == '') {
        document.querySelector('#text').classList.add('is-invalid');
        document.getElementById("text_error_message").innerHTML = "Text is a required field.";
        return false;
    } else if (text.length < 1 || text.length > 2000) {
        document.querySelector('#text').classList.add('is-invalid');
        document.getElementById("text_error_message").innerHTML = "Text must be between 1 and 100 characters.";
        return false;
    } else {
        document.querySelector('#text').classList.remove('is-invalid');
        document.getElementById("text_error_message").innerHTML = "";
        return false;
    }
}