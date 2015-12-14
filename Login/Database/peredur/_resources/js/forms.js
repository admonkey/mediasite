/* 
 * Copyright (C) 2013 peredur.net
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

function formhash(form) {
    // Create a new element input, this will be our hashed password field. 
    var p = document.createElement("input");

    // Add the new element to our form. 
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(form.password.value);

    // Make sure the plaintext password doesn't get sent.
    form.password.value = "";
    form.confirmpwd.value = "";
}

function validate_custom_message(input, message) {  

  input.setCustomValidity(message);
  // trigger native HTML5 validators
  $('<input type="submit">').hide().appendTo($(input.form)).click().remove();
  input.addEventListener("input", function(){this.setCustomValidity('')});
  return false;
              
}

function validate_registration(form) {

    // Check the username
    re = /^\w+$/; 
    if(!re.test(form.username.value))
	return validate_custom_message(form.username, "Username must contain only letters, numbers and underscores.");
    
    // Check that the password is sufficiently long (min 6 chars)
    // The check is duplicated below, but this is included to give more
    // specific guidance to the user
    if (form.password.value.length < 6)
        return validate_custom_message(form.password, "Passwords must be at least 6 characters long.");
    
    // At least one number, one lowercase and one uppercase letter 
    // At least six characters 
    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/; 
    if (!re.test(form.password.value))
        return validate_custom_message(form.password, "Passwords must contain numbers, lowercase AND uppercase letters.");
    
    // Check password and confirmation are the same
    if (form.password.value != form.confirmpwd.value)
	return validate_custom_message(form.confirmpwd, "Passwords do not match.");

    return true;
}

function submit_registration(form){
  if (validate_registration(form)) {
    formhash(form);
    var serialized_data = $(form).serialize();
    $.post('peredur/register.ajax.php', serialized_data, function(result) {
      $("#registration_div").hide("blind",function(){
	$("#registration_callback_messages").hide("blind",function(){
	  $("#registration_callback_messages").html(result);
	  $("#registration_callback_messages").show("blind",function(){
	    if( $("#registration_callback_messages").find("label").hasClass("label-danger") ){
	      $("#registration_div").show("blind");
	    }
	  });
	});
      });
    });
  }
}