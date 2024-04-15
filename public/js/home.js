// const favourite=document.getElementsByClassName("favourite-icon");
// console.log(favourite)
// Array.from(favourite).forEach(card => {
//   card.addEventListener('click',(e)=>{
//     e.preventDefault()
//     // let id=card.id
//     if(card.classList.contains('fa-solid')){
//       card.classList.remove("fa-solid")
//       card.classList.add("fa-regular")
//     }else{
//       card.classList.remove("fa-regular")
//       card.classList.add("fa-solid")
//     }
//   })
// });


// const favourites = document.getElementsByClassName("favourite-icon");

// Array.from(favourites).forEach((icon) => {
//     icon.addEventListener("click", (e) => {
//         e.preventDefault();

//         const isLoggedIn = true; // Assuming user is logged in for demonstration purposes

//         if (isLoggedIn) {
//             const petId = icon.dataset.petId; // Assuming you have a data-pet-id attribute on your heart icon
//             const formData = new FormData();
//             formData.append("pet_id", petId);

//             fetch("/favourites", {
//                 method: "POST",
//                 body: formData,
//                 headers: {
//                     "X-CSRF-TOKEN": "{{ csrf_token() }}", // Assuming you're using Laravel and have CSRF protection enabled
//                 },
//             })
//                 .then((response) => {
//                     if (response.ok) {
//                         // Pet added to favourites successfully
//                         icon.classList.toggle("fa-solid"); // Toggle solid and regular heart icon styles
//                         icon.classList.toggle("fa-regular");
//                         alert("Pet added to favourites successfully.");
//                     } else {
//                         alert("Failed to add pet to favourites.");
//                     }
//                 })
//                 .catch((error) => {
//                     console.error("Error:", error);
//                     alert("An error occurred while processing your request.");
//                 });
//         } else {
//             window.location.href = "/login";
//         }
//     });
// });