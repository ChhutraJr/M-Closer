@extends('master')
@section('content')
    <div class="container">

        <div class="cont hidden-xs" style="margin-bottom: 1px;min-height: 40em">
            <div class="content" style="padding: 3em;padding-top: 1px;" >
            <div class="banner">

                <script src="{{url('js/responsiveslides.min.js')}}"></script>
                <script>
                    $(function () {
                        $("#slider").responsiveSlides({
                            auto: true,
                            nav: true,
                            speed: 500,
                            namespace: "callbacks",
                            pager: true
                        });

                    });
                </script>
                <div  id="top" class="callbacks_container">
                    <ul class="rslides " id="slider" >
                        @foreach($slides as $sl)
                            <li>
                                <img src="{{url('storage/'.$sl->image)}}" alt="{{$sl->name}}" width="100%" height="100%">

                            </li>
                        @endforeach

                    </ul>


                </div>


            </div>
            </div>
            </div>

        <!--Mobile-->
        <div class="cont hidden-sm hidden-md hidden-lg" style="margin-bottom: 1px;min-height: 18em">
            <div class="content" style="padding: 3em;padding-top: 1px" >
                <div class="banner">

                    <script src="{{url('js/responsiveslides.min.js')}}"></script>
                    <script>
                        $(function () {
                            $("#slider2").responsiveSlides({
                                auto: true,
                                nav: true,
                                speed: 500,
                                namespace: "callbacks",
                                pager: true
                            });

                        });
                    </script>
                    <div  id="top" class="callbacks_container">
                        <ul class="rslides " id="slider2" >
                            @foreach($slides as $sl)
                                <li>
                                    <img src="{{url('storage/'.$sl->image)}}" alt="{{$sl->name}}" width="100%" height="100%">

                                </li>
                            @endforeach

                        </ul>


                    </div>


                </div>
            </div>
        </div>

    </div>
    <!--content-->
    <div class="container">
        <div class="cont">
            <div class="content" style="z-index: 100" >


                <div class="content-top-bottom" style="margin-top: 10px">
                    <h2>Featured PRODUCTS</h2>
                    @php
                          $n=0;
                    @endphp
                    <div class="col-md-6 men">
                        @foreach($features as $fe1)
                        <a href="{{url('product/'.$fe1->name)}}" class="b-link-stripe b-animate-go  thickbox"><img class="" width="100%" height="100%" src="{{url('storage/'.$fe1->pictures->first()->name)}}" alt="{{$fe1->name}}">
                            <div class="b-wrapper">
                                <h3 class="b-animate b-from-top top-in   b-delay03 ">
                                    <span>{{$fe1->name}}</span>
                                </h3>
                            </div>
                        </a>
                            @break($fe1)
                        @endforeach


                    </div>
                    <div class="col-md-6">
                        <div class="col-md1 ">

                            @foreach($features as $fe2)
                                @php
                                    $n++;
                                @endphp

                            @if($n>1)
                                <a href="{{url('product/'.$fe2->name)}}" class="b-link-stripe b-animate-go  thickbox"><img class="" width="100%" height="240" src="{{url('storage/'.$fe2->pictures->first()->name)}}" alt="{{$fe2->name}}">
                                    <div class="b-wrapper">
                                        <h3 class="b-animate b-from-top top-in1   b-delay03 ">
                                            <span>{{$fe2->name}}</span>
                                        </h3>
                                    </div>
                                </a>
                                    @php
                                        $n=0;
                                    @endphp
                                @break($fe2)
                            @endif
                            @endforeach

                        </div>
                        <div class="col-md2">
                            <div class="col-md-6 men1">
                                @foreach($features as $fe3)
                                    @php
                                        $n++;
                                    @endphp
                                     @if($n>2)
                                        <a href="{{url('product/'.$fe3->name)}}" class="b-link-stripe b-animate-go  thickbox"><img class="" width="100%" height="100%" src="{{url('storage/'.$fe3->pictures->first()->name)}}" alt="{{$fe3->name}}">
                                            <div class="b-wrapper">
                                                <h3 class="b-animate b-from-top top-in2   b-delay03 ">
                                                    <span>{{$fe3->name}}</span>
                                                </h3>
                                            </div>
                                        </a>
                                        @php
                                            $n=0;
                                        @endphp
                                         @break($fe3)
                                     @endif
                                @endforeach

                            </div>
                            <div class="col-md-6 men2">
                                @foreach($features as $fe4)
                                    @php
                                        $n++;
                                    @endphp
                                    @if($n>3)
                                        <a href="{{url('product/'.$fe4->name)}}" class="b-link-stripe b-animate-go  thickbox"><img class="" width="100%" height="100%"   src="{{url('storage/'.$fe4->pictures->first()->name)}}" alt="{{$fe3->name}}">
                                            <div class="b-wrapper">
                                                <h3 class="b-animate b-from-top top-in2   b-delay03 ">
                                                    <span>{{$fe3->name}}</span>
                                                </h3>
                                            </div>
                                        </a>
                                        @php
                                            $n=0;
                                        @endphp
                                        @break($fe4)
                                    @endif

                                 @endforeach

                            </div>
                            <div class="clearfix"> </div>
                        </div>
                    </div>
                    <div class="clearfix"> </div>
                </div>

                <div class="content-top">
                    <h1>NEW PRODUCTS</h1>
                    <div class="grid-in">

                        @foreach($latest_pro as $l)
                        <div class="col-md-3 grid-top simpleCart_shelfItem">
                            <a href="{{url('product/'.$l->name)}}" class="b-link-stripe b-animate-go  thickbox"><img class="img-responsive" src="{{url('storage/'.$l->pictures->first()->name)}}" alt="">
                                <div class="b-wrapper">
                                    <h3 class="b-animate b-from-left b-delay03 ">
                                        <span>{{$l->name}}</span>

                                    </h3>
                                </div>
                            </a>


                            <p><a href="{{url('product/'.$l->name)}}">{{$l->name}}</a></p>
                            <a href="{{url('product/'.$l->name)}}" class="item_add"><p class="number item_price"><i> </i>${{ number_format($l->price, 2) }}</p></a>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
            <!----->
        </div>
        <!---->
    </div>

    <div class="row" style="margin-top: 90px">
    </div>
@endsection