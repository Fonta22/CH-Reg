window.addEventListener("load", () => {
    const isMobile = navigator.userAgent.toLowerCase().match(/mobile/i);
    if (isMobile) {
        const elt = document.querySelector(".w-25");
        elt.classList.remove("w-25");
        elt.classList.add("w-100");
    }
});
