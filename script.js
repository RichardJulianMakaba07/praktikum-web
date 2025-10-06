document.addEventListener('DOMContentLoaded', function() {
    // Ambil status login dari atribut data di body
    const isLoggedIn = document.body.dataset.loggedIn === 'true';

    // ===== LOADING SPINNER =====
    function showLoadingSpinner() {
        const spinner = document.getElementById('loading-spinner');
        if (spinner) {
            spinner.style.display = 'block';
        }
    }

    function hideLoadingSpinner() {
        const spinner = document.getElementById('loading-spinner');
        if (spinner) {
            spinner.style.display = 'none';
        }
    }

    // ===== NAVBAR SCROLL EFFECT =====
    const navbar = document.querySelector('.navbar');
    const navLinks = document.querySelectorAll('.nav-links a');
    
    window.addEventListener('scroll', function() {
        if (window.scrollY > 100) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // ===== SMOOTH SCROLL AND EXTERNAL LINK HANDLING =====
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            console.log('Link clicked:', this.getAttribute('href')); // Debugging
            const href = this.getAttribute('href');
            
            if (href.startsWith('#')) {
                e.preventDefault();
                const targetSection = document.querySelector(href);
                if (targetSection) {
                    const offsetTop = targetSection.offsetTop - 80;
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            } else {
                e.preventDefault();
                showLoadingSpinner();
                setTimeout(() => {
                    window.location.href = href;
                }, 500); // Delay untuk menunjukkan spinner
            }
        });
    });

    // ===== MOBILE MENU TOGGLE =====
    const mobileMenuBtn = createMobileMenuButton();
    const navLinksContainer = document.querySelector('.nav-links');
    
    function createMobileMenuButton() {
        const btn = document.createElement('button');
        btn.className = 'mobile-menu-btn';
        btn.innerHTML = '☰';
        btn.setAttribute('aria-label', 'Toggle mobile menu');
        document.querySelector('.nav-content').appendChild(btn);
        return btn;
    }

    mobileMenuBtn.addEventListener('click', function() {
        console.log('Mobile menu toggled'); // Debugging
        navLinksContainer.classList.toggle('mobile-active');
        this.classList.toggle('active');
        this.innerHTML = this.classList.contains('active') ? '✕' : '☰';
    });

    // ===== ANIMATED COUNTERS =====
    const counters = document.querySelectorAll('.angka-statistik, .angka-dampak, .stat-number');
    const observerOptions = {
        threshold: 0.5,
        rootMargin: '0px'
    };

    const counterObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                counterObserver.unobserve(entry.target);
            }
        });
    }, observerOptions);

    counters.forEach(counter => {
        counterObserver.observe(counter);
    });

    function animateCounter(element) {
        const target = parseInt(element.textContent.replace(/[^\d]/g, '')) || 0;
        const suffix = element.textContent.replace(/[\d]/g, '');
        let current = 0;
        const increment = target / 100;
        const duration = 2000;
        const stepTime = duration / 100;

        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            
            if (target >= 1000) {
                element.textContent = Math.floor(current / 1000) + 'K' + suffix;
            } else {
                element.textContent = Math.floor(current) + suffix;
            }
        }, stepTime);
    }

    // ===== DONATION AND VOLUNTEER FORM MODAL =====
    createDonationModal();
    createVolunteerModal();
    createContactModal();
    
    function createDonationModal() {
        const modalHTML = `
            <div id="donation-modal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Form Donasi Makanan</h2>
                    <form id="donation-form">
                        <div class="form-group">
                            <label for="donor-name">Nama Lengkap:</label>
                            <input type="text" id="donor-name" name="donor-name" required>
                        </div>
                        <div class="form-group">
                            <label for="donor-phone">Nomor Telepon:</label>
                            <input type="tel" id="donor-phone" name="donor-phone" required pattern="[0-9]{10,12}" title="Nomor telepon harus 10-12 angka">
                        </div>
                        <div class="form-group">
                            <label for="food-type">Jenis Makanan:</label>
                            <select id="food-type" name="food-type" required>
                                <option value="">Pilih jenis makanan</option>
                                <option value="nasi-lauk">Nasi + Lauk</option>
                                <option value="roti-kue">Roti & Kue</option>
                                <option value="buah-sayur">Buah & Sayur</option>
                                <option value="makanan-siap-saji">Makanan Siap Saji</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="portions">Jumlah Porsi:</label>
                            <input type="number" id="portions" name="portions" min="1" required>
                        </div>
                        <div class="form-group">
                            <label for="pickup-time">Waktu Pickup:</label>
                            <input type="datetime-local" id="pickup-time" name="pickup-time" required>
                        </div>
                        <div class="form-group">
                            <label for="location">Alamat Pickup:</label>
                            <textarea id="location" name="location" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="notes">Catatan Tambahan:</label>
                            <textarea id="notes" name="notes" rows="2"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim Donasi</button>
                    </form>
                </div>
            </div>
        `;
        document.body.insertAdjacentHTML('beforeend', modalHTML);
    }

    function createVolunteerModal() {
        const modalHTML = `
            <div id="volunteer-modal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Daftar Sebagai Relawan</h2>
                    <form id="volunteer-form">
                        <div class="form-group">
                            <label for="volunteer-name">Nama Lengkap:</label>
                            <input type="text" id="volunteer-name" name="volunteer-name" required>
                        </div>
                        <div class="form-group">
                            <label for="volunteer-email">Email:</label>
                            <input type="email" id="volunteer-email" name="volunteer-email" required>
                        </div>
                        <div class="form-group">
                            <label for="volunteer-phone">Nomor Telepon:</label>
                            <input type="tel" id="volunteer-phone" name="volunteer-phone" required pattern="[0-9]{10,12}" title="Nomor telepon harus 10-12 angka">
                        </div>
                        <div class="form-group">
                            <label for="volunteer-area">Area Tempat Tinggal:</label>
                            <input type="text" id="volunteer-area" name="volunteer-area" required>
                        </div>
                        <div class="form-group">
                            <label for="availability">Ketersediaan:</label>
                            <select id="availability" name="availability" required>
                                <option value="">Pilih ketersediaan</option>
                                <option value="weekdays">Hari Kerja</option>
                                <option value="weekends">Akhir Pekan</option>
                                <option value="flexible">Fleksibel</option>
                                <option value="emergency-only">Hanya Darurat</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="transportation">Transportasi:</label>
                            <select id="transportation" name="transportation" required>
                                <option value="">Pilih transportasi</option>
                                <option value="motor">Sepeda Motor</option>
                                <option value="car">Mobil</option>
                                <option value="bicycle">Sepeda</option>
                                <option value="public">Transportasi Umum</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="volunteer-notes">Mengapa ingin menjadi relawan?</label>
                            <textarea id="volunteer-notes" name="volunteer-notes" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Daftar Relawan</button>
                    </form>
                </div>
            </div>
        `;
        document.body.insertAdjacentHTML('beforeend', modalHTML);
    }

    function createContactModal() {
        const modalHTML = `
            <div id="contact-modal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <h2>Kirim Pesan</h2>
                    <form id="contact-modal-form">
                        <div class="form-group">
                            <label for="contact-name">Nama Lengkap:</label>
                            <input type="text" id="contact-name" name="contact-name" required>
                        </div>
                        <div class="form-group">
                            <label for="contact-email">Email:</label>
                            <input type="email" id="contact-email" name="contact-email" required>
                        </div>
                        <div class="form-group">
                            <label for="contact-message">Pesan Anda:</label>
                            <textarea id="contact-message" name="contact-message" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim Pesan</button>
                    </form>
                </div>
            </div>
        `;
        document.body.insertAdjacentHTML('beforeend', modalHTML);
    }

    // ===== PROTECTED ACTIONS =====
    const actionButtons = document.querySelectorAll('[data-action]');
    actionButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const action = this.dataset.action;
            if (!isLoggedIn) {
                showNotification('Silakan login terlebih dahulu untuk melanjutkan.', 'info');
                showLoadingSpinner();
                setTimeout(() => {
                    window.location.href = `login.php?redirect=${action}`;
                }, 500);
                return;
            }

            if (action === 'donate') {
                document.getElementById('donation-modal').style.display = 'block';
                document.body.style.overflow = 'hidden';
            } else if (action === 'volunteer') {
                document.getElementById('volunteer-modal').style.display = 'block';
                document.body.style.overflow = 'hidden';
            } else if (action === 'contact') {
                document.getElementById('contact-modal').style.display = 'block';
                document.body.style.overflow = 'hidden';
            }
        });
    });

    // ===== MODAL HANDLING =====
    const donationModal = document.getElementById('donation-modal');
    const volunteerModal = document.getElementById('volunteer-modal');
    const contactModal = document.getElementById('contact-modal');
    
    const closeButtons = document.querySelectorAll('.close');
    closeButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            donationModal.style.display = 'none';
            volunteerModal.style.display = 'none';
            contactModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
    });

    window.addEventListener('click', function(e) {
        if (e.target === donationModal || e.target === volunteerModal || e.target === contactModal) {
            donationModal.style.display = 'none';
            volunteerModal.style.display = 'none';
            contactModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    });

    // ===== FORM SUBMISSIONS =====
    const donationForm = document.getElementById('donation-form');
    const volunteerForm = document.getElementById('volunteer-form');
    const contactForm = document.getElementById('contact-form');
    const contactModalForm = document.getElementById('contact-modal-form');

    if (donationForm) {
        donationForm.addEventListener('submit', function(e) {
            e.preventDefault();
            if (validateForm(this)) {
                const formData = new FormData(this);
                const donationData = Object.fromEntries(formData);
                showNotification('Terima kasih! Donasi Anda telah berhasil didaftarkan. Tim kami akan menghubungi Anda segera.', 'success');
                this.reset();
                donationModal.style.display = 'none';
                document.body.style.overflow = 'auto';
                updateStatistics();
            }
        });
    }

    if (volunteerForm) {
        volunteerForm.addEventListener('submit', function(e) {
            e.preventDefault();
            if (validateForm(this)) {
                const formData = new FormData(this);
                const volunteerData = Object.fromEntries(formData);
                showNotification('Selamat datang di keluarga FoodCycle! Kami akan menghubungi Anda untuk orientasi relawan.', 'success');
                this.reset();
                volunteerModal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });
    }

    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            if (validateForm(this)) {
                showNotification('Pesan Anda telah terkirim! Kami akan membalas dalam 24 jam.', 'success');
                this.reset();
            }
        });
    }

    if (contactModalForm) {
        contactModalForm.addEventListener('submit', function(e) {
            e.preventDefault();
            if (validateForm(this)) {
                showNotification('Pesan Anda telah terkirim! Kami akan membalas dalam 24 jam.', 'success');
                this.reset();
                contactModal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });
    }

    // ===== FORM VALIDATION =====
    function validateForm(form) {
        const inputs = form.querySelectorAll('input, select, textarea');
        let valid = true;
        inputs.forEach(input => {
            if (!input.checkValidity()) {
                input.classList.add('invalid');
                valid = false;
            } else {
                input.classList.remove('invalid');
            }
        });
        if (!valid) {
            showNotification('Harap isi semua kolom dengan benar.', 'error');
        }
        return valid;
    }

    // ===== NOTIFICATIONS =====
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.innerHTML = `
            <span>${message}</span>
            <button class="notification-close">&times;</button>
        `;
        document.body.appendChild(notification);
        setTimeout(() => {
            notification.classList.add('show');
        }, 100);
        setTimeout(() => {
            hideNotification(notification);
        }, 5000);
        notification.querySelector('.notification-close').addEventListener('click', () => {
            hideNotification(notification);
        });
    }

    function hideNotification(notification) {
        notification.classList.remove('show');
        setTimeout(() => {
            notification.remove();
        }, 300);
    }

    // ===== UPDATE STATISTICS =====
    function updateStatistics() {
        const stats = document.querySelectorAll('.angka-statistik, .stat-number');
        stats.forEach(stat => {
            const current = parseInt(stat.textContent.replace(/[^\d]/g, '')) || 0;
            const newValue = current + Math.floor(Math.random() * 10) + 1;
            if (stat.textContent.includes('K')) {
                stat.textContent = Math.floor(newValue / 1000) + 'K+';
            } else {
                stat.textContent = newValue;
            }
        });
    }

    // ===== DARK MODE TOGGLE =====
    const darkModeToggle = createDarkModeToggle();
    
    function createDarkModeToggle() {
        const toggle = document.createElement('button');
        toggle.className = 'dark-mode-toggle';
        toggle.innerHTML = '🌙';
        toggle.setAttribute('aria-label', 'Toggle dark mode');
        document.querySelector('.nav-content').appendChild(toggle);
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
            document.body.classList.add('dark-mode');
            toggle.innerHTML = '☀️';
        }
        return toggle;
    }

    darkModeToggle.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
        if (document.body.classList.contains('dark-mode')) {
            this.innerHTML = '☀️';
            localStorage.setItem('theme', 'dark');
        } else {
            this.innerHTML = '🌙';
            localStorage.setItem('theme', 'light');
        }
    });

    // ===== TESTIMONIAL CAROUSEL =====
    const testimoniGrid = document.querySelector('.testimoni-grid');
    const testimonials = document.querySelectorAll('.kartu-testimoni');
    
    if (testimonials.length > 0) {
        let currentTestimonial = 0;
        const carouselControls = document.createElement('div');
        carouselControls.className = 'carousel-controls';
        carouselControls.innerHTML = `
            <button class="carousel-btn prev">‹</button>
            <div class="carousel-dots"></div>
            <button class="carousel-btn next">›</button>
        `;
        testimoniGrid.parentNode.appendChild(carouselControls);
        const dotsContainer = carouselControls.querySelector('.carousel-dots');
        testimonials.forEach((_, index) => {
            const dot = document.createElement('button');
            dot.className = `carousel-dot ${index === 0 ? 'active' : ''}`;
            dot.addEventListener('click', () => goToTestimonial(index));
            dotsContainer.appendChild(dot);
        });
        const prevBtn = carouselControls.querySelector('.prev');
        const nextBtn = carouselControls.querySelector('.next');
        const dots = carouselControls.querySelectorAll('.carousel-dot');
        prevBtn.addEventListener('click', () => {
            currentTestimonial = currentTestimonial === 0 ? testimonials.length - 1 : currentTestimonial - 1;
            updateTestimonialDisplay();
        });
        nextBtn.addEventListener('click', () => {
            currentTestimonial = currentTestimonial === testimonials.length - 1 ? 0 : currentTestimonial + 1;
            updateTestimonialDisplay();
        });
        function goToTestimonial(index) {
            currentTestimonial = index;
            updateTestimonialDisplay();
        }
        function updateTestimonialDisplay() {
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentTestimonial);
            });
            if (window.innerWidth <= 768) {
                testimonials[currentTestimonial].scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest',
                    inline: 'center'
                });
            }
        }
        setInterval(() => {
            currentTestimonial = currentTestimonial === testimonials.length - 1 ? 0 : currentTestimonial + 1;
            updateTestimonialDisplay();
        }, 5000);
    }

    // ===== SEARCH FUNCTIONALITY =====
    const searchBtn = createSearchButton();
    
    function createSearchButton() {
        const btn = document.createElement('button');
        btn.className = 'search-btn';
        btn.innerHTML = '🔍';
        btn.setAttribute('aria-label', 'Search');
        document.querySelector('.nav-content').appendChild(btn);
        btn.addEventListener('click', function() {
            const searchTerm = prompt('Cari informasi di FoodCycle:');
            if (searchTerm) {
                performSearch(searchTerm);
            }
        });
        return btn;
    }

    function performSearch(term) {
        const searchableElements = document.querySelectorAll('h1, h2, h3, p');
        const results = [];
        searchableElements.forEach(element => {
            if (element.textContent.toLowerCase().includes(term.toLowerCase())) {
                results.push({
                    element: element,
                    text: element.textContent.trim(),
                    section: element.closest('section')?.id || 'unknown'
                });
            }
        });
        if (results.length > 0) {
            showSearchResults(results, term);
        } else {
            showNotification(`Tidak ditemukan hasil untuk "${term}"`, 'info');
        }
    }

    function showSearchResults(results, term) {
        const resultsHTML = results.slice(0, 5).map(result => `
            <div class="search-result" data-section="${result.section}">
                <h4>Di bagian: ${getSectionName(result.section)}</h4>
                <p>${highlightTerm(result.text, term)}</p>
            </div>
        `).join('');
        const modal = document.createElement('div');
        modal.className = 'modal';
        modal.innerHTML = `
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Hasil Pencarian untuk "${term}"</h2>
                <div class="search-results">
                    ${resultsHTML}
                </div>
            </div>
        `;
        document.body.appendChild(modal);
        modal.style.display = 'block';
        modal.querySelectorAll('.search-result').forEach(result => {
            result.addEventListener('click', function() {
                const sectionId = this.dataset.section;
                const section = document.getElementById(sectionId);
                if (section) {
                    modal.remove();
                    section.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
        modal.querySelector('.close').addEventListener('click', () => {
            modal.remove();
        });
    }

    function getSectionName(sectionId) {
        const sectionNames = {
            'home': 'Beranda',
            'about': 'Tentang Kami', 
            'fitur': 'Fitur',
            'carakerja': 'Cara Kerja',
            'dampak': 'Dampak',
            'testimoni': 'Testimoni',
            'berita': 'Berita',
            'kontak': 'Kontak'
        };
        return sectionNames[sectionId] || 'Bagian Lain';
    }

    function highlightTerm(text, term) {
        const regex = new RegExp(`(${term})`, 'gi');
        return text.replace(regex, '<mark>$1</mark>');
    }

    // ===== LAZY LOADING IMAGES =====
    const images = document.querySelectorAll('img');
    const imageObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                }
                imageObserver.unobserve(img);
            }
        });
    });

    images.forEach(img => {
        imageObserver.observe(img);
    });

    // ===== FLOATING ACTION BUTTON =====
    const fab = document.createElement('div');
    fab.className = 'floating-action-btn';
    fab.innerHTML = '💬';
    fab.title = 'Hubungi Kami';
    document.body.appendChild(fab);

    fab.addEventListener('click', function() {
        if (!isLoggedIn) {
            showNotification('Silakan login terlebih dahulu untuk menghubungi kami.', 'info');
            showLoadingSpinner();
            setTimeout(() => {
                window.location.href = 'login.php?redirect=contact';
            }, 500);
            return;
        }
        const phone = '+6281212345678';
        const message = 'Halo FoodCycle! Saya tertarik untuk berkontribusi.';
        const whatsappURL = `https://wa.me/${phone}?text=${encodeURIComponent(message)}`;
        window.open(whatsappURL, '_blank');
    });

    // ===== SCROLL TO TOP BUTTON =====
    const scrollTopBtn = document.createElement('button');
    scrollTopBtn.className = 'scroll-top-btn';
    scrollTopBtn.innerHTML = '↑';
    scrollTopBtn.title = 'Kembali ke atas';
    document.body.appendChild(scrollTopBtn);

    window.addEventListener('scroll', function() {
        if (window.scrollY > 500) {
            scrollTopBtn.classList.add('show');
        } else {
            scrollTopBtn.classList.remove('show');
        }
    });

    scrollTopBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // ===== LOGIN FORM VALIDATION =====
    const loginForm = document.getElementById('login-form');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            const username = document.getElementById('username');
            const password = document.getElementById('password');
            if (!username.value || !password.value) {
                e.preventDefault();
                showNotification('Harap isi username dan password.', 'error');
                username.classList.add('invalid');
                password.classList.add('invalid');
            }
        });
    }

    console.log('FoodCycle website loaded successfully! 🌱');
});