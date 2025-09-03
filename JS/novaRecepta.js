/** @format */

let input_select = [];

let ingredientRowTemplate;
let ingredientTable;
let numRows = 1;

let leftBtn;
let rightBtn;
let createBtn;
let stepNum;
let textArea;
let inputTitle;

let currentStep = 0;
let maxSteps = 1;
let disabledColor = "#555";
let enabledColor;
let steps_input = [];

let ingredientsArrayInput;
let stepsArrayInput;
let submitBtn;
let form;

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
            selecionNode.value = option.firstElementChild.innerHTML;
         };
      }
   }

   //crear ingredients

   ingredientRowTemplate = document.getElementById("nr_ingredient_row_template");
   ingredientTable = document.getElementById("nr_ingredient_table");
   ingredientTable.lastElementChild.children[0].children[0].addEventListener("click", this.addRow);

   //steps
   steps();

   //submit
   submit();
}

function addRow() {
   //prepare element
   let newRow = ingredientRowTemplate.cloneNode(true);
   newRow.children[1].children[0].name += numRows.toString();
   newRow.children[1].children[0].id += numRows.toString();
   newRow.children[2].children[0].name += numRows.toString();
   newRow.children[2].children[0].id += numRows.toString();
   newRow.children[3].children[0].name += numRows.toString();
   newRow.children[3].children[0].id += numRows.toString();

   newRow.id = "";

   numRows++;

   //place element
   ingredientTable.lastElementChild.insertAdjacentElement("afterend", newRow);
   // console.log(ingredientTable.lastElementChild.children[1].children[0].id);
   attachEvent();
}

function attachEvent() {
   ingredientTable.lastElementChild.children[0].children[0].addEventListener("click", this.addRow);
}

function steps() {
   leftBtn = document.getElementById("nr_step_navbar_left");
   rightBtn = document.getElementById("nr_step_navbar_right");
   createBtn = document.getElementById("nr_step_navbar_create");
   stepNum = document.getElementById("nr_step_navbar_step_number");
   textArea = document.getElementById("nr_step_number");
   inputTitle = document.getElementById("nr_step_number_label");

   enabledColor = leftBtn.style.backgroundColor;
   updateStepNumber();

   leftBtn.onclick = function () {
      console.log("leftClick");
      //limitar sortides d'array
      if (currentStep > 0) {
         steps_input[currentStep] = textArea.value;
         currentStep--;
         textArea.value = steps_input[currentStep] == null ? "" : steps_input[currentStep];
      }

      updateStepNumber();
   };

   rightBtn.onclick = function () {
      console.log("RightClick");

      if (currentStep + 1 < maxSteps) {
         steps_input[currentStep] = textArea.value;
         currentStep++;
         textArea.value = steps_input[currentStep] == null ? "" : steps_input[currentStep];
      }
      updateStepNumber();
   };

   createBtn.onclick = function () {
      console.log("CreateClick");
      maxSteps++;
      updateStepNumber();
   };

   textArea.addEventListener("focusout", (event) => {
      steps_input[currentStep] = textArea.value;
   });
}

function updateStepNumber() {
   stepNum.innerHTML = "PAS #" + (currentStep + 1);
   leftBtn.style.backgroundColor = currentStep == 0 ? disabledColor : enabledColor;
   rightBtn.style.backgroundColor = currentStep == maxSteps - 1 ? disabledColor : enabledColor;
   textArea.placeholder = "Descriu les accions del pas " + (currentStep + 1);
   inputTitle.innerHTML = "Pas " + (currentStep + 1);
}

function submit() {
   ingredientsArrayInput = document.getElementById("nr_ingredients_array");
   stepsArrayInput = document.getElementById("nr_step_array");
   form = document.getElementById("content").children[0];

   // document.onkeydown = function () {
   form.addEventListener("submit", () => {
      //steps
      steps_input[currentStep] = textArea.value; //guarda a l'array la part que esta escribint

      stepsArrayInput.value = JSON.stringify(steps_input); //codifica l'array i assignal al input hidden

      //ingredients
      let ingredientsArray = [];
      let ingredientTableRows = ingredientTable.getElementsByClassName("nr_ingredient_row");
      //saltar la num 0 perque és el header
      //saltar la num 1 perque és la template i no te dades.
      for (let i = 2; i < ingredientTableRows.length; i++) {
         const element = ingredientTableRows[i];
         let ingredient = [];
         // llegeix valors de la taula.
         ingredient[0] = element.children[1].children[0].value;
         ingredient[1] = element.children[2].children[0].value;
         ingredient[2] = element.children[3].children[0].value;

         ingredientsArray.push(ingredient);
      }

      // console.log(ingredientsArrayInput);
      ingredientsArrayInput.value = JSON.stringify(ingredientsArray);
   });
}
