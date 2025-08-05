/**
 * Kode Navigasi Mobile Final
 */
(function() {
    "use strict";

/**
 * Logika Header: Sembunyikan saat scroll, tampilkan hanya di puncak halaman.
 */
document.addEventListener('DOMContentLoaded', () => {
    "use strict";

    const selectBody = document.querySelector('body');
    const selectHeader = document.querySelector('#header');

    if (selectHeader) {
        const handleHeaderState = () => {
            // Aturan #1: Prioritas utama adalah menampilkan topbar jika sudah di puncak.
            // Angka 10px memberi sedikit ruang toleransi.
            if (window.scrollY < 5) {
                selectBody.classList.remove('scrolled');
            } 
            // Aturan #2: Jika tidak di puncak dan sudah scroll melewati 100px, sembunyikan topbar.
            else if (window.scrollY > 110) {
                selectBody.classList.add('scrolled');
            }
            // Jika posisi scroll di antara 10px dan 100px, tidak ada yang terjadi.
            // State header akan tetap (entah itu 'scrolled' atau tidak).
        };

        // Jalankan fungsi setiap kali ada event scroll
        window.addEventListener('scroll', handleHeaderState);
    }
});




    
    document.addEventListener('scroll', toggleScrolled);
    window.addEventListener('load', toggleScrolled);
    const preloader = document.querySelector('#preloader');
    if (preloader) {
        window.addEventListener('load', () => {
            preloader.remove();
        });
    }
    let scrollTop = document.querySelector('.scroll-top');
    if (scrollTop) {
        function toggleScrollTop() {
            window.scrollY > 100 ? scrollTop.classList.add('active') : scrollTop.classList.remove('active');
        }
        scrollTop.addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
        window.addEventListener('load', toggleScrollTop);
        document.addEventListener('scroll', toggleScrollTop);
    }
    if (typeof AOS !== 'undefined') {
        window.addEventListener('load', () => {
            AOS.init({
                duration: 600,
                easing: 'ease-in-out',
                once: true,
                mirror: false
            });
        });
    }
    if (typeof GLightbox !== 'undefined') {
        const glightbox = GLightbox({
            selector: '.glightbox'
        });
    }
    if (typeof PureCounter !== 'undefined') {
        new PureCounter();
    }
    if (typeof Swiper !== 'undefined') {
        window.addEventListener("load", () => {
            document.querySelectorAll(".init-swiper").forEach(function(swiperElement) {
                let config = JSON.parse(swiperElement.querySelector(".swiper-config").innerHTML.trim());
                new Swiper(swiperElement, config);
            });
        });
    }
    document.querySelectorAll('.faq-item h3, .faq-item .faq-toggle').forEach((faqItem) => {
        faqItem.addEventListener('click', () => {
            faqItem.parentNode.classList.toggle('faq-active');
        });
    });
    window.addEventListener('load', function(e) {
        if (window.location.hash) {
            if (document.querySelector(window.location.hash)) {
                setTimeout(() => {
                    let section = document.querySelector(window.location.hash);
                    let scrollMarginTop = getComputedStyle(section).scrollMarginTop;
                    window.scrollTo({
                        top: section.offsetTop - parseInt(scrollMarginTop),
                        behavior: 'smooth'
                    });
                }, 100);
            }
        }
    });
    let navmenulinks = document.querySelectorAll('.navmenu a');

    function navmenuScrollspy() {
        navmenulinks.forEach(navmenulink => {
            if (!navmenulink.hash) return;
            let section = document.querySelector(navmenulink.hash);
            if (!section) return;
            let position = window.scrollY + 200;
            if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
                document.querySelectorAll('.navmenu a.active').forEach(link => link.classList.remove('active'));
                navmenulink.classList.add('active');
            } else {
                navmenulink.classList.remove('active');
            }
        })
    }
    window.addEventListener('load', navmenuScrollspy);
    document.addEventListener('scroll', navmenuScrollspy);


    /**
     * ===================================================================
     * SCRIPT NAVIGASI MOBILE BARU
     * ===================================================================
     */
    const body = document.querySelector('body');

    // Fungsi untuk membuka/menutup menu utama (hamburger)
    function mobileNavToggle() {
        body.classList.toggle('mobile-nav-active');
        mobileNavToggleBtn.classList.toggle('bi-list');
        mobileNavToggleBtn.classList.toggle('bi-x');
    }

    const mobileNavToggleBtn = document.querySelector('.mobile-nav-toggle');
    if (mobileNavToggleBtn) {
        mobileNavToggleBtn.addEventListener('click', mobileNavToggle);
    }

    // Event listener untuk semua link di dalam menu
    document.querySelectorAll('.navmenu a').forEach(link => {
        link.addEventListener('click', function(e) {
            if (body.classList.contains('mobile-nav-active')) {
                const parentLi = this.closest('li');
                const submenu = parentLi.querySelector('ul');

                // Jika link punya submenu (adalah parent)
                if (submenu) {
                    e.preventDefault(); // Batalkan navigasi
                    parentLi.classList.toggle('active'); // Toggle highlight di <li>
                    submenu.classList.toggle('dropdown-active'); // Toggle dropdown di <ul>
                } else {
                    // Jika link biasa, tutup menu utama
                    mobileNavToggle();
                }
            }
        });
    });

})();