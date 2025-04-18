const clearButton = document.querySelector("button[type='reset']");
const form = document.querySelector("form");
const titleInput = document.getElementById("title");
const contentInput = document.getElementById("content");
const titleInputBox = document.getElementById("title-input-box");
const contentInputBox = document.getElementById("content-input-box");
const addPostButton = document.getElementById("add-post-button");
const previewButton = document.getElementById("preview-button");

function validateForm(event) {
    let valid = true;

    titleInput.classList.remove("error");
    contentInput.classList.remove("error");
    titleInputBox.classList.remove("error");
    contentInputBox.classList.remove("error");

    if (titleInput.value.trim() === "") {
        titleInput.classList.add("error");
        titleInputBox.classList.add("error");
        valid = false;
    }

    if (contentInput.value.trim() === "") {
        contentInput.classList.add("error");
        contentInputBox.classList.add("error");
        valid = false;
    }

    if (!valid) {
        event.preventDefault();
        alert("Please fill in all required fields.");
    }

    return valid;
}

function confirmClear(event) {
    event.preventDefault();
    
    const confirmClear = confirm("Are you sure you want to clear the form?");
    if (confirmClear) {
        window.location.href = "./addEntry.php";
    }
}

function disablePreview(event) {
    event.preventDefault();

    if (validateForm(event)) {
        document.getElementById("preview-mode").value = "false";
        form.submit();
    }
}

function enablePreview(event) {
    event.preventDefault();

    if (validateForm(event)) {
        document.getElementById("preview-mode").value = "true";
        form.submit();
    }
}

clearButton.addEventListener("click", confirmClear);
addPostButton.addEventListener("click", disablePreview);
previewButton.addEventListener("click", enablePreview);