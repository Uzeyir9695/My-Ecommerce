<template>
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <div class="dropdown">
                            <a :href="routes.stores" class="btn btn-primary mr-1" type="button">View stores</a>
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="app-todo.html"><i class="mr-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i class="mr-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><i class="mr-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><i class="mr-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Validation -->
                <section class="bs-validation">
                    <div class="row">
                        <!-- Bootstrap Validation -->
                        <div class="col-md-8 offset-md-2 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Create Your Store</h4>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="messages"></div>
                                            <div class="alert alert-danger" style="display: none">
                                                <ul class="errors">

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <form @submit.prevent="submit">
                                        <div class="row">
                                            <div class="col-md-6 offset-md-0 col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="name">Name <span class="text-danger">*</span>
                                                        <small class="text-danger ml-1" v-if="errors && errors.name">{{ errors.name[0] }}</small>
                                                    </label>
                                                    <input type="text" v-model="formData.name" class="form-control" :class="{ 'is-invalid': errors.name }" placeholder="Name" aria-label="Name" aria-describedby="name" />
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="email">Email <span class="text-danger">*</span>
                                                        <small class="text-danger ml-1" v-if="errors && errors.email">{{ errors.email[0] }}</small>
                                                    </label>
                                                    <input type="email" v-model="formData.email" class="form-control" :class="{ 'is-invalid': errors.email }" placeholder="john.doe@email.com" aria-label="john.doe@email.com" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="select-type">Type <span class="text-danger">*</span>
                                                        <small class="text-danger ml-1" v-if="errors && errors.type">{{ errors.type[0] }}</small>
                                                    </label>
                                                    <select class="form-control" v-model="formData.type" :class="{ 'is-invalid': errors.type }">
                                                        <option value="">Choose the type</option>
                                                        <option value="LLC">LLC</option>
                                                        <option VALUE="IE">IE</option>
                                                        <option VALUE="SLS">SLS</option>
                                                        <option VALUE="LEPL">LEPL</option>
                                                        <option VALUE="JSC">JSC</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="org_name">Organization Name <span class="text-danger">*</span>
                                                        <small class="text-danger ml-1" v-if="errors && errors.org_name">{{ errors.org_name[0] }}</small>
                                                    </label>
                                                    <input type="text" v-model="formData.orgName" class="form-control" :class="{ 'is-invalid': errors.orgName }" placeholder="Organization name" />
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="identification">Identification <span class="text-danger">*</span>
                                                        <small class="text-danger ml-1" v-if="errors && errors.identification">{{ errors.identification[0] }}</small>
                                                    </label>
                                                    <input type="text" v-model="formData.identification" class="form-control" :class="{ 'is-invalid': errors.identification }" placeholder="000120201" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone">Phone <span class="text-danger">*</span>
                                                        <small class="text-danger ml-1" v-if="errors && errors.phone">{{ errors.phone[0] }}</small>
                                                    </label>
                                                    <input type="text" v-model="formData.phone" class="form-control" :class="{ 'is-invalid': errors.identification }" placeholder="+995555112233" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="country">Country <span class="text-danger">*</span>
                                                        <small class="text-danger ml-1" v-if="errors && errors.country">{{ errors.country[0] }}</small>
                                                    </label>
                                                    <input type="text" v-model="formData.country"  class="form-control" :class="{ 'is-invalid': errors.country }" placeholder="Georgia" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 offset-md-0 col-sm-12">
                                                <div class="form-group">
                                                    <label for="city">City <span class="text-danger">*</span>
                                                        <small class="text-danger ml-1" v-if="errors && errors.city">{{ errors.city[0] }}</small>
                                                    </label>
                                                    <input type="text" v-model="formData.city" class="form-control" :class="{ 'is-invalid': errors.city }" placeholder="Tbilisi" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="street">Street <span class="text-danger">*</span>
                                                        <small class="text-danger ml-1" v-if="errors && errors.street">{{ errors.street[0] }}</small>
                                                    </label>
                                                    <input type="text" v-model="formData.street" class="form-control" :class="{ 'is-invalid': errors.street }" placeholder="Pekini #1" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="website">Website <span class="text-danger">*</span>
                                                        <small class="text-danger ml-1" v-if="errors && errors.website">{{ errors.website[0] }}</small>
                                                    </label>
                                                    <input type="text" v-model="formData.website" class="form-control" :class="{ 'is-invalid': errors.website }" placeholder="www.example.com" />
                                                </div>
                                                <div class="form-group">
                                                    <label class="d-block" for="description">Description <span class="text-danger">*</span>
                                                        <small class="text-danger ml-1" v-if="errors && errors.description">{{ errors.description[0] }}</small>
                                                    </label>
                                                    <textarea class="form-control" :class="{ 'is-invalid': errors.description }" v-model="formData.description" placeholder="Something..." rows="3"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="logoImage">Store Logo <span class="text-danger">*</span></label>
                                                    <div class="custom-file">
                                                        <input type="file" name="logoImage" ref="logoImageInput" id="logoImage" class="custom-file-input" :class="{ 'is-invalid': errors.logoImage }" @change="handleLogoImageUpload" />
                                                        <label class="custom-file-label" for="logoImage">Choose store image</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="coverImage">Cover Image <span class="text-danger">*</span></label>
                                                    <div class="custom-file">
                                                        <input type="file" name="coverImage" ref="coverImageInput" id="coverImage" class="custom-file-input" :class="{ 'is-invalid': errors.coverImage }" @change="handleCoverImageUpload" />
                                                        <label class="custom-file-label" for="coverImage">Choose store image</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" v-model="agreed" class="custom-control-input" :class="{ 'is-invalid': errors.agreed }" id="agreed" />
                                                <label class="custom-control-label" for="agreed">Agree to our terms and conditions <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary" :disabled="isCreating">
                                                    <span v-if="isCreating" class="spinner-border spinner-border-sm"></span>
                                                    {{ isCreating ? 'Creating...' : 'Create'}}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /Bootstrap Validation -->
                    </div>
                </section>
                <!-- /Validation -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

</template>
<script>
export default {
    props: ['storeIndexRoute'],
    data() {
        return {
            routes: {
                stores: this.storeIndexRoute,
            },
            formData: {
                name: '',
                city: '',
                type: '',
                email: '',
                phone: '',
                street: '',
                website: '',
                country: '',
                orgName: '',
                logoImage: '',
                coverImage: '',
                description: '',
                identification: ''

            },
            agreed: false,
            errors: {},
            isCreating: false,
        }
    },

    created() {
    },

    methods: {
        async submit(){
            this.isCreating = true;
            this.errors = {};
            const formData = new FormData();
            // Append the properties to the FormData object
            formData.append('agreed', this.agreed);
            formData.append('name', this.formData.name);
            formData.append('city', this.formData.city);
            formData.append('type', this.formData.type);
            formData.append('email', this.formData.email);
            formData.append('phone', this.formData.phone);
            formData.append('street', this.formData.street);
            formData.append('website', this.formData.website);
            formData.append('country', this.formData.country);
            formData.append('org_name', this.formData.orgName);
            formData.append('logoImage', this.formData.logoImage);
            formData.append('coverImage', this.formData.coverImage);
            formData.append('description', this.formData.description);
            formData.append('identification', this.formData.identification);
            // Append cover and logo images
            const logoFile = this.formData.logoImage;
            formData.append('logoImage', logoFile);
            const coverFile = this.formData.coverImage;
            formData.append('coverImage', coverFile);

            await axios.post('/stores', formData)
                .then((response) => {
                    // After successful submission clear form data
                    const logoInput = this.$refs.logoImageInput;
                    logoInput.labels[1].textContent = 'Choose store logo image'; // Clear the label text
                    const coverInput = this.$refs.coverImageInput;
                    coverInput.labels[1].textContent = 'Choose store cover image'; // Clear the label text
                    this.agreed = false;
                    Object.keys(this.formData).forEach((key) => {
                        this.formData[key] = '';
                    });

                    Swal.fire({
                        title: 'Congrats!',
                        text: response.data.message,
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2500,
                    });

                    // Set this.isCreating to false after a 2-second delay
                    setTimeout(() => {
                        this.isCreating = false;
                    }, 1000);

                })
                .catch((error) => {
                    if (error.response && error.response.status === 422) {
                        this.isCreating = false;
                        // Validation failed, store the errors
                        this.errors = error.response.data.errors;
                    } else {
                        console.log(error);
                    }
                })
            // End of the axios call
        },

        handleLogoImageUpload() {
            this.formData.logoImage = this.$refs.logoImageInput.files[0];
        },

        handleCoverImageUpload() {
            this.formData.coverImage = this.$refs.coverImageInput.files[0];
        },
    },
}
</script>
