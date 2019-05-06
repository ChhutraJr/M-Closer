
<div class="container">

    <div class="head-top">
        <a href="{{url('/')}}"><img src="{{url('storage/icons/lv-furniture.png')}}" alt="" class="img hidden-xs" width="130px" style="margin-left: 115px;margin-bottom: -97px;float: left; position: absolute;z-index: 150;"></a>
        <a href="{{url('/')}}"><img src="{{url('storage/icons/lv-furniture.png')}}" alt="" class="img col-xs hidden-md hidden-sm hidden-lg hidden-xl" width="60px" style="margin-left: 68px;margin-bottom: -90px;float: left;position: relative;z-index: 101;"></a>

        <div class=" h_menu4">
            <ul class="memenu skyblue">
                <li><a class="color8 " href="{{url('/')}}">ទំព័រដើម</a></li>
                <li><a class="color1 " href="javascript:void(0)">ផលិតផល</a>

                    <!--Desktop-->
                    <div class="mepanel" style="width: 499px;">
                        <div class="row">

                            @if($products->count()<=10)
                                <div class="h_nav">
                                    <ul>
                                        @foreach($products as $pro)
                                            <li><a style="text-decoration: none" href="{{url('product/'.$pro->name)}}">{{$pro->name}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            @elseif($products->count()<=20)
                                <div class="col1">
                                    <div class="h_nav">
                                        <ul>
                                            @foreach($products as $pro)
                                                <li><a style="text-decoration: none" href="{{url('product/'.$pro->name)}}">{{$pro->name}}</a></li>
                                                @if($loop->iteration==10)
                                                    @break($pro)
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                <div class="col1">
                                    <div class="h_nav">
                                        <ul>
                                            @foreach($products as $pro)
                                                @if($loop->iteration>10&&$loop->iteration<21)
                                                <li><a style="text-decoration: none" href="{{url('product/'.$pro->name)}}">{{$pro->name}}</a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @else
                                <div class="col1">
                                    <div class="h_nav">
                                        <ul>
                                            @foreach($products as $pro)
                                                <li><a style="text-decoration: none" href="{{url('product/'.$pro->name)}}">{{$pro->name}}</a></li>
                                                @if($loop->iteration==10)
                                                    @break($pro)
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                <div class="col1">
                                    <div class="h_nav">
                                        <ul>
                                            @foreach($products as $pro)
                                                @if($loop->iteration>10&&$loop->iteration<21)
                                                    <li><a style="text-decoration: none" href="{{url('product/'.$pro->name)}}">{{$pro->name}}</a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                <div class="col1">
                                    <div class="h_nav">
                                        <ul>
                                            @foreach($products as $pro)
                                                @if($loop->iteration>20)
                                                    <li><a style="text-decoration: none" href="{{url('product/'.$pro->name)}}">{{$pro->name}}</a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif

                        </div>


                    </div>


                </li>

                <li class="grid"><a class="color2 " href="javascript:void(0)">ប្រភេទ</a>
                    <!--Desktop-->
                    <div class="mepanel col-xs-offset-0 col-md-offset-2">
                        <div class="row">
                                <div class="h_nav">
                                    <ul>
                                        @foreach($categories as $cat)
                                            <li><a style="text-decoration: none" href="{{url('category/'.$cat->slug)}}">{{$cat->name}}</a></li>
                                        @endforeach

                                    </ul>
                                </div>
                        </div>
                    </div>

                </li>
                <li><a class="color4 " href="{{url('contact')}}">ទំនាក់ទំនង</a></li>
                <li><a class="color6 " href="{{url('about_us')}}">អំពីយើង</a></li>
            </ul>
        </div>

        <div class="clearfix hd-line"> </div>
    </div>
</div>
</div>

