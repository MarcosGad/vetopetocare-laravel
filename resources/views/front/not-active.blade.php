@extends('layouts.front')
@section('title','غير مفعل')
@section('content')
@if (!Auth::guest() && auth()->user()->active == 1)
<?php
  header('Location: /');
  exit;
?>
@else
<div class="main">
        <section>
            <div class="container">
                <div>
                <div class="alert alert-danger not-active-alert" role="alert">
                    انت مستخدم غير مفعل لن تستمتع بجميع مميزات الموقع --- انتظر التفعيل او تواصل معنا
                </div>
                </div>
        </section>
    </div>
@endif
@endsection
