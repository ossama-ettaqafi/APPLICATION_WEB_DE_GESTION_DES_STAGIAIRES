document.addEventListener("DOMContentLoaded", function() {
  const searchInput = document.getElementById("searchInput");
  const internItems = document.querySelectorAll(".intern-item");
  const nothingFound = document.getElementById("nothing-found");
  const textExplication = document.getElementById("textExplanation");
  const deleteIcon = document.querySelector('.delete-icon');

  // Filter interns based on search input
  searchInput.addEventListener("input", function(event) {
      const searchValue = event.target.value.toLowerCase();
      let anyInternExists = false;

      internItems.forEach(function(item) {
          const internDetails = item.querySelector(".intern-details");
          const internDetailsText = internDetails.textContent.toLowerCase();

          if (internDetailsText.includes(searchValue)) {
              item.style.display = "block";
              anyInternExists = true;
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
  });

  // Add click event listeners to each intern item
  internItems.forEach((item) => {
      const checkbox = item.querySelector('.intern-checkbox');
      const internName = item.querySelector('.intern-name');

      item.addEventListener("click", () => {
          // Toggle the 'selected' class on the clicked item
          item.classList.toggle("selected");

          // Check if any intern item is selected
          const anyInternSelected = document.querySelector(".intern-item.selected");

          // Show or hide the delete icon based on selection
          if (anyInternSelected) {
              deleteIcon.style.display = 'block';
          } else {
              deleteIcon.style.display = 'none';
          }

          // Mark or unmark the checkbox based on selection
          checkbox.checked = item.classList.contains("selected");
      });

      // Deselect intern cards by default
      item.classList.remove("selected");

      // Modify intern names if they exceed a certain length
      const originalName = internName.textContent;
      const maxLength = 8;

      if (originalName.length > maxLength) {
          const truncatedName = originalName.substring(0, maxLength) + ".";
          internName.textContent = truncatedName;
          internName.title = originalName;
      }
  });
});

function deleteInterns() {
  const form = document.getElementById('delete-form');
  const checkboxes = document.querySelectorAll('.intern-checkbox:checked');

  if (checkboxes.length === 0) {
      return; // No interns selected, exit the function
  }

  checkboxes.forEach((checkbox) => {
      const internId = checkbox.dataset.id;
      const input = document.createElement('input');
      input.setAttribute('type', 'hidden');
      input.setAttribute('name', 'intern_ids[]');
      input.setAttribute('value', internId);
      form.appendChild(input);
  });

  form.submit();
}

function handleCheckboxChange() {
  const checkboxes = document.querySelectorAll('.intern-checkbox:checked');
  const deleteIcon = document.querySelector('.delete-icon');

  if (checkboxes.length > 0) {
      deleteIcon.style.display = 'block';
  } else {
      deleteIcon.style.display = 'none';
  }
}