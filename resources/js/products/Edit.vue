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
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                </ol>
                            </div>
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
                        <div class="col-md-6 offset-md-3 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Edit Your Product</h4>
                                </div>

                                <div class="card-body">
                                    <form @submit.prevent="updateProduct">
                                        <div class="form-group">
                                            <label class="form-label" for="name">Name <span class="text-danger">*</span>
                                                <small class="text-danger ml-1" v-if="errors && errors.name">{{ errors.name[0] }}</small>
                                            </label>
                                            <input type="text" v-model="formData.name" class="form-control" :class="{ 'is-invalid': errors.name }" />
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="price">Price <span class="text-danger">*</span>
                                                <small class="text-danger ml-1" v-if="errors && errors.price">{{ errors.price[0] }}</small>
                                            </label>
                                            <input type="number" v-model="formData.price" class="form-control" :class="{ 'is-invalid': errors.price }" id="price" />
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="quantity">Quantity <span class="text-danger">*</span>
                                                <small class="text-danger ml-1" v-if="errors && errors.quantity">{{ errors.quantity[0] }}</small>
                                            </label>
                                            <input type="number" id="quantity" v-model="formData.quantity" class="form-control" :class="{ 'is-invalid': errors.quantity }" />
                                        </div>
                                        <div class="form-group">
                                            <label class="d-block" for="description">Description <span class="text-danger">*</span>
                                                <small class="text-danger ml-1" v-if="errors && errors.description">{{ errors.description[0] }}</small>
                                            </label>
                                            <textarea class="form-control" :class="{ 'is-invalid': errors.description }" v-model="formData.description" id="description" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="discount">Discount (optional - default is 0)</label>
                                            <small class="text-danger ml-1" v-if="errors && errors.discount">{{ errors.discount[0] }}</small>
                                            <input type="number" min="0" max="100" v-model="formData.discount" class="form-control" :class="{ 'is-invalid': errors.discount }" id="discount" />
                                        </div>
                                        <div class="form-group my-5" style="position:relative;">
                                            <div v-for="image in formData.images" :key="image.id" class="mr-2" style="position: relative; float: left; width: 65px; height: 65px;">
                                                <img :src="image.original_url" id="productImage" class="rounded" alt="image">
                                                <input v-model="checkedImages" :value="image.id" :id="image.id" type="checkbox" style="position:absolute; right: -5px; top: -4px;" >
                                            </div>
                                            <br><br>
                                            <button @click="deleteProductImage" :disabled="checkedImages.length < 1" class="btn btn-sm btn-danger" type="button" style="position:absolute; right: -5px; top: 0px;">
                                                <i class="text-white" data-feather="trash"></i>
                                            </button>
                                        </div>
                                        <br>
                                        <div class="form-group mt-5">
                                            <label for="image">Product Image <span class="text-danger mt-2">*</span>
                                                <small class="text-danger ml-1" v-if="errors && errors.images">{{ errors.images[0] }}</small>
                                            </label>
                                            <div class="custom-file">
                                                <input type="file" name="images[]" class="custom-file-input" :class="{ 'is-invalid': errors.images }" id="images" ref="imageInput" multiple @change="handleImageUpload" />
                                                <label class="custom-file-label" for="images">Choose product image</label>
                                            </div>
                                        </div>
<!--                                        <div class="form-group d-flex justify-content-start">-->
<!--                                            <div v-for="preview in imagePreviews" :key="preview" class="mt-2 mr-1">-->
<!--                                                  <img :src="preview" alt="Image Preview"  style="width: 65px; height: 60px;" />-->
<!--                                            </div>-->
<!--                                        </div>-->
                                        <br>
                                        <div class="row">
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary" :disabled="isCreating">
                                                    <i class="mr-1" style="width: 18px; height: auto" data-feather="save"></i> {{ isCreating ? 'Saving...' : 'Save'}}
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
    props: ['productIndexRoute', 'productId'],
    data() {
        return {
            routes: {
                products: this.productIndexRoute,
                productID: this.productId,
            },
            formData: {
                name: '',
                description: '',
                price: '',
                quantity: '',
                discount: '',
                images: null
            },
            product: null,
            agreed: false,
            errors: {},
            isCreating: false,
            checkedImages: [],
            uploadImages: null,
            imagePreviews: [] // Temporary not used
        }
    },

    created() {
        this.fetchProduct()
    },

    methods: {
        async updateProduct(){

            this.isCreating = true;
            this.errors = {};
            const formData = new FormData();
            formData.append("_method", "put"); // Append to handle passing data using PUT method
            // Append the properties to the FormData object
            formData.append('name', this.formData.name);
            formData.append('price', this.formData.price);
            formData.append('quantity', this.formData.quantity);
            formData.append('discount', this.formData.discount);
            formData.append('description', this.formData.description);
            // // Append the images files
            if (this.uploadImages) {
                for (let i = 0; i < this.uploadImages.length; i++) {
                    const file = this.uploadImages[i];
                    formData.append('images[]', file);
                }
            }
            await axios.post('/products/'+this.product.id,  formData )
                .then((response) => {
                    // Set this.isCreating to false after a 2-second delay
                    setTimeout(() => {
                        this.isCreating = false;
                    }, 1000);

                    // After successful submission clear image label text and set default
                    const input = this.$refs.imageInput;
                    input.labels[0].textContent = 'Choose product image(s)'; // Clear the label text
                    this.fetchProduct(); // Refetch updated product data
                    this.uploadImages = null;

                    Swal.fire({
                        title: 'Congrats!',
                        text: response.data.message,
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2500,
                    });

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

        async deleteProductImage() {
            await axios.delete('/products/'+this.product.id, { data: { media_id: this.checkedImages } })
                .then((response) => {
                    // Image deleted successfully, remove it from the formData.images array
                    this.formData.images = this.formData.images.filter(
                        (image) => !this.checkedImages.includes(image.id)
                    );
                    this.checkedImages = []
                })
                .catch((error) => {
                    console.log(error.response.data.errors)
                })
        },

        async fetchProduct(){
            await axios.get('/product-editor/'+this.routes.productID)
                .then((response) => {
                    this.product = response.data.product;
                    this.formData.name = this.product.name;
                    this.formData.description = this.product.description;
                    this.formData.discount = this.product.discount;
                    this.formData.quantity = this.product.quantity;
                    this.formData.price = this.product.price;
                    this.formData.images = this.product.media;
                })
                .catch((error) => {
                    console.log(error.response.data.errors)
                })
        },

        handleImageUpload(event) {
            this.uploadImages = this.$refs.imageInput.files;
         // ***  Temporary comment image preview displaying  ***
            // const file = event.target.files;
            // if (file) {
            //     this.previewImage(file);
            // }
        },

      // ***  Temporary comment image preview displaying  ***
        // previewImage(files) {
        //     for (let i = 0; i < files.length; i++) {
        //         const file = files[i];
        //         const reader = new FileReader();
        //         reader.onload = (event) => {
        //             this.imagePreviews.push(event.target.result);
        //         };
        //         reader.readAsDataURL(file);
        //     }
        // }
    },
}
</script>
<style scoped>
#productImage{
    width: 65px;
    height: 60px;
}
</style>
