<template>
    <div class="inquiry-form">
        <div class="panel panel-default">
            <div class="panel-body">
                <h1 class="mt-0 mb-2 assistant-light text-center primary-color">INQUIRE THIS TOUR</h1>
                <form @submit.prevent="sendData" ref="enquiryForm" id="enquiryForm" method="post" class="assistant-light">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon" style="background: none; border-right: none"><i class="fa fa-fw fa-user primary-color"></i></div>
                            <input type="text" name="name" v-model="tourist.fullName" id="name" class="form-control input-lg" title="name" style="border-left: none" placeholder="Full name (required)" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon" style="background: none; border-right: none"><i class="fa fa-fw fa-phone primary-color"></i></div>
                            <input type="text" name="phone" v-model="tourist.phone" id="phone" class="form-control input-lg" title="phone" style="border-left: none" placeholder="Your Phone number">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon" style="background: none; border-right: none"><i class="fa fa-fw fa-envelope primary-color"></i></div>
                            <input type="email" name="email" v-model="tourist.email" class="form-control input-lg" style="border-left: none" title="Email Address" placeholder="Email Address (required)" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon" style="background: none; border-right: none"><i class="fa fa-fw fa-calendar primary-color"></i></div>
                            <input type="date" name="start_date" v-model="tourist.startDate" class="form-control input-lg" style="border-left: none" title="Starting Date" placeholder="Starting Date (ex. 23/12/2020)">
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea name="message" v-model="tourist.extras" class="form-control" cols="30" rows="3" title="message" style="min-height: 0; max-height: 100px" placeholder="Number of people, Hotels types or any extra information and any suggested changes"></textarea>
                    </div>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="subscribe" v-model="tourist.newsletterSubscription"> Subscribe to our Newsletter
                        </label>
                    </div>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="terms" v-model="tourist.termsAcceptance">
                            I accept the <a href="https://www.takemetotanzania.com/terms-and-conditions" target="_blank">Terms & Conditions</a>
                        </label>
                    </div>
                    <button type="submit" id="submit" @click.prevent="checkData" class="btn btn-lg btn-warning btn-block assistant-light" :class="{ 'disabled': !tourist.termsAcceptance }">
                        <i class="fa fa-fw fa-send mr-2"></i>SEND MY INQUIRY
                    </button>
                    <div class="small text-muted text-muted text-center">You must accept the Terms to send your inquiry!</div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                tourist: { fullName:'', phone:'', email:'', startDate:'', extras:'', tourSlug:'', newsletterSubscription:true, termsAcceptance:'' }
            }
        },
        created() {
            this.getTourSlug();
        },
        methods: {
            checkData() {
                if (this.validate()) { this.sendData() }
            },
            sendData() {
                let vm = this, formData = new FormData(vm.$refs.enquiryForm), submitButton = $('#submit');
                submitButton.html('<i class="fa fa-fw fa-spinner fa-spin mr-2"></i>SEND MY INQUIRY');
                formData.append('tourSlug', vm.tourist.tourSlug);
                axios.post('/api/admin/tour/enquiry', formData)
                .then(res => {
                    if (res.status === 200) {
                        submitButton.html('<i class="fa fa-fw fa-send mr-2"></i>SEND MY INQUIRY');
                        Vue.$toast.success('Congrats, your enquiry have been sent successfully. Will get back the soonest or before 2Hrs', { onDismiss: this.clearForm })
                    }
                })
                .catch(err => Vue.$toast.error(err.message))
            },
            getTourSlug() {
                this.tourist.tourSlug = (window.location.href.split('/'))[4];
            },
            validate() {
                let vm = this; return !!(vm.tourist.fullName !== '' && vm.tourist.email && vm.tourist.startDate && vm.tourist.termsAcceptance);
            },
            clearForm() {
                this.tourist.fullName = ''; this.tourist.phone = ''; this.tourist.email = ''; this.tourist.startDate = '';
                this.tourist.extras = ''; this.tourist.tourSlug = ''; this.tourist.newsletterSubscription = true;
                this.tourist.termsAcceptance = '';
            }
        }
    }
</script>

<style lang="scss" scoped>
    .inquiry-form {
        display: inline-block;
        position: -webkit-sticky;
        position: sticky;
        top: 150px;

        .panel-body {
            form {
                input, textarea {
                    &::placeholder {
                        color: #ccc;
                        font-size: 14px;
                    }
                }
            }
        }
    }
</style>