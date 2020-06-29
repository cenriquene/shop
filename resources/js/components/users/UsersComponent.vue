<template>
    <div>
        <layout-component title="Users">
            <template v-slot:content>
                <table-component
                    :headers="headers"
                    :items="users"
                    @editClicked="goToProductDetails"
                    @deleteClicked="openDeleteDialog"
                >
                </table-component>
            </template>
        </layout-component>
    </div>
</template>

<script>
    import UsersService from './../../services/UsersService';

    export default {
        mounted() {
            console.log('Component mounted.')
        },
        created() {
            //this.fetchUsers();
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
            async fetchUsers() {
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
            goToUserDetails(payload) {
                console.log('user details');
            },
            openDeleteDialog(payload) {
                console.log('delete product');
            }
        }
    }
</script>
