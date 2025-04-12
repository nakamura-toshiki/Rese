document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.input_field').forEach(input => {
        const targetElement = document.getElementById(input.dataset.target);
        if (targetElement) {
            targetElement.textContent = input.value || "";

            input.addEventListener('input', function () {
                targetElement.textContent = this.value || "";
            });
        }
    });

    const numberSelect = document.getElementById('number-select');
    if (numberSelect) {
        const displayNumber = document.getElementById('display_number');
        if (displayNumber) {
            displayNumber.textContent = numberSelect.value ? `${numberSelect.value}人` : "";

            numberSelect.addEventListener('change', function () {
                displayNumber.textContent = this.value ? `${this.value}人` : "";
            });
        }
    }
});