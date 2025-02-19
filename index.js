// Ensure GSAP and ScrollTrigger are loaded
document.addEventListener("DOMContentLoaded", function() {
    // Header Navigation Animation
    gsap.from("nav ul li", {
        duration: 0.5,
        y: -20,
        opacity: 0,
        stagger: 0.1,
        ease: "power2.out",
        delay: 0.5
    });

    // Hero Section Animation
   

  
    // About Section Animation
    gsap.from("#about", {
        duration: 1,
        opacity: 0,
        y: 50,
        ease: "power2.out",
        scrollTrigger: {
            trigger: "#about",
            start: "top 80%",
            toggleActions: "play none none reverse"
        }
    });

    // Services Section Animation
    gsap.utils.toArray(".service-card").forEach((card) => {
        gsap.from(card, {
            duration: 0.5,
            opacity: 0,
            y: 20,
            ease: "power2.out",
            scrollTrigger: {
                trigger: card,
                start: "top 80%",
                toggleActions: "play none none reverse"
            }
        });
    });

    // Contact Form Animation
    gsap.from("#contact-form", {
        duration: 1,
        opacity: 0,
        y: 30,
        ease: "power2.out",
        scrollTrigger: {
            trigger: "#contact",
            start: "top 80%",
            toggleActions: "play none none reverse"
        }
    });

    // Footer Animation
    gsap.from(".footer .box", {
        duration: 0.5,
        opacity: 0,
        y: 20,
        stagger: 0.2,
        ease: "power2.out",
        scrollTrigger: {
            trigger: ".footer",
            start: "top 80%",
            toggleActions: "play none none reverse"
        }
    });
});