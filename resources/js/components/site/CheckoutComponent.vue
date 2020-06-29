<template>
    <v-container>
        <div class="card">
            <div class="card-header bg-primary text-white">
                Items in your Cart
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Quantity</th>
                                <th scope="col">Product</th>
                                <th scope="col">Unit Price</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="product in products" :key="product.id">
                                <th scope="row">{{ product.total }}</th>
                                <td>{{ product.product.name }}</td>
                                <td>{{ product.product.price | currency }}</td>
                                <td>delete</td>
                            </tr>

                            <tr><td class="text-right" colspan="3">Subtotal</td><td>{{ total | currency }}</td></tr>
                            <tr><td class="text-right" colspan="3">Total</td><td>{{ total | currency }}</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <v-form ref="form" v-model="valid">
            <v-row class="mt-3">
                <v-col cols="6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Billing Information
                        </div>
                        <div class="card-body">
                            <v-container>
                                <v-row>
                                    <v-col class="mt-3" cols="6">
                                        <label for="">First Name</label>
                                        <input
                                            type="text"
                                            v-model="first_name"
                                            class="form-control"
                                            required
                                            :rules="[rules.required]">
                                    </v-col>
                                    <v-col class="mt-3" cols="6">
                                        <label for="">Last Name</label>
                                        <input
                                            type="text"
                                            v-model="last_name"
                                            class="form-control"
                                            required>
                                    </v-col>
                                    <v-col class="mt-3" cols="6">
                                        <label for="">Email</label>
                                        <input
                                            type="email"
                                            v-model="email"
                                            class="form-control">
                                    </v-col>
                                    <v-col class="mt-3" cols="6">
                                        <label for="">Phone Number</label>
                                        <input
                                            type="number"
                                            v-model="phone"
                                            class="form-control">
                                    </v-col>
                                    <v-col class="mt-3" cols="6">
                                        <label for="">Address</label>
                                        <input
                                            type="text"
                                            v-model="address"
                                            class="form-control">
                                    </v-col>
                                    <v-col class="mt-3" cols="6">
                                        <label for="">Country</label>
                                        <country-select
                                            class="form-control"
                                            v-model="country"
                                            :country="country"
                                            topCountry="US"/>
                                    </v-col>
                                    <v-col class="mt-3" cols="6">
                                        <label for="">State</label>
                                        <region-select
                                            class="form-control"
                                            v-model="region"
                                            :country="country"
                                            :region="region"/>
                                    </v-col>
                                    <v-col class="mt-3" cols="6">
                                        <label for="">City</label>
                                        <input
                                            type="text"
                                            v-model="city"
                                            class="form-control">
                                    </v-col>
                                    <v-col class="mt-3" cols="6">
                                        <label for="">Zip Code</label>
                                        <input
                                            type="text"
                                            v-model="zip_code"
                                            class="form-control">
                                    </v-col>
                                </v-row>
                            </v-container>
                        </div>
                    </div>
                </v-col>
                <v-col cols="6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Payment Information
                        </div>
                        <div class="card-body">
                            <v-container>
                                <v-row>
                                    <v-col class="mt-3" cols="12">
                                        <label for="">Credit Card Number</label>
                                        <input
                                            type="number"
                                            v-model="card"
                                            class="form-control"
                                            required>
                                    </v-col>
                                    <v-col class="mt-3" cols="3">
                                        <label for="">Exp. Year</label>
                                        <input
                                            type="text"
                                            v-model="exp_year"
                                            class="form-control">
                                    </v-col>
                                    <v-col class="mt-3" cols="3">
                                        <label for="">Exp. Mont</label>
                                        <input
                                            type="text"
                                            v-model="exp_month"
                                            class="form-control">
                                    </v-col>
                                    <v-col class="mt-3" cols="3">
                                        <label for="">CVC</label>
                                        <input
                                            type="number"
                                            v-model="cvc"
                                            class="form-control">
                                    </v-col>
                                    <v-col class="mt-3" cols="3">
                                        <label for="">Zip Code</label>
                                        <input
                                            type="text"
                                            v-model="card_zip_code"
                                            class="form-control">
                                    </v-col>
                                    <v-col class="mt-3 text-center" cols="8">
                                        <v-btn
                                            class="add-to-card btn btn-primary btn-xl js-scroll-trigger"
                                            @click="storeSale"
                                        >Pay Now {{ total | currency }}</v-btn>
                                    </v-col>
                                </v-row>
                            </v-container>
                        </div>
                    </div>
                </v-col>
            </v-row>
        </v-form>
    </v-container>
</template>

<script>
    import ProductsService from './../../services/ProductsService';

    export default {
        mounted() {
            console.log('Component mounted.')
        },
        created() {
            this.fetchProductsFromCartSession();
        },
        computed: {
            cart_total: {
                get() {
                    this.$store.state.general.cart.total;
                }
            }
        },
        data () {
            return {
                valid: false,
                headers: [
                    { text: 'Quantity', value: 'total' },
                    { text: 'Product', value: 'name' },
                    { text: 'Unit Price', value: 'price' },
                    { text: 'Actions', value: 'actions', sortable: false },
                ],
                products: [],
                total: 0,
                country: '',
                region: '',
                first_name: '',
                last_name: '',
                email: '',
                phone: null,
                address: '',
                city: '',
                zip_code: '',
                card: '',
                exp_year: '',
                exp_month: '',
                cvc: '',
                card_zip_code: '',
                rules:{
                    required: value => !!value || "Campo requerido"
                }
            }
        },
        methods: {
            async fetchProductsFromCartSession() {
                try {
                    let response = await ProductsService.getProductsFromCartSession();
                    let cart = response.data.data;

                    this.products = Object.entries(cart['products']);

                    if ( this.products.length > 0 ) {
                        this.products = this.products.map(product => product[1]);
                    }

                    let total = 0;
                    this.products.map(product => {total = total + parseFloat((product.total * product.product.price))});
                    this.total = total;

                    this.$store.dispatch('setProductCartSession', cart)
                } catch (error) {
                    console.log(error);
                }
            },
            async storeSale() {
                if ( this.validateBeforeSubmit ) {
                    try {
                        const payload = {
                            total: this.total,
                            country: this.country,
                            region: this.region,
                            first_name: this.first_name,
                            last_name: this.last_name,
                            email: this.email,
                            phone: this.phone,
                            address: this.address,
                            city: this.city,
                            zip_code: this.zip_code,
                            card: this.card,
                            exp_year: this.exp_year,
                            exp_month: this.exp_month,
                            cvc: this.cvc,
                            card_zip_code: this.card_zip_code,
                        }

                        let response = await ProductsService.storeSale(payload);
                        console.log(response);
                        this.$router.push('/');
                    } catch (error) {
                        console.log(error);
                    }
                }
            },
            validateBeforeSubmit() {
                return this.$refs.form.validate();
            }
        }
    }
</script>

<style scoped>
</style>
