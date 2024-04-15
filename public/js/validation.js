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
