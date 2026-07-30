/**
 * AIC Tailwind - Main JS. Zero dependencies, IntersectionObserver only.
 */
(function () {
    'use strict';

    // ============================================
    // LOADER — show once per session
    // ============================================
    var loader = document.getElementById('loader');
    if (loader) {
        var skipLoader = sessionStorage.getItem('aic-loader-done');
        if (skipLoader) {
            loader.remove();
        } else {
            var minDisplay = 1400;
            var startTime = Date.now();
            function hideLoader() {
                var elapsed = Date.now() - startTime;
                var remaining = Math.max(0, minDisplay - elapsed);
                setTimeout(function () {
                    loader.classList.add('loaded');
                    sessionStorage.setItem('aic-loader-done', '1');
                    setTimeout(function () { loader.remove(); }, 700);
                }, remaining);
            }
            if (document.readyState === 'complete') {
                hideLoader();
            } else {
                window.addEventListener('load', hideLoader);
            }
        }
    }

    // ============================================
    // MOBILE MENU TOGGLE
    // ============================================
    var header = document.getElementById('site-header');
    var headerInner = document.getElementById('header-inner');
    var mobileToggle = document.getElementById('mobile-toggle');
    var mobileMenu = document.getElementById('mobile-menu');
    var iconOpen = document.getElementById('menu-icon-open');
    var iconClose = document.getElementById('menu-icon-close');

    if (mobileToggle && mobileMenu && iconOpen && iconClose) {
        function closeMenu() {
            mobileMenu.classList.add('hidden');
            iconOpen.classList.remove('hidden');
            iconClose.classList.add('hidden');
            mobileToggle.setAttribute('aria-expanded', 'false');
        }

        function openMenu() {
            mobileMenu.classList.remove('hidden');
            iconOpen.classList.add('hidden');
            iconClose.classList.remove('hidden');
            mobileToggle.setAttribute('aria-expanded', 'true');
        }

        mobileToggle.addEventListener('click', function () {
            var open = !mobileMenu.classList.contains('hidden');
            if (open) closeMenu(); else openMenu();
        });

        // Close menu on link click (not submenu toggles)
        mobileMenu.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', closeMenu);
        });

        // Submenu accordion toggles
        mobileMenu.querySelectorAll('.mobile-submenu-toggle').forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.stopPropagation();
                var submenu = this.nextElementSibling;
                var chevron = this.querySelector('svg');
                submenu.classList.toggle('hidden');
                chevron.classList.toggle('rotate-180');
            });
        });

        // Close menu on Escape
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && !mobileMenu.classList.contains('hidden')) {
                closeMenu();
                mobileToggle.focus();
            }
        });
    }

    // ============================================
    // HEADER SCROLL: transparent <-> solid
    // ============================================
    if (header && headerInner) {
        var sentinel = document.createElement('div');
        sentinel.style.cssText = 'position:absolute;top:0;height:1px;width:1px;pointer-events:none;';
        document.body.prepend(sentinel);

        var isHome = document.body.classList.contains('is-front-page') || document.body.classList.contains('home');

        function setHeaderMode(scrolled) {
            if (scrolled) {
                header.classList.add('header-solid');
                header.classList.remove('header-transparent');
            } else {
                header.classList.add('header-transparent');
                header.classList.remove('header-solid');
            }
        }

        if (isHome) {
            var headerObs = new IntersectionObserver(function (entries) {
                setHeaderMode(!entries[0].isIntersecting);
            }, { threshold: 0 });
            headerObs.observe(sentinel);
            setHeaderMode(false);
        } else {
            setHeaderMode(true);
        }
    }

    // ============================================
    // SCROLL REVEAL (IntersectionObserver) — supports .reveal, .reveal-left, .reveal-right, .reveal-scale
    // ============================================
    var revealSelector = '.reveal';
    var revealEls = document.querySelectorAll(revealSelector);
    if (revealEls.length && 'IntersectionObserver' in window) {
        var revealObs = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    revealObs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.05, rootMargin: '0px 0px -30px 0px' });

        revealEls.forEach(function (el) { revealObs.observe(el); });

        // Fallback: after 3 seconds, show any still-hidden elements
        setTimeout(function() {
            var stillHidden = document.querySelectorAll(revealSelector.split(',').map(function(s){ return s.trim() + ':not(.visible)'; }).join(','));
            for (var i = 0; i < stillHidden.length; i++) {
                stillHidden[i].classList.add('visible');
            }
        }, 3000);
    } else {
        for (var i = 0; i < revealEls.length; i++) {
            revealEls[i].classList.add('visible');
        }
    }

    // Mark body as JS-loaded (for CSS fallback)
    document.body.classList.add('js-loaded');

    // ============================================
    // COUNT-UP (IntersectionObserver + RAF)
    // ============================================
    var countEls = document.querySelectorAll('[data-count-up]');
    if (countEls.length && 'IntersectionObserver' in window) {
        var countObs = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    var el = entry.target;
                    var target = parseInt(el.getAttribute('data-count-up'), 10);
                    var duration = parseInt(el.getAttribute('data-duration'), 10) || 2000;
                    var prefix = el.getAttribute('data-prefix') || '';
                    var suffix = el.getAttribute('data-suffix') || '';
                    var start = performance.now();

                    (function tick(now) {
                        var p = Math.min((now - start) / duration, 1);
                        var e = p === 1 ? 1 : 1 - Math.pow(2, -10 * p);
                        el.textContent = prefix + Math.round(e * target).toLocaleString() + suffix;
                        if (p < 1) requestAnimationFrame(tick);
                    })(start);

                    countObs.unobserve(el);
                }
            });
        }, { threshold: 0.4 });
        countEls.forEach(function (el) { countObs.observe(el); });
    }

    // ============================================
    // COUNTDOWN TIMER — 3 states: before / during / after conference
    // ============================================
    var countdownEl = document.querySelector('[data-countdown]');
    if (countdownEl) {
        var startDate = new Date(countdownEl.getAttribute('data-countdown') + 'T00:00:00').getTime();
        var endDateStr = countdownEl.getAttribute('data-countdown-end');
        var endDate = endDateStr ? new Date(endDateStr + 'T00:00:00').getTime() : startDate + (2 * 86400000);

        function pad(n) { return n < 10 ? '0' + n : n; }

        function tick() {
            var now = Date.now();

            if (now >= endDate) {
                countdownEl.innerHTML = '<div class="text-center"><div class="text-2xl lg:text-3xl font-bold text-white/70">See you next year</div><div class="text-caption text-white/40 mt-2">The 16th AIC has concluded. Thank you to all participants.</div></div>';
                return;
            }

            if (now >= startDate) {
                countdownEl.innerHTML = '<div class="text-center"><div class="inline-flex items-center gap-3 px-6 py-4 rounded-2xl bg-accent/20 border border-accent/30 backdrop-blur-sm"><span class="w-3 h-3 rounded-full bg-accent animate-pulse"></span><span class="text-2xl lg:text-3xl font-bold text-accent">Conference in Progress</span></div><div class="text-caption text-white/50 mt-3">November 4-5, 2026</div></div>';
                return;
            }

            var diff = startDate - now;
            var days    = Math.floor(diff / (1000 * 60 * 60 * 24));
            var hours   = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((diff % (1000 * 60)) / 1000);

            countdownEl.innerHTML =
                '<div class="countdown-box"><span class="countdown-number">' + days + '</span><span class="countdown-label">Days</span></div>' +
                '<div class="countdown-box"><span class="countdown-number">' + pad(hours) + '</span><span class="countdown-label">Hours</span></div>' +
                '<div class="countdown-box"><span class="countdown-number">' + pad(minutes) + '</span><span class="countdown-label">Minutes</span></div>' +
                '<div class="countdown-box"><span class="countdown-number">' + pad(seconds) + '</span><span class="countdown-label">Seconds</span></div>';
        }

        tick();
        setInterval(tick, 1000);
    }

    // ============================================
    // KEYNOTE CAROUSEL — auto-rotate with dot navigation
    // ============================================
    var carousel = document.getElementById('keynote-carousel');
    if (carousel) {
        var slides = carousel.querySelectorAll('.keynote-slide');
        var dots   = carousel.querySelectorAll('.keynote-dot');
        var current = 0;
        var interval = parseInt(carousel.getAttribute('data-interval'), 10) || 6000;
        var timer;

        function showSlide(index) {
            slides.forEach(function (s, i) {
                s.classList.toggle('hidden', i !== index);
            });
            dots.forEach(function (d, i) {
                d.classList.toggle('bg-accent', i === index);
                d.classList.toggle('scale-125', i === index);
                d.classList.toggle('bg-surface-300', i !== index);
                d.classList.toggle('hover:bg-surface-400', i !== index);
            });
            current = index;
        }

        function nextSlide() {
            showSlide((current + 1) % slides.length);
        }

        if (slides.length > 1) {
            timer = setInterval(nextSlide, interval);

            function resetTimer() {
                clearInterval(timer);
                timer = setInterval(nextSlide, interval);
            }

            dots.forEach(function (dot) {
                dot.addEventListener('click', function () {
                    clearInterval(timer);
                    showSlide(parseInt(this.getAttribute('data-index'), 10));
                    timer = setInterval(nextSlide, interval);
                });
            });

            var prevBtn = carousel.querySelector('.keynote-prev');
            var nextBtn = carousel.querySelector('.keynote-next');
            if (prevBtn) prevBtn.addEventListener('click', function () {
                clearInterval(timer);
                showSlide((current - 1 + slides.length) % slides.length);
                timer = setInterval(nextSlide, interval);
            });
            if (nextBtn) nextBtn.addEventListener('click', function () {
                clearInterval(timer);
                nextSlide();
                timer = setInterval(nextSlide, interval);
            });

            carousel.addEventListener('mouseenter', function () { clearInterval(timer); });
            carousel.addEventListener('mouseleave', function () { timer = setInterval(nextSlide, interval); });

            // Touch swipe support for mobile
            var touchStartX = 0;
            carousel.addEventListener('touchstart', function (e) {
                touchStartX = e.changedTouches[0].screenX;
            }, { passive: true });
            carousel.addEventListener('touchend', function (e) {
                var diff = touchStartX - e.changedTouches[0].screenX;
                if (Math.abs(diff) > 50) {
                    clearInterval(timer);
                    if (diff > 0) nextSlide(); else showSlide((current - 1 + slides.length) % slides.length);
                    timer = setInterval(nextSlide, interval);
                }
            }, { passive: true });
        }
    }

    // ============================================
    // BACK TO TOP BUTTON
    // ============================================
    var backToTop = document.getElementById('back-to-top');
    if (backToTop) {
        window.addEventListener('scroll', function () {
            if (window.scrollY > 400) {
                backToTop.classList.add('visible');
            } else {
                backToTop.classList.remove('visible');
            }
        }, { passive: true });

        backToTop.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

})();
