// Wait for the DOM content to load
document.addEventListener("DOMContentLoaded", function () {
  const sidebar = document.querySelector(".sidebar");
  const sidebarClose = document.querySelector("#sidebar-close");
  const main = document.querySelectorAll(".main");
  const navbar = document.querySelectorAll("header");
  const userNames = document.querySelectorAll(".user-name");
  const submenuItems = document.querySelectorAll(".submenu-item");

  if (sidebar && sidebarClose) {
    sidebarClose.addEventListener("click", () => sidebar.classList.toggle("close"));
  }

  function closeSidebarOnLowHeight() {
    const pageHeight = document.documentElement.clientHeight;
    const pageWidth = document.documentElement.clientWidth;

    if (sidebar && sidebarClose) {
      if (pageHeight < 600 || pageWidth < 800) {
        sidebar.classList.add("close");
        sidebarClose.style.display = "none";
      } else {
        sidebar.classList.remove("close");
        sidebarClose.style.display = "block";
      }
    }
  }

  closeSidebarOnLowHeight();
  window.addEventListener("resize", closeSidebarOnLowHeight);

  userNames.forEach((userName) => {
    if (userName.offsetWidth < userName.scrollWidth) {
      userName.setAttribute("data-overflow", "");
    }
  });

  submenuItems.forEach((item) => {
    let isHovered = false;

    item.addEventListener("click", (event) => {
      const tooltip = item.querySelector(".tooltiptext");
      tooltip.style.visibility = "hidden";
      isHovered = false;

      event.stopPropagation();
    });

    item.addEventListener("mouseenter", () => {
      if (!isHovered) {
        const tooltip = item.querySelector(".tooltiptext");
        tooltip.style.visibility = "visible";
        isHovered = true;
      }
    });

    item.addEventListener("mouseleave", () => {
      if (isHovered) {
        const tooltip = item.querySelector(".tooltiptext");
        tooltip.style.visibility = "hidden";
        isHovered = false;
      }
    });
  });

  const menu1 = document.getElementById('menu1');
  const menu2 = document.getElementById('menu2');
  const submenuItem = document.querySelector('#menu1 .submenu-item');
  const menuTitle = document.querySelector('#menu2 .menu-title');

  menu2.style.display = 'none';

  submenuItem.addEventListener('click', function () {
    menu1.style.display = 'none';
    menu2.style.display = 'inline-block';
  });

  menuTitle.addEventListener('click', function () {
    menu1.style.display = 'inline-block';
    menu2.style.display = 'none';
  });
});
