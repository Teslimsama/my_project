<!-- Dark Mode Toggle Script -->
<script>
    // Apply saved dark mode preference immediately (before page renders)
    (function() {
        const darkModePreference = localStorage.getItem('darkMode');
        if (darkModePreference === 'enabled') {
            document.documentElement.classList.add('dark-version');
            document.body.classList.add('dark-version');
        }
    })();

    function darkMode(checkbox) {
        if (checkbox.checked) {
            document.body.classList.add('dark-version');
            localStorage.setItem('darkMode', 'enabled');
        } else {
            document.body.classList.remove('dark-version');
            localStorage.setItem('darkMode', 'disabled');
        }
    }

    // Set checkbox state on page load
    document.addEventListener('DOMContentLoaded', function() {
        const darkModeToggle = document.getElementById('dark-mode-toggle');
        if (darkModeToggle) {
            const darkModePreference = localStorage.getItem('darkMode');
            if (darkModePreference === 'enabled') {
                darkModeToggle.checked = true;
            }
        }
    });
</script>