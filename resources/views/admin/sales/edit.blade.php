@extends('layouts.admin')
@section('content')
    @php
        $user = Auth::user()->id;
    @endphp
    <div class="main-card">
        <div class="header">
            {{ trans('global.edit') }} {{ trans('cruds.sale.title_singular') }}
        </div>

            <div class="body">
                @if(session('success'))
                    <div class="bg-green-500 text-white px-4 py-2 rounded">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="flex flex-wrap">
                    <div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/2 mb-3 md:pr-2 lg:pr-2 xl:pr-2">

                        <div class="mb-3 mx-2">
                            <label for="product_id"
                                class="text-xs required">{{ trans('cruds.sale.fields.product_id') }}</label>
                            <select class="select2 {{ $errors->has('product_id') ? ' is-invalid' : '' }}" name="product_id"
                                id="product_id" multiple>
                                @foreach ($productList as $prod)
                                    <option data-price="{{ $prod->price }}" value="{{ $prod->id }}"
                                        {{ old('product_id', '') ? 'selected' : '' }}>
                                        {{ $prod->product_name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('product_id'))
                                <p class="invalid-feedback">{{ $errors->first('product_id') }}</p>
                            @endif
                            <span class="block">{{ trans('cruds.sale.fields.name_helper') }}</span>
                        </div>
                        <div class="mb-3 mx-2">
                            <label for="quantity"
                                class="text-xs required">{{ trans('cruds.sale.fields.quantity') }}</label>
                            <div class="form-group">
                                <input type="number" id="quantity" name="quantity"
                                    class="{{ $errors->has('quantity') ? ' is-invalid' : '' }}"
                                    value="{{ old('quantity') }}" required>
                            </div>
                            @if ($errors->has('quantity'))
                                <p class="invalid-feedback">{{ $errors->first('quantity') }}</p>
                            @endif
                            <span class="block">{{ trans('cruds.sale.fields.name_helper') }}</span>
                        </div>

                        <div class="mb-3 mx-2">
                            <label for="unit_price"
                                class="text-xs required">{{ trans('cruds.sale.fields.unit_price') }}</label>
                            <div class="form-group">
                                <input type="number" id="unit_price" name="unit_price"
                                    class="{{ $errors->has('unit_price') ? ' is-invalid' : '' }}"
                                    value="{{ old('unit_price') }}" required>
                            </div>
                            @if ($errors->has('unit_price'))
                                <p class="invalid-feedback">{{ $errors->first('unit_price') }}</p>
                            @endif
                            <span class="block">{{ trans('cruds.sale.fields.name_helper') }}</span>
                        </div>
                    </div>

                    <div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/2 mb-3 md:pl-2 lg:pl-2 xl:pl-2">


                        <div class="mb-3 mx-2">
                            <label for="discount"
                                class="text-xs required">{{ trans('cruds.sale.fields.discount') }}</label>
                            <div class="form-group">
                                <input type="number" id="discount" name="discount"
                                    class="{{ $errors->has('discount') ? ' is-invalid' : '' }}"
                                    value="{{ old('discount') }}" readonly>
                            </div>
                            @if ($errors->has('discount'))
                                <p class="invalid-feedback">{{ $errors->first('discount') }}</p>
                            @endif
                            <span class="block">{{ trans('cruds.sale.fields.name_helper') }}</span>
                        </div>

                        <div class="mb-3 mx-2">
                            <label for="total_amount"
                                class="text-xs required">{{ trans('cruds.sale.fields.total_amount') }}</label>
                            <div class="form-group">
                                <input type="number" id="total_amount" name="total_amount"
                                    class="{{ $errors->has('total_amount') ? ' is-invalid' : '' }}"
                                    value="{{ old('total_amount') }}" readonly required>
                            </div>
                            @if ($errors->has('total_amount'))
                                <p class="invalid-feedback">{{ $errors->first('total_amount') }}</p>
                            @endif
                            <span class="block">{{ trans('cruds.sale.fields.name_helper') }}</span>
                        </div>
                    </div>
                </div>
                <div class="w-full mb-3" style="margin-bottom: 1rem;">
                    <button type="button" id="addProduct" class="submit-button"
                        style="background-color: #4CAF50; /* Green */
                    border: none;
                    color: white;
                    padding: 0.5rem 1rem;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;
                    margin: 4px 2px;
                    transition-duration: 0.4s;
                    cursor: pointer;
                    border-radius: 4px;">Tambah
                        Produk</button>
                </div>
            </div>
            <div class="container flex flex-wrap" style="padding: 1rem;">
                <div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/2 mb-3 md:pr-2 lg:pr-2 xl:pr-2">
                    <div class="w-full">
                        <h2 style="font-size: 1.25rem; font-weight: bold; margin-bottom: 0.5rem;">Data Produk</h2>
                        <table style="width: 100%; border-collapse: collapse; border: 1px solid #000;">
                            <thead>
                                <tr>
                                    <th style="padding: 0.5rem; border-bottom: 1px solid #000;">Produk</th>
                                    <th style="padding: 0.5rem; border-bottom: 1px solid #000;">Kuantitas</th>
                                    <th style="padding: 0.5rem; border-bottom: 1px solid #000;">Harga Satuan</th>
                                    <th style="padding: 0.5rem; border-bottom: 1px solid #000;">Diskon</th>
                                    <th style="padding: 0.5rem; border-bottom: 1px solid #000;">Total</th>
                                </tr>
                            </thead>
                            <tbody id="soldProductsTableBody">
                                @foreach ($soldWithProduct as $soldProduct)
                                    <tr style="border: 1px solid #000;">
                                        <td style="padding: 0.5rem;">{{ $soldProduct['product_name'] }}</td>
                                        <td style="padding: 0.5rem;">{{ $soldProduct['quantity'] }}</td>
                                        <td style="padding: 0.5rem;">{{ $soldProduct['unit_price'] }}</td>
                                        <td style="padding: 0.5rem;">{{ $soldProduct['discount'] }}</td>
                                        <td style="padding: 0.5rem;">{{ $soldProduct['total_amount'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" style="padding: 0.5rem; text-align: right; font-weight: bold;">Grand
                                        Total:</td>
                                    <td id="grandTotal" style="padding: 0.5rem; font-weight: bold;">
                                        {{ $sale->grand_total }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/2 mb-3 md:pl-2 lg:pl-2 xl:pl-2" style="padding: 1rem;">
                    <div class="w-full">
                        <label for="amount_paid" class="text-xs">{{ trans('cruds.sale.fields.amount_paid') }}</label>
                        <div class="form-group">
                            <input type="number" id="amount_paid" name="amount_paid"
                                class="{{ $errors->has('amount_paid') ? ' is-invalid' : '' }}"
                                value="{{ old('amount_paid') }}" required>
                        </div>
                        @if ($errors->has('amount_paid'))
                            <p class="invalid-feedback">{{ $errors->first('amount_paid') }}</p>
                        @endif
                        <span class="block">{{ trans('cruds.sale.fields.name_helper') }}</span>
                    </div>

                    <div class="w-full">
                        <label for="change_due" class="text-xs">{{ trans('cruds.sale.fields.change_due') }}</label>
                        <div class="form-group">
                            <input type="number" id="change_due" name="change_due"
                                class="{{ $errors->has('change_due') ? ' is-invalid' : '' }}" readonly>
                        </div>
                        @if ($errors->has('change_due'))
                            <p class="invalid-feedback">{{ $errors->first('change_due') }}</p>
                        @endif
                        <span class="block">{{ trans('cruds.sale.fields.name_helper') }}</span>
                    </div>
                </div>
            </div>

            @php
                $soldId = null;
                foreach ($soldProducts as $sold) {
                    $soldId = $sold->id;
                }
            @endphp

            <form method="POST" action="{{ route("admin.sales.update",  $soldId) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <input type="hidden" name="user_id" value="{{ $user }}" id="">
                <input type="hidden" id="tableData" name="sold_product" value="">
                <input type="hidden" name="amount_paid" id="amount_paid_input" value="">
                <input type="hidden" name="change_due" id="change_due_input" value="">
                <input type="hidden" name="sold_product_id"  value="{{ $soldId}}">
                <input type="hidden" name="sale_date" id="sale_date" value="{{ old('sale_date', date('Y-m-d')) }}">
                <input type="hidden" name="grand_total" id="grand_total_input" value="0">
                <div class="footer">
                    <button type="submit" class="submit-button">{{ trans('global.save') }}</button>
                </div>
            </form>

    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            $('#product_id').change(function() {
                var selectedProductId = $(this).val();

                if (selectedProductId && selectedProductId.length > 0) {
                    var selectedProductPrice = $('#product_id option[value="' + selectedProductId[0] + '"]')
                        .data('price');
                    $('#unit_price').val(selectedProductPrice);
                }
            });

            $('#product_id, #quantity').on('input', function() {
                updateTotalAmount();
            });

            function updateTotalAmount() {
                var selectedProductId = $('#product_id').val();
                var selectedProductPrice = selectedProductId ? $('#product_id option[value="' + selectedProductId[
                    0] + '"]').data('price') : 0;
                var quantity = $('#quantity').val();

                var totalAmount = selectedProductPrice * quantity;


                var discount = (quantity >= 10) ? 0.02 * totalAmount : 0;

                discount = parseFloat(discount.toFixed(2));


                $('#discount').val(discount);


                $('#total_amount').val(parseInt(totalAmount - discount));
            }

            $('#addProduct').click(function() {

                var productId = $('#product_id').val();
                var productName = $('#product_id option:selected').text();
                var quantity = $('#quantity').val();
                var unitPrice = $('#unit_price').val();
                var discount = $('#discount').val();
                var totalAmount = $('#total_amount').val();


                if (!productId || !quantity) {
                    alert('Produk dan kuantitas harus diisi.');
                    return;
                }


                addProductToTable(productId, productName, quantity, unitPrice, discount, totalAmount);


                resetInputFields();


                updateGrandTotal();
                updateAmountPaidAndChangeDue();

            });

            var initialGrandTotal = parseFloat("{{ $sale->grand_total }}") || 0;
            var grandTotal = initialGrandTotal;
            var rowTotals = [];
            var savedProducts = [];

            // Initialize Grand Total with data from the controller
            $('#grandTotal').text(grandTotal.toFixed(2));

            function updateGrandTotalWithNewValues() {
                grandTotal = rowTotals.reduce(function(total, value) {
                    return total + value;
                }, initialGrandTotal);

                $('#grandTotal').text(grandTotal.toFixed(2));
                $('#grand_total_input').val(grandTotal.toFixed(2));
            }

            // Simpan dan print
            $('#saveAndPrint').click(function() {
                alert('Data berhasil disimpan dan dicetak.');
            });

            function updateAmountPaidAndChangeDue() {
                var amountPaid = parseFloat($('#amount_paid').val()) || 0;

                $('#amount_paid_input').val(amountPaid.toFixed(2));

                if (!isNaN(amountPaid)) {
                    var changeDue = amountPaid - grandTotal;
                    $('#change_due').val(changeDue.toFixed(2));
                    $('#change_due_input').val(changeDue.toFixed(2));
                }
            }


            function addProductToTable(productId, productName, quantity, unitPrice, discount, totalAmount) {

                var existingRow = $('#soldProductsTableBody tr').filter(function() {
                    return $('td:first-child', this).text() == productName;
                });

                if (existingRow.length > 0) {

                    var existingQuantity = parseInt($('td:nth-child(2)', existingRow).text());
                    var newQuantity = existingQuantity + parseInt(quantity);
                    $('td:nth-child(2)', existingRow).text(newQuantity);


                    updateTotalAndQuantity(existingRow, newQuantity, unitPrice, discount, totalAmount);
                } else {

                    rowTotals.push(parseFloat(totalAmount.replace(',', '')));

                    var newRow = `
                        <tr style="border: 1px solid #000;">
                            <td style="padding: 0.5rem;">${productName}</td>
                            <td style="padding: 0.5rem;">${quantity}</td>
                            <td style="padding: 0.5rem;">${unitPrice}</td>
                            <td style="padding: 0.5rem;">${discount}</td>
                            <td style="padding: 0.5rem;">${totalAmount}</td>
                            <td style="padding: 0.5rem;">
                                <button class="deleteButton" type="button" style="background-color: #e53e3e; color: #fff; padding: 0.5rem 1rem; border-radius: 0.25rem;">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    `;

                    $('#soldProductsTableBody').append(newRow);
                }
                var productData = {
                    product_id: productId,
                    quantity: quantity,
                    unit_price: unitPrice,
                    discount: discount,
                    total_amount: totalAmount
                };

                savedProducts.push(productData);
                updateGrandTotal();
                updateTableDataInput();
                resetInputFields()
            }

            function updateTotalAndQuantity(row, newQuantity, unitPrice, discount, totalAmount) {

                $('td:nth-child(2)', row).text(newQuantity);


                var newTotalAmount = parseFloat(totalAmount.replace(',', ''));
                var newDiscount = (newQuantity >= 10) ? 0.02 * newTotalAmount : 0;

                $('td:nth-child(4)', row).text(newDiscount.toFixed(2));


                rowTotals[row.index()] = newTotalAmount - newDiscount;
                updateGrandTotal();
            }

            function resetInputFields() {

                $('#product_id').val('');
                $('#quantity').val('');
                $('#unit_price').val('');
                $('#discount').val('');
                $('#total_amount').val('');
            }
            $(document).on('click', '.deleteButton', function() {

                var deletedRow = $(this).closest('tr');
                var deletedTotal = parseFloat(deletedRow.find('td:last').text().replace(',', ''));


                var index = deletedRow.index();
                if (index !== -1) {
                    rowTotals.splice(index, 1);
                }


                deletedRow.remove();


                updateGrandTotal();
            });

            function updateGrandTotal() {
                var initialGrandTotal = parseFloat("{{ $sale->grand_total }}") || 0;

                var newGrandTotal = rowTotals.reduce(function(total, value) {
                    return total + value;
                }, initialGrandTotal);

                $('#grandTotal').text(newGrandTotal.toFixed(2));
                $('#grand_total_input').val(newGrandTotal.toFixed(2));
            }

            function updateTableDataInput() {

                $('#tableData').val(JSON.stringify(savedProducts));
            }

            $('#amount_paid').on('input', function() {
                updateChangeDue();
                updateAmountPaidAndChangeDue()
            });

            function updateChangeDue() {
                var amountPaid = $('#amount_paid').val();
                var grandTotal = parseFloat($('#grandTotal').text());


                if (!isNaN(amountPaid)) {
                    var changeDue = parseFloat(amountPaid) - grandTotal;
                    $('#change_due').val(changeDue.toFixed(2));
                    $('#change_due_input').val(changeDue.toFixed(2));
                    $('#amount_paid_input').val(amountPaid);
                }
            }

            function resetInputFields() {

                $('#product_id').val('').trigger('change');
                $('#quantity').val('');
                $('#unit_price').val('');
                $('#discount').val('');
                $('#total_amount').val('');
            }


        });
    </script>
@endsection
