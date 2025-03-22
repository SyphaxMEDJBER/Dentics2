function confirmAppointment(element) {
  alert("Rendez-vous confirmé !");
  element.closest("tr").querySelector(".status").textContent = "Confirmé";
  element.closest("tr").querySelector(".status").classList.remove("pending");
  element.closest("tr").querySelector(".status").classList.add("confirmed");
  element.remove();
}

function cancelAppointment(element) {
  if (confirm("Voulez-vous vraiment annuler ce rendez-vous ?")) {
      element.closest("tr").querySelector(".status").textContent = "Annulé";
      element.closest("tr").querySelector(".status").classList.remove("pending", "confirmed");
      element.closest("tr").querySelector(".status").classList.add("cancelled");
      element.remove();
  }
}

document.querySelectorAll(".faq-question").forEach(button => {
  button.addEventListener("click", function() {
      this.nextElementSibling.classList.toggle("visible");
  });
});