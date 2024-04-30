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

    let doctor = tr.getElementsByTagName("td")[5].innerText;
    let date = tr.getElementsByTagName("td")[6].innerText;
    let time = tr.getElementsByTagName("td")[7].innerText;
    // let room = tr.getElementsByTagName("td")[8].innerText;
    let status = tr.getElementsByTagName("td")[9].innerText;

    // Populate form fields with data
    document.getElementById("idEdit").value = parseInt(id);
    document.getElementById("doctorEdit").value = doctor;
    document.getElementById("dateEdit").value = date;
    document.getElementById("timeEdit").value = time;
    // document.getElementById("roomEdit").value = room;
    document.getElementById("statusEdit").value = status;

    // Remove error messages
    removeErrorMessages();

    // Toggle the modal
    editModal.toggle();
});
});

// Add event listener to update button
// const updateBtn = document.getElementById("update-btn");
// updateBtn.addEventListener("click", (e) => {
//     let inputs = document.querySelectorAll(".form-control");
//   document.getElementById("idEdit").value = id;
//   document.getElementById("doctorEdit").value = doctor;
//   document.getElementById("dateEdit").value = date;
//   document.getElementById("timeEdit").value = time;
//   document.getElementById("roomEdit").value = room;
//   document.getElementById("statusEdit").value = status;

//     // Validate form inputs
//     inputs.forEach((input) => {
//         if (!input.checkValidity()) {
//             input.classList.add("is-invalid");
//             validForm = false;
//         } else {
//             input.classList.remove("is-invalid");
//         }
//     });

//     // If form is not valid, prevent form submission
//     if (!validForm) {
//         e.preventDefault();
//     }
// });


// const updateBtn = document.getElementById("update-btn");
// updateBtn.addEventListener("click", (e) => {
//     let inputs = document.querySelectorAll(".form-control");
//     let validForm = true; // Initialize validForm flag

//     // Validate form inputs
//     inputs.forEach((input) => {
//         if (!input.checkValidity()) {
//             input.classList.add("is-invalid");
//             validForm = false;
//         } else {
//             input.classList.remove("is-invalid");
//         }
//     });

//     // If form is not valid, prevent form submission
//     if (!validForm) {
//         e.preventDefault();
//     }
// });
