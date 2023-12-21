const URLROOT = "http://localhost/~ycode/b8/"

let url = window.location.href.split("/");
let lastUrlSection = url[url.length - 1].split(".");
let pageName = lastUrlSection[0];

let sidebar = document.querySelector(`#sidebar`);
let allSections = Array.from(sidebar.children);
allSections.forEach(e => {
    e.classList.replace("text-black", "hover:text-black");
    e.classList.replace("bg-white", "hover:bg-white"); 
});

let currentSection = document.querySelector(`#${pageName}`);
currentSection.classList.replace("hover:text-black", "text-black");
currentSection.classList.replace("hover:bg-white", "bg-white");

// console.log(currentSection);

