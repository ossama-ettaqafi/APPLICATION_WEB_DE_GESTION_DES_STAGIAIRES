// Selecting DOM elements
const internItems = document.querySelectorAll(".intern-item");
const form = document.querySelector(".edit-form");
const h2 = document.querySelector(".edit-form-h2");
const cancelButton = document.querySelector(".cancelBtn");
const removeImageButton = document.getElementById("removeImage");
const nothingFound = document.getElementById("nothing-found");
const textExplication = document.getElementById("textExplanation");
const searchInput = document.getElementById("searchInput");
const formImage = document.getElementById("imagePreview");

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
  document.getElementById("address").value = "";
  document.getElementById("school").value = "";
  document.getElementById("sector").value = "";
  document.getElementById("startDate").value = "";
  document.getElementById("endDate").value = "";
  document.getElementById("phone").value = "";
  document.getElementById("cin").value = "";
  formImage.src = defaultImagePath; // Set the default image
}

// Function to shorten the intern's name if it's longer than a specified maximum length
function shortenName(name, maxLength) {
  if (name.length > maxLength) {
    return name.substring(0, maxLength) + ".";
  }
  return name;
}

let selectedIntern = null; // Store the currently selected intern
let formVisible = false; // Flag to track if the form is visible

// Update intern selection and form visibility
function updateInternSelection(selectedItem, internId) {
  internItems.forEach(function (item) {
    if (item === selectedItem) {
      item.classList.add("selected");
      selectedIntern = internId; // Store the intern's ID

      // Retrieve the intern's information
      const firstName = item.querySelector(".intern-firstname").textContent;
      const lastName = item.querySelector(".intern-lastname").textContent;
      const age = item.querySelector(".intern-age").textContent;
      const address = item.querySelector(".intern-address").textContent;
      const school = item.querySelector(".intern-school").textContent;
      const sector = item.querySelector(".intern-sector").textContent;
      const startDate = item.querySelector(".intern-start-date").textContent;
      const endDate = item.querySelector(".intern-end-date").textContent;
      const phone = item.querySelector(".intern-phone").textContent;
      const cin = item.querySelector(".intern-cin").textContent;
      const imageSrc = item.querySelector("img").getAttribute("src");

      // Update the form fields with the intern's information
      document.getElementById("firstName").value = firstName;
      document.getElementById("lastName").value = lastName;
      document.getElementById("age").value = age;
      document.getElementById("address").value = address;
      document.getElementById("school").value = school;
      document.getElementById("sector").value = sector;
      document.getElementById("startDate").value = startDate;
      document.getElementById("endDate").value = endDate;
      document.getElementById("phone").value = phone;
      document.getElementById("cin").value = cin;
      formImage.src = imageSrc;
      
      // Update form action with the intern ID
      const form = document.querySelector(".edit-form");
      const formAction = form.getAttribute("action");
      const updatedFormAction = formAction.replace(/\/\d+$/, `/${internId}`);
      form.setAttribute("action", updatedFormAction);

    } else {
      item.classList.remove("selected");
    }
  });

  // Show the form
  form.style.display = "block";
  h2.style.display = "block";
  formVisible = true;
}


// Add event listener to intern items
internItems.forEach(function (item) {
  item.addEventListener("click", function () {
    const isSelected = item.classList.contains("selected");
    const internId = item.getAttribute("data-id");

    if (!isSelected) {
      updateInternSelection(item, internId);
    } else {
      item.classList.remove("selected");
      selectedIntern = null;
      formVisible = false;
      updateFormVisibility();
    }
  });
});

// Add event listener to search input for filtering
searchInput.addEventListener("input", function () {
  const searchTerm = searchInput.value.toLowerCase();
  let anyInternExists = false;
  let selectedInternExists = false;

  // Filter intern items based on search term
  internItems.forEach(function (item) {
    const internDetails = item.querySelector(".intern-details").textContent.toLowerCase();

    if (internDetails.includes(searchTerm)) {
      item.style.display = "block";
      anyInternExists = true;

      // Check if the selected intern exists in the search results
      if (item === selectedIntern) {
        selectedInternExists = true;
      }
    } else {
      item.style.display = "none";
    }
  });

  // Show or hide "nothingFound" based on intern existence
  if (anyInternExists || searchTerm.trim() === "") {
      nothingFound.style.display = "none";
      textExplication.style.display = "block";
  } else {
      nothingFound.style.display = "block";
      textExplication.style.display = "none";
  }

  // Update form visibility based on search results and selected intern
  updateFormVisibility(selectedInternExists);
});

// Update form visibility based on search results and selected intern
function updateFormVisibility(selectedInternExists) {
  if (selectedInternExists) {
    h2.style.display = "block";
    form.style.display = "block";
    formVisible = true;
  } else {
    h2.style.display = "none";
    form.style.display = "none";
    formVisible = false;
  }
}

// Checking if the cancelButton element exists
if (cancelButton) {
  // Adding event listener to the cancel button
  cancelButton.addEventListener("click", function () {
    clearForm();
  });
} else {
  console.log("Cancel button not found!");
}

// Add event listener to "Remove Image" button
if (removeImageButton) {
  removeImageButton.addEventListener("click", function () {
    formImage.src = defaultImagePath;
  });
} else {
  console.log("Remove Image button not found!");
}

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

// Add event listener to image input
const imageInput = document.getElementById("image");
imageInput.addEventListener("change", handleImageInputChange);
imageInput.addEventListener("input", handleImageInputChange); // Update the image preview on input change

// Initial setup
updateInternNames();
form.style.display = "none";
h2.style.display = "none";
