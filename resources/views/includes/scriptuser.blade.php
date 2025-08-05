
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script> {{-- Asumsi main.js mungkin memiliki fungsi global atau inisialisasi --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


  <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Event listeners untuk popup
            const appointmentButton = document.querySelector('.appointment-submit-button');
            if (appointmentButton) { // Periksa apakah elemen ada sebelum menambahkan listener
                appointmentButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    const devPopup = document.getElementById('devPopup');
                    if (devPopup) {
                        devPopup.style.display = 'flex';
                    }
                });
            }

            const closePopupButton = document.querySelector('.close-popup');
            if (closePopupButton) { // Periksa apakah elemen ada
                closePopupButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    const devPopup = document.getElementById('devPopup');
                    if (devPopup) {
                        devPopup.style.display = 'none';
                    }
                });
            }

            const devPopupElement = document.getElementById('devPopup');
            if (devPopupElement) { // Periksa apakah elemen ada
                // Gunakan event listener yang lebih spesifik untuk klik latar belakang popup
                devPopupElement.addEventListener('click', function(e) {
                    if (e.target === devPopupElement) { // Hanya tutup jika mengklik latar belakang, bukan anak-anaknya
                        e.preventDefault();
                        devPopupElement.style.display = 'none';
                    }
                });
            }

            // Inisialisasi Splide
            const informasiSlider = document.getElementById('informasi-slider');
            if (informasiSlider && typeof Splide !== 'undefined') { // Periksa apakah elemen dan Splide sudah didefinisikan
                new Splide(informasiSlider, {
                    type: 'loop',
                    perPage: 3,
                    focus: 'left',
                    perMove: 1,
                    autoplay: true,
                    interval: 1500,
                    gap: '1rem',
                    arrows: false,
                    pagination: false,
                    padding: {
                        left: '2rem',
                        right: '2rem'
                    },
                    breakpoints: {
                        992: {
                            perPage: 2,
                            padding: {
                                left: '1rem',
                                right: '1rem'
                            },
                        },
                        768: {
                            perPage: 1,
                            padding: {
                                left: '3rem',
                                right: '3rem'
                            },
                        }
                    }
                }).mount();
            }

            // Inisialisasi AOS
            if (typeof AOS !== 'undefined') { // Periksa apakah AOS sudah didefinisikan sebelum menginisialisasi
                AOS.init();
            }
        });


        $(document).ready(function () {
        $('#informasiTable').DataTable({
            "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
            "language": {
            "lengthMenu": "Tampilkan _MENU_ data per halaman",
            "zeroRecords": "Tidak ada data ditemukan",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            "infoEmpty": "Tidak ada data tersedia",
            "infoFiltered": "(difilter dari total _MAX_ data)",
            "search": "Cari:",
            "paginate": {
                "first": "Awal",
                "last": "Akhir",
                "next": "›",
                "previous": "‹"
            },
            }
        });
        });



        window.addEventListener("load", function () {
            const preloader = document.getElementById("preloader");
            preloader.classList.add("opacity-0");
            setTimeout(() => preloader.style.display = "none", 500);
        });


        const appointmentForm = document.querySelector('.appointment-form');
        if(appointmentForm) {
            const comingSoonModal = new bootstrap.Modal(document.getElementById('comingSoonModal'));
            
            appointmentForm.addEventListener('submit', (e) => {
                e.preventDefault(); // Mencegah form untuk submit
                comingSoonModal.show(); // Menampilkan modal
            });
        }

        // Script untuk mengelola tab agenda
     document.addEventListener('DOMContentLoaded', () => {
        const agendaList = document.querySelector('.agenda-list');

        agendaList.addEventListener('click', (e) => {
            // Find the clicked agenda-item
            const clickedItem = e.target.closest('.agenda-item');
            if (!clickedItem) return;

            const targetId = clickedItem.dataset.target;
            const targetDetailCard = document.getElementById(targetId);

            // Check if the clicked item is already active
            const isAlreadyActive = clickedItem.classList.contains('active');

            // Deactivate all items first
            document.querySelectorAll('.agenda-item.active').forEach(item => {
                item.classList.remove('active');
            });
            document.querySelectorAll('.agenda-detail-card.active').forEach(card => {
                card.classList.remove('active');
            });

            // If the clicked item was NOT already active, activate it
            if (!isAlreadyActive) {
                clickedItem.classList.add('active');
                targetDetailCard.classList.add('active');
            }
        });
    });


    document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('.appointment-form');
    const modalEl = document.getElementById('comingSoonModal');

    if (!form || !modalEl || typeof bootstrap === 'undefined') return;

    const modal = new bootstrap.Modal(modalEl);

    form.addEventListener('submit', function (e) {
        e.preventDefault(); // MENCEGAH redirect atau reload halaman
        modal.show();       // MUNCULKAN modal
    });
    });

</script>