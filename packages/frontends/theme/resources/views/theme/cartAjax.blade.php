@if(isset($cartData))
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-bordered text-center mb-0">
                <thead class="bg-secondary text-dark">
                    <tr>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                @if(Cookie::get('cart'))
                    @php
                        $total = 0;
                        $count = 0;
                    @endphp
                    <tbody class="align-middle">
                        @foreach ($cartData as $item)
                            <tr class="cart-item">
                                <td class="align-middle"><img src="img/product-1.jpg" alt="" style="width: 50px;">{{ $item['name'] }}</td>
                                <td class="align-middle">${{ number_format($item['price'], 2) }}</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <input type="text" class="form-control form-control-sm bg-secondary text-center quantity" value="{{ $item['quantity'] }}">
                                    </div>
                                </td>
                                <td class="align-middle">${{ number_format($item['quantity'] * $item['price']) }}</td>
                                <td class="align-middle"><button class="btn btn-sm btn-primary btn-remove"><i class="fa fa-times"></i></button></td>
                                <input type="hidden" class="car-id" value="{{ $item['id'] }}">
                            </tr>
                            @php
                                $total = $total + ($item["quantity"] * $item["price"]);
                                $count = $count + $item["quantity"];
                            @endphp
                        @endforeach
                    </tbody>
                @endif
            </table>
        </div>
        <div class="col-lg-4">
            <div class="card border-secondary mb-5">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3 pt-1">
                        <h6 class="font-weight-medium">Sum Quantity</h6>
                        <h6 class="font-weight-medium">{{ $count }}</h6>
                    </div>
                </div>
                <div class="card-footer border-secondary bg-transparent">
                    <div class="d-flex justify-content-between mt-2">
                        <h5 class="font-weight-bold">Total</h5>
                        <h5 class="font-weight-bold">${{ number_format($total, 2) }}</h5>
                    </div>
                    <button class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</button>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <div class="no-content">Your cart is empty!</div>
        </div>
    </div>
@endif