@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-3">@include('admin.includes.nav')</div>
        <div class="col-md-9">
            <h3 class="text-center">
                {{ $title }}
                {{-- <button class="btn btn-warning pull-right" data-toggle="modal" data-target="#tourModal"><i class="fa fa-plus-circle mr-2"></i>Add new Tour</button> --}}
                <a href="{{ route('admin.tours.create') }}" class="btn btn-success pull-right">Add New Tour</a>
            </h3>
            <hr/>
            @if($tours->count())
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
                        <td class="text-center">{{ $tour->tour_category->count() }}</td>
                        <td class="text-center">{{ $tour->days }}</td>
                        <td class="text-center">
                            {{-- <a href="#" @click.prevent="toggleFeatured(i)" title="Toggle Featured">
                                <span v-if="tour.featured"><i class="fa fa-lg fa-check text-success"></i></span>
                                <span v-else><i class="fa fa-check" style="color: #eee"></i></span>
                            </a> --}}
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.tours.edit', $tour->id)}}" class="mr-2" title="{{ ('Edit '.$tour->name) }}"><i class="fa fa-edit"></i></a>
                            <form id="coin" method="POST" action="{{ route('admin.tours.destroy', $tour->id) }}">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('admin.tours.destroy', $tour->id)}}" onclick="window.confirm('Are you sure you want to delete this tour {{ __($tour->id) }}.')" title="{{ ('Delete'.$tour->name) }}"><i class="fa fa-times text-danger"></i></a>
                            </form>
                        </td>
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
                            {{-- <div class="modal-body">
                                <form ref="tour_form" action="{{ route('admin.tours.store') }}" id="tour_form">
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
                            </div> --}}
                            <div class="modal-body">
                                <form id="tour_form" action="{{ route('admin.tours.store') }}">
                                    <div class="row">
                                        <div class="form-group col-md-8">
                                            <label for="name">Tour Package Name</label>
                                            <input type="text" name="name" id="name" class="form-control">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="days_count">Tour Days</label>
                                            <input type="number" name="days_count" id="days_count" class="form-control">
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="price">Tour Price</label>
                                            <input type="number" name="price" id="price" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-8">
                                            <label for="seo_title">SEO Title</label>
                                            <small>(optional)</small>
                                            <!---->
                                            <input type="text" name="seo_title" maxlength="70" id="seo_title" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="map">Upload Tour Map</label>
                                            <input type="file" name="map" id="map" class="form-control">
                                        </div> <div class="form-group col-md-12">
                                            <label for="meta_description">Meta Description</label>
                                            <small>(optional)</small>
                                            <!---->
                                            <textarea name="meta_description" id="meta_description" maxlength="160" cols="30" rows="2" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="overview">Tour Overview</label>
                                        <textarea name="overview" id="overview" cols="30" rows="2" class="form-control"></textarea>
                                    </div>
                                    <div class="row mb-3">
                                        <div>
                                           @foreach ($tour_categories as $category)
                                                <div class="col-sm-4 col-md-6 col-lg-4">
                                                    <label>
                                                        <input type="checkbox" name="categories[]" value="{{ $category->id }}">
                                                        {{ $category->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        @foreach ($tour->tour_days as $day)
                                        <div class="bg-info mt-3 p-2">
                                            <div class="row">
                                                <div class="form-group col-md-2">
                                                    <label for="day_order">Day {{$day->day_order}} Order</label>
                                                    <input type="number" name="day_order" id="day_order" class="form-control">
                                                </div>
                                                <div class="form-group col-md-10">
                                                    <label for="day_title">Day {{$day->day_order}} Title</label>
                                                    <input type="text" id="day_title" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="day_description">Day {{ $tour->name }} Activities Description</label>
                                                <textarea class="ckeditor" name="editor1" id="editor1" rows="10" cols="80"> </textarea>
                                            </div>
                                             <div class="row">
                                                <div>
                                                    <div class="form-group col-md-6">
                                                        <label for="day_photo1">Day 1 first Photo</label>
                                                        <span>(800px by 500px)</span>
                                                        <input type="file" name="day_photo1" id="day_photo1" class="form-control">
                                                    </div>
                                                </div>
                                              {{--  <div>
                                                    <div class="form-group col-md-6">
                                                        <label for="day_photo2">Day 1 second Photo</label>
                                                        <span>(800px by 500px)</span>
                                                        <input type="file" name="day_photo2" id="day_photo2" class="form-control"></div>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <button class="btn btn-primary">
                                                    Add Day below
                                                </button>
                                                <button class="btn btn-danger pull-right">
                                                    Remove Day 1
                                                </button>--}}
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    {{-- <div class="row">
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="photo">Upload Tour Photo</label>
                                            <input type="file" name="photo" id="photo" class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="best_time">Best time for this Tour</label>
                                            <input type="text" name="best_time" id="best_time" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="useful_information">Useful Safari Information</label>
                                        <small class="text-muted">(Sightseeing Highlights, Dining Experience, Travel
                                            Highlights, Includes &amp; Excludes)
                                        </small>
                                        <div id="useful_information" style="display: none;"></div>
                                        <div class="ck ck-reset ck-editor ck-rounded-corners" role="application" dir="ltr" aria-labelledby="ck-editor__label_e217c760a6bc6bd0099c560e5113a2823" lang="en">
                                            <label class="ck ck-label ck-voice-label" id="ck-editor__label_e217c760a6bc6bd0099c560e5113a2823">Rich Text Editor</label>
                                            <div class="ck ck-editor__top ck-reset_all" role="presentation">
                                                <div class="ck ck-sticky-panel">
                                                    <div class="ck ck-sticky-panel__placeholder" style="display: none;"></div>
                                                    <div class="ck ck-sticky-panel__content">
                                                        <div class="ck ck-toolbar ck-toolbar_grouping" role="toolbar" aria-label="Editor toolbar">
                                                            <div class="ck ck-toolbar__items">
                                                                <div class="ck ck-dropdown ck-heading-dropdown">
                                                                    <button class="ck ck-button ck-off ck-button_with-text ck-dropdown__button" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_ea6d670e63b40f86414bb90f478bc519e" aria-haspopup="true">
                                                                        <span class="ck ck-tooltip ck-tooltip_s">
                                                                            <span class="ck ck-tooltip__text">Heading</span>
                                                                        </span>
                                                                        <span class="ck ck-button__label" id="ck-editor__aria-label_ea6d670e63b40f86414bb90f478bc519e">Paragraph</span>
                                                                        <svg class="ck ck-icon ck-dropdown__arrow" viewBox="0 0 10 10">
                                                                            <path d="M.941 4.523a.75.75 0 1 1 1.06-1.06l3.006 3.005 3.005-3.005a.75.75 0 1 1 1.06 1.06l-3.549 3.55a.75.75 0 0 1-1.168-.136L.941 4.523z"></path>
                                                                        </svg>
                                                                    </button>
                                                                    <div class="ck ck-reset ck-dropdown__panel ck-dropdown__panel_se">
                                                                        <ul class="ck ck-reset ck-list">
                                                                            <li class="ck ck-list__item">
                                                                                <button class="ck ck-button ck-heading_paragraph ck-on ck-button_with-text" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_e39accf640f361beb572b5e72d289815d">
                                                                                    <span class="ck ck-tooltip ck-tooltip_s ck-hidden">
                                                                                        <span class="ck ck-tooltip__text"></span>
                                                                                    </span>
                                                                                    <span class="ck ck-button__label" id="ck-editor__aria-label_e39accf640f361beb572b5e72d289815d">Paragraph</span>
                                                                                </button>
                                                                            </li>
                                                                            <li class="ck ck-list__item">
                                                                                <button class="ck ck-button ck-heading_heading1 ck-off ck-button_with-text" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_e6d5d45f8525b1e2b415f9a68765a91ea">
                                                                                    <span class="ck ck-tooltip ck-tooltip_s ck-hidden">
                                                                                        <span class="ck ck-tooltip__text"></span>
                                                                                    </span>
                                                                                    <span class="ck ck-button__label" id="ck-editor__aria-label_e6d5d45f8525b1e2b415f9a68765a91ea">Heading 1</span>
                                                                                </button>
                                                                            </li>
                                                                            <li class="ck ck-list__item">
                                                                                <button class="ck ck-button ck-heading_heading2 ck-off ck-button_with-text" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_ea8b39d3a698567f403d7ab0d03a4ef8a">
                                                                                    <span class="ck ck-tooltip ck-tooltip_s ck-hidden">
                                                                                        <span class="ck ck-tooltip__text">
                                                                                            </span>
                                                                                        </span>
                                                                                        <span class="ck ck-button__label" id="ck-editor__aria-label_ea8b39d3a698567f403d7ab0d03a4ef8a">Heading 2</span>
                                                                                </button>
                                                                            </li>
                                                                            <li class="ck ck-list__item">
                                                                                <button class="ck ck-button ck-heading_heading3 ck-off ck-button_with-text" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_ecede40c20e48e5672a355bed17747c9f">
                                                                                    <span class="ck ck-tooltip ck-tooltip_s ck-hidden">
                                                                                        <span class="ck ck-tooltip__text"></span>
                                                                                    </span>
                                                                                    <span class="ck ck-button__label" id="ck-editor__aria-label_ecede40c20e48e5672a355bed17747c9f">Heading 3</span>
                                                                                </button>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <span class="ck ck-toolbar__separator"></span>
                                                                <button class="ck ck-button ck-off" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_e3961670afa24717024de45c8a045e1d7" aria-pressed="false">
                                                                    <svg class="ck ck-icon ck-button__icon" viewBox="0 0 20 20">
                                                                        <path d="M10.187 17H5.773c-.637 0-1.092-.138-1.364-.415-.273-.277-.409-.718-.409-1.323V4.738c0-.617.14-1.062.419-1.332.279-.27.73-.406 1.354-.406h4.68c.69 0 1.288.041 1.793.124.506.083.96.242 1.36.478.341.197.644.447.906.75a3.262 3.262 0 0 1 .808 2.162c0 1.401-.722 2.426-2.167 3.075C15.05 10.175 16 11.315 16 13.01a3.756 3.756 0 0 1-2.296 3.504 6.1 6.1 0 0 1-1.517.377c-.571.073-1.238.11-2 .11zm-.217-6.217H7v4.087h3.069c1.977 0 2.965-.69 2.965-2.072 0-.707-.256-1.22-.768-1.537-.512-.319-1.277-.478-2.296-.478zM7 5.13v3.619h2.606c.729 0 1.292-.067 1.69-.2a1.6 1.6 0 0 0 .91-.765c.165-.267.247-.566.247-.897 0-.707-.26-1.176-.778-1.409-.519-.232-1.31-.348-2.375-.348H7z"></path>
                                                                    </svg>
                                                                    <span class="ck ck-tooltip ck-tooltip_s">
                                                                        <span class="ck ck-tooltip__text">Bold (CTRL+B)</span>
                                                                    </span>
                                                                    <span class="ck ck-button__label" id="ck-editor__aria-label_e3961670afa24717024de45c8a045e1d7">Bold</span>
                                                                </button>
                                                                <button class="ck ck-button ck-off" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_e917d036fa80f39227c560afcf603e6fd" aria-pressed="false">
                                                                    <svg class="ck ck-icon ck-button__icon" viewBox="0 0 20 20">
                                                                        <path d="M9.586 14.633l.021.004c-.036.335.095.655.393.962.082.083.173.15.274.201h1.474a.6.6 0 1 1 0 1.2H5.304a.6.6 0 0 1 0-1.2h1.15c.474-.07.809-.182 1.005-.334.157-.122.291-.32.404-.597l2.416-9.55a1.053 1.053 0 0 0-.281-.823 1.12 1.12 0 0 0-.442-.296H8.15a.6.6 0 0 1 0-1.2h6.443a.6.6 0 1 1 0 1.2h-1.195c-.376.056-.65.155-.823.296-.215.175-.423.439-.623.79l-2.366 9.347z"></path>
                                                                    </svg>
                                                                    <span class="ck ck-tooltip ck-tooltip_s">
                                                                        <span class="ck ck-tooltip__text">Italic (CTRL+I)</span>
                                                                    </span>
                                                                    <span class="ck ck-button__label" id="ck-editor__aria-label_e917d036fa80f39227c560afcf603e6fd">Italic</span>
                                                                </button>
                                                                <button class="ck ck-button ck-off" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_e07c9eb3ff53abd43bbf095864128edb6" aria-pressed="false">
                                                                    <svg class="ck ck-icon ck-button__icon" viewBox="0 0 20 20">
                                                                        <path d="M11.077 15l.991-1.416a.75.75 0 1 1 1.229.86l-1.148 1.64a.748.748 0 0 1-.217.206 5.251 5.251 0 0 1-8.503-5.955.741.741 0 0 1 .12-.274l1.147-1.639a.75.75 0 1 1 1.228.86L4.933 10.7l.006.003a3.75 3.75 0 0 0 6.132 4.294l.006.004zm5.494-5.335a.748.748 0 0 1-.12.274l-1.147 1.639a.75.75 0 1 1-1.228-.86l.86-1.23a3.75 3.75 0 0 0-6.144-4.301l-.86 1.229a.75.75 0 0 1-1.229-.86l1.148-1.64a.748.748 0 0 1 .217-.206 5.251 5.251 0 0 1 8.503 5.955zm-4.563-2.532a.75.75 0 0 1 .184 1.045l-3.155 4.505a.75.75 0 1 1-1.229-.86l3.155-4.506a.75.75 0 0 1 1.045-.184z"></path>
                                                                    </svg>
                                                                    <span class="ck ck-tooltip ck-tooltip_s">
                                                                        <span class="ck ck-tooltip__text">Link (Ctrl+K)</span>
                                                                    </span>
                                                                    <span class="ck ck-button__label" id="ck-editor__aria-label_e07c9eb3ff53abd43bbf095864128edb6">Link</span>
                                                                </button>
                                                                <button class="ck ck-button ck-off" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_e3da23c5bbdf5d62af8881dca410dda5b" aria-pressed="false">
                                                                    <svg class="ck ck-icon ck-button__icon" viewBox="0 0 20 20">
                                                                        <path d="M7 5.75c0 .414.336.75.75.75h9.5a.75.75 0 1 0 0-1.5h-9.5a.75.75 0 0 0-.75.75zm-6 0C1 4.784 1.777 4 2.75 4c.966 0 1.75.777 1.75 1.75 0 .966-.777 1.75-1.75 1.75C1.784 7.5 1 6.723 1 5.75zm6 9c0 .414.336.75.75.75h9.5a.75.75 0 1 0 0-1.5h-9.5a.75.75 0 0 0-.75.75zm-6 0c0-.966.777-1.75 1.75-1.75.966 0 1.75.777 1.75 1.75 0 .966-.777 1.75-1.75 1.75-.966 0-1.75-.777-1.75-1.75z"></path>
                                                                    </svg>
                                                                    <span class="ck ck-tooltip ck-tooltip_s">
                                                                        <span class="ck ck-tooltip__text">Bulleted List</span>
                                                                    </span>
                                                                    <span class="ck ck-button__label" id="ck-editor__aria-label_e3da23c5bbdf5d62af8881dca410dda5b">Bulleted List</span>
                                                                </button>
                                                                <button class="ck ck-button ck-off" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_effcccf2ed27e4c59f190f0a1ee406ae0" aria-pressed="false">
                                                                    <svg class="ck ck-icon ck-button__icon" viewBox="0 0 20 20">
                                                                        <path d="M7 5.75c0 .414.336.75.75.75h9.5a.75.75 0 1 0 0-1.5h-9.5a.75.75 0 0 0-.75.75zM3.5 3v5H2V3.7H1v-1h2.5V3zM.343 17.857l2.59-3.257H2.92a.6.6 0 1 0-1.04 0H.302a2 2 0 1 1 3.995 0h-.001c-.048.405-.16.734-.333.988-.175.254-.59.692-1.244 1.312H4.3v1h-4l.043-.043zM7 14.75a.75.75 0 0 1 .75-.75h9.5a.75.75 0 1 1 0 1.5h-9.5a.75.75 0 0 1-.75-.75z"></path>
                                                                    </svg>
                                                                    <span class="ck ck-tooltip ck-tooltip_s">
                                                                        <span class="ck ck-tooltip__text">Numbered List</span>
                                                                    </span>
                                                                    <span class="ck ck-button__label" id="ck-editor__aria-label_effcccf2ed27e4c59f190f0a1ee406ae0">Numbered List</span>
                                                                </button>
                                                                <span class="ck ck-toolbar__separator"></span>
                                                                <button class="ck ck-button ck-disabled ck-off" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_efcdefc9843d1234c27ca5920effbe874" aria-disabled="true">
                                                                    <svg class="ck ck-icon ck-button__icon" viewBox="0 0 20 20">
                                                                        <path d="M2 3.75c0 .414.336.75.75.75h14.5a.75.75 0 1 0 0-1.5H2.75a.75.75 0 0 0-.75.75zm5 6c0 .414.336.75.75.75h9.5a.75.75 0 1 0 0-1.5h-9.5a.75.75 0 0 0-.75.75zM2.75 16.5h14.5a.75.75 0 1 0 0-1.5H2.75a.75.75 0 1 0 0 1.5zM1.632 6.95L5.02 9.358a.4.4 0 0 1-.013.661l-3.39 2.207A.4.4 0 0 1 1 11.892V7.275a.4.4 0 0 1 .632-.326z"></path>
                                                                    </svg>
                                                                    <span class="ck ck-tooltip ck-tooltip_s">
                                                                        <span class="ck ck-tooltip__text">Increase indent</span>
                                                                    </span>
                                                                    <span class="ck ck-button__label" id="ck-editor__aria-label_efcdefc9843d1234c27ca5920effbe874">Increase indent</span>
                                                                </button>
                                                                <button class="ck ck-button ck-disabled ck-off" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_e7c3742411c6207bd8a2c18399d601e6a" aria-disabled="true">
                                                                    <svg class="ck ck-icon ck-button__icon" viewBox="0 0 20 20">
                                                                        <path d="M2 3.75c0 .414.336.75.75.75h14.5a.75.75 0 1 0 0-1.5H2.75a.75.75 0 0 0-.75.75zm5 6c0 .414.336.75.75.75h9.5a.75.75 0 1 0 0-1.5h-9.5a.75.75 0 0 0-.75.75zM2.75 16.5h14.5a.75.75 0 1 0 0-1.5H2.75a.75.75 0 1 0 0 1.5zm1.618-9.55L.98 9.358a.4.4 0 0 0 .013.661l3.39 2.207A.4.4 0 0 0 5 11.892V7.275a.4.4 0 0 0-.632-.326z"></path>
                                                                    </svg>
                                                                    <span class="ck ck-tooltip ck-tooltip_s">
                                                                        <span class="ck ck-tooltip__text">Decrease indent</span>
                                                                    </span>
                                                                    <span class="ck ck-button__label" id="ck-editor__aria-label_e7c3742411c6207bd8a2c18399d601e6a">Decrease indent</span>
                                                                </button>
                                                                <span class="ck ck-toolbar__separator"></span>
                                                                <span class="ck-file-dialog-button">
                                                                    <button class="ck ck-button ck-off" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_e0c11f6c148cde91eab09e3d609252563">
                                                                        <svg class="ck ck-icon ck-button__icon" viewBox="0 0 20 20">
                                                                            <path d="M6.91 10.54c.26-.23.64-.21.88.03l3.36 3.14 2.23-2.06a.64.64 0 0 1 .87 0l2.52 2.97V4.5H3.2v10.12l3.71-4.08zm10.27-7.51c.6 0 1.09.47 1.09 1.05v11.84c0 .59-.49 1.06-1.09 1.06H2.79c-.6 0-1.09-.47-1.09-1.06V4.08c0-.58.49-1.05 1.1-1.05h14.38zm-5.22 5.56a1.96 1.96 0 1 1 3.4-1.96 1.96 1.96 0 0 1-3.4 1.96z"></path>
                                                                        </svg>
                                                                        <span class="ck ck-tooltip ck-tooltip_s">
                                                                            <span class="ck ck-tooltip__text">Insert image</span>
                                                                        </span>
                                                                        <span class="ck ck-button__label" id="ck-editor__aria-label_e0c11f6c148cde91eab09e3d609252563">Insert image</span>
                                                                    </button>
                                                                    <input class="ck-hidden" type="file" tabindex="-1" accept="image/jpeg,image/png,image/gif,image/bmp,image/webp,image/tiff" multiple="true">
                                                                </span>
                                                                <button class="ck ck-button ck-off" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_e1962597db63f2242b8040fbb518ac41b" aria-pressed="false">
                                                                    <svg class="ck ck-icon ck-button__icon" viewBox="0 0 20 20">
                                                                        <path d="M3 10.423a6.5 6.5 0 0 1 6.056-6.408l.038.67C6.448 5.423 5.354 7.663 5.22 10H9c.552 0 .5.432.5.986v4.511c0 .554-.448.503-1 .503h-5c-.552 0-.5-.449-.5-1.003v-4.574zm8 0a6.5 6.5 0 0 1 6.056-6.408l.038.67c-2.646.739-3.74 2.979-3.873 5.315H17c.552 0 .5.432.5.986v4.511c0 .554-.448.503-1 .503h-5c-.552 0-.5-.449-.5-1.003v-4.574z"></path>
                                                                    </svg>
                                                                    <span class="ck ck-tooltip ck-tooltip_s">
                                                                        <span class="ck ck-tooltip__text">Block quote</span>
                                                                    </span>
                                                                    <span class="ck ck-button__label" id="ck-editor__aria-label_e1962597db63f2242b8040fbb518ac41b">Block quote</span>
                                                                </button>
                                                                <div class="ck ck-dropdown">
                                                                    <button class="ck ck-button ck-off ck-dropdown__button" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_e6e98234dadcbfa1c9cc8d4076e8c69c2" aria-haspopup="true">
                                                                        <svg class="ck ck-icon ck-button__icon" viewBox="0 0 20 20">
                                                                            <path d="M3 6v3h4V6H3zm0 4v3h4v-3H3zm0 4v3h4v-3H3zm5 3h4v-3H8v3zm5 0h4v-3h-4v3zm4-4v-3h-4v3h4zm0-4V6h-4v3h4zm1.5 8a1.5 1.5 0 0 1-1.5 1.5H3A1.5 1.5 0 0 1 1.5 17V4c.222-.863 1.068-1.5 2-1.5h13c.932 0 1.778.637 2 1.5v13zM12 13v-3H8v3h4zm0-4V6H8v3h4z"></path>
                                                                        </svg>
                                                                        <span class="ck ck-tooltip ck-tooltip_s">
                                                                            <span class="ck ck-tooltip__text">Insert table</span>
                                                                        </span>
                                                                        <span class="ck ck-button__label" id="ck-editor__aria-label_e6e98234dadcbfa1c9cc8d4076e8c69c2">Insert table</span>
                                                                        <svg class="ck ck-icon ck-dropdown__arrow" viewBox="0 0 10 10">
                                                                            <path d="M.941 4.523a.75.75 0 1 1 1.06-1.06l3.006 3.005 3.005-3.005a.75.75 0 1 1 1.06 1.06l-3.549 3.55a.75.75 0 0 1-1.168-.136L.941 4.523z"></path>
                                                                        </svg>
                                                                    </button>
                                                                    <div class="ck ck-reset ck-dropdown__panel ck-dropdown__panel_se"></div>
                                                                </div>
                                                                <div class="ck ck-dropdown">
                                                                    <button class="ck ck-button ck-off ck-dropdown__button" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_e2f6c787c73f563cb1fd5a4b76cedd120" aria-haspopup="true">
                                                                        <svg class="ck ck-icon ck-button__icon" viewBox="0 0 20 20">
                                                                            <path d="M18.68 3.03c.6 0 .59-.03.59.55v12.84c0 .59.01.56-.59.56H1.29c-.6 0-.59.03-.59-.56V3.58c0-.58-.01-.55.6-.55h17.38zM15.77 15V5H4.2v10h11.57zM2 4v1h1V4H2zm0 2v1h1V6H2zm0 2v1h1V8H2zm0 2v1h1v-1H2zm0 2v1h1v-1H2zm0 2v1h1v-1H2zM17 4v1h1V4h-1zm0 2v1h1V6h-1zm0 2v1h1V8h-1zm0 2v1h1v-1h-1zm0 2v1h1v-1h-1zm0 2v1h1v-1h-1zM7.5 7.177a.4.4 0 0 1 .593-.351l5.133 2.824a.4.4 0 0 1 0 .7l-5.133 2.824a.4.4 0 0 1-.593-.35V7.176v.001z"></path>
                                                                        </svg>
                                                                        <span class="ck ck-tooltip ck-tooltip_s">
                                                                            <span class="ck ck-tooltip__text">Insert media</span>
                                                                        </span>
                                                                        <span class="ck ck-button__label" id="ck-editor__aria-label_e2f6c787c73f563cb1fd5a4b76cedd120">Insert media</span>
                                                                        <svg class="ck ck-icon ck-dropdown__arrow" viewBox="0 0 10 10">
                                                                            <path d="M.941 4.523a.75.75 0 1 1 1.06-1.06l3.006 3.005 3.005-3.005a.75.75 0 1 1 1.06 1.06l-3.549 3.55a.75.75 0 0 1-1.168-.136L.941 4.523z"></path>
                                                                        </svg>
                                                                    </button>
                                                                    <div class="ck ck-reset ck-dropdown__panel ck-dropdown__panel_se">
                                                                        <form class="ck ck-media-form ck-responsive-form" tabindex="-1">
                                                                            <div class="ck ck-labeled-field-view ck-labeled-field-view_empty">
                                                                                <div class="ck ck-labeled-field-view__input-wrapper">
                                                                                    <input type="text" class="ck ck-input ck-input-text ck-input-text_empty" id="ck-labeled-field-view-e85e0082c3167907c271f5810a08ae81c" aria-describedby="ck-labeled-field-view-status-e3639187ee95dc813ac9b63b2d4874089">
                                                                                    <label class="ck ck-label" id="ck-editor__label_eec7206428cb41ba0dabbe6a5013e2d4b" for="ck-labeled-field-view-e85e0082c3167907c271f5810a08ae81c">Media URL</label>
                                                                                </div>
                                                                                <div class="ck ck-labeled-field-view__status" id="ck-labeled-field-view-status-e3639187ee95dc813ac9b63b2d4874089">Paste the media URL in the input.</div>
                                                                            </div>
                                                                            <button class="ck ck-button ck-disabled ck-off ck-button-save" type="submit" tabindex="-1" aria-labelledby="ck-editor__aria-label_eec0dcdfb0ac4d76ec01ec598fdcd6534" aria-disabled="true">
                                                                                <svg class="ck ck-icon ck-button__icon" viewBox="0 0 20 20">
                                                                                    <path d="M6.972 16.615a.997.997 0 0 1-.744-.292l-4.596-4.596a1 1 0 1 1 1.414-1.414l3.926 3.926 9.937-9.937a1 1 0 0 1 1.414 1.415L7.717 16.323a.997.997 0 0 1-.745.292z"></path>
                                                                                </svg>
                                                                                <span class="ck ck-tooltip ck-tooltip_s">
                                                                                    <span class="ck ck-tooltip__text">Save</span>
                                                                                </span>
                                                                                <span class="ck ck-button__label" id="ck-editor__aria-label_eec0dcdfb0ac4d76ec01ec598fdcd6534">Save</span>
                                                                            </button>
                                                                            <button class="ck ck-button ck-off ck-button-cancel" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_e3991c7952e31384360ccf009171a2c31">
                                                                                <svg class="ck ck-icon ck-button__icon" viewBox="0 0 20 20">
                                                                                    <path d="M11.591 10.177l4.243 4.242a1 1 0 0 1-1.415 1.415l-4.242-4.243-4.243 4.243a1 1 0 0 1-1.414-1.415l4.243-4.242L4.52 5.934A1 1 0 0 1 5.934 4.52l4.243 4.243 4.242-4.243a1 1 0 1 1 1.415 1.414l-4.243 4.243z"></path>
                                                                                </svg>
                                                                                <span class="ck ck-tooltip ck-tooltip_s">
                                                                                    <span class="ck ck-tooltip__text">Cancel</span>
                                                                                </span>
                                                                                <span class="ck ck-button__label" id="ck-editor__aria-label_e3991c7952e31384360ccf009171a2c31">Cancel</span>
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                                <button class="ck ck-button ck-disabled ck-off" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_e42a2e2edc6a0d709c7f5b6fe235c5792" aria-disabled="true">
                                                                    <svg class="ck ck-icon ck-button__icon" viewBox="0 0 20 20">
                                                                        <path d="M5.042 9.367l2.189 1.837a.75.75 0 0 1-.965 1.149l-3.788-3.18a.747.747 0 0 1-.21-.284.75.75 0 0 1 .17-.945L6.23 4.762a.75.75 0 1 1 .964 1.15L4.863 7.866h8.917A.75.75 0 0 1 14 7.9a4 4 0 1 1-1.477 7.718l.344-1.489a2.5 2.5 0 1 0 1.094-4.73l.008-.032H5.042z"></path>
                                                                    </svg>
                                                                    <span class="ck ck-tooltip ck-tooltip_s">
                                                                        <span class="ck ck-tooltip__text">Undo (CTRL+Z)</span>
                                                                    </span>
                                                                    <span class="ck ck-button__label" id="ck-editor__aria-label_e42a2e2edc6a0d709c7f5b6fe235c5792">Undo</span>
                                                                </button>
                                                                <button class="ck ck-button ck-disabled ck-off" type="button" tabindex="-1" aria-labelledby="ck-editor__aria-label_efc0661f35576b6f274706b806061595f" aria-disabled="true">
                                                                    <svg class="ck ck-icon ck-button__icon" viewBox="0 0 20 20">
                                                                        <path d="M14.958 9.367l-2.189 1.837a.75.75 0 0 0 .965 1.149l3.788-3.18a.747.747 0 0 0 .21-.284.75.75 0 0 0-.17-.945L13.77 4.762a.75.75 0 1 0-.964 1.15l2.331 1.955H6.22A.75.75 0 0 0 6 7.9a4 4 0 1 0 1.477 7.718l-.344-1.489A2.5 2.5 0 1 1 6.039 9.4l-.008-.032h8.927z"></path>
                                                                    </svg>
                                                                    <span class="ck ck-tooltip ck-tooltip_s">
                                                                        <span class="ck ck-tooltip__text">Redo (CTRL+Y)</span>
                                                                    </span>
                                                                    <span class="ck ck-button__label" id="ck-editor__aria-label_efc0661f35576b6f274706b806061595f">Redo</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ck ck-editor__main" role="presentation">
                                                <div class="ck-blurred ck ck-content ck-editor__editable ck-rounded-corners ck-editor__editable_inline cke_editable cke_editable_inline cke_contents_ltr cke_show_borders" dir="ltr" role="textbox" aria-label="Rich Text Editor, editor2" tabindex="0" spellcheck="false" style="position: relative;" title="Rich Text Editor, editor2" aria-describedby="cke_102" lang="en" contenteditable="true">
                                                    <p><br data-cke-filler="true"> </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        @else
            <h3 class="text-danger">Sorry, We have no Tours added yet..!</h3>
        @endif
    </div>
@endsection
