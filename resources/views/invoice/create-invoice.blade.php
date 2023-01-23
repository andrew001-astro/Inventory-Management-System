@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-12">
                <div class="card">
                    {{-- <div class="card-header">{{ __('Dashboard') }}</div> --}}

                    <div class="card-body">
                        <div class="row shipping-details mb-2">
                            <div class="col-6">
                                <h5>FROM</h5>
                                <span class="details">
                                    <input id="csrfToken" value=" {{ csrf_token() }}" hidden />
                                    <input id="senderId" value="{{ Auth::id() }}" hidden />
                                    @isset(Auth::user()->name)
                                        {{ Auth::user()->name }}<br />
                                    @endisset
                                    <address>
                                        @isset(Auth::user()->address)
                                            {{ Auth::user()->address }}<br />
                                        @endisset
                                        @isset(Auth::user()->contact_no)
                                            <a href="{{ Auth::user()->contact_no }}">{{ Auth::user()->contact_no }}</a><br />
                                        @endisset
                                        @isset(Auth::user()->email)
                                            <a href="andrewgutierrez001@gmail.com">{{ Auth::user()->email }}</a><br>
                                        @endisset
                                    </address>
                                </span>
                            </div>
                            <div class="col-6">
                                <h5>TO</h5>
                                <input type="text" class="form-control" id="recipientName" name="recipientName" required
                                    placeholder="Recipient Name">
                                <br />
                                <textarea class="form-control" rows='3' id="recipientAddress" name="recipientAddress" required
                                    placeholder="Recipient Address"></textarea>
                            </div>
                        </div>
                        <div class="row items">
                            <div class="col-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                        onclick="selectAll(this.checked)" id="checkAll">
                                                    <label class="custom-control-label" for="checkAll"></label>
                                                </div>
                                            </th>
                                            <th>Item No.</th>
                                            <th>Item Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="6">
                                                <button class="btn btn-sm btn-danger" onclick="deleteSelectedItem()">-
                                                    Delete</button>
                                                <button class="btn btn-sm btn-success" onclick="addMoreItem()">+ Add
                                                    More</button>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="row summary">
                            <div class="col-7">
                                <h5>Notes</h5>
                                <textarea class="form-control" rows='4' id="notes" required name="notes"></textarea>
                                <button class="btn btn-success mt-3" onclick="saveInvoice()">Save Invoice</button>
                            </div>
                            <div class="col-5">
                                <div class="d-flex flex-wrap align-items-center justify-content-end">
                                    <strong class="label mr-2">Subtotal:</strong>
                                    <div>
                                        <div class="input-group mb-2 mr-sm-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">$</div>
                                            </div>
                                            <input name="subTotal" readonly type="text" class="form-control"
                                                id="subTotal" placeholder="" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-wrap align-items-center justify-content-end">
                                    <strong class="label mr-2">Tax Rate:</strong>
                                    <div>
                                        <div class="input-group mb-2 mr-sm-2">
                                            <input name="taxRate" type="number" class="form-control" placeholder=""
                                                aria-label="" aria-describedby="basic-addon1" min="0" id="taxRate"
                                                oninput="computeTaxAmount(),computeInvoiceTotal(),computeAmountDue()"
                                                required>
                                            <div class="input-group-append">
                                                <div class="input-group-text">%</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-wrap align-items-center justify-content-end">
                                    <strong class="label mr-2">Tax Amount:</strong>
                                    <div>
                                        <div class="input-group mb-2 mr-sm-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">$</div>
                                            </div>
                                            <input readonly type="text" class="form-control" id="taxAmount"
                                                placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-wrap align-items-center justify-content-end">
                                    <strong class="label mr-2">Total:</strong>
                                    <div>
                                        <div class="input-group mb-2 mr-sm-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">$</div>
                                            </div>
                                            <input readonly type="text" class="form-control" id="total"
                                                placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-wrap align-items-center justify-content-end">
                                    <strong class="label mr-2">Amount Paid:</strong>
                                    <div>
                                        <div class="input-group mb-2 mr-sm-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">$</div>
                                            </div>
                                            <input name="amountPaid" type="number" class="form-control" id="amountPaid"
                                                oninput="computeAmountDue()" placeholder="" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-wrap align-items-center justify-content-end">
                                    <strong class="label mr-2">Amount Due:</strong>
                                    <div>
                                        <div class="input-group mb-2 mr-sm-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">$</div>
                                            </div>
                                            <input readonly type="text" class="form-control" id="amountDue"
                                                placeholder="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection

@section('create-invoice-scripts')
    <script>
        function addMoreItem() {
            let table = document.querySelector(".items table");
            let tbody = table.querySelector("tbody");
            let newRow = tbody.insertRow(tbody.rows.length);
            newRow.innerHTML = getItem();
            computeSubTotal();
            computeTaxAmount();
            computeInvoiceTotal();
            computeAmountDue();
        }

        function deleteSelectedItem() {
            let table = document.querySelector(".items table");
            let tbody = table.querySelector("tbody");
            let checks = tbody.querySelectorAll("input[type=checkbox]:checked");
            checks.forEach(check => {
                check.parentElement.parentElement.parentElement.remove();
            });
            document.getElementById("checkAll").checked = false;
            computeSubTotal();
            computeTaxAmount();
            computeInvoiceTotal();
            computeAmountDue();
        }

        function getItem() {
            let uniqueId = Math.random().toString(16).slice(2);
            return `
                <tr>
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="check-${uniqueId}">
                            <label class="custom-control-label" for="check-${uniqueId}"></label>
                        </div>
                    </td>
                    <td>
                        <input name="itemNo" type="text" class="form-control" id="no-${uniqueId}" required>
                    </td>
                    <td>
                        <input name="itemName" type="text" class="form-control" id="name-${uniqueId}" required>
                    </td>
                    <td>
                        <input oninput="computeItemTotal(this.id.split('-')[1])" type="number" class="form-control" id="quantity-${uniqueId}" min="0" value="0">
                    </td>
                    <td>
                        <input oninput="computeItemTotal(this.id.split('-')[1])" type="number" class="form-control" id="price-${uniqueId}" min="0" value="0">
                    </td>
                    <td>
                        <input readonly type="text" class="form-control" id="total-${uniqueId}" value="0">
                    </td>
                </tr>
    `;
        }

        function selectAll(checked) {
            let table = document.querySelector(".items table");
            let tbody = table.querySelector("tbody");
            let checks = tbody.querySelectorAll("input[type=checkbox]");
            checks.forEach(check => {
                check.checked = checked;
            });
        }

        function computeItemTotal(uniqueId) {
            let quantity = document.getElementById(`quantity-${uniqueId}`).value;
            let price = document.getElementById(`price-${uniqueId}`).value;
            document.getElementById(`total-${uniqueId}`).value = roundOffTwoDec((quantity * price));
            computeSubTotal();
            computeTaxAmount();
            computeInvoiceTotal();
            computeAmountDue();
        }

        function computeSubTotal() {
            let totals = document.querySelectorAll("input[id^=total-]");
            let subTotal = 0;
            totals.forEach(total => {
                subTotal += parseFloat(total.value);
            });
            document.getElementById("subTotal").value = roundOffTwoDec(subTotal);
        }

        function roundOffTwoDec(value) {
            return Math.round((value + Number.EPSILON) * 100) / 100;
        }

        function computeTaxAmount() {
            let taxRate = document.getElementById("taxRate").value / 100;
            let subTotal = document.getElementById("subTotal").value;
            let taxAmount = subTotal * taxRate;
            document.getElementById("taxAmount").value = roundOffTwoDec(taxAmount);
        }

        function computeInvoiceTotal() {
            let subTotal = document.getElementById("subTotal").value;
            let taxAmount = document.getElementById("taxAmount").value;
            let total = parseFloat(subTotal) + parseFloat(taxAmount);
            document.getElementById("total").value = roundOffTwoDec(total);
        }

        function computeAmountDue() {
            let total = document.getElementById("total").value;
            let amountPaid = document.getElementById("amountPaid").value;
            let amountDue = total - amountPaid;
            document.getElementById("amountDue").value = amountDue >= 0 ? roundOffTwoDec(amountDue) : 0;
        }

        function saveInvoice() {
            let validateResult = validateInputs();
            if (validateResult) {
                alert(validateResult);
                return;
            }
            if (confirm("Continue Save?")) {
                let items = buildItemsJson();
                let invoice = buildInvoiceJson();
                let jsonString = JSON.stringify({
                    items: items,
                    invoice: invoice
                });

                let xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && (this.status == 200 || this.status == 201)) {
                        // document.getElementById("demo").innerHTML = this.responseText;
                        console.log(this.responseText);
                        alert("Invoice saved with reference no. " + JSON.parse(this.responseText).invoiceReferenceNo);
                        location.reload();
                    } else if (this.readyState == 4 && (this.status != 200 || this.status != 201)) {
                        console.error(this.responseText);
                        alert("Something went wrong. \n" + this.responseText);
                    }
                };
                xhttp.open("POST", "{{url('/')}}/invoice", true);
                xhttp.setRequestHeader("Content-type", "application/json");
                xhttp.setRequestHeader("X-CSRF-TOKEN", document.getElementById('csrfToken').value);
                xhttp.send(jsonString);
            }
        }

        function buildItemsJson() {
            let table = document.querySelector(".items table");
            let tbody = table.querySelector("tbody");
            let checks = tbody.querySelectorAll("input[type=checkbox]");
            let items = [];
            checks.forEach(check => {
                let uniqueId = check.id.split("-")[1];
                let item = {
                    no: document.getElementById(`no-${uniqueId}`).value.trim(),
                    name: document.getElementById(`name-${uniqueId}`).value.trim(),
                    price: document.getElementById(`price-${uniqueId}`).value,
                    quantity: document.getElementById(`quantity-${uniqueId}`).value,
                    total: document.getElementById(`total-${uniqueId}`).value,
                };

                items.push(item);
            });
            return items;
        }

        function buildInvoiceJson() {
            let senderId = document.getElementById("senderId").value;
            let recipientName = document.getElementById("recipientName").value.trim()
            let recipientAddress = document.getElementById("recipientAddress").value.trim()
            let subTotal = document.getElementById("subTotal").value
            let taxRate = document.getElementById("taxRate").value
            let taxAmount = document.getElementById("taxAmount").value
            let total = document.getElementById("total").value
            let amountPaid = document.getElementById("amountPaid").value
            let amountDue = document.getElementById("amountDue").value
            let notes = document.getElementById("notes").value

            let invoice = {
                senderId,
                recipientName,
                recipientAddress,
                subTotal,
                taxRate,
                taxAmount,
                total,
                amountPaid,
                amountDue,
                notes
            };
            return invoice;
        }

        function validateInputs() {
            let requiredInputs = document.querySelectorAll("input[required], textarea[required]");

            for (const input of requiredInputs) {
                if (input.value == null || input.value.trim() == "" || input.value.trim().length <= 0) {
                    console.log(`${input.name} is required.`);
                    return `${input.name} is required.`
                }
            }
        }
    </script>
@endsection
