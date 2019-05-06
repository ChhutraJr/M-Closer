@extends('admin.master')
@section('content')
    <div class="col-sm-12">
        <div class="m-b-20 table-responsive">

            <form class="" role="form" method="POST" id="form-product">
                {{ csrf_field() }}

                <input type="hidden" id="update_id" name="update_id" value="{{$product->id}}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Update: <img class="img img-rounded" src="{{url('storage/'.$product->pictures->first()->name)}}" alt=""  height="25px"> {{$product->name}}</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Title <span class="req">*</span></label>
                                <input type="text" class="form-control input-name" name="title" id="title" value="{{$product->name}}" placeholder="Enter Title...">
                                <span class="text-danger">
                                    <strong id="name-error"></strong>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Category <span class="req">*</span></label>
                                <select class="form-control select2 input-cat" id="select2" name="category" data-placeholder="Select a category..." data-tabindex="1">
                                    <option value=""></option>
                                    @foreach($cats as $item)
                                        @if($item->id==$product->cat->id)
                                            <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                        @else
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                         <strong id="cat-error"></strong>
                                 </span>
                            </div>

                        </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Sub Category <span class="req">*</span></label>
                                    <select class="form-control select2 input-cat_sub" id="select3" name="sub_category" data-placeholder="Select a Sub Category..." data-tabindex="1">
                                        <option value=""></option>
                                        @foreach($sub_cats as $item)
                                            @if($item->id==$product->sub_cat->id)
                                                <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                            @else
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    <span class="text-danger">
                                    <strong id="cat_sub-error"></strong>
                                </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Brand <span class="req">*</span></label>
                                <select class="form-control select2 input-brand" id="select4" name="brand" data-placeholder="Select a Brand..." data-tabindex="1">
                                    @foreach($brands as $item)
                                        @if($item->id==$product->brand->id)
                                            <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                        @else
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    <strong id="brand-error"></strong>
                                </span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Supplier <span class="req">*</span></label>
                                <select class="form-control select2 input-sup" id="select5" name="supplier" data-placeholder="Select a Supplier..." data-tabindex="1">
                                    @foreach($suppliers as $item)
                                        @if($item->id==$product->supplier->id)
                                            <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                        @else
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    <strong id="sup-error"></strong>
                                </span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group3">
                                <label class="control-label">Product Availability <span class="req">*</span></label>
                                <select class="form-control select2 input-pro_ava" id="select6" name="pro_ava" data-placeholder="Select a product_Ava..." data-tabindex="1">
                                    @foreach($pro_avaty as $item)
                                        @if($item->id==$product->supplier->id)
                                            <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                        @else
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    <strong id="pro_ava-error"></strong>
                                </span>
                            </div>
                        </div>
                        </div>
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group2">
                                <label class="control-label">Model<span class="req">*</span></label>
                                <input type="text" class="form-control input-model" name="model" id="model" value="{{$product->mod}}" placeholder="Enter Model...">
                                <span class="text-danger">
                                    <strong id="model-error"></strong>
                                </span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group1">
                                <label class="control-label">Product Code <span class="req">*</span></label>
                                <input type="text" class="form-control input-pro_code" name="pro_code" id="pro_code" value="{{$product->pro_code}}" placeholder="Enter Product_Code...">
                                <span class="text-danger">
                                    <strong id="pro_code-error"></strong>
                                </span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Price <span class="req">*</span></label>
                                <input type="text" class="form-control input-price" id="price" name="price" value="{{$product->price}}" placeholder="Enter Price...">
                                <span class="text-danger">
                                       <strong id="price-error"></strong>
                                </span>
                            </div>
                        </div>

                    </div>

                    </div>

                    <div class="row col-md-12">
                        <div class="form-group">
                            <label class="control-label">Size <span class="req">*</span></label>
                            <select class=" multipleSelect select2-input-size" multiple name="size" id ="size">
                                <option value=""></option>
                                @foreach($sizes as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">
                                <strong id="size-error"></strong>
                            </span>

                            <script>
                                $('.multipleSelect').fastselect();
                            </script>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Description <span class="req">*</span></label>
                                <div class="summernote input-des" id="des">
                                    {!! $product->description !!}
                                </div>
                                <span class="text-danger">
                                    <strong id="des-error"></strong>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Review Images</label>
                                <div >
                                    @foreach($product->pictures as $pic)
                                        <img class="img img-rounded" src="{{url('storage/'.$pic->image)}}" alt=""  height="75px" style="margin-bottom: 20px">
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row form-group">
                                <label class="col-sm-12 form-control-label">New Images</label>
                                <div class="col-sm-12 mg-t-10 mg-sm-t-0">
                                    <form action="" class="dropzone2" method="POST" enctype="multipart/form-data" id="">

                                    </form>

                                </div>
                            </div><!-- row -->

                            <form action="{{route('products.picture')}}" class="dropzone" method="POST" enctype="multipart/form-data" id="my-awesome-dropzone">
                                {{ csrf_field() }}
                                <div class="form-group">

                                    <div id="picture-error"></div>
                                    <div class="fallback ">
                                        <input type="file" class="form-control input-image" name="file" multiple />
                                    </div>
                                </div>
                            </form>
                            <a href="javascript:void(0)" id="clear_image"><span class="fa fa-times clear-cl">Clear</span></a>

                            <span class="text-danger">
                                               <strong id="image-error"></strong>
                                        </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="window.location='{{url('/system/products')}}'" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    <button class="btn btn-info waves-effect waves-light" id="btn-save">Update</button>
                </div>
            </form>
      </div>


    </div>

@endsection

@section('data')
    <script type="text/javascript">

        $('.multipleSelects').fastselect();

        $('#select2').select2({
            width: '100%',
            placeholder: 'Select an option...',
            allowClear: true

        });

        $('#select3').select2({
            width: '100%',
            placeholder: 'Select an option...',
            allowClear: true

        });

        $('#size').select2({
            width: '100%',
            placeholder: 'Select an option...',
            allowClear: true

        });

        $('#select4').select2({
            width: '100%',
            placeholder: 'Select an option...',
            allowClear: true

        });

        $('#select5').select2({
            width: '100%',
            placeholder: 'Select an option...',
            allowClear: true

        });

        $('#select6').select2({
            width: '100%',
            placeholder: 'Select an option...',
            allowClear: true

        });

        var btnSave= $('#btn-save');
        btnSave.click(function (e) {
            e.preventDefault();


            has_errors('.input-name', '#name-error');
            has_errors('.input-model','#model-error');
            has_errors('.input-pro_code','#pro_code-error');
            has_errors('.input-brand','#brand-error');
            has_errors('.input-sup','#sup-error');
            has_errors('.input-pro_ava','#pro_ava');
            has_errors('.input-price', '#price-error');
            has_errors('.input-des', '#des-error');
            has_errors('.input-image', '#image-error');

            var title=$('#title').val();
            var cat=$('#select2').val();
            var model=$('#model').val();
            var pro_code=$('#pro_code').val();
            var brand=$('#select4').val();
            var sup=$('#select5').val();
            var pro_ava=$('#select6').val();
            var price=$('#price').val();
            var description=$('#des').summernote('code');
            var update_id=$('#update_id').val();

            $.ajax({
                type: "POST",
                url: "{{route('products.update')}}",
                dataType: 'json',
                data: {
                    'title': title,
                    'model':model,
                    'pro_code':pro_code,
                    'pro_ava':pro_ava,
                    'brand':brand,
                    'supplier':sup,
                    'price': price,
                    'description':description,
                    'category':cat,
                    'update_id':update_id,
                    '_token': "{{ csrf_token() }}"
                },
                success: function (data) {
                    console.log(data);
                    if (data.errors) {

                        if (data.errors.title) {
                            errors('#name-error', data.errors.title[0], '.input-name');
                        }

                        if (data.errors.category) {
                            errors('#cat-error', data.errors.category[0], '.input-cat');
                        }

                        if (data.errors.model) {
                            errors('#model-error', data.errors.model[0], '.input-model');
                        }
                        if (data.errors.pro_code) {
                            errors('#pro_code-error', data.errors.pro_code[0], '.input-pro_code');
                        }

                        if (data.errors.brand) {
                            errors('#brand-error', data.errors.brand[0], '.input-brand');
                        }

                        if (data.errors.pro_ava) {
                            errors('#pro_ava-error', data.errors.pro_ava[0], '.input-pro_ava');
                        }

                        if (data.errors.supplier) {
                            errors('#sup-error', data.errors.supplier[0], '.input-supp');
                        }

                        if (data.errors.price) {
                            errors('#price-error', data.errors.price[0], '.input-price');
                        }

                        if (data.errors.description) {
                            errors('#des-error', data.errors.description[0], '.input-des');
                        }

                    }

                    if (data.images=='false'){

                        $('#image-error').html('The images field is required.');
                    }

                    if (data.verify=='true'){

                        window.location.href = "{{URL::to('system/products')}}"
                    }
                }
            });
        });

            $('#clear_image').fadeOut();
            Dropzone.options.myAwesomeDropzone = {
                paramName: "file", // The name that will be used to transfer the file
                maxFilesize: 2, // MB
                maxFiles: 10,
                acceptedFiles: ".jpeg,.jpg,.png",

                accept: function(file, done) {
                    console.log("uploaded");
                    done();
                },

                init: function() {
                    this.on("maxfilesexceeded", function(file){
                        //alert("You can't add more image!");
                        this.removeFile(file);
                    });

                    this.on("addedfile", function(file) {
                        //Check the same files
                        if (this.files.length) {
                            var _i, _len;
                            for (_i = 0, _len = this.files.length; _i < _len - 1; _i++) // -1 to exclude current file
                            {
                                if(this.files[_i].name === file.name && this.files[_i].size === file.size && this.files[_i].lastModifiedDate.toString() === file.lastModifiedDate.toString())
                                {
                                    this.removeFile(file);
                                    break;
                                }
                            }
                        }

                        $('#clear_image').fadeIn();
                    });

                    this.on("error", function(file, message) {
                        alert(message);
                        this.removeFile(file);
                    });

                }
            };

        $('#datatable-responsive').DataTable();
        $(document).ready(function() {
            $('.summernote').summernote({

                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['link', ['linkDialogShow', 'unlink']],
                    ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Merriweather']
                ]
            });
        });

        $('input#price').on('input', function() {
            this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
        });


        $('#clear_image').click(function () {
            $.ajax({
                /* location to go*/
                url: "{{route('products.picture.delete')}}",
                method: "POST",
                dataType: 'json',
                /* Send all values from Users to controller to check*/
                data: {
                    '_token':"{{csrf_token()}}"
                },
                success: function (data) {
                    console.log(data);
                }
            });

            $('div.dz-success').remove();

            $('#clear_image').fadeOut();
        })

    </script>
@endsection