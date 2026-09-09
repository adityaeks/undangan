<!-- SWEETALERT2 COMPONENT & GLOBAL NOTIFICATION SYSTEM -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    div:where(.swal2-container) {
        z-index: 99999 !important;
    }
    div:where(.swal2-container) div:where(.swal2-popup) {
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        border-radius: 1.5rem !important;
        padding: 1.75rem !important;
        border: 1px solid #EFECE3 !important;
        background: #FFFFFF !important;
        box-shadow: 0 25px 50px -12px rgba(14, 13, 12, 0.25) !important;
    }
    div:where(.swal2-container) .swal2-title {
        font-family: 'Playfair Display', serif !important;
        color: #0E0D0C !important;
        font-weight: 700 !important;
        font-size: 1.35rem !important;
    }
    div:where(.swal2-container) .swal2-html-container {
        color: #575249 !important;
        font-size: 0.85rem !important;
        line-height: 1.6 !important;
    }
    div:where(.swal2-icon).swal2-warning {
        border-color: #FBBF24 !important;
        color: #D97706 !important;
    }
    div:where(.swal2-icon).swal2-success {
        border-color: #6EE7B7 !important;
        color: #059669 !important;
    }
    div:where(.swal2-icon).swal2-error {
        border-color: #FDA4AF !important;
        color: #E11D48 !important;
    }
    .swal2-actions {
        gap: 0.75rem !important;
        margin-top: 1.25rem !important;
    }
    .swal2-styled.swal2-confirm {
        border-radius: 1rem !important;
        font-weight: 700 !important;
        font-size: 0.75rem !important;
        padding: 0.75rem 1.5rem !important;
        background: linear-gradient(to right, #8A7245, #6C5834) !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
        border: none !important;
    }
    .swal2-styled.swal2-cancel {
        border-radius: 1rem !important;
        font-weight: 700 !important;
        font-size: 0.75rem !important;
        padding: 0.75rem 1.5rem !important;
        background-color: #FAF8F5 !important;
        color: #38342D !important;
        border: 1px solid #EFECE3 !important;
    }
    .swal2-styled.swal2-cancel:hover {
        background-color: #EFECE3 !important;
    }
</style>

<script>
    // Global Toast Mixin
    window.Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3500,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
    });

    // Helper functions
    window.showToast = function(message, icon = 'success') {
        window.Toast.fire({
            icon: icon,
            title: message
        });
    };

    window.showSuccess = function(message, title = 'Berhasil!') {
        return Swal.fire({
            icon: 'success',
            title: title,
            text: message,
            confirmButtonColor: '#8A7245',
            confirmButtonText: 'Tutup'
        });
    };

    window.showError = function(message, title = 'Perhatian') {
        return Swal.fire({
            icon: 'error',
            title: title,
            text: message,
            confirmButtonColor: '#8A7245',
            confirmButtonText: 'Mengerti'
        });
    };

    window.showWarning = function(message, title = 'Peringatan') {
        return Swal.fire({
            icon: 'warning',
            title: title,
            text: message,
            confirmButtonColor: '#8A7245',
            confirmButtonText: 'Mengerti'
        });
    };

    window.showInfo = function(message, title = 'Informasi') {
        return Swal.fire({
            icon: 'info',
            title: title,
            text: message,
            confirmButtonColor: '#8A7245',
            confirmButtonText: 'Tutup'
        });
    };

    // Confirm Action Helper
    window.confirmAction = function({ 
        title = 'Apakah Anda Yakin?', 
        text = 'Tindakan ini tidak dapat dibatalkan.', 
        icon = 'warning',
        confirmButtonText = 'Ya, Lanjutkan',
        cancelButtonText = 'Batalkan',
        confirmButtonColor = '#8A7245',
        onConfirm
    }) {
        return Swal.fire({
            title: title,
            text: text,
            icon: icon,
            showCancelButton: true,
            confirmButtonColor: confirmButtonColor,
            cancelButtonColor: '#FAF8F5',
            confirmButtonText: confirmButtonText,
            cancelButtonText: cancelButtonText,
            reverseButtons: true,
            focusCancel: true
        }).then((result) => {
            if (result.isConfirmed && typeof onConfirm === 'function') {
                onConfirm();
            }
            return result;
        });
    };

    // Universal Form Delete / Action Confirmation Interceptor
    document.addEventListener('submit', function(e) {
        const form = e.target;
        if (!form) return;

        const confirmMsg = form.getAttribute('data-confirm') || form.dataset.confirm;
        if (confirmMsg && !form.dataset.confirmed) {
            e.preventDefault();

            const title = form.getAttribute('data-confirm-title') || 'Konfirmasi Tindakan';
            const icon = form.getAttribute('data-confirm-icon') || 'warning';
            const btnText = form.getAttribute('data-confirm-btn') || 'Ya, Lanjutkan';
            const isDanger = form.getAttribute('data-confirm-danger') === 'true' || form.getAttribute('method')?.toLowerCase() === 'delete' || form.querySelector('input[name="_method"][value="DELETE"]');
            const btnColor = isDanger ? '#E11D48' : '#8A7245';

            Swal.fire({
                title: title,
                text: confirmMsg,
                icon: icon,
                showCancelButton: true,
                confirmButtonColor: btnColor,
                cancelButtonColor: '#FAF8F5',
                confirmButtonText: btnText,
                cancelButtonText: 'Batal',
                reverseButtons: true,
                focusCancel: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.dataset.confirmed = 'true';
                    form.submit();
                }
            });
        }
    });

    // Session Flash Alert Trigger on Page Load
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: @json(session('success')),
                confirmButtonColor: '#8A7245',
                confirmButtonText: 'Tutup'
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Perhatian',
                text: @json(session('error')),
                confirmButtonColor: '#8A7245',
                confirmButtonText: 'Mengerti'
            });
        @endif

        @if(session('warning'))
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: @json(session('warning')),
                confirmButtonColor: '#8A7245',
                confirmButtonText: 'Mengerti'
            });
        @endif

        @if(session('info'))
            Swal.fire({
                icon: 'info',
                title: 'Informasi',
                text: @json(session('info')),
                confirmButtonColor: '#8A7245',
                confirmButtonText: 'Tutup'
            });
        @endif

        @if(session('status') === 'profile-updated')
            Swal.fire({
                icon: 'success',
                title: 'Profil Berhasil Diperbarui',
                text: 'Perubahan data profil akun Anda telah berhasil disimpan.',
                confirmButtonColor: '#8A7245',
                confirmButtonText: 'Bagus'
            });
        @elseif(session('status') === 'password-updated')
            Swal.fire({
                icon: 'success',
                title: 'Kata Sandi Diperbarui',
                text: 'Kata sandi akun Anda telah berhasil diubah.',
                confirmButtonColor: '#8A7245',
                confirmButtonText: 'Mengerti'
            });
        @elseif(session('status') && !in_array(session('status'), ['verification-link-sent']))
            Swal.fire({
                icon: 'info',
                title: 'Status',
                text: @json(session('status')),
                confirmButtonColor: '#8A7245',
                confirmButtonText: 'Tutup'
            });
        @endif
    });
</script>
