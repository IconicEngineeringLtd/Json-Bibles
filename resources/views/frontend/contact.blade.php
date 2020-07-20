@extends('layouts.app')

@section('content')
  <!-- Common Header Background Start -->
  @php
    $headerInfo = "Contact";
  @endphp
  @include('layouts.headerBackground')
  <!-- Common Header Background End -->

  <!-- Container Start -->
  <div class="container my-5">
    <div class="row">

      <!-- Contact Informations -->
      <div class="col-md-5 contactInformations">
        <h2 class="mb-4">Office</h2>
        <h5 class="mb-4">Tools.com.bd</h5>
        <p class="mb-0"><strong>Mobile:</strong> +88 01631790043</p>
        <p class="mb-0"><strong>Email:</strong> info@tools.com.bd</p>
        <address class="mt-4">
          Bikrampur Tower, 137 Nawabpur, Dhaka-1100 Bangladesh
        </address>
      </div>

      <!-- Contact Form -->
      <div class="col-md-7 contactForm">
        @if (session('status'))
          <div class="alert alert-success" role="alert" id="alert">
            {{ session('status') }}
          </div>
        @endif
        <h2 class="mb-4">Write to Us</h2>
        <form action="{{route('contact_send_message')}}" method="post">
          @csrf
          <div class="form-group">
            <label for="name">Your Name (Required)</label>
            <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" value="{{ old('name') }}" placeholder="Ex: Adam" required autofocus>
            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
          </div>
          <div class="form-group">
            <label for="email">Email Address (Required)</label>
            <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" value="{{ old('email') }}" placeholder="Ex: adam@gmail.com" required>
            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>
          <div class="form-group">
            <label for="mobile">Mobile</label>
            <input type="text" class="form-control {{ $errors->has('mobile') ? ' is-invalid' : '' }}" id="mobile" name="mobile" value="{{ old('mobile') }}" placeholder="Ex: +880155XXXXXX" required>
            @if ($errors->has('mobile'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('mobile') }}</strong>
                </span>
            @endif
          </div>
          <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" class="form-control {{ $errors->has('subject') ? ' is-invalid' : '' }}" id="subject" name="subject" value="{{ old('subject') }}" placeholder="Insert your subject." required>
            @if ($errors->has('subject'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('subject') }}</strong>
                </span>
            @endif
          </div>
          <div class="form-group">
            <label for="content">Your Message</label>
            <textarea class="form-control {{ $errors->has('content') ? ' is-invalid' : '' }}" id="content" name="content" value="{{ old('content') }}" placeholder="Insert your content." required></textarea>
            @if ($errors->has('content'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('content') }}</strong>
                </span>
            @endif
          </div>
          <button type="submit" class="btn btn-pico-lg">Submit</button>
        </form>
      </div>
    </div>

    <!-- Google Map Integration -->
    <div class="googleMap">
      <h2 class="mapHeader">Get Direction</h2>
      <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6143.127944575547!2d90.40930606362987!3d23.721475724762797!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c11284b76cbd%3A0xe6674a21688603e4!2sTools%20Bangladesh!5e0!3m2!1sen!2sbd!4v1595221740876!5m2!1sen!2sbd" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
  </div>
@endsection
