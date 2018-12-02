/* Confirm Passwords if they match.*/

var signup_password = document.getElementById('password');
var signup_confirm  = document.getElementById('confirm-password');
var prof_password   = document.getElementById('newpassword');
var prof_confirm    = document.getElementById('confirm-newpassword');
var reset_password  = document.getElementById('reset-password');
var reset_confirm   = document.getElementById('reset-confirm');

if (signup_confirm && signup_password){
  function check_password(){
    if (signup_password.length < 8){
      signup_password.setCustomValidity("Password length too short.");
    }else{
      signup_password.setCustomValidity('');
    }
  }
  function validate_password(){
    if(signup_password.value != signup_confirm.value){
      signup_confirm.setCustomValidity("Passwords Do Not Match!");
    }else{
      signup_confirm.setCustomValidity('');
    }
  }
  signup_password.onkeyup = check_password;
  signup_password.onchange   = validate_password;
  signup_confirm.onkeyup     = validate_password;
}

if (prof_password && prof_confirm){
  if (prof_confirm.value < 8){
    prof_confirm.setCustomValidity("Password length too short.");
  }
  else if (prof_password.value < 8){
    prof_password.setCustomValidity("Password length too short.");
  }
  function validate_password(){
    if (prof_password.value != prof_confirm.value){
      prof_confirm.setCustomValidity("Passwords Do Not Match!");
    }else{
      prof_confirm.setCustomValidity('');
    }
  }
  prof_password.onchange = validate_password;
  prof_confirm.onkeyup   = validate_password;
}

if (reset_password && reset_confirm){
  function validate_password(){
    if (reset_password.value != reset_confirm.value){
      reset_confirm.setCustomValidity("Passwords Do Not Match!");
    }else{
      reset_confirm.setCustomValidity('');
    }
  }
  reset_password.onchange = validate_password;
  reset_confirm.onkeyup   = validate_password;
}