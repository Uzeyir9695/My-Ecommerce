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
                            <a :href="routes.products" class="btn btn-primary mr-1" type="button">View Products</a>
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
                        <div class="col-8 offset-2">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Create Your Product</h4>
                                </div>

                                <div class="card-body">
                                    <form @submit.prevent="submit" ref="productForm">
                                        <div class="row">
                                            <div class="col-6 offset-0">
                                                <div class="form-group">
                                                    <label class="form-label" for="name">Name <span class="text-danger">*</span>
                                                        <small class="text-danger ml-1" v-if="errors && errors.name">{{ errors.name[0] }}</small>
                                                    </label>
                                                    <input type="text" v-model="formData.name" class="form-control" :class="{ 'is-invalid': errors.name }" id="name" placeholder="some name..." />
                                                </div>
                                                <div class="form-group">
                                                    <label for="select-category">Category <span class="text-danger">*</span>
                                                        <small class="text-danger ml-1" v-if="errors && errors.category_id">{{ errors.category_id[0] }}</small>
                                                    </label>
                                                    <select class="form-control" :class="{ 'is-invalid': errors.category_id }" v-model="formData.selectedCategory" id="select-category" @change="onCategoryChange">
                                                        <option value="" disabled selected>Choose Category</option>
                                                        <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
                                                    </select>
                                                </div>
                                                <div class="form-group" v-if="formData.selectedCategory">
                                                    <label for="select-subcategory">Subcategory <span class="text-danger">*</span>
                                                        <small class="text-danger ml-1" v-if="errors && errors.subcategory_id">{{ errors.subcategory_id[0] }}</small>
                                                    </label>
                                                    <select class="form-control" :class="{ 'is-invalid': errors.subcategory_id }" v-model="formData.selectedSubcategory" id="select-subcategory" @change="onSubcategoryChange">
                                                        <option value="" disabled selected>Choose Subcategory</option>
                                                        <option v-for="subcategory in subcategories" :value="subcategory.id">{{ subcategory.name }}</option>
                                                    </select>
                                                </div>
                                                <div  v-if="formData.selectedSubcategory" class="form-group" id="attributes" v-for="(values, name) in attributes">
                                                    <label for="attribute">{{ name }} <span class="text-danger">*</span>
                                                        <small class="text-danger ml-1" v-if="errors && errors[getNameKey(name)]">{{ errors[getNameKey(name)][0] }}</small>
                                                    </label>
                                                    <select class="form-control mb-2" :class="{ 'is-invalid': errors[name] }" v-model="formData.selectedAttributes[name]" id="attribute">
                                                        <option value="" selected disabled>Choose {{ name }}</option>
                                                        <option v-for="value in values" :value="value.value">{{ value.value }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6 offset-0">
                                                <div class="form-group">
                                                    <label class="form-label" for="price">Price <span class="text-danger">*</span>
                                                        <small class="text-danger ml-1" v-if="errors && errors.price">{{ errors.price[0] }}</small>
                                                    </label>
                                                    <input type="number" v-model="formData.price" class="form-control" :class="{ 'is-invalid': errors.price }" id="price" placeholder="some price..." />
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="quantity">Quantity <span class="text-danger">*</span>
                                                        <small class="text-danger ml-1" v-if="errors && errors.quantity">{{ errors.quantity[0] }}</small>
                                                    </label>
                                                    <input type="number" v-model="formData.quantity" class="form-control" :class="{ 'is-invalid': errors.quantity }" id="quantity" placeholder="some quantity..." />
                                                </div>
                                                <div class="form-group">
                                                    <label class="d-block" for="description">Description <span class="text-danger">*</span>
                                                        <small class="text-danger ml-1" v-if="errors && errors.description">{{ errors.description[0] }}</small>
                                                    </label>
                                                    <textarea class="form-control" :class="{ 'is-invalid': errors.description }" v-model="formData.description" id="description" placeholder="Describe your product..." rows="3"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="discount">Discount (optional - default is 0%)</label>
                                                    <small class="text-danger ml-1" v-if="errors && errors.discount">{{ errors.discount[0] }}</small>
                                                    <input type="number" min="0" max="100" v-model="formData.discount" class="form-control" :class="{ 'is-invalid': errors.discount }" id="discount"  placeholder="Discount in percent..." />
                                                </div>
                                                <div class="form-group">
                                                    <label for="images">Product Image <span class="text-danger">*</span>
                                                        <small class="text-danger ml-1" v-if="errors && errors.images">{{ errors.images[0] }}</small>
                                                    </label>
                                                    <div class="custom-file">
                                                        <input type="file" name="images[]" class="custom-file-input" :class="{ 'is-invalid': errors.images }" id="images" ref="imageInput" multiple @change="handleImageUpload" />
                                                        <label class="custom-file-label" for="images">Choose product image(s)</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox"  v-model="agreed" :value="agreed"  id="agreed" class="custom-control-input" :class="{ 'is-invalid': errors.agreed }" />
                                                        <label class="custom-control-label" for="agreed">Agree to our terms and conditions <span class="text-danger">*</span></label>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-primary" :disabled="isCreating">
                                                            <span v-if="isCreating" class="spinner-border spinner-border-sm"></span>
                                                            {{ isCreating ? 'Creating...' : 'Add Product'}}
                                                        </button>
                                                    </div>
                                                </div>
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
        props: ['productIndexRoute', 'storeId'],
        data() {
            return {
                routes: {
                    products: this.productIndexRoute,
                },
                formData: {
                    name: '',
                    description: '',
                    price: '',
                    quantity: '',
                    discount: '',
                    selectedCategory: '',
                    selectedSubcategory: '',
                    selectedAttributes: '',
                    selectedImages: '',
                },
                categories: null,
                subcategories: null,
                attributes: null,
                agreed: false,
                errors: {},
                isCreating: false,
            }
        },

        created() {
            this.fetchCategories();
        },

        methods: {
           async submit(){
               this.isCreating = true;
                this.errors = {};
                const formData = new FormData();
                // Append the properties to the FormData object
                formData.append('agreed', this.agreed);
                formData.append('store_id', this.storeId);
                formData.append('category_id', this.formData.selectedCategory);
                formData.append('subcategory_id', this.formData.selectedSubcategory);
                formData.append('name', this.formData.name);
                formData.append('price', this.formData.price);
                formData.append('quantity', this.formData.quantity);
                formData.append('discount', this.formData.discount);
                formData.append('description', this.formData.description);
                formData.append('attributes', JSON.stringify(this.formData.selectedAttributes)); // this is used to apply validation ruels to each attribute

               // Append selected attributes' values
                if (this.formData.selectedAttributes) {
                    for (const attrName in this.formData.selectedAttributes) {
                        const key = this.getNameKey(attrName); // Convert attrName to lowercase and snake case
                        formData.append(key, this.formData.selectedAttributes[attrName]);
                    }
                }
                // Append the selectedImages files
                if (this.formData.selectedImages) {
                    for (let i = 0; i < this.formData.selectedImages.length; i++) {
                        const file = this.formData.selectedImages[i];
                        formData.append('images[]', file);
                    }
                }

               await axios.post('/products', formData)
                    .then((response) => {
                        // After successful submission clear form data
                        const input = this.$refs.imageInput;
                        input.labels[0].textContent = 'Choose product image(s)'; // Clear the label text
                        this.agreed = false;
                        Object.keys(this.formData).forEach((key) => {
                            this.formData[key] = '';
                        });

                        Swal.fire({
                            title: 'Congrats!',
                            text: response.data.message,
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 3000,
                        });

                        // Set this.isCreating to false after 1-second delay
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

            async fetchCategories(){
                await axios.get('/products/create?store_id='+this.storeId)
                .then((response) => {
                    this.categories = response.data.categories
                })
                .catch((error) => {
                    console.log(error)
                })
            },

            async onCategoryChange() {
                if (this.formData.selectedCategory) {
                    try {
                        this.subcategories = null;
                        this.attributes = null;
                        const response = await axios.get('/subcategories?category_id='+this.formData.selectedCategory);
                        this.subcategories = response.data.subcategories;
                        this.formData.selectedSubcategory = '';
                    } catch (error) {
                        console.log(error);
                    }
                }
            },

            async onSubcategoryChange() {
                if (this.formData.selectedSubcategory) {
                    try {
                        const response = await axios.get('/attributes-values?subcategory_id='+this.formData.selectedSubcategory);
                        this.attributes = response.data.attributes;
                        // Clear previously selected attribute values
                        this.formData.selectedAttributes = {};
                        // Iterate over attributes and set initial values as empty
                        for (const attrName in this.attributes) {
                            this.formData.selectedAttributes[attrName] = '';
                        }
                    } catch (error) {
                        console.log(error);
                    }
                }
            },

            handleImageUpload() {
                this.formData.selectedImages = this.$refs.imageInput.files;
            },

            getNameKey(name) {
                return name.toLowerCase().replace(/\s+/g, '_'); // convert keys into lowercase and sankecase to math with validation
            },
        },
    }
</script>
