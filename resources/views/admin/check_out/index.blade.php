@extends('admin.master')
@section('content')
    <div class="col-sm-12">
        <div class="m-b-20 table-responsive">
            <h4 class="m-t-0 header-title">Check Out </h4>

        </div>

        <table id="datatable-responsive"
               class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
               width="100%">
            <thead>
            <tr>
                <th>No</th>
                <th>Product</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Address</th>
                <th>Shipping</th>
                <th>Sub Total</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>

            @foreach($check_outs as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td><a target="_blank" href="{{url('/system/checkout_detail/'.$item->id)}}" style="outline: none;" ><img class="img img-rounded" src="{{url('storage/'.$item->check_out_detail->first()->pro->pictures->first()->image)}}" alt=""  height="35px"></a> </td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->phone_number}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->address}}</td>
                    <td>ddd</td>
                    <td>${{number_format($item->sub_total, 2)}}</td>
                    <td>${{number_format($item->total, 2)}}</td>

                    <td>
                        <a href="#" style="outline: none;" data-toggle="modal" data-target="#delete-{{$item->id}}"><i class="glyphicon glyphicon-trash btn-delete delete-cl"></i>Delete</a>

                    </td>
                </tr>
                <!--Delete-->
                <div class="modal fade modal-danger" id="delete-{{$item->id}}" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Delete: <img src="{{url('storage/'.$item->image)}}" alt="" class="img-circle" width="25px"> {{$item->name}}</h4>
                            </div>

                            <div class="modal-body">
                                Continue ?
                            </div>

                            <div class="modal-footer">
                                <form action="{{ url('/system/checkout/delete') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="delete_id" value="{{$item->id}}">
                                    <button type="submit" class="btn btn-default" data-dismiss="modal">No</button>
                                    <button type="submit" class="btn btn-primary">Yes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection