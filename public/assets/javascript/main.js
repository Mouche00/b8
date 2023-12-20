const URLROOT = "http://localhost/~ycode/b8/"

let url = window.location.href.split("/");
let lastUrlSection = url[url.length - 1].split(".");
let pageName = lastUrlSection[0];

let currentSection = document.querySelector(`#${pageName}`);
currentSection.classList.replace("hover:text-black", "text-black");
currentSection.classList.replace("hover:bg-white", "bg-white");

// console.log(currentSection);

