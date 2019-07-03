<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		
		
		<!-- Bootstrap core CSS -->
		<link href="{{url('css/bootstrap.min.css')}}" rel="stylesheet">
		<link href="{{url('css/bootstrap-reset.css')}}" rel="stylesheet">
		
		
    <script type="text/javascript" src="{{ url('js/jquery.min.js') }}"></script>
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Inventory
                </div>
<div class="row">
                <div class="table col-md-12">
                   <table class="display table table-bordered table-striped"  id="dynamic-table">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th class="numeric">Price Per Stock</th>
                                <th class="numeric">Quantity</th>
                                <th class="numeric">Total Price</th>
                                <th class="numeric">Delete</th>
                            </tr>
                        </thead>
                        <tbody class="ajax-append">
						@foreach ($products as $key=>$product)
                            <tr>
                                <td>{{$product->name}}</td>
                                <td class="numeric">{{$product->price}}</td>
                                <td class="numeric">{{$product->quantity}}</td>
								<td class="numeric">{{$product->quantity * $product->price}}</td>
                                <td class="numeric"><a role='button' onclick="" href="" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a></td>
                                
                            </tr>
						@endforeach	
						
                        </tbody>
                    </table>
					Net Total<input type="button" class="form-control btn-warning"  id="total-btn" value="{{$total}}" readonly>
                </div>
            </div>
        </div>
		</div>
		<div class="flex-center" style="padding-top: 0px;    margin-top: -160px;">
		<div class="row">
    <form class="form-horizontal" id="admin_add_property" >
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <div class="col-md-12">
            <div class="panel panel-default">
               
                <!--Property Information Section Starts-->

                <div class="panel-heading">Enter New Product</div>
                <div class="panel-body">
<input id="signup-token" name="_token" type="hidden" value="{{csrf_token()}}">
                    <div class="form-group">    
                        <label class="control-label col-sm-4" for="">Product Name</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="pname" id="pname" required>
                        </div>
                    </div>

                    <div class="form-group">    
                        <label class="control-label col-sm-4" for="">Quantity</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="quantity" id="quantity" required>
                        </div>
                    </div>

                    <div class="form-group">    
                        <label class="control-label col-sm-4" for="">Price per Stock</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="price" id="price" required>
                        </div>
                    </div>

                    <div class="form-group">
                <div class="col-sm-6 col-sm-offset-3">
                    <input type="button" class="form-control btn-success"  id="btn-ajax" value="Add Product">
                </div>
            </div>

                <!--Website Section Starts-->

              
                </div>

        </div>
    </form>
</div></div>
    </body>
	
	<script>

	$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
		
		
		
		$('#btn-ajax').on('click', function () {
            var price = $('#price').val();
			var quantity = $('#quantity').val();
			var pname = $('#pname').val();

            $.ajax({
                url: '/add/product',
                method: "POST",
                dataType: "json",
                data: {price: price, quantity: quantity, pname: pname},
                success: function (response) {
                    $('.ajax-append').append('<tr><td>'+pname+'</td><td>'+price+'</td><td>'+quantity+'</td><td>'+(price*quantity)+'</td><td class="numeric"><a role="button" onclick="" href="" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></a></td></tr>');
					$('#price').val('');
					$('#quantity').val('');
					$('#pname').val('');
					var net = price*quantity;
					var sumtotal = $('#total-btn').val();
					$('#total-btn').val('');
					$('#total-btn').val(net+sumtotal);
				}
            });

        });
	});
	
	</script>
</html>
