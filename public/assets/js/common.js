

/** **************************
 *  
 *  Accardion START
 * 
 ***************************/
document.addEventListener('DOMContentLoaded', function () {

    document
        .querySelectorAll('[data-accordion]')
        .forEach(function (accordion) {

            const rows = accordion.querySelectorAll( '[data-accordion-row]' );

            rows.forEach(function (row) {

                row.addEventListener('click', function (event) {

                    /*
                     * Если внутри строки нажали
                     * на ссылку или кнопку —
                     * accordion не открываем.
                     */
                    if (event.target.closest('a, button')) { return; }

                    const targetId = row.dataset.accordionTarget;

                    const details = document.getElementById(targetId);

                    if (!details) { return; }

                    const content = details.querySelector('[data-accordion-content]');
                    const icon = row.querySelector('[data-accordion-icon]');

                    if (!content) { return; }

                    const isOpen = row.classList.contains('is-open');

                    /*
                     * Если уже открыт —
                     * закрываем.
                     */
                    if (isOpen) {
                        closeAccordion( row, content, icon );
                        return;
                    }

                    /*
                     * Закрываем все остальные.
                     */
                    rows.forEach(function (otherRow) {
                        if (otherRow === row) { return; }
                        if ( !otherRow.classList.contains( 'is-open' ) ) { return; }

                        const otherDetails = document.getElementById( otherRow.dataset.accordionTarget );

                        if (!otherDetails) { return; }

                        const otherContent = otherDetails.querySelector('[data-accordion-content]' );

                        const otherIcon = otherRow.querySelector('[data-accordion-icon]');

                        if (otherContent) { closeAccordion(otherRow, otherContent, otherIcon); }

                    });

                    /*
                     * Открываем текущий.
                     */
                    openAccordion( row, content, icon );

                });

            });

        });

});


/**
 * Открыть accordion.
 */
function openAccordion(row, content, icon) {
    row.classList.add('is-open');

    if (icon) { icon.classList.add('is-open'); }

    /*
     * Получаем реальную высоту содержимого.
     */
    content.style.height = content.scrollHeight + 'px';

    /*
     * После окончания анимации
     * устанавливаем auto.
     */
    content.addEventListener(
        'transitionend',
        function handler(event) {

            if (event.propertyName !== 'height') {
                return;
            }


            if (row.classList.contains('is-open')) {
                content.style.height = 'auto';
            }


            content.removeEventListener(
                'transitionend',
                handler
            );

        }
    );
}
/**
 * Закрыть accordion.
 */
function closeAccordion(row, content, icon) {
    /*
     * Если height = auto,
     * сначала ставим реальную высоту.
     */
    content.style.height =
        content.scrollHeight + 'px';


    /*
     * На следующем кадре
     * плавно идём к 0.
     */
    requestAnimationFrame(function () {

        content.style.height = '0px';

    });


    row.classList.remove('is-open');


    if (icon) {
        icon.classList.remove('is-open');
    }
}

/** **************************
 *  
 *  Accardion END
 * 
 ***************************/


/** **************************
 *  
 *  Toast Message
 * 
 ***************************/
const Toast = {

    container: null,

    config: {
        alert: {
            class: 'toast-secondary',
            icon: 'bi-bell-fill',
            title: 'Notification'
        },

        primary: {
            class: 'toast-primary',
            icon: 'bi-circle-fill',
            title: 'Notification'
        },

        secondary: {
            class: 'toast-secondary',
            icon: 'bi-circle-fill',
            title: 'Notification'
        },

        success: {
            class: 'toast-success',
            icon: 'bi-check-circle-fill',
            title: 'Success'
        },

        info: {
            class: 'toast-info',
            icon: 'bi-info-circle-fill',
            title: 'Information'
        },

        warning: {
            class: 'toast-warning',
            icon: 'bi-exclamation-triangle-fill',
            title: 'Warning'
        },

        danger: {
            class: 'toast-danger',
            icon: 'bi-x-circle-fill',
            title: 'Error'
        },

        light: {
            class: 'toast-light',
            icon: 'bi-circle-fill',
            title: 'Notification'
        },

        dark: {
            class: 'toast-dark',
            icon: 'bi-circle-fill',
            title: 'Notification'
        }
    },

    init: function () {

        this.container = document.querySelector('.toast-container');

        return this;
    },

    show: function (type, message, title) {

        if (!this.container) {
            console.error('Toast is not initialized');
            return;
        }

        const settings = this.config[type] ?? this.config.info;
              
        const toast = document.createElement('div');

        toast.className = `toast ${settings.class}`;
        toast.setAttribute('role', 'alert');
        toast.setAttribute('aria-live', 'assertive');
        toast.setAttribute('aria-atomic', 'true');

        toast.innerHTML = `
            <div class="toast-header">

                <i class="bi ${settings.icon} me-2"></i>

                <strong class="me-auto">
                    ${ title ?? settings.title }
                </strong>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="toast"
                    aria-label="Close">
                </button>

            </div>

            <div class="toast-body">
                ${message}
            </div>
        `;

        this.container.appendChild(toast);

        const instance = bootstrap.Toast.getOrCreateInstance(toast, {
            delay: 3000
        });

        toast.addEventListener('hidden.bs.toast', () => {
            toast.remove();
        });

        instance.show();
    }
};
/** **************************
 *  
 *  Toast Message  END
 *  
 ***************************/