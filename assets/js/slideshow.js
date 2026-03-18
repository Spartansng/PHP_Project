const slides = document.querySelectorAll(".slide");
let index = 0;

function showSlide(i) {
    slides.forEach(slide => slide.classList.remove("active"));
    slides[i].classList.add("active");
}

if (slides.length > 0) {
    setInterval(() => {
        index = (index + 1) % slides.length;
        showSlide(index);
    }, 4000);
}
EOF
bashcat > assets/js/achievement.js << 'EOF'
document.addEventListener("DOMContentLoaded", function () {
    const popup = document.getElementById("achievement-popup");
    if (popup) {
        setTimeout(() => {
            popup.style.opacity = "0";
        }, 3000);
    }
});