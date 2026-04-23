function openCard() {
    document.getElementById("cardModal").style.display = "flex";
}

function closeCard() {
    document.getElementById("cardModal").style.display = "none";
}

// cerrar haciendo click fuera
window.onclick = function(e) {
    const modal = document.getElementById("cardModal");
    if (e.target === modal) {
        modal.style.display = "none";
    }
}