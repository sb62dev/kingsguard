document.addEventListener('DOMContentLoaded', function() {
    const customMultiselects = document.querySelectorAll('.multipleSelect');

    customMultiselects.forEach(function(multiselect) {
        const selectElement = multiselect.querySelector('select');
        const placeholder = selectElement.querySelector('.placeholder');
        const options = Array.from(selectElement.options).slice(1);
        const selectBox = document.createElement('div');
        selectBox.classList.add('selectBox');
        selectBox.innerHTML = `<span class="placeholder">${placeholder.textContent}</span>`;
        const optionsContainer = document.createElement('div');
        optionsContainer.classList.add('options');

        options.forEach(function(option) {
            const optionDiv = document.createElement('div');
            optionDiv.textContent = option.textContent;
            optionDiv.addEventListener('click', function() {
                if (!option.dataset.added) {
                    const selectedItem = document.createElement('div');
                    selectedItem.classList.add('selectedItem');
                    selectedItem.textContent = option.textContent;

                    const closeIcon = document.createElement('span');
                    closeIcon.classList.add('close');
                    closeIcon.textContent = 'x';
                    closeIcon.addEventListener('click', function() {
                        selectedItem.remove();
                        option.selected = false;
                        delete option.dataset.added;
                        if (selectBox.querySelectorAll('.selectedItem').length === 0) {
                            selectBox.querySelector('.placeholder').style.display = 'block';
                        }
                        // Trigger change event on the select element when an option is deselected
                        selectElement.dispatchEvent(new Event('change'));
                    });

                    selectedItem.appendChild(closeIcon);
                    selectBox.insertBefore(selectedItem, selectBox.querySelector('.placeholder'));
                    option.dataset.added = true;
                    option.selected = true;
                    selectBox.querySelector('.placeholder').style.display = 'none';

                    // Trigger change event on the select element when an option is selected
                    selectElement.dispatchEvent(new Event('change'));
                }
            });
            optionsContainer.appendChild(optionDiv);
        });

        selectBox.addEventListener('click', function() {
            optionsContainer.classList.toggle('open');
        });

        document.addEventListener('click', function(event) {
            if (!multiselect.contains(event.target)) {
                optionsContainer.classList.remove('open');
            }
        });

        multiselect.appendChild(selectBox);
        multiselect.appendChild(optionsContainer);
    });

    // Event listener for change in select field
    const selectElement = document.getElementById('wpforms-750-field_14'); // Replace with your actual select field ID
    selectElement.addEventListener('change', function() {
        var selectedValues = Array.from(this.selectedOptions).map(option => option.value);

        // Hide all conditional fields initially
        document.querySelectorAll('.wpforms-conditional-show').forEach(function(field) {
            field.style.display = 'none';
            field.classList.remove('wpforms-conditional-show');
            field.classList.add('wpforms-conditional-hide');
        });

        // Show the conditional fields based on the selected values
        selectedValues.forEach(function(value) {
            if (value === 'Parking Enforcement') {
                const field11Container = document.getElementById('wpforms-750-field_11-container');
                field11Container.style.display = 'block';
                field11Container.classList.remove('wpforms-conditional-hide');
                field11Container.classList.add('wpforms-conditional-show');
            }
            if (value === 'Security Systems') {
                const field12Container = document.getElementById('wpforms-750-field_12-container');
                field12Container.style.display = 'block';
                field12Container.classList.remove('wpforms-conditional-hide');
                field12Container.classList.add('wpforms-conditional-show');
            }
        });

        // Remove wpforms-has-error class if it's present
        const errorFields = document.querySelectorAll('.wpforms-has-error');
        errorFields.forEach(function(field) {
            field.classList.remove('wpforms-has-error');
        });
    });
});
