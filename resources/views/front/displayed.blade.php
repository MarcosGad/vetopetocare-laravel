@extends('layouts.front')
@section('title','المعروضات')
@section('content')
@if (!Auth::guest() && auth()->user()->active == 1)
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
   .nav-pill-main-div {
    position: initial;
    border-radius: 20px;
    box-shadow: inset -1px -7px 28px 3px rgba(1, 1, 1, 0.11);
    margin: 50px;
    width: 90%;
    }
    ul.tabs{
		margin: 0px;
		padding: 0px;
		list-style: none;
	}
	 ul.tabs li{
		background: none;
		color: #222;
		display: inline-block;
		padding: 10px 15px;
		cursor: pointer;
		transition: 0.3s ease all;
        width: 33%;
	}
	ul.tabs li.current{
		color: #222;
		transition: 0.3s ease all;
	}
	ul.tabs li.current span{
		color: #1AA8E2;
		transition: 0.3s ease all;
	}
	.tab-content{
		display: none;
		padding: 15px;
		transition: 0.3s ease all;
	}
	.tab-content.current{
		display: inherit;
		transition: 0.3s ease all;
        overflow: scroll;
        height: 480px;
	}
	.nav-justified > li { 
		float: none; 
	}
	.nav-justified > li span { 
		width: 100%; 
	}
	.customize_solution .nav-justified > li {
    	float: none;
	}
	.customize_solution span.ease-effect { 
		text-decoration: none; 
		-webkit-transition: 0.3s all ease; 
		transition: 0.3s ease all; 
	}
	.customize_solution span.ease-effect:hover, .customize_solution span.ease-effect:focus,.customize_solution ul.tabs li.current span:hover,.customize_solution ul.tabs li.current span:focus { 
		color: #FFF; 
		transition: 0.3s ease all; 
	}
	.customize_solution span.ease-effect { 
		letter-spacing: 2px; 
		text-transform: uppercase; 
		display: inline-block; 
		text-align: center; 
		font-weight: bold; 
		padding: 14px 0px; 
		border-top-right-radius: 2px; 
		border-top-left-radius: 2px; 
		position: relative; 
		box-shadow: 0 2px 10px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.1); 
	}
	.customize_solution .ease-effect:before { 
		-webkit-transition: 0.5s all ease; 
		transition: 0.5s all ease; 
		position: absolute; 
		top: 0; left: 50%; 
		right: 50%; 
		bottom: 0; 
		opacity: 0; 
		content: ''; 
		background-color: #1AA8E2; 
		z-index: -2; 
	}
	.customize_solution .ease-effect:hover:before, .customize_solution .ease-effect:focus:before { 
		-webkit-transition: 0.5s all ease; 
		transition: 0.5s all ease; 
		left: 0; 
		right: 0; 
		opacity: 1; 
	}

.finbyz-icon {
    height: 100px;
    width: 100px;
}
.fa-trash{
    float: left;
    font-size: 22px;
}
@media (min-width: 1200px){
.purchase{
    margin-top:48%;
 }
}
</style>
   

<div class="container">
    <h2 align="center"><a href="https://finbyz.tech" target= "_blank"><u></u></a></h2>        
</div> 

<div class="col-lg-8 col-xl-8 col-12 nav-pill-main-div mx-auto">
                <div class="customize_solution pt-3">
                    <ul class="tabs nav nav-justified">
                        <li class="tab-link current nav-pill mt-2" href="tab-1">
                            <span class="ease-effect">المنتظر</span> </li>
                        <li class="tab-link nav-pill mt-2" href="tab-2">
                            <span class="ease-effect">المقبول</span>
                        </li>
                        <li class="tab-link nav-pill mt-2" href="tab-3">
                            <span class="ease-effect">المرفوض</span>
                        </li>
                    </ul>
                    <div class="tab-content current" id="tab-1">
                        <div class="float-left pr-3 pt-3">

                        </div>
                        <p class="pb-20">
                        @if(!$guideWaits->isEmpty())
                        <h2>الحيوانات والمستلزمات</h2>
                        @endif
                        @isset($waits)
                            @foreach($waits as $wait)
                            <div class="alert alert-warning" role="alert">
                                   <p> @if($wait->purpose == 'مستلزمات') الأسم :  <a href="{{route('single',$wait->id)}}"> {{$wait->address}} </a> @else السلالة :  <a href="{{route('single',$wait->id)}}"> {{$wait->strain}} </a>  @endif
                                      <a href="{{route('displayed.delete',$wait->id)}}" onclick="return confirm('هل انت متاكد')">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                      </a>
                                   </p>
                                   
                            </div>
                            @endforeach
                        @endisset

                        @if(!$guideWaits->isEmpty())
                        <h2>الدلائل</h2>
                        @endif
                        @isset($guideWaits)
                            @foreach($guideWaits as $wait)
                            <div class="alert alert-warning" role="alert">
                                   <p> الأسم :  <a href="{{route('singleGuide',[$wait->id, $wait->type])}}"> {{$wait->name}} </a>
                                      <a href="{{route('destroyDisplayedGuide.delete',$wait->id)}}" onclick="return confirm('هل انت متاكد')">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                      </a>
                                   </p>
                            </div>
                            @endforeach
                        @endisset

                        @if(!$RequestsUserWaits->isEmpty())
                        <h2>طلبات الأنضمام</h2>
                        @endif
                        @isset($RequestsUserWaits)
                            @foreach($RequestsUserWaits as $RequestsUserWait)
                            <div class="alert alert-warning" role="alert">
                                   <p>  طلب الأنضمام لتحويل الى مستخدم :   @if($RequestsUserWait->type == 2) عيادة @endif
                                                                     @if($RequestsUserWait->type == 3) صيدلية @endif
                                                                     @if($RequestsUserWait->type == 4) محل تجارى @endif
                                                                     @if($RequestsUserWait->type == 5) شركة @endif
                                                                     @if($RequestsUserWait->type == 6) مدرسة @endif
                                      <a href="{{route('destroyDisplayedUserR.delete',$RequestsUserWait->id)}}" onclick="return confirm('هل انت متاكد')">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                      </a>
                                   </p>
                            </div>
                            @endforeach
                        @endisset
                        </p>
                    </div>
                    <div class="tab-content" id="tab-2">
                        <div class="float-left pr-3 pt-3">
                            
                        </div>
                        <p class="pb-20">
                        @if(!$guideAccepteds->isEmpty())
                        <h2>الحيوانات والمستلزمات</h2>
                        @endif
                        @isset($accepteds)
                            @foreach($accepteds as $accepted)
                            <div class="alert alert-success" role="alert">
                                   <p> @if($accepted->purpose == 'مستلزمات') الأسم :  <a href="{{route('single',$accepted->id)}}"> {{$accepted->address}} </a> @else السلالة : <a href="{{route('single',$accepted->id)}}"> {{$accepted->strain}} </a> @endif 
                                      <a href="{{route('displayed.delete',$accepted->id)}}" onclick="return confirm('هل انت متاكد')">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                      </a>
                                   </p>
                            </div>
                            @endforeach
                        @endisset

                        @if(!$guideAccepteds->isEmpty())
                        <h2>الدلائل</h2>
                        @endif
                        @isset($guideAccepteds)
                            @foreach($guideAccepteds as $accepted)
                            <div class="alert alert-warning" role="alert">
                                   <p> الأسم :  <a href="{{route('singleGuide',[$accepted->id, $accepted->type])}}"> {{$accepted->name}} </a>
                                      <a href="{{route('destroyDisplayedGuide.delete',$accepted->id)}}" onclick="return confirm('هل انت متاكد')">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                      </a>
                                   </p>
                                   
                            </div>
                            @endforeach
                        @endisset
                        </p>
                    </div>
                    <div class="tab-content" id="tab-3">
                        <div class="float-left pr-3 pt-3">

                        </div>
                        <p class="pb-20">
                        @isset($refusals)
                            @foreach($refusals as $refusal)
                            <div class="alert alert-danger" role="alert">
                                   <p> تم رفض طلب <span style="color: #000;font-weight: bold;">{{$refusal->one}}</span>
                                       بسبب : {{$refusal->details}} 
                                      <a href="{{route('destroyDisplayedRefusal.delete',$refusal->id)}}" onclick="return confirm('هل انت متاكد')">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                      </a>
                                   </p>
                            </div>
                            @endforeach
                        @endisset
                        </p>
                    </div>
                </div>
            </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
  $('ul.tabs li').click(function () {
        var tab_id = $(this).attr('href');

        $('ul.tabs li').removeClass('current');
        $('.tab-content').removeClass('current');

        $(this).addClass('current');
        $("#" + tab_id).addClass('current');
    })
</script>
@else
<div class="alert alert-danger not-active-alert" role="alert">
    انت مستخدم غير مفعل لن تستمتع بجميع مميزات الموقع --- انتظر التفعيل او تواصل معنا
</div>
@endif
@endsection