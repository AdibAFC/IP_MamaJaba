document.addEventListener("DOMContentLoaded", function() {
    // Animate the card to fade in and slide up
    gsap.from(".card", {
        duration: 1,
        opacity: 0,
        y: 50,
        ease: "power3.out"
    });

    // Animate the header text
    gsap.from(".login-header h1", {
        duration: 1.5,
        opacity: 0,
        y: -20,
        delay: 0.3,
        ease: "power3.out"
    });

    // Animate the header paragraph
    gsap.from(".login-header p", {
        duration: 1.5,
        opacity: 0,
        y: -20,
        delay: 0.5,
        ease: "power3.out"
    });

    // Animate the form elements to fade in and slide up sequentially
    gsap.from(".form-group", {
        duration: 1,
        opacity: 0,
        y: 20,
        stagger: 0.3,
        delay: 0.8,
        ease: "power3.out"
    });

    // Animate the submit button
    gsap.from("button", {
        duration: 1,
        opacity: 0,
        scale: 0.8,
        delay: 1.5,
        ease: "back.out(1.7)"
    });
});
