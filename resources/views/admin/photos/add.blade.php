@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-3">@include('admin.includes.nav')</div>
        <div class="col-md-6">
            <h3 class="text-center">{{ $title }}</h3>
            <hr>
            <form action="{{ action('App\Http\Controllers\Safaris\PhotoController@store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Enter Photo Name</label>
                    <input type="text" id="name" name="name" class="form-control" maxlength="30" placeholder="Enter Page Name" required>
                </div>
                <div class="form-group">
                    <label for="description">Photo Description</label> <small class="description-character-counter pull-right"><span class="char-counter">0</span> characters total</small>
                    <textarea name="description" id="description" class="form-control textarea" maxlength="160" cols="30" rows="10"></textarea>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="photo">Upload Photo</label>
                            <input type="file" id="photo" name="photo" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group pt-3">
                            <button type="submit" class="btn btn-lg btn-primary"><i class="fa fa-check mr-2"></i>Add Photo</button>
                            <button type="reset" class="btn btn-default"><i class="fa fa-times mr-2"></i>Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-3">
            <h3 class="text-right">List of Added Photos</h3>
            <hr>
            <table class="table">
                @if($photos->count())
                    <tr>
                        <th>Name</th>
                        <th class="w-5 text-center">Action</th>
                    </tr>
                    @foreach($photos as $photo)
                        <tr>
                            <td>{{ $photo->name }}</td>
                            <td class="w-5 text-center">
                                <a href="/admin/photos/{{ $photo->id }}/edit" title="Edit {{ $photo->name }} details"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <h4 class="text-danger">Sorry, No Photos added yet..!</h4>
                @endif
            </table>
        </div>
    </div>
@endsection
