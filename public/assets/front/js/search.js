
document.getElementById('search').addEventListener('input', function() {
    let query = this.value

    if (query.length > 2) {
        fetch("/crm/search?query=" + encodeURIComponent(query))
            .then(response => response.json())
            .then(data => {
                let resultsContainer = document.getElementById('search-results')
                resultsContainer.innerHTML = ''

                data.forEach(function(item, index) {
                    let row = document.createElement('div')
                    row.className = 'row'

                    row.innerHTML = `
                        <div class="cell">
                            <div class="form-group _bg-white">
                                <input type="text" name="articul" value="${item.articul}" id="articul-${index}" readOnly>
                            </div>
                        </div>
                        <div class="cell">
                            <div class="form-group">
                                <input type="text" name="product" value="${item.product}" id="product-${index}" readOnly>
                            </div>
                        </div>
                        <div class="cell">
                            <div class="form-group">
                                <input type="text" name="price" value="${item.price}" id="price-${index}" readOnly>
                            </div>
                        </div>

                        <div class="cell">
                            <div class="form-group">
                                <input type="text" name="qty" value="1" id="qty-${index}" >
                            </div>
                        </div>

                        <div class="cell">
                            <div class="form-group">
                                <input type="text" name="discount" value="${item.discount}" id="discount-${index}" readOnly>
                            </div>
                        </div>

                        <div class="cell">
                            <div class="form-group">
                                <input type="text" name="total" value="" id="total-${index}" readOnly>
                            </div>
                        </div>

                        <div class="cell">
                            <div class="form-group">
                                <input type="text" value="" readOnly>
                            </div>
                        </div>

                        <div class="cell">
                            <button type="button" class="btn-border btn-blue btn-action">
                                <span class="icon-plus" id="plus-${index}"></span>
                            </button>
                        </div>
                    `

                    let qtyInput = row.querySelector(`#qty-${index}`)
                    let priceInput = row.querySelector(`#price-${index}`)
                    let discountInput = row.querySelector(`#discount-${index}`)
                    let totalInput = row.querySelector(`#total-${index}`)
                    let addButton = row.querySelector(`#plus-${index}`)

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
    row.className = 'row'
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
            <div class="form-group checkbox">
                <input type="checkbox" readonly>
                <label for=""></label>
            </div>
        </div>
        <div class="cell">
            <button type="button" class="btn-border btn-red btn-action">
                <span class="icon-minus"></span>
            </button>
        </div>
    `;

    addedResultsContainer.appendChild(row);
}
