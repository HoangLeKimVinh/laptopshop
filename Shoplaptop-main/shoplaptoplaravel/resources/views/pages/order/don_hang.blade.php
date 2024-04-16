@extends('welcome')
@section('content')
<div class="container">
<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li class="active">Don hàng của bạn</li>
				</ol>
			</div>
<div class="table-responsive cart_info">
<table class="table table-condensed">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Ten san pham</th>
      <th scope="col">So luong</th>
      <th scope="col">Gia san pham</th>
      <th scope="col">Phi ship</th>
      <th scope="col">Tong</th>
      <th scope="col">Tinh trang</th>

    </tr>
  </thead>
  <tbody>
    @php
    $i=0;
    $total = 0;
    @endphp
    @foreach($order_frontend as $key => $od_fe)
    @php
    $i++;
    $subtotal = $od_fe->product_price*$od_fe->product_sales_quantity+$od_fe->product_feeship;
    $total+=$subtotal;
    @endphp
    <tr>
      <th scope="row">{{$i}}</th>
      <td>{{$od_fe->product_name}}</td>
      <td>{{$od_fe->product_sales_quantity}}</td>
      <td>{{number_format($od_fe->product_price ,0,',','.')}}đ</td>
      <td>{{number_format($od_fe->product_feeship ,0,',','.')}}đ</td>
      <td>{{number_format($subtotal ,0,',','.')}}đ</td>
      @if($od_fe->order_status==1)
      <td>Chưa xử lý</td>
      @elseif($od_fe->order_status==2)
      <td>Đã xử lý</td>
      @else
      <td>Hủy đơn hàng</td>
      @endif
    </tr>
    @endforeach
  </tbody>
</table>
</div>
</div>
@endsection