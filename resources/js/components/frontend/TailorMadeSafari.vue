<template>
    <div>
        <form @submit.prevent="sendRequest" ref="tailorMadeForm" id="tailorMadeForm" class="mb-3">
            <div class="row mb-3">
                <div class="col-xs-2 col-sm-1 section-counter"><h2 class="counter-holder assistant-light">01</h2></div>
                <div class="col-xs-10 col-sm-11 section-title">
                    <h2 class="ubuntucondensed mb-0 pb-0">YOUR TRAVEL PLANS...</h2>
                    <p class="text-muted ubuntucondensed">Places of Interest, Hotel Budgets and the likes</p>
                </div>
            </div>
            <div class="form-group">
                <label for="count">How many people are travelling? if there are children, please specify their ages</label>
                <textarea name="count" id="count" v-model="tourist.count" cols="10" rows="1" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="destinations" class="mb-1">Where would you like to visit in Tanzania?</label>
                <div class="row">
                    <div class="col-md-6" v-for="(destinationCategory,i) in destinationCategories" :key="i">
                        <label>
                            <input type="checkbox" name="destinations[]" v-model="tourist.destinations" :value="destinationCategory.name" id="destinations"> {{ destinationCategory.name }}
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label>
                            <input type="checkbox" v-model="tourist.otherDestination"> Other <input type="text" name="other_destination" v-model="tourist.extraDestination" :disabled="!tourist.otherDestination"  autofocus style="border: 1px solid #ccc; border-radius: 4px; padding: 3px;">
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="dates">Dates you would like to travel, and for how long? Are these dates flexible?</label>
                <textarea name="dates" id="dates" v-model="tourist.date" cols="10" rows="1" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="hotels" class="mb-1">What type of Hotels, Lodges or Camps would you like to use?</label>
                <select name="hotels" id="hotels" v-model="tourist.hotelBudget" class="form-control" required>
                    <option value="" selected disabled>--- Please select your Accommodation Option ---</option>
                    <option value="World Class / Luxury Hotels or Lodges">World Class / Luxury Hotels or Lodges</option>
                    <option value="Mid-range Hotels or Lodges">Mid-range Hotels or Lodges</option>
                    <option value="Budget Hotels or Lodges">Budget / Limited Hotels or Lodges</option>
                    <option value="Camping">Camping</option>
                    <option value="Homestay">Homestay</option>
                </select>
            </div>
            <div class="form-group">
                <label for="furtherInfo">Further Information</label>
                <p class="text-muted">Please enter any further information or special interests such as Food tours, Cooking Class, Nature & Wildlife, Beach, Culture Shows, History, Museum, market & local village visits and Soft Adventure (leisure cycling, hiking & walking...etc.).</p>
                <textarea name="furtherInfo" id="furtherInfo" v-model="tourist.furtherInfo" cols="30" rows="6" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="howDidYouHearUs" class="mb-1">How did you hear about us</label>
                <div class="row">
                    <div class="col-md-6"><label><input v-model="tourist.howDidYouHearUs" value="Google" type="checkbox" name="howDidYouHearUs[]" title=""> Google</label></div>
                    <div class="col-md-6"><label><input v-model="tourist.howDidYouHearUs" value="Facebook/Instagram" type="checkbox" name="howDidYouHearUs[]" title=""> Facebook / Instagram</label></div>
                    <div class="col-md-6"><label><input v-model="tourist.howDidYouHearUs" value="TripAdvisor" type="checkbox" name="howDidYouHearUs[]" title=""> TripAdvisor</label></div>
                    <div class="col-md-6"><label><input v-model="tourist.howDidYouHearUs" value="Other Websites" type="checkbox" name="howDidYouHearUs[]" title=""> Other Websites & Blogs</label></div>
                    <div class="col-md-6"><label><input v-model="tourist.howDidYouHearUs" value="Referrals" type="checkbox" name="howDidYouHearUs[]" title=""> Referrals</label></div>
                    <div class="col-md-6"><label><input v-model="tourist.howDidYouHearUs" value="Returning Customer" type="checkbox" name="howDidYouHearUs[]" title=""> Returning Customer</label></div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-xs-2 col-sm-1 section-counter"><h2 class="counter-holder assistant-light">02</h2></div>
                <div class="col-xs-10 col-sm-11 section-title">
                    <h2 class="ubuntucondensed mb-0 pb-0">TELL US ABOUT YOU</h2>
                    <p class="text-muted ubuntucondensed">Note: Your information will be kept private</p>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-6 form-group"><input type="text" name="full_name" v-model="tourist.fullName" class="form-control input-lg" placeholder="Your Full Name ( required )" title="" required></div>
                <div class="col-md-6 form-group"><input type="text" name="country" v-model="tourist.emailConfirm" class="form-control input-lg" placeholder="Your Country of origin" title="" required></div>
                <div class="col-md-6 form-group"><input type="email" name="email" v-model="tourist.email" class="form-control input-lg" placeholder="Email Address ( required )" title="" required></div>
                <div class="col-md-6 form-group"><input type="text" name="phone" v-model="tourist.phone" class="form-control input-lg" placeholder="phone ( + country code & number - optional )" title=""></div>
            </div>
            <div class="mt-3">
                <label>
                    <input type="checkbox" name="subscribe" v-model="tourist.subscribe">
                    Subscribe to our newsletter and stay updated on the latest special offers
                </label>
                <label>
                    <input type="checkbox" name="accept_terms" v-model="tourist.acceptTerms">
                    Accept the <a href="https://www.takemetotanzania.com/terms-and-conditions" target="_blank">Accept the Terms & Conditions</a>
                </label>
            </div>
            <div class="mt-3">
                <button type="submit" id="submit" class="btn btn-lg btn-warning mr-3 text-uppercase" :disabled="!tourist.acceptTerms"><i class="fa fa-fw fa-send mr-2"></i>Submit my Request</button>
                <button @click.prevent="clearForm" class="btn btn-lg btn-default text-uppercase"><i class="fa fa-fw fa-times mr-1"></i>Reset</button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                destinationCategories: [],
                tourist: {
                    fullName:'', phone:'', email:'', emailConfirm:'', count:'', destinations:[],
                    otherDestination: false, date:'', hotelBudget:'', furtherInfo:'', howDidYouHearUs:[],
                    subscribe: true, acceptTerms: false, extraDestination:'', tourID:'',
                },
            }
        },
        created() {
            this.getDestinationCategories();
            this.getTourID();
        },
        methods: {
            sendRequest() {
                let vm = this, formData = new FormData(vm.$refs.tailorMadeForm), submitButton = $('#submit');
                submitButton.attr('disabled',true).html('<i class="fa fa-fw fa-spinner fa-spin mr-2"></i>Submit my Request');
                if (vm.tourist.tourID) { formData.append('tourID', vm.tourist.tourID) } else { formData.append('tourID', "") }
                axios.post('/api/admin/tailored/booking', formData)
                    .then(res => {
                        if (res.status === 200) {
                            submitButton.attr('disabled',false).html('<i class="fa fa-fw fa-send mr-2"></i>Submit my Request');
                            Vue.$toast.success(`${res.data.message}`, { onDismiss: vm.clearForm });
                        }
                    })
                    .catch(err => {
                        Vue.$toast.error(err.message);
                        submitButton.attr('disabled',false).html('<i class="fa fa-fw fa-send mr-2"></i>Submit my Request');
                    })
            },
            getDestinationCategories() {
                axios.get('/api/admin/destination-categories').then(res => this.destinationCategories = res.data).catch(err => console.log(err));
            },
            getTourID() {
                this.tourist.tourID = new URL(window.location.href).searchParams.get('id');
            },
            clearForm() {
                this.tourist.fullName = ''; this.tourist.phone = ''; this.tourist.email = ''; this.tourist.emailConfirm = '';
                this.tourist.count = ''; this.tourist.destinations = []; this.tourist.otherDestination = false;
                this.tourist.date = ''; this.tourist.hotelBudget = ''; this.tourist.furtherInfo = '';
                this.tourist.howDidYouHearUs = []; this.tourist.subscribe = true; this.tourist.acceptTerms = false;
                this.tourist.extraDestination = '';
            }
        }
    }
</script>

<style lang="scss" scoped>
    $primary-color: orange;
    @media screen and (min-width: 769px) {
        #tailorMadeForm {
            .section-counter {

                height: 100%;
                .counter-holder {
                    background: $primary-color;
                    border-radius: 50%;
                    width: 50px; height: 50px;
                    padding: 10px;
                    color: white;
                    box-shadow: 0 1px 2px 0 #000;
                }
            }
            .section-title {
                padding-left: 30px;
            }
        }
    }
    @media screen and (max-width: 768px) {
        #tailorMadeForm {
            label {
                font-family: "Ubuntu Condensed", sans-serif, Arial, Verdana, "Trebuchet MS";
            }

            .section-counter {
                /*padding-left: 10px;*/

                .counter-holder {
                    background: $primary-color;
                    border-radius: 50%;
                    width: 50px; height: 50px;
                    padding: 10px;
                    color: white;
                    box-shadow: 0 1px 2px 0 #000;
                }
            }
            .section-title {
                /*border: 1px solid blue;*/
            }
        }
    }
</style>