<template>
    <div>
        <layout-component title="Edit Product">
            <template v-slot:content>
                <v-form ref="form" v-model="valid">
                    <v-container>
                        <v-row>
                            <v-col cols="12">
                                <v-text-field
                                    label="Name"
                                    outlined
                                    required
                                    v-model="name"
                                    :loading="waitingForResponse"
                                    :rules="[rules.required]"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12">
                                <v-textarea
                                    outlined
                                    label="Description"
                                    :loading="waitingForResponse"
                                    v-model="description"
                                ></v-textarea>
                            </v-col>
                            <v-col cols="3">
                                <v-switch
                                    :loading="waitingForResponse"
                                    v-model="active"
                                    label="Active">
                                </v-switch>
                            </v-col>
                            <v-col cols="12" lg="9">
                                <v-text-field
                                    label="Price"
                                    type="number"
                                    outlined
                                    required
                                    :rules="[rules.required]"
                                    v-model="price"
                                    :loading="waitingForResponse"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12">
                                <v-select
                                    :items="categories"
                                    label="Category"
                                    outlined
                                    required
                                    item-value="id"
                                    item-text="name"
                                    v-model="category"
                                    :loading="waitingForResponse"
                                ></v-select>
                            </v-col>
                            <v-col cols="12" class="text-right">
                                <v-btn
                                    color="accent"
                                    large
                                    :loading="waitingForResponse"
                                    @click="updateProduct"
                                >UPDATE PRODUCT</v-btn>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-form>
            </template>
        </layout-component>
    </div>
</template>

<script>
    import ProductsService from './../../services/ProductsService';
    import CategoriesService from './../../services/CategoriesService';

    export default {
        mounted() {
            console.log('Component mounted.')
        },
        created() {
            this.productId = this.$route.params.id;
            this.fetchCategories();
            this.fetchProduct();
        },
        computed: {

        },
        data () {
            return {
                valid: false,
                active: false,
                category: null,
                price: 0,
                name: '',
                description: '',
                rules:{
                    required: value => !!value || 'Required field.'
                },
                waitingForResponse: true,
                categories: []
            }
        },
        methods: {
            async fetchCategories() {
                try {
                    let response = await CategoriesService.getCategories();

                    this.categories = response.data.data.categories;
                } catch (error) {
                    console.log(error);
                }
            },
            async fetchProduct() {
                try {
                    let response = await ProductsService.getProduct(this.productId);

                    this.product = response.data.data.product;

                    this.name = this.product.name;
                    this.active = this.product.status;
                    this.category = this.product.category_id;
                    this.price = this.product.price;
                    this.description = this.product.description;
                } catch (error) {
                    console.log(error);
                }
                this.waitingForResponse = false;
            },
            async updateProduct() {
                if ( !this.validateBeforeSubmit() ) {
                    return;
                }

                this.waitingForResponse = true;

                let payload = {
                    name            : this.name,
                    description     : this.description,
                    status          : this.active,
                    price           : this.price,
                    category_id     : this.category
                };

                try {
                    let response = await ProductsService.updateProduct(this.productId, payload);
                    this.$router.go(-1);
                } catch (error) {
                    console.log(error);
                }
                this.waitingForResponse = false;
            },
            validateBeforeSubmit() {
                return this.$refs.form.validate();
            }
        }
    }
</script>
