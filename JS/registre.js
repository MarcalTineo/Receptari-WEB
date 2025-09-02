/** @format */

let submitButton;

let nameIF;
let surname1IF;
let surname2IF;
let emailIF;
let phoneIF;
let addressIF;
let usernameIF;
let passwordIF;
let rPasswordIF;

let borderColor = "#283c0f";

function OnLoadRegister() {
	nameIF = document.getElementById("registre_nom");
	surname1IF = document.getElementById("registre_cognom1");
	surname2IF = document.getElementById("registre_cognom2");
	emailIF = document.getElementById("registre_email");
	phoneIF = document.getElementById("registre_tel");
	addressIF = document.getElementById("registre_address");
	usernameIF = document.getElementById("registre_username");
	passwordIF = document.getElementById("registre_password");
	rPasswordIF = document.getElementById("registre_Rpassword");
	submitButton = document.getElementById("register_submit");

	submitButton.disabled = true;

	getInputField(nameIF).oninput = function () {
		CheckInputFields();
	};
	getInputField(surname1IF).oninput = function () {
		CheckInputFields();
	};
	getInputField(surname2IF).oninput = function () {
		CheckInputFields();
	};
	getInputField(phoneIF).oninput = function () {
		CheckInputFields();
	};
	getInputField(emailIF).oninput = function () {
		CheckInputFields();
	};
	getInputField(addressIF).oninput = function () {
		CheckInputFields();
	};
	getInputField(usernameIF).oninput = function () {
		CheckInputFields();
	};
	getInputField(passwordIF).oninput = function () {
		CheckInputFields();
	};
	getInputField(rPasswordIF).oninput = function () {
		CheckInputFields();
	};
	submitButton.onmouseenter = function () {
		CheckInputFields();
	};
}

function CheckInputFields() {
	let value;
	let allOK = true;

	value = getInputField(nameIF).value;
	if (value == null || value.trim() == "") {
		nameIF.style.borderColor = "red";
		allOK = false;
	} else {
		nameIF.style.borderColor = borderColor;
	}

	value = getInputField(surname1IF).value;
	if (value == null || value.trim() == "") {
		surname1IF.style.borderColor = "red";
		allOK = false;
	} else {
		surname1IF.style.borderColor = borderColor;
	}

	value = getInputField(emailIF).value;
	if (!validateEmail(value)) {
		emailIF.style.borderColor = "red";
		allOK = false;
	} else {
		emailIF.style.borderColor = borderColor;
	}

	value = getInputField(phoneIF).value;
	if (value == null || value.trim() == "") {
		allOK = false;
		phoneIF.style.borderColor = "red";
	} else {
		phoneIF.style.borderColor = borderColor;
	}

	value = getInputField(addressIF).value;
	if (value == null || value.trim() == "") {
		allOK = false;
		addressIF.style.borderColor = "red";
	} else {
		addressIF.style.borderColor = borderColor;
	}

	value = getInputField(usernameIF).value;
	if (value == null || value.trim() == "") {
		allOK = false;
		usernameIF.style.borderColor = "red";
	} else {
		usernameIF.style.borderColor = borderColor;
	}

	value = getInputField(passwordIF).value;
	if (value == null || value.trim() == "") {
		allOK = false;
		passwordIF.style.borderColor = "red";
	} else {
		passwordIF.style.borderColor = borderColor;
	}

	let password = value;
	value = getInputField(rPasswordIF).value;
	if (value != password) {
		allOK = false;
		rPasswordIF.style.borderColor = "red";
	} else {
		rPasswordIF.style.borderColor = borderColor;
	}

	if (allOK) {
		submitButton.disabled = false;
	} else {
		submitButton.disabled = true;
	}
}

function validateEmail(email) {
	const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

	return emailPattern.test(email);
}

function getInputField(parentElement) {
	return parentElement.getElementsByClassName("registre_input_field")[0].firstElementChild;
}
