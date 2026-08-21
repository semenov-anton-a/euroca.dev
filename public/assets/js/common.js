

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