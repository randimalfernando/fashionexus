<<<<<<< HEAD
// js for admin dashboard navigation
let list = document.querySelectorAll(".navigation li");

function activeLink(event) {
  if (event) event.preventDefault(); 

  list.forEach((item) => {
    item.classList.remove("hovered");
  });

  this.classList.add("hovered");

  // To display the corresponding content
  let target = this.getAttribute("data-target");
  let contentSections = document.querySelectorAll(".details > div");
  contentSections.forEach((section) => {
    section.style.display = "none";
  });

  // Show the selected section
  if (target) {
    document.querySelector(`.${target}`).style.display = "block";
  }
}

list.forEach((item) => {
  item.removeEventListener("click", activeLink); 
  item.addEventListener("click", activeLink);
});

// Menu Toggle
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");

toggle.onclick = function () {
  navigation.classList.toggle("active");
  main.classList.toggle("active");
};

// Set default active item and content on page load
document.addEventListener("DOMContentLoaded", () => {
  let defaultItem = document.querySelector('li[data-target="dashboard"]'); 
  if (defaultItem) {
    defaultItem.click(); 
  }
});



=======
// js for admin dashboard navigation
let list = document.querySelectorAll(".navigation li");

function activeLink(event) {
  if (event) event.preventDefault(); 

  list.forEach((item) => {
    item.classList.remove("hovered");
  });

  this.classList.add("hovered");

  // To display the corresponding content
  let target = this.getAttribute("data-target");
  let contentSections = document.querySelectorAll(".details > div");
  contentSections.forEach((section) => {
    section.style.display = "none";
  });

  // Show the selected section
  if (target) {
    document.querySelector(`.${target}`).style.display = "block";
  }
}

list.forEach((item) => {
  item.removeEventListener("click", activeLink); 
  item.addEventListener("click", activeLink);
});

// Menu Toggle
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");

toggle.onclick = function () {
  navigation.classList.toggle("active");
  main.classList.toggle("active");
};

// Set default active item and content on page load
document.addEventListener("DOMContentLoaded", () => {
  let defaultItem = document.querySelector('li[data-target="dashboard"]'); 
  if (defaultItem) {
    defaultItem.click(); 
  }
});



>>>>>>> 91105eb802265e963dae491a690e1cdf2e8713f5
