@extends('userend.layouts.login-form-template')

@section('page-title')
    Forgot Password
@endsection

@section('content')
<div class="container">
  <input type="checkbox" id="flip">
  <div class="cover">
    <div class="front">
      <img src="{{ URL('images/holding-phone.jpg') }}" alt="">
      <div class="text">
        <span class="text-1">Every new friend is a <br> new adventure</span>
        <span class="text-2">Let's get connected</span>
      </div>
    </div>
    <div class="back">
      <img class="backImg" src="{{ URL('images/holding-phone.jpg') }}" alt="">
      <div class="text">
        <span class="text-1">Complete miles of journey <br> with one step</span>
        <span class="text-2">Let's get started</span>
      </div>
    </div>
  </div>
  <div class="forms">
      <div class="form-content">
        <div class="login-form">
          <div class="title">Forgot Password</div>
          <form action="{{ route('user-forgot-password') }}" method="POST" autocomplete="off">
          @csrf
          <div class="input-boxes">
            <div class="input-box">
              <i class="fas fa-envelope"></i>
              <input type="text" name="email" placeholder="Enter your email">
            </div>
            <div class="button input-box">
              <input type="submit" value="Sumbit">
            </div>
            <div>
              <span class="error-message">
                  @if(session('message'))
                      {{ session('message') }}
                  @endif
  
                  @if($errors->any())
                      @foreach ($errors->all() as $error)
                          {{ $error}} <br>
                      @endforeach                    
                  @endif
                  </span>
            </div>
          </div>
      </form>
    </div>
  </div>
  </div>
</div>
@endsection