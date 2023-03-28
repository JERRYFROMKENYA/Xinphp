// Get the navigation links and the section headers
const navLinks = document.querySelectorAll('nav ul li a');
const sectionHeaders = document.querySelectorAll('h2, h3');

// Add a click event listener to each navigation link
navLinks.forEach(link => {
  link.addEventListener('click', (event) => {
    // Prevent the default behavior of the link
    event.preventDefault();

    // Get the ID of the target section
    const targetId = link.getAttribute('href').substring(1);

    // Get the target section
    const targetSection = document.getElementById(targetId);

    // Scroll to the target section
    targetSection.scrollIntoView({ behavior: 'smooth' });
  });
});

// Add a click event listener to each section header
sectionHeaders.forEach(header => {
  header.addEventListener('click', () => {
    // Toggle the class on the section to expand or collapse it
    header.parentNode.classList.toggle('expanded');
  });
});
