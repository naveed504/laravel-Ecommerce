<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row p-5">
                        <div class="col-md-4"></div>
                        <div class="col-md-8">
                                <img src="{{asset('front_assets/images/logo.png')}}" style="text-align:center;">
                            </div>


                        </div>

                        <hr class="my-5">

                        <div class="row pb-5 p-5">
                            <div class="col-md-6">
                                <p class="font-weight-bold mb-4">Client Information</p>
                                <p class="mb-1">{{$details['name']}}</p>
                                <p>{{$details['city']}}, {{$details['country']}}</p>
                                <p class="mb-1">Sadat Colony Taranda saway khan , stret no 4 house no 422</p>
                                <p class="mb-1"><b>Status</b> {{$details['order_status']}}</p>
                            </div>


                        </div>

                        <div class="row p-5">
                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="border-0 text-uppercase small font-weight-bold">Color</th>
                                            <th class="border-0 text-uppercase small font-weight-bold">Code</th>
                                            <th class="border-0 text-uppercase small font-weight-bold">Size</th>
                                            <th class="border-0 text-uppercase small font-weight-bold">Price</th>
                                            <th class="border-0 text-uppercase small font-weight-bold">Qnty</th>
                                        </tr>
                                    </thead>
                                    <tbody>





                                      @foreach($orderdetail['orders'] as $order)
                                        <tr>
                                        <td>{{$order['product_color']}}</td>
                                        <td>{{$order['product_code']}}</td>
                                        <td>{{$order['product_size']}}</td>
                                        <td>{{$order['product_price']}}</td>
                                        <td>{{$order['product_qty']}}</td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="d-flex flex-row-reverse bg-dark text-white p-4">
                            <div class="py-3 px-5 text-right">
                                <div class="mb-2">Grand Total</div>
                                <div class="h2 font-weight-light">pkr{{$details['grand_total']}}</div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-light mt-5 mb-5 text-center small">by : <a class="text-light" target="_blank" href="http://totoprayogo.com">totoprayogo.com</a></div>

    </div>



</body>

</html>