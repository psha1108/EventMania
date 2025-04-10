// C:\xampp\htdocs\event-management\script.js
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scrolling for navigation
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if(targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if(targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 70, // Account for header height
                    behavior: 'smooth'
                });
            }
        });
    });

    // Check login status
    checkAuthStatus();

    document.querySelectorAll('.book-package').forEach(button => {
        button.addEventListener('click', function() {
            const packageId = this.getAttribute('data-package-id');
            
            fetch('check_auth.php')
                .then(response => {
                    if(!response.ok) throw new Error('Network error');
                    return response.json();
                })
                .then(data => {
                    if(data.loggedIn) {
                        window.location.href = `payment.php?package=${packageId}`;
                    } else {
                        if(confirm('You need to login to book this package. Go to login page?')) {
                            window.location.href = `login.php?redirect=payment.php?package=${packageId}`;
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error checking login status. Please try again.');
                });
        });
    });
    // Payment form validation
    const paymentForm = document.querySelector('.payment-form');
    if(paymentForm) {
        paymentForm.addEventListener('submit', function(e) {
            const cardNumber = document.getElementById('card-number').value;
            const expiry = document.getElementById('expiry').value;
            const cvc = document.getElementById('cvc').value;
            
            if(!validateCardNumber(cardNumber)) {
                e.preventDefault();
                alert('Please enter a valid card number');
                return;
            }
            
            if(!validateExpiry(expiry)) {
                e.preventDefault();
                alert('Please enter a valid expiry date (MM/YY)');
                return;
            }
            
            if(!validateCVC(cvc)) {
                e.preventDefault();
                alert('Please enter a valid CVC');
                return;
            }
        });
    }
    
});


function checkAuthStatus() {
    fetch('check_auth.php')
        .then(response => response.json())
        .then(data => {
            const authLink = document.getElementById('auth-link');
            if(data.loggedIn) {
                authLink.innerHTML = `<a href="logout.php">${data.username} (Logout)</a>`;
                document.body.classList.add('logged-in');
            } else {
                authLink.innerHTML = '<a href="login.php">Login/Register</a>';
                document.body.classList.remove('logged-in');
            }
        });
}

function checkAuthBeforeBooking(packageId) {
    fetch('check_auth.php')
        .then(response => response.json())
        .then(data => {
            if(data.loggedIn) {
                window.location.href = `payment.php?package=${packageId}`;
            } else {
                if(confirm('You need to login to book a package. Go to login page?')) {
                    window.location.href = `login.php?redirect=payment.php?package=${packageId}`;
                }
            }
        });
}
function validateCardNumber(number) {
    return /^\d{16}$/.test(number.replace(/\s/g, ''));
}

function validateExpiry(expiry) {
    return /^\d{2}\/\d{2}$/.test(expiry);
}

function validateCVC(cvc) {
    return /^\d{3,4}$/.test(cvc);
}








// C:\xampp\htdocs\event-management\script.js
/*document.addEventListener('DOMContentLoaded', function() {
    // Smooth scrolling for navigation
    document.querySelectorAll('nav a').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            if(targetId === '#home') {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            } else {
                document.querySelector(targetId).scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });
    document.querySelectorAll('.book-package').forEach(button => {
        button.addEventListener('click', function(e) {
            checkAuthBeforeBooking(this.dataset.packageId);
        });
    });
    // Payment form validation
    const paymentForm = document.querySelector('.payment-form');
    if(paymentForm) {
        paymentForm.addEventListener('submit', function(e) {
            const cardNumber = document.getElementById('card-number').value;
            const expiry = document.getElementById('expiry').value;
            const cvc = document.getElementById('cvc').value;
            
            if(!validateCardNumber(cardNumber)) {
                e.preventDefault();
                alert('Please enter a valid card number');
                return;
            }
            
            if(!validateExpiry(expiry)) {
                e.preventDefault();
                alert('Please enter a valid expiry date (MM/YY)');
                return;
            }
            
            if(!validateCVC(cvc)) {
                e.preventDefault();
                alert('Please enter a valid CVC');
                return;
            }
        });
    }

    // Check login status
    checkAuthStatus();
});*/
