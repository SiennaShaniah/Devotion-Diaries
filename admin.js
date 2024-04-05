// FOR THE SIDEBAR
let body = document.querySelector(".body")


let menu = document.querySelector(".menu")
let sidebar = document.querySelector(".sidebar")
let mainContainer = document.querySelector(".main--container")

menu.onclick = function(){
    sidebar.classList.toggle("activemenu")
}
mainContainer.onclick = function(){
    sidebar.classList.remove("activemenu")
}

