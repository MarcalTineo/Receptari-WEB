/** @format */

const NavPages = {
	inici: 0,
	novetats: 1,
	categories: 2,
	contacte: 3,
	perfil: 4,
	nova_recepta: 5,
	login: 6,
	registre: 7,
};
let nav_buttons = [];

function OnLoadHeader() {
	nav_buttons[NavPages.inici] = document.getElementById("header_nav_inici");
	nav_buttons[NavPages.novetats] = document.getElementById("header_nav_novetats");
	nav_buttons[NavPages.categories] = document.getElementById("header_nav_categories");
	nav_buttons[NavPages.contacte] = document.getElementById("header_nav_contacte");
	nav_buttons[NavPages.perfil] = document.getElementById("header_profile");
	nav_buttons[NavPages.nova_recepta] = document.getElementById("header_create_recipe");
	nav_buttons[NavPages.login] = document.getElementById("header_login");
	nav_buttons[NavPages.registre] = document.getElementById("register");
}
