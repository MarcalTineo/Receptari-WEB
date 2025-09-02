/** @format */

let input_select = [];

function OnLoadNewRecipe() {
   //selectors de tags
   input_select = document.getElementsByClassName("nr_input_select");

   for (const input of input_select) {
      let options = input.children;
      for (let i = 0; i < options.length - 1; i++) {
         const option = options[i];
         console.log(option.firstElementChild.innerHTML);
         option.onclick = function () {
            //desseleccionar anteriorrs
            for (const element of options) {
               element.classList.remove("nr_tag_selected");
            }
            //seleccionar nous
            option.classList.add("nr_tag_selected");

            //escriure resposta
            let selecionNode = input.lastElementChild;
            selecionNode.innerHTML = option.firstElementChild.innerHTML;
         };
      }
   }

   //suggeriments

   //crear ingredients
}
