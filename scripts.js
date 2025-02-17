const imageInput = document.querySelector('#photo');
const imageLabel = document.querySelector('#photo-label');

if(imageInput) {
    imageInput.addEventListener('change', function () {
        if (imageInput.files.length > 0) {
            imageLabel.innerHTML = imageInput.files[0].name; // Display selected file name
        } else {
            imageLabel.innerHTML = "Upload Photo"; // Reset if no file selected
        }
    });
}


const mobileNav = document.querySelector(".mobile-nav");
const menu = document.querySelector(".menu");

mobileNav.addEventListener("click", function () {
    menu.style.display = (menu.style.display === "block") ? "none" : "block";
});