<!-- Dark Mode Toggle Script -->
<script>
    function darkMode(checkbox) {
        if (checkbox.checked) {
            document.body.classList.add('dark-version');
            localStorage.setItem('darkMode', 'enabled');
        } else {
            document.body.classList.remove('dark-version');
            localStorage.setItem('darkMode', 'disabled');
        }
    }

    // Check for saved dark mode preference
    document.addEventListener('DOMContentLoaded', function() {
        const darkModeToggle = document.getElementById('dark-mode-toggle');
        if (darkModeToggle) {
            const darkModePreference = localStorage.getItem('darkMode');
            if (darkModePreference === 'enabled') {
                document.body.classList.add('dark-version');
                darkModeToggle.checked = true;
            }
        }
    });
</script>