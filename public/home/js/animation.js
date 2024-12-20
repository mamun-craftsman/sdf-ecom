
document.addEventListener("DOMContentLoaded", () => {
  const animatedDivs = document.querySelectorAll('.animate-move');

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.remove('hidden'); // Remove hidden
      } else {
        entry.target.classList.add('hidden');
      }
    });
  }, { threshold: 0.1 }); // Trigger when 10% of the div is in view

  animatedDivs.forEach(div => observer.observe(div));
});
