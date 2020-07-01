<template>
    <div>
        <layout-component title="Products">
            <template v-slot:toolbar>
                <v-btn
                    style="margin-bottom:-50px"
                    color="accent"
                    dark
                    large
                    absolute
                    bottom
                    left
                    fab
                    to="products/new"
                    :loading="waitingForResponse"
                    >
                    <v-icon>add</v-icon>
                </v-btn>
            </template>
            <template v-slot:content>
                <table-component
                    :headers="headers"
                    :items="products"
                    @editClicked="goToProductDetails"
                    @deleteClicked="openDeleteDialog"
                    :loading="waitingForResponse"
                >
                </table-component>
            </template>
        </layout-component>
        <delete-dialog-component
            :dialog="showDeleteDialog"
            instance="Product"
            @closeDialogClicked="closeDialog"
            @confirmDialogClicked="deleteProduct"
            :id="productIdToDelete"
        ></delete-dialog-component>
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
                products: [],
                waitingForResponse: true,
                showDeleteDialog: false,
                productIdToDelete: null
            }
        },
        methods:{
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

                this.waitingForResponse = false;
            },
            goToProductDetails(payload) {
                this.$router.push(`/admin/products/edit/${payload.id}`);
            },
            openDeleteDialog(payload) {
                this.productIdToDelete = payload.id;
                this.showDeleteDialog = true;
            },
            closeDialog(id) {
                this.showDeleteDialog = false;
            },
            async deleteProduct(id) {
                this.showDeleteDialog = false;

                this.waitingForResponse = true;

                try {
                    let response = await ProductsService.deleteProduct(id);
                    this.fetchProducts();
                } catch (error) {
                    console.log(error);
                }
            }
        }
    }
</script>
