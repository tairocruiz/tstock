@extends('layouts.front')

@section('content')
    <div class="row header">
        <div class="header_top_overlay"></div>
        <div class="col-md-12 p-0 header_img_container">
            <img src="images/post_images/{{ $post->photo }}" class="img-responsive" alt="{{ $post->title }}">
        </div>
    </div>
    <div class="container main">
        <div class="row">
            <div class="col-md-12">
                <h1 class="ubuntucondensed">
                    {{ $title }}<br>
                    <small style="font-size: 1rem">
                        <i class="fa fa-calendar-o mr-1"></i>Posted {{ $post->created_at->diffForHumans() }},
                        to <span class="mr-2"><a href="/tourism/blog/{{ $category->slug }}"><i class="fa fa-folder-open-o primary-color mr-1 ml-2"></i>{{ $category->name }}</a></span> |
                        <a href="#comments"><i class="fa fa-comment-o primary-color ml-2 mr-1"></i>3 Comments</a>
                    </small>
                </h1>
                <hr>
            </div>
            <div class="col-md-8">
                <span class="text-justify">{!! $post->description !!}</span>

                {{--comments + commenting box shows below--}}
                <div id="comments" class="mt-3">
                    <div class="latest-comments">
                        <div class="panel panel-default">
                            <div class="panel-body p-1 ubuntucondensed text-muted">
                                <span>Comments on post of {{ $post->created_at->format('d M Y') }} to
                                <ul class="list-inline ml-1" style="display: inline-block">
                                    @foreach($post->categories as $category)
                                        <li><a href="/tourism/blog/{{ $category->slug }}"><i class="fa fa-folder-o primary-color mr-1"></i>{{ $category->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="panel-footer p-1">
                                <h5 class="ubuntucondensed">By <a href="#">Henry Kitkat</a> <span class="pull-right badge">24th Jul 2019</span></h5>
                                <p class="text-justify">My comment My comment My comment My comment My comment My comment My comment My comment My comment My comment My comment My comment My comment My comment My comment My comment My comment My comment My comment My comment</p>
                                <hr>
                                <h5 class="ubuntucondensed">By <a href="#">Andreas Kpojes</a> <span class="pull-right badge">04th Jan 2020</span></h5>
                                <p class="text-justify">My comment My comment My comment My comment My comment My comment My comment My comment My comment My comment My comment My comment My comment My comment My comment My comment My comment My comment My comment My comment</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-warning mt-3">
                        <div class="panel-heading ubuntucondensed">
                            Drop your comment here
                            <span class="pull-right primary-color">[ comments are moderated ]</span>
                        </div>
                        <div class="panel-body text-muted">
                            <form action="">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="name">Your Full Name</label>
                                    <input type="text" id="name" name="name" class="form-control">
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="email">Your Email Address</label>
                                        <input type="email" name="email" id="email" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="website">Your Website</label>
                                        <input type="text" id="website" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="message">Your comment</label>
                                    <textarea name="message" id="message" cols="30" rows="10"></textarea>
                                </div>
                                <button type="submit" class="btn btn-success"><i class="fa fa-send mr-1"></i>Submit</button>
                                <button type="reset" class="btn btn-default"><i class="fa fa-times mr-1"></i>Clear</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                @if($posts->count())
                    <div class="list-group">
                        @foreach($posts as $the_post)
                            <a href="/{{ $category->slug }}/{{ $the_post->slug }}" class="list-group-item">{{ $the_post->title }}</a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        @include('front.includes.footer')
    </div>
@endsection