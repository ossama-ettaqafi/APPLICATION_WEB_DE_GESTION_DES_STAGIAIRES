// Function to filter table based on search term
function filterTable(filter) {
  var table = document.querySelector("table");
  var rows = table.getElementsByTagName("tr");
  var noResultsRow = document.querySelector(".no-results-row");
  var showMoreButton = document.querySelector(".show-more button");

  var found = false; // Flag to track if any matching results are found

  // Start iteration from index 1 to skip the table head
  for (var i = 1; i < rows.length; i++) {
    var rowMatches = false; // Flag to track if the row matches the search query

    var cells = rows[i].getElementsByTagName("td");
    for (var j = 0; j < cells.length; j++) {
      var cell = cells[j];
      if (cell) {
        var textValue = cell.textContent || cell.innerText;
        textValue = textValue.toLowerCase(); // Convert to lowercase for case-insensitive search
        if (textValue.indexOf(filter) > -1) {
          rowMatches = true;
          break;
        }
      }
    }

    rows[i].style.display = rowMatches ? "" : "none";

    if (rowMatches) {
      found = true;
    }
  }

  // Show/hide the "No results found" row and "Show More" button
  noResultsRow.style.display = found ? "none" : "";
  showMoreButton.style.display = found ? "" : "none";
}

function startSearch() {
  const searchInput = document.querySelector(".search-input");
  const searchTerm = searchInput.value.trim().toLowerCase();

  // Check if the search term is a number (ID search)
  const searchById = !isNaN(searchTerm);

  filterTable(searchTerm, searchById);
}

// Show message overlay on button click
document.addEventListener("DOMContentLoaded", function () {
  const showMessageButtons = document.querySelectorAll(".show-message-btn");
  const messageOverlay = document.getElementById("message");
  const internIdSpan = document.getElementById("intern-id");
  const confirmDeleteButton = document.getElementById("confirm-delete-btn");
  const cancelDeleteButton = document.getElementById("cancel-delete-btn");
  let internIdToDelete = null;

  showMessageButtons.forEach(function (button) {
    button.addEventListener("click", function (event) {
      event.preventDefault(); // Prevent the form submission

      const internId = button.dataset.internId;
      internIdToDelete = internId; // Store the intern ID to delete
      internIdSpan.textContent = internId; // Update the span with the intern ID
      showConfirmationMessage();
    });
  });

  function showConfirmationMessage() {
    messageOverlay.style.display = "flex";
  }

  confirmDeleteButton.onclick = function () {
    deleteIntern(internIdToDelete);
    messageOverlay.style.display = "none";
  };

  cancelDeleteButton.onclick = function () {
    messageOverlay.style.display = "none";
  };

  window.addEventListener("click", function (event) {
    if (event.target === messageOverlay) {
      messageOverlay.style.display = "none";
    }
  });

  function deleteIntern(internId) {
    const deleteForm = document.querySelector('.delete-form');
    const formAction = deleteForm.getAttribute("action");
    const updatedFormAction = formAction.replace(/\/\d+$/, `/${internId}`);
    deleteForm.setAttribute("action", updatedFormAction);
    deleteForm.submit();
  }
});

// Show edit form overlay on button click
document.addEventListener("DOMContentLoaded", function () {
  const modifyButtons = document.querySelectorAll(".modify-btn");
  const editForm = document.getElementById("edit-form");
  const cancelButton = document.querySelector(".form-container .cancel-button");
  const formOverlay = document.querySelector(".form-overlay");

  modifyButtons.forEach(function (button) {
    button.addEventListener("click", function () {
      formOverlay.style.display = "block"; // Show the form overlay
      editForm.style.display = "block"; // Show the form
    });
  });

  cancelButton.addEventListener("click", function () {
    closeFormOverlay();
  });

  formOverlay.addEventListener("click", function (event) {
    if (event.target === formOverlay) {
      closeFormOverlay();
    }
  });

  function closeFormOverlay() {
    formOverlay.style.display = "none"; // Hide the form overlay
    editForm.style.display = "none"; // Hide the form
  }
});

// Show add form overlay on button click
document.addEventListener("DOMContentLoaded", function () {
  const addButtons = document.querySelectorAll(".add-new-intern-button button");
  const addForm = document.querySelector(".overlay");
  const cancelButton = document.querySelector(".cancel-button");

  addButtons.forEach(function (button) {
    button.addEventListener("click", function () {
      addForm.style.display = "block"; // Show the form overlay
    });
  });

  cancelButton.addEventListener("click", function () {
    closeFormOverlay();
  });

  addForm.addEventListener("click", function (event) {
    if (
      event.target === addForm ||
      event.target.classList.contains("cancel-button")
    ) {
      closeFormOverlay();
    }
  });

  function closeFormOverlay() {
    addForm.style.display = "none"; // Hide the form overlay
  }
});

// Show intern details overlay on card click
function showInternDetails(internId) {
  const internCard = event.currentTarget;
  const overlayContainer = document.getElementById("overlay-container-"+internId);
  const overlayCard = overlayContainer.querySelector(".overlay-card");
  const closeButton = overlayCard.querySelector(".close-button");

  // Show the overlay
  overlayContainer.style.display = "flex";

  // Add event listener to hide the overlay when the background is clicked
  overlayContainer.addEventListener("click", function (event) {
    if (event.target === overlayContainer) {
      hideInternDetails(internId);
    }
  });
}

// Function to hide intern details overlay
function hideInternDetails(internId) {
  const overlayContainer = document.getElementById("overlay-container-"+internId);

  // Hide the overlay
  overlayContainer.style.display = "none";
}

function editIntern(button) {
  // Get the row element
  var row = button.parentNode.parentNode;

  // Get the values from the row
  var id = row.cells[0].innerText;
  var firstName = row.cells[2].innerText;
  var lastName = row.cells[3].innerText;
  var age = row.cells[4].innerText;
  var cin = row.cells[5].innerText;
  var phone = row.cells[6].innerText;
  var address = row.cells[7].innerText;
  var school = row.cells[8].innerText;
  var sector = row.cells[9].innerText;
  var startDate = row.cells[10].innerText;
  var endDate = row.cells[11].innerText;

  // Set the values in the edit form
  document.getElementById('edit-firstname').value = firstName;
  document.getElementById('edit-lastname').value = lastName;
  document.getElementById('edit-age').value = age;
  document.getElementById('edit-cin').value = cin;
  document.getElementById('edit-phone').value = phone;
  document.getElementById('edit-address').value = address;
  document.getElementById('edit-school').value = school;
  document.getElementById('edit-sector').value = sector;
  document.getElementById('edit-startdate').value = startDate;
  document.getElementById('edit-enddate').value = endDate;
  

  // Show the edit form
  document.querySelector('.form-overlay').style.display = 'block';

  // Update form action with the intern ID
  const form = document.getElementById("edit-form");
  const formAction = form.getAttribute("action");
  const updatedFormAction = formAction.replace(/\/\d+$/, `/${id}`);
  form.setAttribute("action", updatedFormAction);
}