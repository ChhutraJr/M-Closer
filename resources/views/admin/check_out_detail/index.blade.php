@extends('admin.master')
@section('content')
    <div class="col-sm-12">
        <div class="m-b-20 table-responsive">
            <h4 class="m-t-0 header-title">Check Out Detail <h4>

        </div>

        <table id="datatable-responsive"
               class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th>No</th>
                <th>Product</th>
                <th>Name</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>

            @foreach($check_out_details as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                   <td> <a href="#" style="outline: none;" data-toggle="modal" data-target="#image-{{$item->id}}"><img class="img img-rounded" src="{{url('storage/'.$item->pro->pictures->first()->image)}}" alt=""  height="35px"></a> </td>
                    <td>{{$item->pro->name}}</td>
                    <td>{{$item->qty}}</td>
                    <td>{{$item->pro->price}}</td>
                    <td>{{$item->pro->price * $item->qty}}</td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>
@endsection