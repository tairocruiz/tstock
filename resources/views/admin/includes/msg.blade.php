@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger" style="margin-top: 20px;">
            <i class="fa fa-lg fa-exclamation-circle mr-2"></i>{{$error}}
        </div>
    @endforeach
@endif

@if(session('message')))
    <div class="alert alert-success alert-dismissable" style="margin-top: 20px;">
        <i class="fa fa-lg fa-check-circle mr-2"></i>{{session('message')}}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger" style="margin-top: 20px;">
        <i class="fa fa-lg fa-times-circle mr-2"></i>{{session('error')}}
    </div>
@endif