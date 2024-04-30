function removeErrorMessagesForIds(ids) {
    ids.forEach((id) => {
        const input = document.getElementById(id);
        const errorMessage = document.getElementById(`${id}-error`);

        if (input) {
            input.classList.remove("is-invalid");
        }
        if (errorMessage) {
            errorMessage.classList.add("d-none");
        }
    });
}
let editModal = new bootstrap.Modal(document.getElementById("editModal"));

const idsToRemoveErrorMessages = ["doctorEdit","dateEdit","timeEdit","roomEdit","statusEdit",];
removeErrorMessagesForIds(idsToRemoveErrorMessages);


// Add event listener to update button
const updateBtn = document.getElementById("update-btn");
updateBtn.addEventListener("click", function (e) {
    let inputs = document.querySelectorAll(".form-control");
    let validForm = true;

    // Validate form inputs
    inputs.forEach((input) => {
        if (!input.checkValidity()) {
            input.classList.add("is-invalid");
            validForm = false;
        } else {
            input.classList.remove("is-invalid");
        }
    });

    // If form is not valid, prevent form submission
    if (!validForm) {
        e.preventDefault();
    }
});

