@extends('layouts.front')
@section('title')
    {{$guide->name}}
@endsection
@section('content')
@if ($guide->active == 1 || $guide->user_id == $guide->user_id)
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
						<a href="{{route('singleGuide',[$previous, $typeGuide])}}" title="" class="prev-page"><span class="glyphicon glyphicon-chevron-left"></span><span class="name">{{$previousName->name}}</span></a>
						@endif
						@if($next != null)
						<a href="{{route('singleGuide',[$next, $typeGuide])}}" title="" class="next-page"><span class="name">{{$nextName->name}}</span><span class="glyphicon glyphicon-chevron-right"></span></a>
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
				     		@foreach(json_decode($guide->filename) as $index => $file)
							<div class="item @if($index == 0) active @endif">
								<img src="{{asset('assets/' . $file)}}" alt="" />
							</div>
							@endforeach
						</div>
						<!-- Indicators -->
						<ul class="carousel-indicators">
						@foreach(json_decode($guide->filename) as $index => $file)
							<li data-target="#adoption" data-slide-to="{{$index}}"  @if($index == 0) class="active"  @endif><img src="{{asset('assets/' . $file)}}" alt="" /></li>
						@endforeach
						</ul>

					</div>
					<!-- Slider end -->
				</div>
				<div class="col-md-6">
					<h2>{{$guide->name}}</h2>
					<p>{{$guide->address}}</p>
					<ol>
						<li><span>??????????????</span>{{$guide->address}}</li>
						<li><span>????????????????</span>{{$guide->phone}}</li>
						<li><span>????????????</span>{{$guide->offers_services}}</li>
						<li><span>?????? ???????????????? ????????????</span>{{$guide->landline_phone}}</li>
						<li><span>???? ???????? ?????????? ??????????????</span>{{$guide->yes_or_no}}</li>
						<li><span>?????? ?????????? ????????????</span>{{$guide->home_detection_rate}}</li>
						<li><span>?????? ?????????? ????????????</span>{{$guide->regular_check_up_price}}</li>
						<li><span>?????? ?????????????? ??????????????</span>{{$guide->doctor_name}}</li>
						<li><span>?????????? ??????????????</span>{{$guide->yes_or_no_two}}</li>
						<li><span>?????? ???????? ??????????????</span>{{$guide->price_of_the_delivery_service}}</li>
						<li><span>???????? ??????????</span>
						   @foreach($businessHours as $index => $businessHour)
						      <p style="margin-bottom:0">{{$businessHour->weekDay}} ???? {{$businessHour->start_time}} ?????? {{$businessHour->end_time}}</p>
                           @endforeach
						</li>
						
					    	@if($guide->user_id == 0) <li> <span style="width: 135px;">???????????? ???????? ??????????????</span> ?????????? ???????????? </li> @endif
                            @foreach($users as $user)
                                @if($user->id == $guide->user_id)
                                <li> <span style="width: 135px;">???????????? ???????? ??????????????</span>
                                    <p style="margin-bottom:0;">?????????? :- {{$user->name}}</p>
									<p style="margin-bottom:0;">?????? ???????????????? :- {{$user->phone}}</p>
									</li>
								@endif
                            @endforeach
						
						<li><span>?????? ??????????????????</span>{{$guide->views}}</li>
					</ol>
					@if($typeGuide == 2)
                    
                    @if (Auth::guest())
                    <div>
                       <button disabled style="margin-bottom: 15px;margin-right: 40px;" type="button" class="btn btn-success showModal"> ???????? ???????????? ???? ???????????? ????????????</button>
                    </div>
                    @endif
                    @if (!Auth::guest())
                    <div>
					   <button style="margin-bottom: 15px;margin-right: 40px;" type="button" class="btn btn-success showModal">???? ????????????</button>
					</div>
				    <div id="formModal" class="modal fade" role="dialog">
				     	<div class="modal-dialog">
					        <div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">???????? ???????????????? ???? ??????????</h4>
								</div>
								<div class="modal-body">
									<form id="sendSms" method="POST">
										@csrf
										<div class="sendSms">
											<input type="hidden" name="id" required value="{{ $guide->user_id }}"> 
											<input type="hidden" name="item_id" required value="{{$guide->id}}">
											<input type="hidden" name="phone" required value="{{ $guide->phone }}">
											<textarea class="form-control" id="mass" name="mass" rows="4" cols="50" required></textarea>
											<button type="button" class="btn btn-success btn-submit" style="margin-top:20px;">??????</button>
										</div>
									</form>
								</div>
						    </div>
						</div>
					</div>
					@endif
					@endif
					
                   <div class="col-md-6">
					@if (!Auth::guest())
					@if (!$ratingForm)
					<form id="rating" method="POST">
						@csrf
						<div class="rating">
							<input id="input-1" name="rate" class="rating rating-loading" data-min="0" data-max="5" data-step="1" data-size="xs">
							<input type="hidden" name="id" required value="{{ $guide->id }}">
							<br/>
						    <button type="button" id="ratingBtn" class="btn btn-success">?????????? ???????????? ?????? ???????? ??????????</button>
						</div>
					</form>
					@elseif($ratingForm)
					  <h2 style="margin-top: 20px;">?????? ?????? ???????? ?????????? ??????</h2>
					@endif
					@endif
					</div>
					<div class="col-md-6">
					    <input id="input-1" name="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="0.1" value="{{ $guide->averageRating }}" data-size="xs" disabled>
                        <h2> ?????? ???????????????? {{$guide->usersRated()}}</h2>
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
	   <p class="coment-login alert alert-success">?????????? ?????????? ???????????? ???????????? ??????????</p>
		</div>
	   @endif
		<div class="col-md-12 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form id="postForm" method="POST">
					@csrf
                        <input type="hidden" name="id" required value="{{$guide->id}}">
						<input type="hidden" name="typee" required value="guides">
                        <textarea class="form-control" name="post" id="post" placeholder="????????????"></textarea>
                        <button type="button" id="postBtn" class="btn btn-primary" style="margin-top:5px;"> ?????????? </button>
                    </form>
                </div>
            </div>
            <div id="postList"></div>
        </div>
        @isset($guides)
		<div class="container">
			<div class="row">
			    @if(count($guides))
				<div class="col-md-12 centered">
					<h3><span>?????????? ?????? ??????</span></h3>
				</div>
				@endif
			</div>
			<div class="row adoption">
                @foreach($guides as $guidee)
				<div class="col-md-4">
			    	@foreach(json_decode($guidee->filename) as $file)
					   @if ($loop->first)
					   <a href="{{route('singleGuide',[$guidee->id, $typeGuide])}}" title="">
					    <img src="{{asset('assets/' . $file)}}" alt="{{$guidee->name}}" />  
					   </a>
					   @endif                         
					@endforeach
					<div class="title">
						<h5>
							<span data-hover="{{$guidee->name}}">{{$guidee->name}}</span>
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
                    alert('?????????? ?????????? ?????????????? ?????????? ??????');
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
                    alert('?????????? ?????????? ?????????????? ?????????? ??????');
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
                        url: '{{route('singleGuide.ratingGuide')}}',
						method:"POST",
						data:form_data,
						contentType: false,
						cache: false,
						processData: false,
						dataType:"json",
                        success: function(){
                            alert('???????? ???????????? ??????????????');
							$('#rating').hide('slow');
                        },
						error: function(xhr, status, error) {
							if(error.error == undefined){
								window.location.href = '/login';   
							}
						}
                    });
            });

            //send sms or email 
			$(document).on('click', '.showModal', function(){
				$('#formModal').modal('show');
            });

			$(".btn-submit").click(function(e){
				if($('#mass').val()==''){
                    alert('?????????? ?????????? ???????????????? ???? ??????????');
                }
                else{
					e.preventDefault();
					$('.btn-submit').attr("disabled", "disabled");
					var form_data = new FormData(document.getElementById("sendSms"));
                    $.ajax({
                        url: '{{route('sendSms')}}',
						method:"POST",
						data:form_data,
						contentType: false,
						cache: false,
						processData: false,
						dataType:"json",
                        success: function(){
                            alert('???? ?????????? ?????????????? ?????? ?????????????? ??????????');
							$('#formModal').modal('hide');
							$('.showModal').hide('slow');
                        },
						error: function(xhr, status, error) {
							if(error.error == undefined){
								window.location.href = '/login';   
							}
						}
                    });
				}
                    
            });
 
        });
        
        function showPost(){
            $.ajax({
                url: '{{route('show',[$guide->id, 'guides'])}}',
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
    ?????? ???????????? ?????? ????????
</div>
@endif
@endsection