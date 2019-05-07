let buttonAbout = document.getElementById("main__about");
let buttonVision = document.getElementById("main__vision");

// change of about us button 
buttonAbout.addEventListener("mouseenter", ()=>{
    buttonAbout.classList.add("main__about--click");
})
buttonAbout.addEventListener("mouseleave", ()=>{
    buttonAbout.classList.remove("main__about--click");
})
buttonAbout.addEventListener("click", ()=>{
	window.location.replace("./about/index.php");
})

// change of our vision button
buttonVision.addEventListener("mouseenter", ()=>{
    buttonVision.classList.add("main__vision--click");
})
buttonVision.addEventListener("mouseleave", ()=>{
    buttonVision.classList.remove("main__vision--click");
})
