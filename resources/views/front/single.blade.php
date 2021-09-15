@extends('layouts.front')
@section('title')
    {{$singledog->type}}
@endsection
@section('content')
@if ($singledog->active == 1 || $singledog->user_id == $singledog->user_id)
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/css/star-rating.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.2/js/star-rating.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
<style>
.rating{
	direction: ltr;
    margin: 55px;
}
.rating-stars{
	direction: ltr;
}
.rating-disabled .glyphicon-minus-sign{
	display: none;
}
.rating-container .caption{
	margin-right: 5px;
}
.caption .label{
	display: none;
}
.adoption div a, .adoption div a img {
    width: 355px;
} 
</style>
<body class="contentpage">
		<!-- Services -->
		<div class="container">
			<div class="row">
				<div class="col-md-12 prev-next">
					<p>
						@if($previous != null)
						<a href="{{route('single',$previous)}}" title="" class="prev-page"><span class="glyphicon glyphicon-chevron-left"></span><span class="name">@if($previousName->purpose == 'مستلزمات') {{$previousName->address}} @else {{$previousName->strain}} @endif</span></a>
						@endif
						@if($next != null)
						<a href="{{route('single',$next)}}" title="" class="next-page"><span class="name">@if($nextName->purpose == 'مستلزمات'){{$nextName->address}} @else {{$nextName->strain}} @endif</span><span class="glyphicon glyphicon-chevron-right"></span></a>
						@endif
					</p>
				</div>
			</div>
			<div class="row adoption-single">
				<div class="col-md-6">
					<!-- Slider -->
					<div id="adoption" class="carousel slide" data-ride="carousel">
						<!-- Wrapper for slides -->
						<div class="carousel-inner">
				     		@foreach(json_decode($singledog->filename) as $index => $file)
							<div class="item @if($index == 0) active @endif">
								<img src="{{asset('assets/' . $file)}}" alt="" />
							</div>
							@endforeach
						</div>
						<!-- Indicators -->
						<ul class="carousel-indicators">
						@foreach(json_decode($singledog->filename) as $index => $file)
							<li data-target="#adoption" data-slide-to="{{$index}}"  @if($index == 0) class="active"  @endif><img src="{{asset('assets/' . $file)}}" alt="" /></li>
						@endforeach
						</ul>

					</div>
					<!-- Slider end -->
				</div>
				<div class="col-md-6">
				    @if($singledog->purpose == 'مستلزمات')
					<h2>{{$singledog->address}}</h2>
					<ol>
					<li><span>السعر</span>{{$singledog->price}}</li>
					@else
					<h2>{{$singledog->strain}}</h2>
					<p>{{$singledog->description}}</p>
					<ol>
						<li><span>النوع</span>{{$singledog->type}}</li>
						<li><span>الهدف</span>{{$singledog->purpose}}</li>
						<li><span>العنوان</span>{{$singledog->address}}</li>
						<li><span>اللون</span>{{$singledog->color}}</li>
						<li><span>السلالة</span>{{$singledog->strain}}</li>
						<li><span>نقاء السلالة</span>{{$singledog->n_strain}}</li>
						<li><span>علامة مميزة</span>{{$singledog->pecial_marque}}</li>
						<li><span>العمر</span>{{$singledog->currency}}</li>
						<li><span>السعر</span>{{$singledog->price}}</li>
						<li><span>رقم الرخصة</span>{{$singledog->license}}</li>
						<li><span>الجنس</span>{{$singledog->sex}}</li>
					@endif
						<li><span>الملاحظات</span>{{$singledog->notes}}</li>
						
					    	@if($singledog->user_id == 0) <li> <span style="width: 135px;">بيانات صاحب الأعلان</span> مسؤال الموقع </li> @endif
                            @foreach($users as $user)
                                @if($user->id == $singledog->user_id)
                                <li> <span style="width: 135px;">بيانات صاحب الأعلان</span>
                                    <p style="margin-bottom:0;">الأسم :- {{$user->name}}</p>
									<p style="margin-bottom:0;">رقم التليفون :- {{$user->phone}}</p>
								</li>
								@endif
                            @endforeach
						
						<li><span>عدد المشاهدات</span>{{$singledog->views}}</li>

							@if (!Auth::guest())							
							@if (!$wishlistForm)
							<form class="wishlist" id="wishlist">
								@csrf
								<input type="hidden" name="id" required value="{{ $singledog->id }}">
								<button type="button" class="btn-wishlist wishlistBtn"><i class="far fa-heart"></i></button>
							</form>
							<form class="removeWishlist" id='removeWishlist' style="display:none;">
								@csrf
								<input type="hidden" name="id" required value="{{ $singledog->id }}">
								<button type="button" class="btn-wishlist removeWishlistBtn"><i class="fas fa-heart"></i></button>
							</form>
							@elseif($wishlistForm)
							<form class="removeWishlist" id='removeWishlist'>
								@csrf
								<input type="hidden" name="id" required value="{{ $singledog->id }}">
								<button type="button" class="btn-wishlist removeWishlistBtn"><i class="fas fa-heart"></i></button>
							</form>
							<form class="wishlist" id="wishlist" style="display:none;">
								@csrf
								<input type="hidden" name="id" required value="{{ $singledog->id }}">
								<button type="button" class="btn-wishlist wishlistBtn"><i class="far fa-heart"></i></button>
							</form>
							@endif
							@endif
													
					</ol>
					
					<div class="col-md-6">
					@if (!Auth::guest())
					@if (!$ratingForm)
					<form id="rating" method="POST">
						@csrf
						<div class="rating">
							<input id="input-1" name="rate" class="rating rating-loading" data-min="0" data-max="5" data-step="1" data-size="xs">
							<input type="hidden" name="id" required value="{{ $singledog->id }}">
							<br/>
						    <button type="button" id="ratingBtn" class="btn btn-success">اختار النجوم وقم بوضع تقيمك</button>
						</div>
					</form>
					@elseif($ratingForm)
					  <h2 style="margin-top: 20px;">لفد قمت بترك تقيمك هنا</h2>
					@endif
					@endif
					</div>
					<div class="col-md-6">
					    <input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{ $singledog->averageRating }}" data-size="xs" disabled>
                        <h2> عدد المقيمين {{$singledog->usersRated()}}</h2>
					</div>
					<div class="social-share">
						<div class="addthis_inline_share_toolbox"></div>            
					</div>
				</div>
			</div>
		</div>
		<!-- Adoption -->
	   @if (Auth::guest())
	   <div class="col-md-12">
	   <p class="coment-login alert alert-success">برجاء تسجيل الدخول لأضافة تعليق</p>
		</div>
	   @endif
		<div class="col-md-12 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form id="postForm" method="POST">
					@csrf
                        <input type="hidden" name="id" required value="{{$singledog->id}}">
						<input type="hidden" name="typee" required value="dogs">
                        <textarea class="form-control" name="post" id="post" placeholder="تعليقك"></textarea>
                        <button type="button" id="postBtn" class="btn btn-primary" style="margin-top:5px;"> تعليق </button>
                    </form>
                </div>
            </div>
            <div id="postList"></div>
        </div>
        @isset($dogs)
		<div class="container">
			<div class="row">
			    @if(count($dogs))
				<div class="col-md-12 centered">
					<h3><span> ذات صلة</span></h3>
				</div>
				@endif
			</div>
			<div class="row adoption">
                @foreach($dogs as $dog)
				<div class="col-md-4">
			    	@foreach(json_decode($dog->filename) as $file)
					   @if ($loop->first)
					   <a href="{{route('single',$dog->id)}}" title="">
					    <img src="{{asset('assets/' . $file)}}" width="355px" alt="{{$dog->type}}" />  
					   </a>
					   @endif                         
					@endforeach
					<div class="title">
						<h5>
						@if($dog->purpose == 'مستلزمات')
						<span data-hover="{{$dog->address}}">{{$dog->address}}</span>
						@else
						<span data-hover="{{$dog->strain}}">{{$dog->strain}}</span>
						@endif  
						</h5>
					</div>
				</div>
				@endforeach
			</div>
		</div>
		<!-- Adoption end -->
        @endisset
        
		<!-- Go to www.addthis.com/dashboard to customize your tools -->
		<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5f3ba3afcf588dd6"></script>
        <script type="text/javascript">
           $("#input-id").rating();
        </script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
            showPost(); 
            $('#postBtn').click(function(){
                var post = $('#post').val();
                if(post==''){
                    alert('برجاء كتابة تعليقك اولا');
                    $('#post').focus();
                }
                else{
                    var postForm = $('#postForm').serialize();
					var form_data = new FormData(document.getElementById("postForm"));
                    $.ajax({
                        url: '{{route('post')}}',
						method:"POST",
						data:form_data,
						contentType: false,
						cache: false,
						processData: false,
						dataType:"json",
                        success: function(){
                            showPost();
                            $('#postForm')[0].reset();
                        },
						error: function(xhr, status, error) {
							if(error.error == undefined){
								window.location.href = '/login';   
							}
						}
                    });
                }
            });
 
            $(document).on('click', '.comment', function(){
                var id = $(this).val();
                if($('#commentField_'+id).is(':visible')){
                    $('#commentField_'+id).slideUp();
                }
                else{
                    $('#commentField_'+id).slideDown();
                    getComment(id);
                }
            });
 
            $(document).on('click', '.submitComment', function(){
                var id = $(this).val();
                if($('#commenttext').val()==''){
                    alert('Please write a Comment First!');
                }
                else{
                    var commentForm = $('#commentForm_'+id).serialize();
					var form_data_two = new FormData(document.getElementById('commentForm_'+id));
                    $.ajax({
                        url: '{{route('writecomment')}}',
                        method:"POST",
						data:form_data_two,
						contentType: false,
						cache: false,
						processData: false,
						dataType:"json",
                        success: function(){
                            getComment(id);
                            $('#commentForm_'+id)[0].reset();
                        },
						error: function(xhr, status, error) {
							if(error.error == undefined){
								window.location.href = '/login';   
							}
						}
                    });
                }
 
            });

            //Rating
			$('#ratingBtn').click(function(){
					var form_data = new FormData(document.getElementById("rating"));
                    $.ajax({
                        url: '{{route('single.rating')}}',
						method:"POST",
						data:form_data,
						contentType: false,
						cache: false,
						processData: false,
						dataType:"json",
                        success: function(){
                            alert('شكرا لقيامك بالتقيم');
							$('#rating').hide('slow');
                        },
						error: function(xhr, status, error) {
							if(error.error == undefined){
								window.location.href = '/login';   
							}
						}
                    });
            });

			//wishlist
			$('.wishlistBtn').click(function(){
					var form_data = new FormData(document.getElementById("wishlist"));
                    $.ajax({
                        url: '{{route('single.wishlist')}}',
						method:"POST",
						data:form_data,
						contentType: false,
						cache: false,
						processData: false,
						dataType:"json",
                        success: function(){
							$('.wishlist').hide('slow');
							$('.removeWishlist').css("display", "block");
                        },
						error: function(xhr, status, error) {
							if(error.error == undefined){
								window.location.href = '/login';   
							}
						}
                    });
            });

			$('.removeWishlistBtn').click(function(){
					var form_data = new FormData(document.getElementById("removeWishlist"));
                    $.ajax({
                        url: '{{route('single.deleteWishlist')}}',
						method:"POST",
						data:form_data,
						contentType: false,
						cache: false,
						processData: false,
						dataType:"json",
                        success: function(){
							$('.removeWishlist').hide('slow');
							$('.wishlist').css("display", "block");
                        },
						error: function(xhr, status, error) {
							if(error.error == undefined){
								window.location.href = '/login';   
							}
						}
                    });
            });
 
        });
        
        function showPost(){
            $.ajax({
                url: '{{route('show',[$singledog->id, 'dogs'])}}',
                success: function(data){
                    $('#postList').html(data); 
                },
            });
        }
 
        function getComment(id){
            $.ajax({
                url: '{{route('getcomment')}}',
                data: {id:id},
                success: function(data){
                    $('#comment_'+id).html(data); 
                }
            });
        }
    </script>
@else
<div class="alert alert-danger not-active-alert" role="alert">
    هذا العنصر غير مفعل
</div>
@endif
@endsection