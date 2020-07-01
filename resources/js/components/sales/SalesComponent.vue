<template>
    <div>
        <layout-component title="Sales">
            <template v-slot:content>
                <table-component
                    :headers="headers"
                    :items="sales"
                    @editClicked="goToSaleDetails"
                    @deleteClicked="openDeleteDialog"
                    :loading="waitingForResponse"
                >
                </table-component>
            </template>
        </layout-component>
    </div>
</template>

<script>
    import SalesService from './../../services/SalesService';

    export default {
        mounted() {
            console.log('Component mounted.')
        },
        created() {
            this.fetchSales();
        },
        computed: {

        },
        data () {
            return {
                headers: [
                    { text: 'Id', value: 'id' },
                    { text: 'Status', value: 'status' },
                    { text: 'Subtotal', value: 'subtotal' },
                    { text: 'Total', value: 'total' },
                    { text: 'Products', value: 'total' },
                    { text: 'Actions', value: 'actions', sortable: false },
                ],
                sales: [],
                waitingForResponse: true
            }
        },
        methods:{
            goTo(path) {
                this.$router.push({path});
            },
            async fetchSales() {
                try {
                    let response = await SalesService.getSales();
                    this.sales = response.data.data.sales;

                    this.sales.map(sale => {
                        sale.total = this.$options.filters.currency(sale.total);
                        sale.subtotal = this.$options.filters.currency(sale.subtotal);
                    });
                } catch (error) {
                    console.log(error);
                }
                this.waitingForResponse = false;
            },
            goToSaleDetails(payload) {
                console.log('product details');
            },
            openDeleteDialog(payload) {
                console.log('delete product');
            }
        }
    }
</script>
