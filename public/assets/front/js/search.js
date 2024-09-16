document.getElementById('search_spareparts').addEventListener('input', function() {
    let query = this.value

    if (query.length > 2) {
        fetch("/crm/search_spareparts?query=" + encodeURIComponent(query))
            .then(response => response.json())
            .then(data => {
                let resultsContainer = document.getElementById('search-results')
                resultsContainer.innerHTML = ''

                data.forEach(function(item) {
                    addRowToResults(item)
                })
            })
            .catch(error => console.error('Error:', error))
    } else {
        document.getElementById('search-results').innerHTML = ''
    }
});

function addRowToAddedResults(item) {
    let addedResultsContainer = document.getElementById('added-results')
    let row = document.createElement('div')
    row.className = 'row added-result-row'
    row.setAttribute('data-index', item.articul);

    row.innerHTML = `
        <div class="cell">
            <div class="form-group _bg-white">
                <input type="text" name="items[${item.articul}][articul]" value="${item.articul}" readonly>
            </div>
        </div>
        <div class="cell">
            <div class="form-group">
                <input type="text" name="items[${item.articul}][product]" value="${item.product}" readonly>
            </div>
        </div>
        <div class="cell">
            <div class="form-group">
                <input type="text" name="items[${item.articul}][price]" id="added-price-${item.articul}" value="${item.price}" readonly>
            </div>
        </div>
        <div class="cell">
            <div class="form-group _bg-white">
                <input type="text" name="items[${item.articul}][qty]" id="added-qty-${item.articul}" value="1">
            </div>
        </div>
        <div class="cell">
            <div class="form-group">
                <input type="text" name="items[${item.articul}][discount]" id="added-discount-${item.articul}" value="${item.discount}" readonly>
            </div>
        </div>
        <div class="cell">
            <div class="form-group">
                <input type="text" value="" id="added-total-${item.articul}" readonly>  <!--??? total -->
            </div>
        </div>
        <div class="cell">
            <div class="form-group">
                <input type="text" value="" readOnly>
            </div>
        </div>
        <div class="cell">
            <button type="button" class="btn-border btn-red btn-action">
                <span class="icon-minus" id="minus-${item.articul}"></span>
            </button>
        </div>
    `;

    let qtyInput = row.querySelector(`#added-qty-${item.articul}`)
    let priceInput = row.querySelector(`#added-price-${item.articul}`)
    let discountInput = row.querySelector(`#added-discount-${item.articul}`)
    let totalInput = row.querySelector(`#added-total-${item.articul}`)
    // let addButton = row.querySelector(`#added-plus-${item.articul}`)

    function calculateTotal() {
        let qty = parseFloat(qtyInput.value) || 0
        let price = parseFloat(priceInput.value) || 0
        let discount = parseFloat(discountInput.value) || 0
        let total = qty * price * (1 - discount / 100)
        totalInput.value = total.toFixed(2)
    }

    qtyInput.addEventListener('input', calculateTotal)

    calculateTotal()

    let removeButton = row.querySelector(`#minus-${item.articul}`)

    removeButton.addEventListener('click', function () {
        removeRowFromAdded(item.articul)
        addRowToResults(item);
    })

    addedResultsContainer.appendChild(row);
}

function removeRowFromResults(articul) {
    let row = document.querySelector(`.search-result-row[data-index="${articul}"]`);
    if (row) {
        row.remove();
    }
}

function removeRowFromAdded(articul) {
    let row = document.querySelector(`.added-result-row[data-index="${articul}"]`);
    if (row) {
        row.remove();
    }
}

function addRowToResults(item) {
    let searchResultsContainer = document.getElementById('search-results')
    let row = document.createElement('div')
    row.className = 'row search-result-row'
    row.setAttribute('data-index', item.articul);
    row.innerHTML = `
        <div class="cell">
            <div class="form-group _bg-white">
                <input type="text" value="${item.articul}" id="articul-${item.articul}" readonly>
            </div>
        </div>
        <div class="cell">
            <div class="form-group">
                <input type="text" value="${item.product}" id="price-${item.articul}" readonly>
            </div>
        </div>
        <div class="cell">
            <div class="form-group">
                <input type="text" value="${item.price}" id="price-${item.articul}" readonly>
            </div>
        </div>
        <div class="cell">
            <div class="form-group _bg-white">
                <input type="text" value="1" id="qty-${item.articul}">
            </div>
        </div>
        <div class="cell">
            <div class="form-group">
                <input type="text" value="${item.discount}" id="discount-${item.articul}" readonly>
            </div>
        </div>
        <div class="cell">
            <div class="form-group">
                <input type="text" value="${item.price}" id="total-${item.articul}" readonly>
            </div>
        </div>
        <div class="cell">
            <div class="form-group">
                <input type="text" value="" readOnly>
            </div>
        </div>
        <div class="cell">
            <button type="button" class="btn-border btn-blue btn-action">
                <span class="icon-plus" id="plus-${item.articul}"></span>
            </button>
        </div>
    `;

    let qtyInput = row.querySelector(`#qty-${item.articul}`)
    let priceInput = row.querySelector(`#price-${item.articul}`)
    let discountInput = row.querySelector(`#discount-${item.articul}`)
    let totalInput = row.querySelector(`#total-${item.articul}`)
    let addButton = row.querySelector(`#plus-${item.articul}`)
    addButton.addEventListener('click', function() {
        addRowToAddedResults(item)
        removeRowFromResults(item.articul)
    })

    function calculateTotal() {
        let qty = parseFloat(qtyInput.value) || 0
        let price = parseFloat(priceInput.value) || 0
        let discount = parseFloat(discountInput.value) || 0
        let total = qty * price * (1 - discount / 100)
        totalInput.value = total.toFixed(2)
    }

    calculateTotal()

    searchResultsContainer.appendChild(row);
}

document.getElementById('serviceWorkSelect').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const serviceWorkName = selectedOption.text;
    const code = selectedOption.value;

    if (code === '-1') {
        return;
    }

    const tableBody = document.getElementById('serviceWorkTableBody');

    const newRow = document.createElement('div');
    newRow.classList.add('row');
    newRow.setAttribute('data-code', code);
    newRow.innerHTML = `
            <div class="cell">
                <input type="hidden" name="works[${code}][code_1c]" value="${code}">
                <div class="form-group checkbox">
                    <input type="checkbox" name="works[${code}][checked]" id="parts-${code}">
                    <label for="parts-${code}"></label>
                </div>
            </div>
            <div class="cell">
                <div class="form-group">
                    <input type="text" name="works[${code}][product]" value="${serviceWorkName}" readonly="">
                </div>
            </div>
            <div class="cell">
                <div class="form-group _bg-white">
                    <input type="text" name="works[${code}][price]" placeholder="Ціна">
                </div>
            </div>
            <div class="cell">
                <div class="form-group _bg-white">
                    <input type="text" name="works[${code}][qty]" placeholder="Нормогодини">
                </div>
            </div>
            <div class="cell">
                <div class="form-group">
                    <input type="text" readonly="">
                </div>
            </div>
        `;

    tableBody.appendChild(newRow);

    const priceInput = newRow.querySelector('.cell:nth-child(3) input');
    const hoursInput = newRow.querySelector('.cell:nth-child(4) input');
    const totalInput = newRow.querySelector('.cell:nth-child(5) input');

    function calculateTotal() {
        const price = parseFloat(priceInput.value) || 0;
        const hours = parseFloat(hoursInput.value) || 0;
        const total = price * hours;
        totalInput.value = total.toFixed(2);
    }

    priceInput.addEventListener('input', calculateTotal);
    hoursInput.addEventListener('input', calculateTotal);
});

