@extends('layouts.front')
@section('title','أضافة المستلزمات')
@section('content')
@if (!Auth::guest() && auth()->user()->active == 1)
<div class="main">
    <section>
        <div class="container">
            <div>
                <form method="post" action="{{url('addAccessories')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <h1 class="form-title centered">أضافة المستلزمات</h1>

                    <div class="col-md-6">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                        <div class="form-group">
                            <input id="address" placeholder="الاسم" type="text"
                                class="form-control form-input @error('address') is-invalid @enderror" name="address"
                                value="{{ old('address') }}" required autocomplete="address" autofocus>
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="price" placeholder="السعر" type="text"
                                class="form-control form-input @error('price') is-invalid @enderror" name="price"
                                value="{{ old('price') }}" required autocomplete="price" autofocus>
                            @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="input-group control-group increment">
                            <input type="file" name="filename[]" class="form-control">
                            <div class="input-group-btn">
                                <button class="btn btn-success btn-addRemove" type="button"><i
                                        class="glyphicon glyphicon-plus"></i></button>
                            </div>
                        </div>
                        <div class="clone hide">
                            <div class="control-group input-group" style="margin-top:10px">
                                <input type="file" name="filename[]" class="form-control">
                                <div class="input-group-btn">
                                    <button class="btn btn-danger btn-addRemove" type="button"><i
                                            class="glyphicon glyphicon-remove"></i></button>
                                </div>
                            </div>
                        </div>

                        @if ($errors->has('filename'))
                        <span class="invalid-feedback" style="display: block;" role="alert">
                            <strong>{{ $errors->first('filename') }}</strong>
                        </span>
                        @endif

                        @if ($errors->has('filename.*'))
                        <!--in case if we have multiple file-->
                        <span class="invalid-feedback" style="display: block;" role="alert">
                            <strong>نوع الملف يجب ان يكون jpeg,png,jpg,gif,svg</strong>
                        </span>
                        @endif

                        <div class="form-group" style="margin-top:15px;">
                            <textarea id="notes" placeholder="ملاحظات"
                                class="form-control form-input @error('notes') is-invalid @enderror"
                                name="notes" autofocus>{{ old('notes') }}</textarea>
                            @error('notes')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="submit" name="submit" id="submit" class="btn btn-primary" value="حفظ" />
                            </div>                      
                    </div>
                </form>
            </div>
    </section>

</div>

<!-- JS -->
<script src="{{asset('assets/front/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/front/js/main-login.js')}}"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $(".btn-success").click(function() {
        var html = $(".clone").html();
        $(".increment").after(html);
    });
    $("body").on("click", ".btn-danger", function() {
        $(this).parents(".control-group").remove();
    });

});
</script>
@else
<div class="alert alert-danger not-active-alert" role="alert">
    انت مستخدم غير مفعل لن تستمتع بجميع مميزات الموقع --- انتظر التفعيل او تواصل معنا
</div>
@endif
@endsection