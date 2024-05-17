// Wait for the DOM content to load
document.addEventListener("DOMContentLoaded", function () {
    // Get the select element and register the event listener
    var sortOptions = document.querySelector(".sort-options");
    var notificationsList = document.querySelector(".notifications");
    var noActivitiesMessage = document.querySelector(".no-activities");
    var sortingDiv = document.querySelector(".sorting");
  
    sortOptions.addEventListener("change", sortNotifications);
  
    // Define the sortNotifications function
    function sortNotifications() {
      var notifications = document.querySelectorAll(".notification-item");
      var notificationsArray = Array.from(notifications);
  
      var selectedOption = sortOptions.value;
  
      notificationsArray.sort(function (a, b) {
        switch (selectedOption) {
          case "date-desc":
            return (
              new Date(b.querySelector(".notification-time").dataset.timestamp) -
              new Date(a.querySelector(".notification-time").dataset.timestamp)
            );
          case "date-asc":
            return (
              new Date(a.querySelector(".notification-time").dataset.timestamp) -
              new Date(b.querySelector(".notification-time").dataset.timestamp)
            );
          case "name-a-z":
            return a
              .querySelector(".notification-content h3")
              .textContent.localeCompare(
                b.querySelector(".notification-content h3").textContent
              );
          case "name-z-a":
            return b
              .querySelector(".notification-content h3")
              .textContent.localeCompare(
                a.querySelector(".notification-content h3").textContent
              );
          default:
            return 0;
        }
      });
  
      if (notificationsArray.length === 0) {
        noActivitiesMessage.style.display = "block";
        notificationsList.style.display = "none";
        sortingDiv.style.display = "none";
      } else {
        noActivitiesMessage.style.display = "none";
        notificationsList.style.display = "block";
        sortingDiv.style.display = "block";
  
        notificationsList.innerHTML = "";
  
        notificationsArray.forEach(function (notification) {
          notificationsList.appendChild(notification);
        });
      }
    }
  
    // Initial check for activities
    sortNotifications();
  });