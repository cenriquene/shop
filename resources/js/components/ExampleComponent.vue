<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ProductsService from './../services/ProductsService';

    export default {
        mounted() {
            console.log('Component mounted.')
        },
        created() {
            this.fetchProducts();
            console.log(axios)
        },
        computed: {

        },
        data: () => ({
        }),
        methods:{
            goTo(path) {
                this.$router.push({path});
            },
            async fetchProducts() {
                try {
                    let data = await ProductsService.getProducts();
                    console.log(data);
                } catch (error) {
                    console.log(error);
                }
            }
        }
    }
</script>
