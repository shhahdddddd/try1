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
    gsap.from(".video-text h2", {
        duration: 1,
        opacity: 0,
        y: 30,
        ease: "power2.out",
        delay: 0.8
    });

    gsap.from(".video-text h6", {
        duration: 1,
        opacity: 0,
        y: 30,
        ease: "power2.out",
        delay: 1.2
    });

    gsap.from(".video-text h5", {
        duration: 1,
        opacity: 0,
        y: 30,
        ease: "power2.out",
        delay: 1.5
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
document.addEventListener("DOMContentLoaded", function() {
    const careerModal = document.getElementById("careerModal");
    const openModalBtn = document.getElementById("openModal");
    const closeModalBtn = document.querySelector(".close");
    const careerForm = document.getElementById("careerForm");

    // Open Modal
    openModalBtn.addEventListener("click", function() {
        careerModal.style.display = "flex"; // Show modal
    });

    // Close Modal when clicking the close button (X)
    closeModalBtn.addEventListener("click", function() {
        careerModal.style.display = "none"; // Close modal
    });

    // Close Modal when clicking outside the modal content
    window.addEventListener("click", function(event) {
        if (event.target === careerModal) {
            careerModal.style.display = "none"; // Close modal
        }
    });

    // Handle Form Submission
    careerForm.addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent page reload

        alert("Application submitted successfully!"); // You can replace this with actual form submission via AJAX if desired

        // Close Modal after submission
        careerModal.style.display = "none";
    });
});



