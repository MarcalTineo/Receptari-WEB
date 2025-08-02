/** @format */

let styleInput;
let styleIcon;

let input;
let icon;
let searchbar;
let iconColor;

let id;
let animationTime = 20;

let isOpen = false;

function SearchbarSetup() {
	input = document.getElementById("searchbar_input");
	icon = document.getElementById("searchbar_icon");
	searchbar = document.getElementById("searchbar");
	iconColor = document.getElementById("searchbar_icon_path");

	styleInput = input.style;
	styleIcon = icon.style;

	ClearSearchbar();

	searchbar.onmouseenter = function () {
		searchbar.style.backgroundColor = "#283618";
	};

	searchbar.onclick = function () {
		if (!isOpen) {
			isOpen = true;
			iconColor.setAttribute("fill", "#BC6C25");
			input.style.visibility = "visible";
			input.style.display = "block";
			icon.style.left = "-34px";
			searchbar.style.margin = "0px 6px 0px 5px";
			searchbar.style.backgroundColor = "transparent";
			input.value = "";

			clearInterval(id);
			let timer = 0;
			id = setInterval(() => {
				if (timer >= animationTime) {
					clearInterval(id);
					input.style.width = "300px";
					FocusSearchbar(250);
				}
				let width = Interpolate(timer / animationTime, 10, 300, Easing.InOutExpo);
				input.style.width = width + "px";
				timer++;
			}, 0);
		}
	};

	searchbar.onmouseleave = function () {
		clearInterval(id);
		searchbar.style.backgroundColor = "transparent";
		input.blur();
		input.value = "";

		let timer = 0;
		id = setInterval(() => {
			if (timer >= animationTime) {
				clearInterval(id);
				ClearSearchbar(0);
				isOpen = false;
			}
			let width = Interpolate(timer / animationTime, 300, 10, Easing.InOutExpo);
			input.style.width = width + "px";
			timer++;
		}, 0);
	};
}

function FocusSearchbar(timeout = 0) {
	setTimeout(() => {
		input.focus();
	}, timeout);
}

function ClearSearchbar(timeout = 0) {
	setTimeout(() => {
		input.style.visibility = "hidden";
		input.style.display = "none";
		iconColor.setAttribute("fill", "#FEFAE0");
		input.style.width = "10px";
		icon.style.left = "0px";
		searchbar.style.margin = "0px 34px 0px 5px";
	}, timeout);
}
