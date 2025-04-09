const urlParams = new URLSearchParams(window.location.search);
const errorCode = urlParams.get("error");
const errorElement = document.getElementById("error-message");

const errorMessages = {
    "1": "Incorrect email or password.",
};

errorElement.classList.remove("error");
errorElement.classList.add("hidden");

if (errorCode && errorMessages[errorCode]) {
    errorElement.classList.add("error");
    errorElement.classList.remove("hidden");
    errorElement.textContent = errorMessages[errorCode];
}