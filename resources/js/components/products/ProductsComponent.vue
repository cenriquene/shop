<template>
    <div>
        <layout-component title="Products">
            <template v-slot:content>
                <table-component
                    :headers="headers"
                    :items="products"
                    @editClicked="goToProductDetails"
                    @deleteClicked="openDeleteDialog"
                >
                </table-component>
            </template>
        </layout-component>
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

        },
        data () {
            return {
                headers: [
                    { text: 'Id', value: 'id' },
                    { text: 'Category', value: 'category.name' },
                    { text: 'Name', value: 'name' },
                    { text: 'Price', value: 'price' },
                    { text: 'Status', value: 'status' },
                    { text: 'Actions', value: 'actions', sortable: false },
                ],
                products: []
            }
        },
        methods:{
            goTo(path) {
                this.$router.push({path});
            },
            async fetchProducts() {
                try {
                    let response = await ProductsService.getProducts();
                    this.products = response.data.data.products;

                    this.products.map(product => {
                        product.price = this.$options.filters.currency(product.price);
                    });
                } catch (error) {
                    console.log(error);
                }
            },
            goToProductDetails(payload) {
                console.log('product details');
            },
            openDeleteDialog(payload) {
                console.log('delete product');
            }
        }
    }
</script>
