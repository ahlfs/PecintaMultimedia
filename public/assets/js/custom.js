/**
 * GudangMeme Custom JavaScript File
 * Separated from Blade Templates
 */

document.addEventListener('DOMContentLoaded', function () {
    // SweetAlert2 Alerts based on body attributes
    const body = document.body;
    const successMsg = body.getAttribute('data-session-success');
    const errorMsg = body.getAttribute('data-session-error');

    if (successMsg) {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: successMsg,
            timer: 3500,
            showConfirmButton: false,
            toast: true,
            position: 'top-end',
            background: '#fff',
            iconColor: '#4274D9',
            customClass: {
                popup: 'rounded-xl shadow-lg border border-slate-100 font-sans'
            }
        });
    }

    if (errorMsg) {
        Swal.fire({
            icon: 'error',
            title: 'Opps...',
            text: errorMsg,
            confirmButtonColor: '#293681',
            customClass: {
                popup: 'rounded-2xl shadow-xl font-sans',
                confirmButton: 'px-6 py-2.5 rounded-xl text-sm font-bold'
            }
        });
    }
});

/**
 * Toggle visibility of password input
 */
function togglePasswordVisibility() {
    const passwordInput = document.getElementById('password');
    const icon = document.getElementById('password-toggle-icon');
    if (passwordInput && icon) {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
}

/**
 * Show local preview of uploaded image
 */
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function () {
        const output = document.getElementById('profile-preview');
        if (output) {
            output.src = reader.result;
        }
    };
    if (event.target.files && event.target.files[0]) {
        reader.readAsDataURL(event.target.files[0]);
    }
}

/**
 * Reusable SweetAlert2 confirmation dialog for form deletes
 */
document.addEventListener('submit', function (e) {
    if (e.target && e.target.classList.contains('form-delete-confirm')) {
        e.preventDefault();
        const form = e.target;
        const message = form.getAttribute('data-confirm-message') || 'Apakah Anda yakin ingin menghapus data ini?';
        
        Swal.fire({
            title: 'Hapus data?',
            text: message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#293681',
            cancelButtonColor: '#ef4444',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            customClass: {
                popup: 'rounded-2xl shadow-xl font-sans',
                confirmButton: 'px-5 py-2.5 rounded-xl text-sm font-bold',
                cancelButton: 'px-5 py-2.5 rounded-xl text-sm font-bold mr-2'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
});

