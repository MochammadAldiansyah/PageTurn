// kode animasi navbar ketika di scroll
  document.addEventListener('DOMContentLoaded', function () {
    const navbar = document.getElementById('mainNavbar');
    const scrollThreshold = 10;

    function handleScroll() {
      if (window.scrollY > scrollThreshold) {
        navbar.classList.add('navbar-scrolled');
      } else {
        navbar.classList.remove('navbar-scrolled');
      }
    }

    window.addEventListener('scroll', handleScroll);
    handleScroll();
  });
