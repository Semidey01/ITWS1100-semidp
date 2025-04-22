// quiz3/resources/login.js
document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.querySelector('.login-form');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            const username = this.elements['username'].value.trim();
            const password = this.elements['password'].value.trim();
            
            if (!username || !password) {
                e.preventDefault();
                alert('Please enter both username and password');
                return false;
            }
            
            if (password.length < 4) {
                e.preventDefault();
                alert('Password must be at least 4 characters');
                return false;
            }
            
            return true;
        });
    }
 });