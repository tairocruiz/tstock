@extends('layouts.admin')

@section('content')
    <div>
        <h3>All Tour Package Listing <button class="btn btn-warning pull-right" data-toggle="modal" data-target="#tourModal"><i class="fa fa-plus-circle mr-2"></i>Add new Tour</button></h3>
        <hr>
        <table class="table table-responsive">
            <tr>
                <th class="w-25">Safari Package Name</th>
                <th class="w-50">SEO Title</th>
                <th class="text-center w-5">Cat</th>
                <th class="text-center w-5">Days</th>
                <th class="text-center w-5">Feat</th>
                <th class="text-center w-5">Actions</th>
            </tr>
            @foreach ($tours as $tour)
                <tr>
                    <td>{{ $tour->name }}</td>
                    <td><span>{{ $tour->seo_title }}</span></td>
                    <td class="text-center">{{ $tour->pivot }}</td>
                    <td class="text-center">{{ $tour->days }}</td>
                    <td class="text-center">
                         {{-- <a href="#" @click.prevent="toggleFeatured(i)" title="Toggle Featured">
                            <span v-if="tour.featured"><i class="fa fa-lg fa-check text-success"></i></span>
                            <span v-else><i class="fa fa-check" style="color: #eee"></i></span>
                        </a> --}}
                    </td>
                    {{-- <td class="text-center">
                        <a href="#" @click.prevent="loadTour(i)" class="mr-2" :title="`Edit ${tour.name}`"><i class="fa fa-edit"></i></a>
                        <a href="#" @click.prevent="deleteTour(i)" :title="`Delete ${tour.name}`"><i class="fa fa-times text-danger"></i></a>
                    </td> --}}
                </tr>
            @endforeach
        </table>
                <!-- Modal -->
                @if (Route::as('des'))


                <div class="modal fade" id="tourModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-warning">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel"><strong>Add New Tour</strong></h4>
                            </div>
                            <div class="modal-body">
                                <form ref="tour_form" id="tour_form">
                                    <div class="row">
                                        <div class="form-group col-md-8">
                                            <label for="name">Tour Package Name</label>
                                            <input type="text" name="name" id="name"  class="form-control">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="days_count">Tour Days</label>
                                            <input type="number" name="days_count" id="days_count"  readonly class="form-control">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="price">Tour Price</label>
                                            <input type="number" name="price" id="price"  class="form-control">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
    </div>
@endsection
