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

    if (navbar) {
      window.addEventListener('scroll', handleScroll);
      handleScroll();
    }

    // Initialize AOS
    if (typeof AOS !== 'undefined') {
      AOS.init({
        once: true,
        duration: 800,
        offset: 50,
      });
    }

    // Koleksi Unggulan Auto Rotation
    const koleksiData = [
      {
        title: "Stellar Drift",
        author: "Nova Sterling",
        desc: "Sebuah novel antariksa yang menggambarkan petualangan di dunia luar angkasa.",
        img: "buku2_mockup.png"
      },
      {
        title: "Beyond the Horizon",
        author: "Alistair GREY",
        desc: "Distopia klasik yang mengeksplorasi pengawasan, kebenaran, dan totaliterisme pemerintahan.",
        img: "buku3_mockup.png"
      },
      {
        title: "Echoes of time",
        author: "Julian Thorne",
        desc: "Perjalanan seorang remaja melalui kompleksitas kecemasan dan keterasingan diri.",
        img: "buku4_mockup.png"
      }
    ];

    let currentKoleksiIndex = 0;
    const koleksiTitle = document.getElementById('koleksi-title');
    const koleksiAuthor = document.getElementById('koleksi-author');
    const koleksiDesc = document.getElementById('koleksi-desc');
    const koleksiImg = document.getElementById('koleksi-img');
    const koleksiContent = document.getElementById('koleksi-content');

    if (koleksiTitle && koleksiAuthor && koleksiDesc && koleksiImg && koleksiContent) {
      setInterval(() => {
        // Fade out
        koleksiContent.style.opacity = '0';
        koleksiImg.style.opacity = '0';

        setTimeout(() => {
          // Change data
          currentKoleksiIndex = (currentKoleksiIndex + 1) % koleksiData.length;
          const data = koleksiData[currentKoleksiIndex];

          koleksiTitle.innerText = data.title;
          koleksiAuthor.innerText = data.author;
          koleksiDesc.innerText = data.desc;

          const currentSrc = koleksiImg.src;
          const basePath = currentSrc.substring(0, currentSrc.lastIndexOf('/') + 1);
          koleksiImg.src = basePath + data.img;

          // Fade in
          koleksiContent.style.opacity = '1';
          koleksiImg.style.opacity = '1';
        }, 500); // tunggu animasi fade out selesai sebelum mengganti data
      }, 5000); //Ganti setiap 5 detik
    }

    // Password eye Toggle
    const togglePasswordBtns = document.querySelectorAll('.btn-toggle-password');
    togglePasswordBtns.forEach(btn => {
      btn.addEventListener('click', function () {
        const wrapper = this.closest('.position-relative');
        if (wrapper) {
          const input = wrapper.querySelector('input');
          if (input) {
            input.type = input.type === 'password' ? 'text' : 'password';
          }
        }
      });
    });

    // Mobile Sidebar Toggle
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.querySelector('.sidebar');
    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', function () {
            sidebar.classList.toggle('show');
        });
        
        // Optional: Close sidebar when clicking outside on mobile
        document.addEventListener('click', function (event) {
            if (window.innerWidth <= 768) {
                const isClickInsideSidebar = sidebar.contains(event.target);
                const isClickOnToggle = sidebarToggle.contains(event.target);
                
                if (!isClickInsideSidebar && !isClickOnToggle && sidebar.classList.contains('show')) {
                    sidebar.classList.remove('show');
                }
            }
        });
    }
  });
