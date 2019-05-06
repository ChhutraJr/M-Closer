@extends('master')
@section('content')
	<div class="grow">
		<div class="container">
			<h2>{{$cat->name}}</h2>
		</div>
	</div>
	<!-- grow -->
	<div class="pro-du">
		<div class="container">
			<div class="col-md-12 product1">
				<div class=" bottom-product">
					@foreach($cat_products as $item)
					<div class="col-md-4 bottom-cd simpleCart_shelfItem">
						<div class="product-at ">
							<a href="{{url('product/'.$item->name)}}"><img class="img-responsive" src="{{url('storage/'.$item->pictures->first()->name)}}" alt="">
								<div class="pro-grid">
									<span class="buy-in">ទិញឥឡូវ​នេះ</span>
								</div>
							</a>
						</div>
						<p class="tun"><span>{{$item->name}}</span></p>
						<div class="ca-rt">
							<a href="{{url('product/'.$item->name)}}" class="item_add"><p class="number item_price"><i> </i>${{ number_format($item->price, 2) }}</p></a>
						</div>
						<div class="clearfix"></div>
					</div>
					@endforeach


				</div>

			</div>

			<div class="container" style="text-align: center">
				@if($paginate=='true')

					<ul class="pagination ">

						@if(!empty($cat_products->previousPageUrl()))
							<li class="page-item">
								<a class="page-link" href="{{$cat_products->previousPageUrl()}}" aria-label="Previous">
									<span aria-hidden="true">&lt;</span>
									<span class="sr-only">Previous</span>
								</a>
							</li>
						@endif

						@php
							$page=0;
                            $total=$cat_products->total();
                            $page=ceil($total/$per_page);
                            $active_page='';
                           // var_dump($page);
						@endphp

						@for($i=1;$i<=$page;$i++)
							@if($i==$cat_products->currentPage())
								@php($active_page='active')
							@else
								@php($active_page='')
							@endif

							<li class="page-item {{$active_page}}">
								<a class="page-link" href="{{$cat_products->url($i)}}">{{$i}}</a>
							</li>
						@endfor

						@if(!empty($cat_products->nextPageUrl()))
							<li class="page-item">
								<a class="page-link" href="{{url($cat_products->nextPageUrl())}}" aria-label="Next">
									<span aria-hidden="true">&gt;</span>
									<span class="sr-only">Next</span>
								</a>
							</li>
						@endif
					</ul>
				@endif
			</div>

			<div class="clearfix"></div>
		</div>
	</div>
	<!-- products -->
@endsection