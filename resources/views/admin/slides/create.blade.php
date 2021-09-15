@extends('layouts.admin')

@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href=""> Slides </a>
                                </li>
                                <li class="breadcrumb-item active">add Slide
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> Add Slide </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                @include('admin.includes.alerts.success')
                                @include('admin.includes.alerts.errors')

        <div class="card-content collapse show">
                <div class="card-body">
                    <form class="form" action="{{ route('admin.slides.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                    <div class="form-body">
                    <h4 class="form-section"><i class="ft-home"></i> Slide </h4>

                            @error('filename')
                                <p style="color: red;margin: 15px;">{{ $message }}</p>
                            @enderror
                            <div class="form-group" >
                                <input id="filename" placeholder="ادخل الصورة" type="file" class="form-control form-input @error('filename') is-invalid @enderror" name="filename" value="{{ old('filename') }}" required autocomplete="filename" autofocus>
                            </div>
  

                            <div class="form-group">
                            <input id="headr" placeholder="العنوان" type="text" class="form-control form-input @error('headr') is-invalid @enderror" name="headr" value="{{ old('headr') }}" required autocomplete="headr" autofocus>
                            @error('headr')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>

                            <div class="form-group" >
                              <textarea id="paragraph" placeholder="النص" class="form-control form-input @error('paragraph') is-invalid @enderror" name="paragraph" autofocus>{{ old('paragraph') }}</textarea>
                              @error('paragraph')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                              @enderror
                            </div>

                            <div class="form-group">
                            <input id="button_name" placeholder="عنوان المفتاح" type="text" class="form-control form-input @error('button_name') is-invalid @enderror" name="button_name" value="{{ old('button_name') }}" autocomplete="button_name" autofocus>
                            @error('button_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>

                            <div class="form-group">
                            <input id="button_url" placeholder="رابط المفتاح" type="text" class="form-control form-input @error('button_name') is-invalid @enderror" name="button_url" value="{{ old('button_url') }}" autocomplete="button_url" autofocus>
                            @error('button_url')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>

                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> حفظ
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>
     


   
@endsection
      