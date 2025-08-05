    <section class="appointment-section">
        <div>
            <div class="appointment-background" data-aos="fade-up" data-aos-delay="200">
                <img src="{{ asset('assets/img/fotodokter.png') }}" alt="foto dokter" class="foto-dokter">
            </div>
            <div class="appointment-form-container" data-aos="fade-up" data-aos-delay="200">
                <div class="appointment-now-tab">Buat Janji Sekarang</div>
                <div class="appointment-form-content">
                    <h2>Formulir Janji Temu</h2>
                </div>
                <form class="appointment-form" id="appointment-form">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="your-name">Nama Anda</label>
                            <input type="text" id="your-name" name="name" placeholder="Enter your name" required>
                        </div>
                        <div class="form-group">
                            <label for="your-email">Email Anda</label>
                            <input type="email" id="your-email" name="email" placeholder="Masukkan email Anda" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone-number">Nomor Telepon</label>
                            <input type="tel" id="phone-number" name="phone" placeholder="Masukkan nomor telepon Anda" required>
                        </div>
                        <div class="form-group">
                            <label for="treatment">Perawatan</label>
                            <select id="treatment" name="treatment" required>
                                <option value="">Pilih Perawatan</option>
                                <option value="Angioplasty">Angioplasty</option>
                                <option value="Cardiology">Cardiology</option>
                                <option value="Dermatology">Dermatology</option>
                                <option value="Pediatrics">Pediatrics</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message">Pesan</label>
                        <textarea id="message" name="message" rows="4" placeholder="Pesan Anda"></textarea>
                    </div>
                    <button type="submit" class="appointment-submit-button" data-bs-toggle="modal" data-bs-target="#comingSoonModal">
                        Buat Janji <span class="arrow">→</span>
                    </button>
                </form>
            </div>
        </div>
    </section>
    @include('modals.comingsoonmodal')  