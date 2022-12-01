@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-3">@include('admin.includes.nav')</div>
        <div class="col-md-6">
            <h3 class="text-center">{{ $title }}</h3>
            <hr>
            <form action="{{ action('App\Http\Controllers\Safaris\PostController@update',$post->id) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Edit Blog Post Title</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $post->title }}" required>
                </div>
                <div class="form-group">
                    <label for="seo_title">Edit SEO Title</label> <small class="seo-title-character-counter pull-right"><span class="char-counter">65</span> characters remaining</small>
                    <input type="text" id="seo_title" name="seo_title" class="form-control" maxlength="80" value="{{ $post->seo_title }}">
                </div>
                <div class="form-group">
                    <label for="meta_description">Meta Description</label> <small class="meta-descr-character-counter pull-right"><span class="char-counter">160</span> characters remaining</small>
                    <textarea name="meta_description" id="meta_description" class="form-control" cols="30" rows="2" maxlength="175">{{ $post->meeta_description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="description">Post Description</label> <small class="description-character-counter pull-right"><span class="char-counter">0</span> characters total</small>
                    <textarea name="description" id="description" class="form-control textarea" cols="30" rows="10" required>{{ $post->description }}</textarea>
                </div>
                @if($post_categories->count())
                    @php $a = [] @endphp
                    <div class="form-group">
                        <div class="row">
                            @if($post->categories->count())
                                @foreach($post->categories as $this_post_category)
                                    <div class="col-md-4">
                                        <label>
                                            <input type="checkbox" name="existing_categories[]" id="existing_categories" value="{{ $this_post_category->id }}" checked>
                                            <span class="ml-2">{{ $this_post_category->name }}</span>
                                            @php array_push($a, $this_post_category->id) @endphp
                                        </label>
                                    </div>
                                @endforeach
                            @endif
                            @if($post_categories->count() > $post->categories->count())
                                @foreach($post_categories as $post_category)
                                    @if(in_array($post_category->id, $a))
                                        @continue
                                    @endif
                                    <div class="col-md-4">
                                        <label>
                                            <input type="checkbox" name="added_categories[]" id="added_categories" value="{{ $post_category->id }}">
                                            <span class="ml-2">{{ $post_category->name }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="photo">Upload Post Photo</label> <small class="text-muted">(1600 by  600px)</small>
                            <input type="file" id="photo" name="photo" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-7">
                        @method('PUT')
                        <div class="form-group pt-3">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-check mr-2"></i>Save Changes</button>
                            <a href="/admin/posts" class="btn btn-default"><i class="fa fa-times mr-2"></i>Cancel</a>
                            <a href="#" id="remove-post-button" class="btn btn-danger pull-right"><i class="fa fa-trash-o mr-2"></i>Remove</a>
                        </div>
                    </div>
                </div>
            </form>
            <form action="{{ action('App\Http\Controllers\Safaris\PostController@destroy',$post->id) }}" id="remove-post-form" method="POST">
                @csrf
                @method('DELETE')
            </form>
        </div>
        <div class="col-md-3">
            <h3 class="text-right">List of Added Posts</h3>
            <hr>
            <table class="table">
                @if($posts->count())
                    <tr>
                        <th>Name</th>
                        <th class="w-5 text-center">Action</th>
                    </tr>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->title }}</td>
                            <td class="w-5 text-center">
                                <a href="/admin/posts/{{ $post->id }}/edit" title="Edit {{ $post->title }} details"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <h4 class="text-danger">Sorry, No Posts added yet..!</h4>
                @endif
            </table>
        </div>
    </div>
@endsection
