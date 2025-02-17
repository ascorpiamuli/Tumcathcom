// Function for typing effect animation
export function typeTextEffect() {
    document.querySelectorAll(".typingEffect").forEach(typingElement => {
        const text = typingElement.innerHTML;
        let index = 0;

        function typeText() {
            if (index < text.length) {
                typingElement.innerHTML += text.charAt(index);
                index++;
                setTimeout(typeText, 100); // Adjust typing speed
            }
        }

        typingElement.innerHTML = ""; // Clear content before typing
        typeText();
    });
}

// Function to animate the count
export function animateCount(id, target) {
    let count = 0;
    const interval = setInterval(() => {
        if (count >= target) {
            clearInterval(interval);
            document.getElementById(id).innerText = `${target}+`;
        } else {
            document.getElementById(id).innerText = `${++count}`;
        }
    }, 10); // Adjust interval speed as needed
}
