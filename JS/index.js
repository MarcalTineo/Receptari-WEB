/** @format */

console.log("LOADING SCRIPTS");
window.onload = function () {
	OnLoadHeader();
	try {
		OnLoadRegister();
	} catch (error) {
		console.log("No Register");
	}
};
