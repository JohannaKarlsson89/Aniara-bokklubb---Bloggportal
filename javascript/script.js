 
/*
*Johanna Karlsson 
*Webbutveckling, Mittuniversitetet.
*/
// function for showing the links in hamburgermenu 
function popoutmenu() {
    //get the elements i want to change
    let menu = document.getElementById("menu");
    let icon_x = document.getElementById("icon_x");
    let icon_menu = document.getElementById("icon_menu");
    //checks if the navigations links are showing 
    if (menu.style.display === "block") {
      //hiding them
      menu.style.display = "none";
      //hide x-icon
      icon_x.style.display = "none";
      //display menu icon
      icon_menu.style.display = "block";
    } else {
      menu.style.display = "block";
      icon_x.style.display = "block";
      icon_menu.style.display = "none";
    }
  }
//function for enable and disable registrera-button
function accepts(checkbox_toggle){
  //get the submit button and save it
  let submit = document.getElementById("submit_button");
  //If the checkbox has been checked
  if(checkbox_toggle.checked){
      //enable button
       submit.disabled = false;
  // if the checkbox is not checked
  } else{
      //disable it
      submit.disabled = true;
  }
}

