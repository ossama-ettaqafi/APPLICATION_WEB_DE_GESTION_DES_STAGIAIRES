// Selecting DOM elements
const internItems = document.querySelectorAll(".intern-item");
const form = document.querySelector(".edit-form");
const formImage = document.getElementById("imagePreview");
const cancelButton = document.querySelector(".cancelBtn");
const textExplanation = document.getElementById("nothing-found");
const searchInput = document.getElementById("searchInput");
const imageInput = document.getElementById("image");
const uploadImageButton = document.getElementById("uploadImageButton");

// Default image path
const defaultImagePath = "/images/intern.png";

// Function to update intern names in the cards
function updateInternNames() {
  internItems.forEach(function (item) {
    const internName = item.querySelector(".intern-name").textContent;
    const shortenedName = shortenName(internName, 8);
    item.querySelector(".intern-name").textContent = shortenedName;
  });
}

// Function to clear the form and set the default image
function clearForm() {
  document.getElementById("firstName").value = "";
  document.getElementById("lastName").value = "";
  document.getElementById("age").value = "";
  document.getElementById("cin").value = "";
  document.getElementById("phone").value = "";
  document.getElementById("address").value = "";
  document.getElementById("school").value = "";
  document.getElementById("sector").value = "";
  document.getElementById("startDate").value = "";
  document.getElementById("endDate").value = "";
  formImage.src = defaultImagePath; // Set the default image
}

// Function to shorten the intern's name if it's longer than a specified maximum length
function shortenName(name, maxLength) {
  if (name.length > maxLength) {
    return name.substring(0, maxLength) + ".";
  }
  return name;
}

// Add event listener to search input for filtering
searchInput.addEventListener("input", function () {
  const searchTerm = searchInput.value.toLowerCase();
  let anyInternExists = false;

  // Filter intern items based on search term
  internItems.forEach(function (item) {
    const internDetails = item.querySelector(".intern-details").textContent.toLowerCase();

    if (internDetails.includes(searchTerm)) {
      item.style.display = "block";
      anyInternExists = true;
    } else {
      item.style.display = "none";
    }
  });

  // Show or hide "textExplanation" based on intern existence
  if (anyInternExists || searchTerm.trim() === "") {
    textExplanation.style.display = "none";
  } else {
    textExplanation.style.display = "block";
  }
});

// Add event listener to removeImage for clearing the form and setting the default image
document.getElementById("removeImage").addEventListener("click", function () {
  formImage.src = defaultImagePath;
  imageInput.value = ""; // Clear the selected file from the input
});

// Add event listener to cancelButton for clearing the form and deselecting the intern
cancelButton.addEventListener("click", function () {
  clearForm();
});

// Add event listener to image input for previewing selected image
function handleImageInputChange(event) {
  const file = event.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function (event) {
      formImage.src = event.target.result;
    };
    reader.readAsDataURL(file);
  } else {
    formImage.src = defaultImagePath; // Set the default image
  }
}

imageInput.addEventListener("change", handleImageInputChange);
imageInput.addEventListener("input", handleImageInputChange); // Update the image preview on input change
uploadImageButton.addEventListener("click", function () {
  imageInput.click();
});

// Initial setup
updateInternNames();
formImage.src = defaultImagePath;
