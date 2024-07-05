// Function to toggle the active class on the navigation links
function setActiveNavLink() {
    const navLinksContainer = document.querySelector('.my-nav');
    navLinksContainer.addEventListener('click', function (event) {
      event.preventDefault();
      const clickedNavLink = event.target.closest('.my-nav-link');
      if (clickedNavLink) {
        const navLinks = document.querySelectorAll('.my-nav-link');
        navLinks.forEach((navLink) => navLink.classList.remove('active'));
        clickedNavLink.classList.add('active');
        const target = clickedNavLink.getAttribute('href').substring(1);
        const tabPanes = document.querySelectorAll('.my-tab-pane');
        tabPanes.forEach((tabPane) => (tabPane.style.display = 'none'));
        document.getElementById(target).style.display = 'block';
      }
    });
  }
  
  // Function to handle window resize event and toggle the active class on navigation links
  function handleResize() {
    const navLinks = document.querySelectorAll('.my-nav-link');
    const activeNavLink = document.querySelector('.my-nav-link.active');
    const activeTabIndex = Array.from(navLinks).indexOf(activeNavLink);
    navLinks.forEach((navLink) => navLink.classList.remove('active'));
    navLinks[activeTabIndex].classList.add('active');
    setActiveTabContent(activeTabIndex);
  }
  
  // Function to toggle the active class on the tab content
  function setActiveTabContent(index) {
    const tabPanes = document.querySelectorAll('.my-tab-pane');
    tabPanes.forEach((tabPane) => (tabPane.style.display = 'none'));
    tabPanes[index].style.display = 'block';
  }
  
  // Event listener for window resize
  window.addEventListener('resize', handleResize);
  
  // Initial setup on page load
  document.addEventListener('DOMContentLoaded', function () {
    setActiveNavLink();
    handleResize();
  });
  