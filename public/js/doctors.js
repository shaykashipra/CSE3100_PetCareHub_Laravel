// Toggling the sidebar menu
$(document).ready(function () {
    $("#sideBarCollapse").on("click", function () {
        $("#sidebar").toggleClass("active");
    });
});

function removeErrorMessages() {
    const name = document.getElementById("nameEdit");
    const specialization = document.getElementById("specializationEdit");
    const gender = document.getElementById("genderEdit");
    const experience = document.getElementById("experienceEdit");
    name.classList.remove("is-invalid");
    name.nextElementSibling.classList.add("d-none");
    specialization.classList.remove("is-invalid");
    specialization.nextElementSibling.classList.add("d-none");
    gender.classList.remove("is-invalid");
    gender.nextElementSibling.classList.add("d-none");
    experience.classList.remove("is-invalid");
    experience.nextElementSibling.classList.add("d-none");
}
// let editModal = new bootstrap.Modal(document.getElementById("editModal"));
// edits = document.getElementsByClassName("edit");
// Array.from(edits).forEach((element) => {
//     element.addEventListener("click", (e) => {
//         tr = e.target.parentNode.parentNode;
//         id = tr.getElementsByTagName("td")[0].innerText;
//         name = tr.getElementsByTagName("td")[1].innerText;
//         specialization = tr.getElementsByTagName("td")[2].innerText;
//         gender = tr.getElementsByTagName("td")[3].innerText;
//         experience = tr.getElementsByTagName("td")[4].innerText;
    
//         idEdit.value = id;
//         nameEdit.value = name;
//         specializationEdit.value = specialization;
//         genderEdit.value = gender;
//         experienceEdit.value = experience;
    

//         removeErrorMessages();
//         // Toggle the Modal
//         editModal.toggle();
//     });
// });
$('#doctor_table').on('click', '.edit', function () {
    var button = $(this); 
    var tr = button.closest('tr');
    var id = tr.find('td').eq(0).text(); 
    var name = tr.find('td').eq(1).text();
    var specialization = tr.find('td').eq(2).text();
    var gender = tr.find('td').eq(3).text();
    var experience = tr.find('td').eq(4).text();

    var modal = $('#editModal');
    modal.find('.modal-title').text('Edit Doctor: ' + name);
    modal.find('#idEdit').val(id);
    modal.find('#nameEdit').val(name);
    modal.find('#specializationEdit').val(specialization);
    modal.find('#genderEdit').val(gender);
    modal.find('#experienceEdit').val(experience);

    modal.modal('show'); // This line is crucial
            removeErrorMessages();
        // Toggle the Modal
        editModal.toggle();
});

let validName = false;
let validExperience=false;


const updateBtn = document.getElementById("update-btn");
updateBtn.addEventListener("click", (e) => {
    const name = document.getElementById("nameEdit");
    const experience=document.getElementById("experienceEdit");
  
    // Name
    if (validateName(name.value)&&name.value!=null) {
        validName = true;
        name.classList.remove("is-invalid");
        name.nextElementSibling.classList.add("d-none");
    }
     else {
        validName = false;
        name.nextElementSibling.classList.remove("d-none");
        name.classList.add("is-invalid");
    }

   
    if (experience.value != "") {
        validExperience = true;
        experience.classList.remove("is-invalid");
        experience.nextElementSibling.classList.add("d-none");
    } else {
        validExperience = false;
        experience.nextElementSibling.classList.remove("d-none");
        experience.classList.add("is-invalid");
    }

    if (
        validName != true||
        validExperience!=true
    
    ) {
        e.preventDefault();
    }
});
