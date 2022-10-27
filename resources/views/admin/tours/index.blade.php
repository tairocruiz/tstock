@extends('layouts.admin')

@section('content')
    <div>
        <h3>All Tour Package Listing <button class="btn btn-warning pull-right" data-toggle="modal" data-target="#tourModal"><i class="fa fa-plus-circle mr-2"></i>Add new Tour</button></h3>
        <hr>
        <table v-if="tours.length" class="table table-responsive">
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
                    <td><span v-if="tour.seo_title">{{ $tour->seo_title }}</span></td>
                    <td class="text-center">{{ $tour->pivot }}</td>
                    <td class="text-center">{{ $tour->days }}</td>
                    <td class="text-center">
                        <a href="#" @click.prevent="toggleFeatured(i)" title="Toggle Featured">
                            <span v-if="tour.featured"><i class="fa fa-lg fa-check text-success"></i></span>
                            <span v-else><i class="fa fa-check" style="color: #eee"></i></span>
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="#" @click.prevent="loadTour(i)" class="mr-2" :title="`Edit ${tour.name}`"><i class="fa fa-edit"></i></a>
                        <a href="#" @click.prevent="deleteTour(i)" :title="`Delete ${tour.name}`"><i class="fa fa-times text-danger"></i></a>
                    </td>
                </tr>
            @endforeach
        </table>

        {{-- <!-- Modal -->
        <div class="modal fade" id="tourModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <button @click="clearForm" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><strong>Add New Tour</strong></h4>
                    </div>
                    <div class="modal-body">
                        <form ref="tour_form" id="tour_form">
                            <div class="row">
                                <div class="form-group col-md-8">
                                    <label for="name">Tour Package Name</label>
                                    <input type="text" name="name" id="name" v-model="tour.name" class="form-control">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="days_count">Tour Days</label>
                                    <input type="number" name="days_count" id="days_count" :value="days.length" readonly class="form-control">
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="price">Tour Price</label>
                                    <input type="number" name="price" id="price" v-model="tour.price" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-8">
                                    <label for="seo_title">SEO Title</label> <small>(optional)</small> <small v-if="tour.seo_title" class="pull-right text-muted">{{ tour.seo_title.length }} characters</small>
                                    <input type="text" name="seo_title" v-model="tour.seo_title" maxlength="70" id="seo_title" class="form-control">
                                </div>
                                <div v-if="!tour.map" class="form-group col-md-4">
                                    <label for="map">Upload Tour Map</label>
                                    <input @change="collectTourMap($event)" type="file" name="map" id="map" class="form-control">
                                </div>
                                <div v-else>
                                    <div v-if="tour.map && tour.mapPreview">
                                        <img :src="tour.mapPreview" style="max-height: 50px; max-width: 120px" alt="Preview">
                                        <button class="btn btn-warning ml-3" @click="tour.map = ''">Remove map</button>
                                    </div>
                                    <div v-else-if="tour.map && !tour.mapPreview">
                                        <img :src="`/storage/tour_maps/${tour.map}`" style="max-height: 50px; max-width: 120px" alt="Preview">
                                        <button class="btn btn-warning ml-3" @click="tour.map = ''">Remove map</button>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="meta_description">Meta Description</label> <small>(optional)</small> <small v-if="tour.meta_description" class="pull-right">{{ tour.meta_description.length }} characters</small>
                                    <textarea name="meta_description" v-model="tour.meta_description" id="meta_description" maxlength="160" cols="30" rows="2" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="overview">Tour Overview</label>
                                <textarea name="overview" id="overview" v-model="tour.overview" cols="30" rows="2" class="form-control"></textarea>
                            </div>

                            <!--   Tour Categories   -->
                            <div class="row mb-3">
                                <!--   if this is editing & thisTourCategories have entries   -->
                                <div v-if="edit === true && thisTourCategories.length">
                                    <div class="col-sm-6 col-md-4" v-for="(thisCategory,i) in thisTourCategories" :key="`B${i}`" v-if="thisCategory.id">
                                        <label>
                                            <input type="checkbox" name="existing_categories[]" :value="thisCategory.id" v-model="thisCategory.id"> {{ thisCategory.name }}
                                        </label>
                                    </div>
                                    <div class="col-sm-6 col-md-4" v-for="(category,i) in allTourCategories" :key="`C${i}`" v-if="category.id && !thisTourCategoriesIds.includes(category.id)">
                                        <label>
                                            <input type="checkbox" name="added_categories[]" :value="category.id"> {{ category.name }}
                                        </label>
                                    </div>
                                </div>

                                <!--   else   -->
                                <div v-else>
                                    <div class="col-sm-4 col-md-6 col-lg-4" v-for="(category,i) in allTourCategories" :key="`D${i}`">
                                        <label>
                                            <input type="checkbox" name="categories[]" :value="category.id"> {{ category.name }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!--   day 2 day blocks   -->
                            <div class="mb-3">
                                <div class="bg-info mt-3 p-2" v-for="(theday,d) in days" :key="theday.day">
                                    <div class="row">
                                        <div class="form-group col-md-2">
                                            <label for="day_order">Day {{ d+1 }} Order</label>
                                            <input type="number" name="day_order" id="day_order" v-model="days[d].day_order" class="form-control">
                                        </div>
                                        <div class="form-group col-md-10">
                                            <label for="day_title">Day {{ d+1 }} Title</label>
                                            <input type="text" id="day_title" v-model="days[d].day_title" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="day_description">Day {{ d+1 }} Activities Description</label>
                                        <ckeditor :editor="editor" :id="`day_description_${d}`" v-model="days[d].day_description" @focus="removeCKFocusClass(d)" :config="editorConfig"></ckeditor>
<!--                                        <textarea name="" id="" cols="30" rows="10" class="form-control"></textarea>-->
                                    </div>
                                    <div class="row">
                                        <div>
                                            <div v-if="!days[d].day_photo1" class="form-group col-md-6">
                                                <label for="day_photo1">Day {{ d+1 }} first Photo</label> <span>(800px by 500px)</span>
                                                <input type="file" @change="collectDayPhoto1(d, $event)" name="day_photo1" id="day_photo1" class="form-control">
                                            </div>
                                            <div v-else class="col-md-6">
                                                <div v-if="days[d].day_photo1 && days[d].day_photo1Preview">
                                                    <img :src="days[d].day_photo1Preview" style="max-height: 70px; max-width: 120px" alt="Preview">
                                                    <button class="btn btn-warning ml-3" @click.prevent="days[d].day_photo1 = ''">Remove Day {{d+1}} photo #1</button>
                                                </div>
                                                <div v-else-if="days[d].day_photo1 && !days[d].day_photo1Preview">
                                                    <img :src="`/storage/day2day_photos/${days[d].day_photo1}`" style="max-height: 70px; max-width: 120px" alt="Preview">
                                                    <button class="btn btn-warning ml-3" @click.prevent="days[d].day_photo1 = ''">Remove Day {{d+1}} photo #1</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <div v-if="!days[d].day_photo2" class="form-group col-md-6">
                                                <label for="day_photo2">Day {{ d+1 }} second Photo</label> <span>(800px by 500px)</span>
                                                <input type="file" @change="collectDayPhoto2(d, $event)" name="day_photo2" id="day_photo2" class="form-control">
                                            </div>
                                            <div v-else class="col-md-6">
                                                <div v-if="days[d].day_photo2 && days[d].day_photo2Preview">
                                                    <img :src="days[d].day_photo2Preview" style="max-height: 70px; max-width: 120px" alt="Preview">
                                                    <button class="btn btn-warning ml-3" @click.prevent="days[d].day_photo2 = ''">Remove Day {{d+1}} photo #2</button>
                                                </div>
                                                <div v-else-if="days[d].day_photo2 && !days[d].day_photo2Preview">
                                                    <img :src="`/storage/day2day_photos/${days[d].day_photo2}`" style="max-height: 70px; max-width: 120px" alt="Preview">
                                                    <button class="btn btn-warning ml-3" @click.prevent="days[d].day_photo2 = ''">Remove Day {{d+1}} photo #2</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <button @click.prevent="addDay(d)" class="btn btn-primary">Add Day below</button>
                                        <button @click.prevent="remDay(d)" class="btn btn-danger pull-right">Remove Day {{ d+1 }}</button>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div v-if="!tour.photo" class="form-group col-md-6 mb-3">
                                    <label for="photo">Upload Tour Photo</label>
                                    <input type="file" @change="collectTourPhoto($event)" name="photo" id="photo" class="form-control">
                                </div>
                                <div v-else class="col-md-6 mb-3">
                                    <img v-if="this.edit" :src="`/storage/tour_photos/${tour.photo}`" alt="preview" style="max-width: 70px; max-height: 100px;">
                                    <img v-else :src="tour.photoPreview" alt="preview" style="max-width: 70px; max-height: 70px;">
                                    <button @click.prevent="tour.photo = ''" class="btn btn-warning ml-3">Remove Tour Photo</button>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="best_time">Best time for this Tour</label>
                                    <input type="text" name="best_time" id="best_time" v-model="tour.best_time" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="useful_information">Useful Safari Information</label> <small class="text-muted">(Sightseeing Highlights, Dining Experience, Travel Highlights, Includes & Excludes)</small>
                                <ckeditor :editor="editor" v-model="tour.useful_information" :config="editorConfig" id="useful_information"></ckeditor>
<!--                                <textarea name="" id="" cols="30" rows="10" class="form-control"></textarea>-->
                            </div>

<!--                            <div class="form-group">-->
<!--                                <label for="includes">Includes</label>-->
<!--                                <textarea name="includes" id="includes" v-model="tour.includes" cols="30" rows="2" class="form-control" required></textarea>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="excludes">Excludes</label>-->
<!--                                <textarea name="excludes" id="excludes" v-model="tour.excludes" cols="30" rows="2" class="form-control" required></textarea>-->
<!--                            </div>-->
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" @click="clearForm" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click="clearForm" class="btn btn-danger">Clear the Form</button>
                        <button type="submit" @click="sendData" id="saveButton" class="btn btn-primary"><i class="fa fa-fw fa-check mr-2"></i>Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


<script>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

    export default {
        data() {
            return {
                tours: [],
                allTourCategories: [],
                thisTourCategories: [],
                tour: {
                    id:'', name:'', map:'', mapPreview:'', overview:'', days:'', seo_title:'', meta_description:'',
                    best_time:'All Year Round', price:'', photo:'', photoPreview:'', useful_information:''
                },
                days: [
                        { day_id:'', day_order:'', day_title:'', day_description:'', day_photo1:'', day_photo1Preview:'', day_photo2:'', day_photo2Preview:'' }
                    ],
                edit: false,
                editor: ClassicEditor,
                editorConfig: {}
            }
        },
        computed: {
            thisTourCategoriesIds() {
                let this_tour_categories_ids = [];
                for (let i = 0; i < this.thisTourCategories.length; i++) {
                    this_tour_categories_ids.push(this.thisTourCategories[i].id)
                }
                return this_tour_categories_ids;
            },
            tourCategoriesIds() {
                let tour_categories_ids = [];
                for (let i = 0; i < this.allTourCategories.length; i++) {
                    tour_categories_ids.push(this.allTourCategories[i].id);
                }
                return tour_categories_ids;
            }
        },
        created() {
            this.getTours(); this.getCategories();
        },
        methods: {
            sendData() {
                if (this.edit) {
                    // edit data
                    let vm  = this;
                    let formData = new FormData(vm.$refs.tour_form);
                    formData.append('useful_information', vm.tour.useful_information);
                    formData.append('_method', 'PUT');
                    formData.append('photo', vm.tour.photo);
                    formData.append('map', vm.tour.map);
                    formData.append('id', vm.tour.id);

                    for (let i = 0; i < vm.days.length; i++) {
                        formData.append(`days[${i}][day_id]`, this.days[i].day_id !== undefined || null ? this.days[i].day_id : "");
                        formData.append(`days[${i}][day_order]`, this.days[i].day_order);
                        formData.append(`days[${i}][day_title]`, this.days[i].day_title);
                        formData.append(`days[${i}][day_description]`, this.days[i].day_description);
                        formData.append(`days[${i}][day_photo1]`, this.days[i].day_photo1 !== undefined || this.days[i].day_photo1 !== null ? this.days[i].day_photo1 : "");
                        formData.append(`days[${i}][day_photo2]`, this.days[i].day_photo2 !== undefined || this.days[i].day_photo2 !== null ? this.days[i].day_photo2 : "");
                    }

                    $('#saveButton').html('<i class="fa fa-fw fa-pulse fa-spinner mr-2"></i>Save Changes');

                    axios.post('/api/admin/tours', formData)
                        .then(res => {
                            console.log(res);
                            if (res.status === 200) {
                                $('#saveButton').html('<i class="fa fa-fw fa-check mr-2"></i>Save changes');
                                let tour = vm.tours.find(t => t.id === parseInt(res.data.id));

                                tour.tour_days = res.data.tour_days; tour.days = res.data.days; tour.name = res.data.name;
                                tour.seo_title = res.data.seo_title; tour.categories = res.data.categories;
                                tour.featured = res.data.featured;

                                $('#tourModal').modal('hide');
                                Vue.$toast.success(`Great, tour changes have been successfully saved`, { onDismiss: this.clearForm });
                            }
                        })
                        .catch(err => Vue.$toast.error(`Sorry, there have been an error and changes were not saved. Error: ${err.message}`));
                } else {
                    // post data
                    let vm  = this;
                    let formData = new FormData(vm.$refs.tour_form);
                    formData.append('useful_information', vm.tour.useful_information);
                    formData.append('photo', vm.tour.photo);
                    formData.append('map', vm.tour.map);

                    for (let i = 0; i < vm.days.length; i++) {
                        formData.append(`days[${i}][day_id]`, this.days[i].day_id !== undefined || null ? this.days[i].day_id : "");
                        formData.append(`days[${i}][day_order]`, this.days[i].day_order);
                        formData.append(`days[${i}][day_title]`, this.days[i].day_title);
                        formData.append(`days[${i}][day_description]`, this.days[i].day_description);
                        formData.append(`days[${i}][day_photo1]`, this.days[i].day_photo1 !== undefined || null ? this.days[i].day_photo1 : "");
                        formData.append(`days[${i}][day_photo2]`, this.days[i].day_photo2 !== undefined || null ? this.days[i].day_photo2 : "");
                    }

                    $('#saveButton').html('<i class="fa fa-fw fa-pulse fa-spinner mr-2"></i>Save Changes');

                    axios.post('/api/admin/tours', formData)
                        .then(res => {
                            console.log(res)
                            if (res.status === 201) {
                                $('#saveButton').html('<i class="fa fa-fw fa-check mr-2"></i>Save changes');
                                $('#tourModal').modal('hide');
                                Vue.$toast.success(`Congratulations, new tour package have been successfully saved`, { onDismiss: this.clearForm });
                            }
                        })
                        .catch(err => Vue.$toast.error(`Sorry, there was an error and tour was not saved. Error: ${err.message}`));
                }
            },
            removeCKFocusClass(d) {
                // code block
            },
            getTours() {axios.get('/api/admin/tours').then(res => this.tours = res.data).catch(err => console.log(err))},
            getCategories() {
                axios.get('/api/admin/tour-categories').then(res => this.allTourCategories = res.data).catch(err => console.log(err))
            },
            addDay(i) {
                let newDay = { ...this.days[0] };
                newDay.day_id = ''; newDay.day_order = ''; newDay.day_title = ''; newDay.day_description = ''; newDay.day_photo1 = ''; newDay.day_photo2 = '';
                this.days.splice((i + 1),0, newDay);
            },
            remDay(i) {
                if(this.days.length > 1) {
                    if (this.days[i].day_id && this.days[i].day_id !== null && this.days[i].day_id !== undefined) {
                        // send request to delete this day from server
                        let tour_day_id = this.days[i].day_id;
                        if (confirm(`Are you sure you want to remove this day ${i + 1} from this package? the process is irreversible and it will completely remove this particular day from this safari package with its photo[s] (if any) as well`)) {
                            axios.delete(`/api/admin/tour-day/${tour_day_id}`)
                                .then((res) => {
                                    if (res.status === 200) {
                                        console.log(res);
                                        this.days.splice(i,1,); /*this.tours.find(t => t.id === this.days[i].tour_id).days = tour.days - 1;*/
                                        Vue.$toast.success(`Success, ${res.data.day_title} (Day ${i+1}) have been successfully removed from this Tour package`)
                                    }
                                })
                                .catch(error => Vue.$toast.error(`Sorry, there is an error. This day have not been removed. Error: ${error.message}`))
                        }
                    } else {
                        // just delete the day from the list on screen
                        if (confirm(`Are you sure you want to delete day ${i + 1} from this package ?`)) {
                            this.days.splice(i,1);
                        }
                    }
                } else {
                    alert('You must have at-least 1 day for a valid safari package');
                }
            },
            collectTourMap(event) {
                this.tour.map = event.target.files[0];
                this.tour.mapPreview = URL.createObjectURL(this.tour.map);
            },
            collectTourPhoto(event) {
                this.tour.photo = event.target.files[0];
                this.tour.photoPreview = URL.createObjectURL(this.tour.photo);
            },
            collectDayPhoto1(d, event) {
                this.days[d].day_photo1 = event.target.files[0];
                this.days[d].day_photo1Preview = URL.createObjectURL(this.days[d].day_photo1);
            },
            collectDayPhoto2(d, event) {
                this.days[d].day_photo2 = event.target.files[0];
                this.days[d].day_photo2Preview = URL.createObjectURL(this.days[d].day_photo2);
            },
            loadTour(i) {
                let vm  = this;
                this.edit = true; $('#tourModal').modal('show');
                this.tour.id = this.tours[i].id; this.tour.name = this.tours[i].name; this.tour.overview = this.tours[i].overview; this.tour.map = this.tours[i].map;
                this.tour.days = this.tours[i].days; this.tour.seo_title = this.tours[i].seo_title; this.tour.meta_description = this.tours[i].meta_description;
                this.tour.best_time = this.tours[i].best_time; this.tour.price = this.tours[i].price; this.tour.photo = this.tours[i].photo;
                this.tour.useful_information = this.tours[i].useful_information;

                this.thisTourCategories = this.tours[i].categories;

                this.days = this.tours[i].tour_days.sort((a,b) => (a.day_order > b.day_order) ? 1 : -1);

                this.days.forEach(function (theDay) {
                    if (!theDay.day_photo1) {
                        theDay.day_photo1 = ''
                    }
                    if (!theDay.day_photo2) {
                        theDay.day_photo2 = ''
                    }
                })

            },
            toggleFeatured(i) {
                this.tours[i].featured = !this.tours[i].featured;
                let featureStatus = this.tours[i].featured;
                axios.post(`/api/admin/tours/${this.tours[i].id}/featured`, {featureStatus})
                    .then(res => {if (res.status === 200) {Vue.$toast.success(`Great, this tour feature status have been successfully changed`);}})
                    .catch(err => Vue.$toast.error(`Sorry, there was an error and feature status was not fully changed. Error: ${err.message}`));
            },
            deleteTour(i) {
                let vm = this, theTour = vm.tours[i];
                if (confirm(`Are you sure you want to delete ${theTour.name}? The process is irreversible and will delete all tour photos as well`)) {
                    axios.delete(`/api/admin/tours/${theTour.id}`)
                        .then(res => {
                            if (res.statusText === 'OK') {
                                vm.tours.splice(i,1);
                                Vue.$toast.success(`Success, ${res.data.name} have been successfully removed`);
                            }
                        })
                        .catch(err => console.log(err));
                }
            },
            clearForm() {
                this.tour.id = null; this.tour.name = ""; this.tour.seo_title = ""; this.tour.meta_description = "";
                this.tour.overview = ""; this.tour.photo = ""; this.tour.best_time = ""; this.tour.price = null; this.tour.days = "";
                this.tour.photoPreview = ""; this.tour.map = ""; this.tour.mapPreview = ""; this.tour.useful_information = "";

                document.getElementById('tour_form').reset();

                // for (let i = 0; i < this.days.length; i++) {
                //     this.days[i].day_id = null; this.days[i].day_title = ""; this.days[i].day_description = "";
                //     this.days[i].day_photo1 = ""; this.days[i].day_photo2 = "";
                // }
                this.days.splice(0, (this.days.length - 1));

                this.days[0].day_id = ''; this.days[0].day_title = ''; this.days[0].day_description = '';
                this.days[0].day_order = ''; this.days[0].day_photo1 = ''; this.days[0].day_photo2 = '';

                this.edit = false;
            }
        }
    }
</script>

<style lang="scss" scoped>
    table {
        tr {
            border-bottom: 1px solid #ccc;
          th, td {
              padding: 10px 7px;
          }
        }
    }
</style> --}}
@endsection
