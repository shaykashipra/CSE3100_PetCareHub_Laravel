// Function to remove error messages
$(document).ready(function () {
    $("#sideBarCollapse").on("click", function () {
        $("#sidebar").toggleClass("active");
    });
});


function removeErrorMessages() {
    const inputs = document.querySelectorAll(".form-control");
    const errorMessages = document.querySelectorAll(".text-danger");

    inputs.forEach((input) => {
        input.classList.remove("is-invalid");
    });

    errorMessages.forEach((errorMessage) => {
        errorMessage.classList.add("d-none");
    });
}

// Get edit modal and initialize it
let editModal = new bootstrap.Modal(document.getElementById("editModal"));

// Add event listener to edit buttons
edits = document.getElementsByClassName("edit");
Array.from(edits).forEach((element) => {
    element.addEventListener("click", (e) => {
        tr = e.target.parentNode.parentNode;
        let id = tr.getElementsByTagName("td")[0].textContent;

        let status = tr.getElementsByTagName("td")[6].innerText;
        let prescription = tr.getElementsByTagName("td")[9].innerText;

        document.getElementById("idEdit").value = parseInt(id);

        document.getElementById("statusEdit").value = status;
                document.getElementById("prescriptionEdit").value = prescription;


        removeErrorMessages();

        editModal.toggle();
    });
});
