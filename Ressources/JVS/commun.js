
function openHelp(url) {
        window.open(url, 'help', 'width=600,height=400,scrollbars=yes,resizable=yes');
}

function confirmAction(message) {
        return confirm(message);
}

function myFunction() {
    alert("I am an alert box!");
}

function showAlert(message) {
        alert(message);
}

// Accessibility and hover/focus handling for profile dropdowns
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.profile').forEach(function (profile) {
        var menu = profile.querySelector('.profile-menu');
        var menuAuth = profile.querySelector('.profile-menu-auth');
        var trigger = profile.querySelector('.profile-link') || profile;

        function openProfile() {
            profile.classList.add('open');
            if (menu) menu.setAttribute('aria-hidden', 'false');
            if (menuAuth) menuAuth.setAttribute('aria-hidden', 'false');
        }

        function closeProfile() {
            profile.classList.remove('open');
            if (menu) menu.setAttribute('aria-hidden', 'true');
            if (menuAuth) menuAuth.setAttribute('aria-hidden', 'true');
        }

        profile.addEventListener('mouseenter', function () {
            openProfile();
        });

        profile.addEventListener('mouseleave', function () {
            closeProfile();
        });

        if (trigger) {
            trigger.addEventListener('focus', function () {
                openProfile();
            });
            trigger.addEventListener('blur', function () {
                setTimeout(function () {
                    if (!profile.contains(document.activeElement)) {
                        closeProfile();
                    }
                }, 100);
            });
        }

        if (menu) {
            menu.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' || e.key === 'Esc') {
                    closeProfile();
                    if (trigger && typeof trigger.focus === 'function') trigger.focus();
                }
            });
            menu.addEventListener('focusout', function () {
                setTimeout(function () {
                    if (!profile.contains(document.activeElement)) closeProfile();
                }, 100);
            });
        }

        if (menuAuth) {
            menuAuth.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' || e.key === 'Esc') {
                    closeProfile();
                    if (trigger && typeof trigger.focus === 'function') trigger.focus();
                }
            });
            menuAuth.addEventListener('focusout', function () {
                setTimeout(function () {
                    if (!profile.contains(document.activeElement)) closeProfile();
                }, 100);
            });
        }
    });
});