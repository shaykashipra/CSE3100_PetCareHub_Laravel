// Toggling the sidebar menu
$(document).ready(function () {
    $("#sideBarCollapse").on("click", function () {
        $("#sidebar").toggleClass("active");
    });
});

const bookBtn = document.getElementById("bookBtn");

bookBtn.addEventListener("click", (e) => {
    const pet_name = document.getElementById("pet_name");
    const category = document.getElementById("category");
    const doctor_id = document.getElementById("doctor_id");
    const date = document.getElementById("date");
    const time = document.getElementById("time");
    const symptoms = document.getElementById("symptoms");
    const contact = document.getElementsById("contact");
    // Email
    if (validateName(pet_name.value)) {
        pet_name.classList.remove("is-invalid");
        document.getElementById("floatingPetNameSpan").classList.add("d-none");
    } else {
        e.preventDefault();
        document
            .getElementById("floatingPetNameSpan")
            .classList.remove("d-none");
        pet_name.classList.add("is-invalid");
    }
    //Select Doctor
    if (validateSelect(doctor_id.value)) {
        doctor_id.classList.remove("is-invalid");
        document.getElementById("floatingDoctorIdSpan").classList.add("d-none");
    } else {
        e.preventDefault();
        document
            .getElementById("floatingDoctorIdSpan")
            .classList.remove("d-none");
        doctor_id.classList.add("is-invalid");
    }
    //Select Category
    if (validateSelect(category.value)) {
        category.classList.remove("is-invalid");
        document.getElementById("floatingCategorySpan").classList.add("d-none");
    } else {
        e.preventDefault();
        document
            .getElementById("floatingDoctorIdSpan")
            .classList.remove("d-none");
        category.classList.add("is-invalid");
    }
    //Date
    if (validateDate(date.value)) {
        date.classList.remove("is-invalid");
        document.getElementById("floatingDateSpan").classList.add("d-none");
    } else {
        e.preventDefault();
        document.getElementById("floatingDateSpan").classList.remove("d-none");
        date.classList.add("is-invalid");
    }
    //Time
    if (validateTime(date.value, time.value)) {
        time.classList.remove("is-invalid");
        document.getElementById("floatingTimeSpan").classList.add("d-none");
    } else {
        e.preventDefault();
        document.getElementById("floatingTimeSpan").classList.remove("d-none");
        time.classList.add("is-invalid");
    }

    // Symptoms
    if (validateDescription(symptoms.value)) {
        symptoms.classList.remove("is-invalid");
        document.getElementById("floatingSymptomsSpan").classList.add("d-none");
    } else {
        e.preventDefault();
        document.getElementById("floatSymptomsSpan").classList.remove("d-none");
        symptoms.classList.add("is-invalid");
    }

    //Contact
    if (validatePhoneApp(contact.value)) {
        contact.classList.remove("is-invalid");
        document.getElementById("floatingContactSpan").classList.add("d-none");
    } else {
        e.preventDefault();
        document
            .getElementById("floatingContactSpan")
            .classList.remove("d-none");
        contact.classList.add("is-invalid");
    }
});
