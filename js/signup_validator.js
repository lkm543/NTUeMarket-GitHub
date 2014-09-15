function checkForm() {
// Fetching values from all input fields and storing them in variables.
var name = document.getElementById("signup_user").value;
var password = document.getElementById("signup_pass").value;
var email = document.getElementById("signup_email").value;
//Check input Fields Should not be blanks.
if (name == '' || password == '' || email == '') {
	alert("All fields are required!");
} else {
//Notifying error fields
var username1 = document.getElementById("user_alert");
var password1 = document.getElementById("pass_alert");
var email1 = document.getElementById("email_alert");
//Check All Values/Informations Filled by User are Valid Or Not.If All Fields Are invalid Then Generate alert.
if (username1.innerHTML == '*Must have 5-15 letters' || username1.innerHTML == '*English letters or numbers only' || username1.innerHTML == '*Username unavailable, please enter another' || password1.innerHTML == '*Password too short' || email1.innerHTML == '*Invalid email address' || email1.innerHTML == '*This email has been registered') {
	alert("Please fill in valid information");
} else {
//Submit Form When All values are valid.
document.getElementById("signup_form").submit();
}
}
}
// AJAX code to check input field values when onblur event triggerd.
function validate(field, query) {
	var xmlhttp;
if (window.XMLHttpRequest) { // for IE7+, Firefox, Chrome, Opera, Safari
	xmlhttp = new XMLHttpRequest();
} else { // for IE6, IE5
	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange = function() {
	if (xmlhttp.readyState != 4 && xmlhttp.status == 200) {
		document.getElementById(field).innerHTML = "Validating..";
	} else if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		document.getElementById(field).innerHTML = xmlhttp.responseText;
	} else {
		document.getElementById(field).innerHTML = "Error Occurred. <a href='index.php'>Reload Or Try Again</a> the page.";
	}
}
xmlhttp.open("GET", "signup_validation.php?field=" + field + "&query=" + query, false);
xmlhttp.send();
}