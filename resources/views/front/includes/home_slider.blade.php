
@if($tour_categories->count())
    @foreach($tour_categories as $tour_category)
        <div class="slide">
            <img src="/storage/tour_category_images/{{ $tour_category->photo }}" class="img-responsive" alt="{{ $tour_category->name }}">
            <div class="slide-details">
                <h1 class="bira mb-3">{{ $tour_category->name }}</h1>
                <p>
                    @if($tour_category->tours->count()) <span class="mr-3"><span class="badge">{{ $tour_category->tours->count() }}</span> Safari {{ $tour_category->tours->count() }}</span> @endif
                    <a href="/safaris/{{ $tour_category->slug }}" class="btn btn-slide-details ubuntucondensed">Read More <i class="fa fa-arrow-right ml-2"></i></a>
                </p>
            </div>
        </div>
    @endforeach
@endif