document.getElementById('search').addEventListener('input', function() {
    let query = this.value

    if (query.length > 2) {
        fetch("/crm/search?query=" + encodeURIComponent(query))
            .then(response => response.json())
            .then(data => {
                let resultsContainer = document.getElementById('search-results')
                resultsContainer.innerHTML = ''

                data.forEach(function(item) {
                    let row = document.createElement('div')
                    row.className = 'row search-result-row'
                    row.setAttribute('data-index', item.articul);

                    row.innerHTML = `
                        <div class="cell">
                            <div class="form-group _bg-white">
                                <input type="text" name="articul" value="${item.articul}" id="articul-${item.articul}" readOnly>
                            </div>
                        </div>
                        <div class="cell">
                            <div class="form-group">
                                <input type="text" name="product" value="${item.product}" id="product-${item.articul}" readOnly>
                            </div>
                        </div>
                        <div class="cell">
                            <div class="form-group">
                                <input type="text" name="price" value="${item.price}" id="price-${item.articul}" readOnly>
                            </div>
                        </div>

                        <div class="cell">
                            <div class="form-group">
                                <input type="text" name="qty" value="1" id="qty-${item.articul}" >
                            </div>
                        </div>

                        <div class="cell">
                            <div class="form-group">
                                <input type="text" name="discount" value="${item.discount}" id="discount-${item.articul}" readOnly>
                            </div>
                        </div>

                        <div class="cell">
                            <div class="form-group">
                                <input type="text" name="total" value="" id="total-${item.articul}" readOnly>
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
                    `

                    let qtyInput = row.querySelector(`#qty-${item.articul}`)
                    let priceInput = row.querySelector(`#price-${item.articul}`)
                    let discountInput = row.querySelector(`#discount-${item.articul}`)
                    let totalInput = row.querySelector(`#total-${item.articul}`)
                    let addButton = row.querySelector(`#plus-${item.articul}`)

                    function calculateTotal() {
                        let qty = parseFloat(qtyInput.value) || 0
                        let price = parseFloat(priceInput.value) || 0
                        let discount = parseFloat(discountInput.value) || 0
                        let total = qty * price * (1 - discount / 100)
                        totalInput.value = total.toFixed(2)
                    }

                    qtyInput.addEventListener('input', calculateTotal)

                    calculateTotal()

                    addButton.addEventListener('click', function() {
                        addRowToAddedResults(item)
                        removeRowFromResults(item.articul)
                    })

                    resultsContainer.appendChild(row)
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
                <input type="text" value="${item.articul}" readonly>
            </div>
        </div>
        <div class="cell">
            <div class="form-group">
                <input type="text" value="${item.product}" readonly>
            </div>
        </div>
        <div class="cell">
            <div class="form-group">
                <input type="text" value="${item.price}" readonly>
            </div>
        </div>
        <div class="cell">
            <div class="form-group _bg-white">
                <input type="text" value="1" readonly>
            </div>
        </div>
        <div class="cell">
            <div class="form-group">
                <input type="text" value="${item.discount}" readonly>
            </div>
        </div>
        <div class="cell">
            <div class="form-group">
                <input type="text" value="${item.price}" readonly>  <!--??? total -->
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
    row.className = 'row added-result-row'
    row.innerHTML = `
        <div class="cell">
            <div class="form-group _bg-white">
                <input type="text" value="${item.articul}" readonly>
            </div>
        </div>
        <div class="cell">
            <div class="form-group">
                <input type="text" value="${item.product}" readonly>
            </div>
        </div>
        <div class="cell">
            <div class="form-group">
                <input type="text" value="${item.price}" readonly>
            </div>
        </div>
        <div class="cell">
            <div class="form-group _bg-white">
                <input type="text" value="1" readonly>
            </div>
        </div>
        <div class="cell">
            <div class="form-group">
                <input type="text" value="${item.discount}" readonly>
            </div>
        </div>
        <div class="cell">
            <div class="form-group">
                <input type="text" value="${item.price}" readonly>
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

    searchResultsContainer.appendChild(row);
}
