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

document.getElementById("openModal").addEventListener("click", function() {
    document.getElementById("careerModal").style.display = "flex";
});

document.querySelector(".close").addEventListener("click", function() {
    document.getElementById("careerModal").style.display = "none";
});

document.getElementById("careerForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent form from reloading the page

    let position = document.getElementById("position").value;
    let name = document.getElementById("name").value;
    let age = document.getElementById("age").value;
    let email = document.getElementById("email").value;

    // Create mailto link
    let mailtoLink = `mailto:youremail@example.com?subject=Job Application - ${position}&body=Name: ${name}%0D%0AAge: ${age}%0D%0AEmail: ${email}`;

    // Open email client
    window.location.href = mailtoLink;

    // Close modal after sending email
    document.getElementById("careerModal").style.display = "none";
});

