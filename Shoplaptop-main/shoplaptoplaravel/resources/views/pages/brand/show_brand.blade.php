@extends('welcome')
@section('content')

                    <div class="features_items"><!--features_items-->
						@foreach($brand_name as $key => $brand_name)
						<h2 class="title text-center">{{$brand_name->brand_name}}</h2>
						@endforeach
						@foreach($brand_by_id as $key => $product)
						<a href="{{URL::to('chi-tiet-san-pham/'.$product->product_id)}}">
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{URL::to('public/upload/product/'.$product->product_image)}}" width="200" height="200" alt="" />
											<h2>{{number_format($product->product_price).''.'VND'}}</h2>
											<p>{{$product->product_name}}</p>
											<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
										</div>
										
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
									</ul>
								</div>
							</div>
						</div>
						</a>
						@endforeach
						
						
						
						
						
					</div><!--features_items-->
					{{$brand_by_id->links()}}

                    
                    
@endsection