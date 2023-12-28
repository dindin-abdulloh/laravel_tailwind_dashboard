
@extends('layouts.admin')
@section('content')
    @php
        $user = Auth::user()->id;
    @endphp
    <div class="main-card">
        <div class="header">
            {{ trans('global.create') }} {{ trans('cruds.sale.title_singular') }}
        </div>

        <div class="body">
            <div class="flex flex-wrap">
                <div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/2 mb-3 md:pr-2 lg:pr-2 xl:pr-2">

                    <div class="mb-3 mx-2">
                        <label for="product_id" class="text-xs required">{{ trans('cruds.sale.fields.product_id') }}</label>
                        <select class="select2 {{ $errors->has('product_id') ? ' is-invalid' : '' }}" name="product_id"
                            id="product_id" multiple>
                            @foreach ($products as $prod)
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
                        <label for="quantity" class="text-xs required">{{ trans('cruds.sale.fields.quantity') }}</label>
                        <div class="form-group">
                            <input type="number" id="quantity" name="quantity"
                                class="{{ $errors->has('quantity') ? ' is-invalid' : '' }}" value="{{ old('quantity') }}"
                                required>
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
                        <label for="discount" class="text-xs required">{{ trans('cruds.sale.fields.discount') }}</label>
                        <div class="form-group">
                            <input type="number" id="discount" name="discount"
                                class="{{ $errors->has('discount') ? ' is-invalid' : '' }}" value="{{ old('discount') }}"
                                readonly>
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
            <div class="w-full mb-3">
                <button type="button" id="addProduct" class="submit-button">Tambah Produk</button>
            </div>
        </div>

        <div class="w-full mb-3">
            <button type="button" id="addProduct" class="submit-button">Tambah Produk</button>
        </div>

        <div class="container flex flex-wrap">
            <div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/2 mb-3 md:pr-2 lg:pr-2 xl:pr-2">
                <div class="w-full">
                    <h2>Data Produk Terjual</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Kuantitas</th>
                                <th>Harga Satuan</th>
                                <th>Diskon</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody id="soldProductsTableBody">
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-right">Grand Total:</td>
                                <td id="grandTotal">0</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="w-full md:w-1/2 lg:w-1/2 xl:w-1/2 mb-3 md:pl-2 lg:pl-2 xl:pl-2">
                <div class="w-full">
                    <label for="amount_paid" class="text-xs required">{{ trans('cruds.sale.fields.amount_paid') }}</label>
                    <div class="form-group">
                        <input type="number" id="amount_paid" name="amount_paid"
                            class="{{ $errors->has('amount_paid') ? ' is-invalid' : '' }}" value="{{ old('amount_paid') }}"
                            required>
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


        <form method="POST" action="{{ route('admin.sales.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user }}" id="">
            <input type="hidden" id="tableData" name="sold_product" value="">
            <input type="hidden" name="amount_paid" id="amount_paid_input" value="">
            <input type="hidden" name="change_due" id="change_due_input" value="">
            <input type="hidden" name="sale_date" id="sale_date" value="{{ old('sale_date', date('Y-m-d')) }}">
            <input type="hidden" name="transaction_code" id="transaction_code" value="{{ '#' . date('dHis') . rand(100, 999) }}">
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
                // Ambil nilai dari input produk dan kuantitas
                var productId = $('#product_id').val();
                var productName = $('#product_id option:selected').text(); // Ambil nama produk
                var quantity = $('#quantity').val();
                var unitPrice = $('#unit_price').val();
                var discount = $('#discount').val();
                var totalAmount = $('#total_amount').val();

                // Validasi input, tambahkan validasi sesuai kebutuhan
                if (!productId || !quantity) {
                    alert('Produk dan kuantitas harus diisi.');
                    return;
                }

                // Tambahkan baris baru ke dalam tabel
                addProductToTable(productId, productName, quantity, unitPrice, discount, totalAmount);

                // Reset nilai input
                resetInputFields();

                // Perbarui total secara dinamis
                updateGrandTotal();
            });

            // Simpan dan print
            $('#saveAndPrint').click(function() {
                // Lakukan logika untuk menyimpan data ke database dan melakukan print
                // ...

                // Setelah penyimpanan, Anda dapat mengarahkan pengguna ke halaman lain atau menampilkan pesan sukses
                alert('Data berhasil disimpan dan dicetak.');
            });

            var rowTotals = [];
            var savedProducts = [];

            function addProductToTable(productId, productName, quantity, unitPrice, discount, totalAmount) {
                // Tambahkan baris baru ke dalam tabel

                rowTotals.push(parseFloat(totalAmount.replace(',', '')));
                var newRow = '<tr>' +
                    '<td>' + productName + '</td>' +
                    '<td>' + quantity + '</td>' +
                    '<td>' + unitPrice + '</td>' +
                    '<td>' + discount + '</td>' +
                    '<td>' + totalAmount + '</td>' +
                    '<td><button type="button" class="btn btn-danger btn-sm deleteRow">Hapus</button></td>' +
                    '</tr>';

                $('#soldProductsTableBody').append(newRow);

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

            function resetInputFields() {
                // Reset nilai input
                $('#product_id').val('');
                $('#quantity').val('');
                $('#unit_price').val('');
                $('#discount').val('');
                $('#total_amount').val('');
            }
            $(document).on('click', '.deleteRow', function() {
                // Hapus baris saat tombol hapus diklik
                var deletedRow = $(this).closest('tr');
                var deletedTotal = parseFloat(deletedRow.find('td:last').text().replace(',', ''));

                // Hapus total baris dari array
                var index = deletedRow.index();
                if (index !== -1) {
                    rowTotals.splice(index, 1);
                }

                // Hapus baris dari tabel
                deletedRow.remove();

                // Perbarui total secara dinamis
                updateGrandTotal();
            });

            function updateGrandTotal() {
                var grandTotal = rowTotals.reduce(function(total, value) {
                    return total + value;
                }, 0);


                $('#grandTotal').text(grandTotal.toFixed(2));
                $('#grand_total_input').val(grandTotal.toFixed(2));
            }

            function updateTableDataInput() {
                // Simpan data tabel dalam input tersembunyi
                $('#tableData').val(JSON.stringify(savedProducts));
            }

            $('#amount_paid').on('input', function() {
                updateChangeDue();
            });

            function updateChangeDue() {
                var amountPaid = $('#amount_paid').val();
                var grandTotal = parseFloat($('#grandTotal').text());

                // Periksa apakah nilai dapat di-parse menjadi angka
                if (!isNaN(amountPaid)) {
                    var changeDue = parseFloat(amountPaid) - grandTotal;
                    $('#change_due').val(changeDue.toFixed(2));
                    $('#change_due_input').val(changeDue.toFixed(2));
                    $('#amount_paid_input').val(amountPaid);
                }
            }

            function resetInputFields() {
            // Reset nilai input
            $('#product_id').val('').trigger('change'); // Trigger change untuk input yang menggunakan select2
            $('#quantity').val('');
            $('#unit_price').val('');
            $('#discount').val('');
            $('#total_amount').val('');
        }

        });
    </script>
@endsection
