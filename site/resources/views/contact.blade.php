
@extends('layouts.visitorsplayground')

@section('content')

<div class="col-md-8">
    <div class="main-card mb-3 card">
    {{-- // @include('partials.alert') --}}
        <div class="card-body"><h5 class="card-title">contact</h5>
            <form class="" method="post" action="{{route('contact')}}" enctype="multipart/form-data">
            @csrf
                                        
                <div class="position-relative form-group">
                    <label for="name" class="">name</label>
                    <input name="name" id="id_name" placeholder="name"  class="form-control" value="">
                </div>
                            
                <div class="position-relative form-group">
                    <label for="email" class="">email</label>
                    <input name="email" id="id_email" placeholder="email"  class="form-control" value="">
                </div>
                            
                <div class="position-relative form-group">
                    <label for="subject" class="">subject</label>
                    <input name="subject" id="id_subject" placeholder="subject"  class="form-control" value="">
                </div>

                <div class="position-relative form-group">
                    <label for="message" class="">message</label>
                    <input name="message" id="id_message" placeholder="message"  class="form-control" value="">
                </div>
    
                <button class="mt-1 btn btn-primary" type="submit">Submit</button>
            </form>
        </div>
    </div>
</div>

@endsection
