document.addEventListener('DOMContentLoaded', function() {
    
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

    // ===== SMOOTH SCROLL FOR NAVIGATION =====
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            
            if (targetSection) {
                const offsetTop = targetSection.offsetTop - 80;
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
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
        navLinksContainer.classList.toggle('mobile-active');
        this.classList.toggle('active');
        this.innerHTML = this.classList.contains('active') ? '✕' : '☰';
    });

    // ===== ANIMATED COUNTERS =====
    const counters = document.querySelectorAll('.angka-statistik, .angka-dampak');
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
        const target = parseInt(element.textContent.replace(/[^\d]/g, ''));
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
                element.textContent = (Math.floor(current / 1000)) + 'K' + suffix;
            } else {
                element.textContent = Math.floor(current) + suffix;
            }
        }, stepTime);
    }

    // ===== DONATION FORM MODAL =====
    const donationBtns = document.querySelectorAll('.btn-primary, .btn-cta');
    const volunteerBtns = document.querySelectorAll('.btn-secondary');
    
    // Create modal HTML
    createDonationModal();
    createVolunteerModal();
    
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
                            <input type="tel" id="donor-phone" name="donor-phone" required>
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
                            <input type="tel" id="volunteer-phone" name="volunteer-phone" required>
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

    // Modal event listeners
    const donationModal = document.getElementById('donation-modal');
    const volunteerModal = document.getElementById('volunteer-modal');
    
    // Open modals
    donationBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            if (this.textContent.includes('Donasi') || this.classList.contains('btn-cta')) {
                e.preventDefault();
                donationModal.style.display = 'block';
                document.body.style.overflow = 'hidden';
            }
        });
    });
    
    volunteerBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            volunteerModal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        });
    });

    // Close modals
    const closeButtons = document.querySelectorAll('.close');
    closeButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            donationModal.style.display = 'none';
            volunteerModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
    });

    // Close modal when clicking outside
    window.addEventListener('click', function(e) {
        if (e.target === donationModal || e.target === volunteerModal) {
            donationModal.style.display = 'none';
            volunteerModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    });

    // ===== FORM SUBMISSIONS =====
    const donationForm = document.getElementById('donation-form');
    const volunteerForm = document.getElementById('volunteer-form');

    donationForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Simulate form submission
        const formData = new FormData(this);
        const donationData = Object.fromEntries(formData);
        
        // Show success message
        showNotification('Terima kasih! Donasi Anda telah berhasil didaftarkan. Tim kami akan menghubungi Anda segera.', 'success');
        
        // Reset form and close modal
        this.reset();
        donationModal.style.display = 'none';
        document.body.style.overflow = 'auto';
        
        // Update statistics (simulate)
        updateStatistics();
    });

    volunteerForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Simulate form submission
        const formData = new FormData(this);
        const volunteerData = Object.fromEntries(formData);
        
        // Show success message
        showNotification('Selamat datang di keluarga FoodCycle! Kami akan menghubungi Anda untuk orientasi relawan.', 'success');
        
        // Reset form and close modal
        this.reset();
        volunteerModal.style.display = 'none';
        document.body.style.overflow = 'auto';
    });

    // ===== NOTIFICATIONS =====
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.innerHTML = `
            <span>${message}</span>
            <button class="notification-close">&times;</button>
        `;
        
        document.body.appendChild(notification);
        
        // Show notification
        setTimeout(() => {
            notification.classList.add('show');
        }, 100);
        
        // Auto hide after 5 seconds
        setTimeout(() => {
            hideNotification(notification);
        }, 5000);
        
        // Close button functionality
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
        const stats = document.querySelectorAll('.angka-statistik');
        stats.forEach(stat => {
            const current = parseInt(stat.textContent.replace(/[^\d]/g, ''));
            const newValue = current + Math.floor(Math.random() * 10) + 1;
            
            if (stat.textContent.includes('K')) {
                stat.textContent = Math.floor(newValue / 1000) + 'K+';
            } else {
                stat.textContent = newValue + '+';
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
        
        // Check for saved theme preference
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
        
        // Add carousel controls
        const carouselControls = document.createElement('div');
        carouselControls.className = 'carousel-controls';
        carouselControls.innerHTML = `
            <button class="carousel-btn prev">‹</button>
            <div class="carousel-dots"></div>
            <button class="carousel-btn next">›</button>
        `;
        
        testimoniGrid.parentNode.appendChild(carouselControls);
        
        // Create dots
        const dotsContainer = carouselControls.querySelector('.carousel-dots');
        testimonials.forEach((_, index) => {
            const dot = document.createElement('button');
            dot.className = `carousel-dot ${index === 0 ? 'active' : ''}`;
            dot.addEventListener('click', () => goToTestimonial(index));
            dotsContainer.appendChild(dot);
        });
        
        // Carousel functionality
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
            // Update dots
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentTestimonial);
            });
            
            // For mobile, scroll to active testimonial
            if (window.innerWidth <= 768) {
                testimonials[currentTestimonial].scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest',
                    inline: 'center'
                });
            }
        }
        
        // Auto-rotate testimonials
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
        
        // Add click handlers for search results
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
        
        // Close modal
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

    // ===== CONTACT FORM  =====
    createContactSection();
    
    function createContactSection() {
        const contactSection = document.querySelector('#kontak .container');
        if (contactSection) {
            const contactForm = document.createElement('div');
            contactForm.className = 'contact-form-container';
            contactForm.innerHTML = `
                <h3>Kirim Pesan</h3>
                <form id="contact-form">
                    <div class="form-group">
                        <input type="text" name="contact-name" placeholder="Nama Lengkap" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="contact-email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <textarea name="contact-message" placeholder="Pesan Anda" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim Pesan</button>
                </form>
            `;
            
            contactSection.appendChild(contactForm);
            
            // Handle contact form submission
            document.getElementById('contact-form').addEventListener('submit', function(e) {
                e.preventDefault();
                showNotification('Pesan Anda telah terkirim! Kami akan membalas dalam 24 jam.', 'success');
                this.reset();
            });
        }
    }

    // ===== FLOATING ACTION BUTTON =====
    const fab = document.createElement('div');
    fab.className = 'floating-action-btn';
    fab.innerHTML = '💬';
    fab.title = 'Hubungi Kami';
    document.body.appendChild(fab);

    fab.addEventListener('click', function() {
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

    console.log('FoodCycle website loaded successfully! 🌱');
});