document.addEventListener('DOMContentLoaded', function () {
    // Modal close on backdrop click
    document.querySelectorAll('.modal').forEach(function (modal) {
        modal.addEventListener('click', function (e) {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });
    });

    // Form loading state
    document.querySelectorAll('[hx-post], [hx-put], [hx-delete]').forEach(function (form) {
        form.addEventListener('submit', function () {
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.textContent = 'Loading...';
            }
        });
    });

    // HTMX trigger for toasts
    document.body.addEventListener('htmx:afterOnLoad', function (evt) {
        if (evt.detail?.xhr?.getResponseHeader('HX-Trigger')) {
            const trigger = JSON.parse(evt.detail.xhr.getResponseHeader('HX-Trigger'));
            if (trigger.showToast) {
                showToast(trigger.showToast.type, trigger.showToast.title, trigger.showToast.message);
            }
        }
    });

    // Simple toast function
    function showToast(type, title, message) {
        const toast = document.createElement('div');
        toast.className = 'toast toast-' + type;
        toast.innerHTML = '<div class="toast-content"><strong>' + title + '</strong> ' + message + '</div>';
        document.body.appendChild(toast);
        
        setTimeout(function () {
            toast.remove();
        }, 3000);
    }
});