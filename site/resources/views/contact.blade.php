
@extends('layouts.visitorsplayground')

@section('content')

<div class="col-md-6">

    <div class="" id="gettingstated" style="">
        <h3 id="titles" style="font-weight: 400;margin-bottom: 0px; font-size: 54px;"> <b> Get CRUD</b></h3>

        <p style="
        font-size: 14px;
        padding-top:0px;
        font-weight:300;
        padding-bottom:8px;">Makes laravel CRUD operations effortless.  </p>
        
    </div>

    <div class="main-card mb-3 card">
    {{-- // @include('partials.alert') --}}
        <div class="card-body pt-5 pl-4"><h2 class="">contact</h2>
            <p>Tell us what do you think and how can we improve it.</p>
            <form  method="POST" action="sendmail" >
            @csrf
                                        
                <div class="position-relative form-group">
                    <label for="name" class="mt-2">name</label>
                    <input name="name" id="id_name" placeholder="name"  class="form-control" value="">
                </div>
                            
                <div class="position-relative form-group">
                    <label for="email" class="mt-2">email</label>
                    <input name="email" id="id_email" placeholder="email"  class="form-control" value="">
                </div>
                            
                <div class="position-relative form-group">
                    <label for="subject" class="mt-2">subject</label>
                    <input name="subject" id="id_subject" placeholder="subject"  class="form-control" value="">
                </div>

                <div class="position-relative form-group">
                    <label for="message" class="mt-2">message</label>
                    <input name="message" id="id_message" placeholder="message"  class="form-control" value="">
                </div>
    
                <button class="mt-4 btn btn-primary" type="submit">Submit</button>
            </form>
        </div>
    </div>
</div>

@endsection
