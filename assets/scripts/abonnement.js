const buttons = document.querySelectorAll(".choose-offer-btn");
const modal = document.getElementById("paymentModal");
const selectedOffer = document.getElementById("selectedOffer");
const selectedPrice = document.getElementById("selectedPrice");
const confirmButton = document.getElementById("confirmPayment");
const cancelButton = document.getElementById("cancelPayment");
const formPayment = document.getElementById("paymentForm");
buttons.forEach((button) => {
    button.addEventListener("click", () => {
        const offerName = button
            .closest(".offer-container")
            .querySelector(".offer-title").innerText;
        const offerPrice = button
            .closest(".offer-container")
            .querySelector(".main-price").innerText;
        selectedOffer.innerText = offerName;
        selectedPrice.innerText = offerPrice;
        modal.classList.add("show");
    });
});
confirmButton.addEventListener("click", () => {
    const cardNumber = document.getElementById("cardNumber").value;
    const cardHolder = document.getElementById("cardHolder").value;
    const expiryDate = document.getElementById("expiryDate").value;
    const cvv = document.getElementById("cvv").value;
    if (cardNumber && cardHolder && expiryDate && cvv) {
        modal.classList.remove("show");
        formPayment.action="appliquerAbo/"+selectedOffer.innerText;
        alert("Paiement réussi ! Merci pour votre abonnement.");

    } else {
        alert("Veuillez remplir tous les champs pour procéder au paiement.");
    }
});
cancelButton.addEventListener("click", () => {
    modal.classList.remove("show");
});
window.addEventListener("click", (event) => {
    if (event.target === modal) {
        modal.classList.remove("show");
    }
});