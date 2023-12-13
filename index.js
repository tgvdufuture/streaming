function toggleSearch() {
  var searchInput = document.getElementById("search-input");
  var closeButton = document.getElementById("close-button");
  var searchButton = document.getElementById("search-button");

  // Inverse la visibilité de l'input de recherche, du bouton de fermeture et de la loupe
  searchInput.classList.toggle("hidden");
  closeButton.classList.toggle("hidden");
  searchButton.classList.toggle("hidden");
}

function resetSearch() {
  var searchInput = document.getElementById("search-input");
  var closeButton = document.getElementById("close-button");
  var searchButton = document.getElementById("search-button");

  // Réinitialise en cachant l'input de recherche et le bouton de fermeture, et en réaffichant la loupe
  searchInput.classList.add("hidden");
  closeButton.classList.add("hidden");
  searchButton.classList.remove("hidden");
}

document
  .getElementById("search-input")
  .addEventListener("keyup", function (event) {
    if (event.key === "Enter") {
      // Récupérer la valeur de l'input de recherche
      var searchTerm = this.value.trim();

      // Vérifier si le terme de recherche n'est pas vide
      if (searchTerm !== "") {
        // Effectuer une redirection vers la page search.php avec le terme de recherche en tant que paramètre
        window.location.href = "search.php?q=" + encodeURIComponent(searchTerm);
      }
    }
  });

// Le reste de votre code reste inchangé...

function performSearch(searchTerm) {
  // Effectuer une requête AJAX pour récupérer les résultats de la recherche
  fetch("search.php?q=" + encodeURIComponent(searchTerm))
    .then((response) => {
      // Vérifier si la requête a abouti
      if (!response.ok) {
        throw new Error("La recherche a échoué");
      }
      // Convertir la réponse en texte
      return response.text();
    })
    .then((data) => {
      // Manipuler les résultats de la recherche et les afficher sur la page
      document.getElementById("search-results").innerHTML = data;
    })
    .catch((error) => {
      console.error("Erreur lors de la recherche :", error);
      // Gérer les erreurs, par exemple, afficher un message d'erreur à l'utilisateur
      document.getElementById("search-results").innerHTML =
        "Une erreur s'est produite lors de la recherche.";
    });
}

// carousel
document.addEventListener("DOMContentLoaded", function () {
  var carousels = document.querySelectorAll(".carousel");

  function updateButtons(carousel) {
    var carouselRow = carousel.querySelector(".row-container");
    var maxIndex = Math.max(0, carouselRow.children.length - 6);
    var prevButton = carousel.querySelector(".prevBTN");
    var nextButton = carousel.querySelector(".nextBTN");
    prevButton.disabled = carousel.dataset.currentIndex <= 0;
    nextButton.disabled = carousel.dataset.currentIndex >= maxIndex;
  }

  function slide(carousel, direction) {
    var carouselRow = carousel.querySelector(".row-container");
    var currentIndex = parseInt(carousel.dataset.currentIndex, 10);
    var maxIndex = Math.max(0, carouselRow.children.length - 6);

    if (direction === "right" && currentIndex < maxIndex) {
      carousel.dataset.currentIndex = currentIndex + 1;
    } else if (direction === "left" && currentIndex > 0) {
      carousel.dataset.currentIndex = currentIndex - 1;
    }

    updateCarousel(carousel);
  }

  function updateCarousel(carousel) {
    var carouselRow = carousel.querySelector(".row-container");
    var currentIndex = parseInt(carousel.dataset.currentIndex, 10);
    var containerWidth = carouselRow.querySelector(".container").offsetWidth;
    var translateX = -containerWidth * currentIndex;

    carouselRow.style.transition = "transform 0.5s ease-in-out";
    carouselRow.style.transform = "translateX(" + translateX + "px)";

    setTimeout(function () {
      carouselRow.style.transition = ""; // Réinitialiser la transition après l'animation
    }, 500);

    updateButtons(carousel);
  }

  carousels.forEach(function (carousel) {
    carousel.dataset.currentIndex = 0;
    updateButtons(carousel);

    var buttons = carousel.querySelectorAll(".flt-left");
    buttons.forEach(function (button) {
      button.addEventListener("click", function (event) {
        var direction = button.classList.contains("prevBTN") ? "left" : "right";
        slide(carousel, direction);
      });
    });
  });
});
