@extends('layouts.front')
@section('title','اتصل بنا')
@section('content')
<div class="main">
<!-- Contact -->
		<div class="container">
			<div class="row">
				<div class="col-md-12 centered">
					<h3><span>اتصل بنا</span></h3>
					
				</div>
			</div>
		</div>
		<!-- Contact end -->
		<!-- Map -->
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3453.7080249542078!2d31.339021314811333!3d30.045233281882!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14583e8842b86d7d%3A0x1e452f7cb666c69c!2s8%20Ahmed%20El-Zomor%2C%20Al%20Manteqah%20Ath%20Thamenah%2C%20Nasr%20City%2C%20Cairo%20Governorate!5e0!3m2!1sen!2seg!4v1581172224480!5m2!1sen!2seg" width="1345" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
		<!-- Map end -->
		<!-- Content -->
		<div class="container content">
			<div class="row">
				<div class="col-md-9">

				{{Session::get('success')}}
				<form  role="form" action="{{ route('contact') }}" id="contact_form" method="POST">
						<div class="form-group">
							<label for="InputName">Your name</label>
							<input type="text" name="name" value="{{ old('name') }}" id="InputName" class="form-control" placeholder="الاسم">
						</div>

						<div class="form-group">
							<label for="InputEmail">Your email</label>
							<input type="text" name="email" value="{{ old('email') }}" class="form-control" id="InputEmail" placeholder="البريد الألكترونى">
							<div class="error">{{ $errors->first('email') }}</div>
						</div>

						<div class="form-group">
							<label for="InputMesaagel">Your messsage</label>
							<textarea name="message" class="form-control" id="Message" placeholder="رسالتك" rows="8">{{ old('message') }}</textarea>
							<div class="error">{{ $errors->first('message') }}</div>
						</div>
						@csrf
						<button type="submit" class="btn btn-default btn-green">أرسل رسالتك</button>
					</form>
				</div>
				<div class="col-md-3">
					<ul class="contact-info">
						<li class="telephone">
							0203 011 0448
						</li>
						<li class="address">
							123 High St, Essex, UK
						</li>
						<li class="mail">
							info@vetopetocare.com
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- Content end -->
</div>
@endsection