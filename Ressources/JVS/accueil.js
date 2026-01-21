
document.addEventListener("DOMContentLoaded", function () {
    const banner = document.getElementById("cookie-banner");

    if (!localStorage.getItem("cookieConsent")) {
        banner.style.display = "block";
    }

    document.getElementById("acceptCookies").onclick = function () {
        localStorage.setItem("cookieConsent", "accepted");
        banner.style.display = "none";
        // 👉 Ici tu peux activer Google Analytics / autres cookies
    };

    document.getElementById("refuseCookies").onclick = function () {
        localStorage.setItem("cookieConsent", "refused");
        banner.style.display = "none";
    };
});
