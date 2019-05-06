@extends('master')
@section('content')
	<!-- grow -->
	<div class="grow">
		<div class="container">
			<h2>{{$pro->name}}</h2>
		</div>
	</div>
	<!-- grow -->
	<div class="product">
		<div class="container">

			<div class="product-price1">
				<div class="top-sing">
					<div class="col-md-7 single-top">
						<div class="flexslider">
							<ul class="slides">
								@foreach($pro->pictures as $pro_img)
								<li data-thumb="{{url('storage/'.$pro_img->name)}}">

									<div class="thumb-image"> <img src="{{url('storage/'.$pro_img->name)}}" data-imagezoom="true" class="" > </div>

								</li>
								@endforeach

							</ul>
						</div>

						<div class="clearfix"> </div>
						<!-- slide -->


						<!-- FlexSlider -->
						<script defer src="{{url('js/jquery.flexslider.')}}js"></script>
						<link rel="stylesheet" href="{{url('css/flexslider.css')}}" type="text/css" media="screen" />

						<script>
                            // Can also be used with $(document).ready()
                            $(window).load(function() {
                                $('.flexslider').flexslider({
                                    animation: "slide",
                                    controlNav: "thumbnails"
                                });
                            });
						</script>

					</div>
					<div class="col-md-5 single-top-in simpleCart_shelfItem">
						<div class="single-para ">
							<h4>{{$pro->name}}</h4>
							<div class="star-on">


								<div class="clearfix"> </div>
							</div>

							<h5 class="item_price">$ {{ number_format($pro->price, 2) }}</h5>
							<p >{!! $pro->description !!}</p>

						</div>
					</div>
					<div class="clearfix"> </div>
				</div>
				<!---->

				<div class=" bottom-product">
					@foreach($related_pro as $r)
					<div class="col-md-4 bottom-cd simpleCart_shelfItem">
						<div class="product-at ">
							<a href="{{url('product/'.$r->name)}}"><img class="img-responsive" src="{{url('storage/'.$r->pictures->first()->name)}}" alt="">
								<div class="pro-grid">
									<span class="buy-in">ទិញឥឡូវ​នេះ</span>
								</div>
							</a>
						</div>
						<p class="tun"><span>{{$r->name}}</span></p>
						<div class="ca-rt">
							<a href="{{url('product/'.$r->name)}}" class="item_add"><p class="number item_price"><i> </i>${{ number_format($r->price, 2) }}</p></a>
						</div>
					</div>
					@endforeach

					<div class="clearfix"> </div>
				</div>
			</div>

			<div class="clearfix"> </div>
		</div>
	</div>
	<!--//content-->
@endsection