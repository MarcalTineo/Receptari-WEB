/** @format */

console.log("LOADING SCRIPTS");
window.onload = function () {
	OnLoadHeader();
	try {
		OnLoadRegister();
	} catch (error) {}
	try {
		OnLoadNewRecipe();
	} catch (error) {}
};
