const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");
const openPopupBtn = document.querySelector("#open-popup-btn");
const closePopupBtn = document.querySelector("#close-popup-btn");
const popup = document.querySelector("#popup");

sign_up_btn.addEventListener("click", () => {
    container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
    container.classList.remove("sign-up-mode");
});

openPopupBtn.addEventListener("click", () => {
    popup.style.display = "block";
});

closePopupBtn.addEventListener("click", () => {
    popup.style.display = "none";
});

window.addEventListener("click", (event) => {
    if (event.target === popup) {
        popup.style.display = "none";
    }
});

function openPopup() {
    document.querySelector(".popup-overlay").style.display = "block";
    document.querySelector(".popup").style.display = "block";
}

function closePopup() {
    document.querySelector(".popup-overlay").style.display = "none";
    document.querySelector(".popup").style.display = "none";
}

document.querySelector(".close-btn").addEventListener("click", closePopup);

document.querySelector("#open-popup-btn").addEventListener("click", openPopup);
