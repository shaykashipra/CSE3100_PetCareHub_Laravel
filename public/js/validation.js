function validateName(name) {
  let regex = /^[a-zA-Z ]{2,40}$/;
  let input = name;
  if (regex.test(input)) {
    return true;
  } else {
    return false;
  }
}

function validateEmail(email) {
  let regex = /^([-_\.a-zA-Z0-9]+)@([-_\.a-zA-Z0-9]+)\.([a-zA-Z0-9]){2,9}$/;
  let input = email;
  if (regex.test(input)) {
    return true;
  } else {
    return false;
  }
}

function validatePassword(pass) {
  let regex = /^(?=.*\d).{8,}$/;
  let input = pass;
  if (regex.test(input)) {
    return true;
  } else {
    return false;
  }
}

function validatePhone(phone) {
  let regex = /^[0-9]{11}$/;
  let input = phone;
  //nullable 
  if (input === "") {
        return true;
    }
  if (regex.test(input)) {
    return true;
  } else {
    return false;
  }
}

function validatePostalCode(postalcode) {
  let regex = /^[0-9]{4}$/;
    // /^[ABCEGHJ-NPRSTVXYabceghj-nprstvxy]\d[ABCEGHJ-NPRSTV-Zabceghj-nprstv-z]\d[ABCEGHJ-NPRSTV-Zabceghj-nprstv-z]\d$/;

  if (input === "") {
      return true;
  }
  let input = postalcode;
  if (regex.test(input)) {
    return true;
  } else {
    return false;
  }
}

function validateDescription(description) {
  let regex = /^(.|\s)*[a-zA-Z]+(.|\s)*$/;
  let input = description;
 
  if (regex.test(input)) {
    return true;
  } else {
    return false;
  }
}

function validateSelect(select){
  let input =select;
  if(input=="" || input==null){
    return false;
  }else{
    return true;
  }
}

function validateDate(selectedDate) {
  let regex = /^(0[1-9]|[12][0-9]|3[01])(0[1-9]|1[012])-(\d{4})$/;
if (regex.test(selectedDate) || selectedDate == null) return false; 

    const today = new Date();
    today.setHours(0, 0, 0, 0); 
    return selectedDate >= today;
}

function validateTime(selectedDate, selectedTime) {
  if (selectedDate==null||selectedTime==null) return false;
    const now = new Date();
    if (selectedDate.toDateString() === now.toDateString()) {
        return selectedTime >= now;
    }
    return true; 
  }

  function validatePhoneApp(phone) {
      let regex = /^[0-9]{11}$/;
      let input = phone;
    //not nullable
      if (regex.test(input)) {
          return true;
      } else {
          return false;
      }
  }


