<template>
    <div>
        <v-row >
            <v-col cols="12" lg="4" sm="6" v-for="product in products" :key="product.id" class="mt-5">
                <div class="portfolio-item">
                    <a class="portfolio-link" :href="product.slug">
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content">
                                <i class="fas fa-eye fa-3x"></i>
                            </div>
                        </div>
                        <img class="img-fluid" src="https://store.hp.com/SpainStore/Html/Merch/Images/c05447684_500x367.jpg" alt="" />
                    </a>
                    <div class="product portfolio-caption">
                        <div class="portfolio-caption-heading">{{ product.name }}</div>
                        <div class="portfolio-caption-subheading text-muted">{{ product.description }}</div>
                    </div>
                    <div>
                        <v-btn
                            class="add-to-card btn btn-primary btn-xl js-scroll-trigger"
                            icon
                            small
                            @click="addProductToCart(1, product)"
                        >
                            ADD TO CART
                        </v-btn>
                    </div>
                </div>
            </v-col>
        </v-row>
    </div>
</template>

<script>
    import ProductsService from './../../services/ProductsService';

    export default {
        mounted() {
            console.log('Component mounted.')
        },
        created() {
            this.fetchProducts();
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
                products: []
            }
        },
        methods: {
            async fetchProducts() {
                try {
                    let response = await ProductsService.getShopProducts();
                    this.products = response.data.data.products;

                    this.products.map(product => {
                        product.price = this.$options.filters.currency(product.price);
                    });
                } catch (error) {
                    console.log(error);
                }
            },
            async addProductToCart(total=1, product) {
                try {
                    const payload = {
                        total: total,
                        product_id: product.id
                    };

                    let response = await ProductsService.addProductToCart(payload);
                    let cart = response.data.data;

                    this.$store.dispatch('setProductCartSession', cart)
                } catch (error) {
                    console.log(error);
                }
            }
        }
    }
</script>

<style scoped>
    .product{
        max-height: 225px !important;
        min-height: 225px !important;
    }
    .add-to-card{ width: 100%; }
</style>
