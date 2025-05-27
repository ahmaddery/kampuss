  // Toggle Mobile Menu
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
        
        // Mobile dropdown toggles
        const mobileDropdowns = document.querySelectorAll('.mobile-dropdown');
        
        mobileDropdowns.forEach(dropdown => {
            const button = dropdown.querySelector('button');
            const content = dropdown.querySelector('div');
            const icon = dropdown.querySelector('i');
            
            button.addEventListener('click', () => {
                content.classList.toggle('hidden');
                icon.classList.toggle('fa-chevron-down');
                icon.classList.toggle('fa-chevron-up');
            });
        });
        
        // Scroll to top functionality
        const scrollTopButton = document.getElementById('scroll-top');
        
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                scrollTopButton.classList.add('active');
            } else {
                scrollTopButton.classList.remove('active');
            }
        });
        
        scrollTopButton.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
        
        // Animation on scroll
        const animateOnScroll = () => {
            const elements = document.querySelectorAll('.animate-on-scroll');
            
            elements.forEach(element => {
                const elementPosition = element.getBoundingClientRect().top;
                const viewportHeight = window.innerHeight;
                
                if (elementPosition < viewportHeight - 100) {
                    element.classList.add('animate-fadeInUp');
                }
            });
        }
        
        // Add animate-on-scroll class to elements
        document.addEventListener('DOMContentLoaded', () => {
            const sections = document.querySelectorAll('section');
            
            sections.forEach(section => {
                section.querySelector('h2')?.classList.add('animate-on-scroll');
                section.querySelectorAll('.grid > div').forEach(item => {
                    item.classList.add('animate-on-scroll');
                });
            });
            
            animateOnScroll();
        });
        
        window.addEventListener('scroll', animateOnScroll);