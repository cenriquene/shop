<template>
    <div>
        <layout-component title="Users">
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
                    to="users/new"
                    :loading="waitingForResponse"
                    >
                    <v-icon>add</v-icon>
                </v-btn>
            </template>
            <template v-slot:content>
                <table-component
                    :headers="headers"
                    :items="users"
                    @editClicked="goToUserDetails"
                    @deleteClicked="openDeleteDialog"
                    :loading="waitingForResponse"
                >
                </table-component>
            </template>
        </layout-component>
        <delete-dialog-component
            :dialog="showDeleteDialog"
            instance="User"
            @closeDialogClicked="closeDialog"
            @confirmDialogClicked="deleteUser"
            :id="userIdToDelete"
        ></delete-dialog-component>
    </div>
</template>

<script>
    import UsersService from './../../services/UsersService';

    export default {
        mounted() {
            console.log('Component mounted.')
        },
        created() {
            this.fetchUsers();
        },
        computed: {

        },
        data () {
            return {
                headers: [
                    { text: 'Id', value: 'id' },
                    { text: 'Name', value: 'name' },
                    { text: 'Email', value: 'email' },
                    { text: 'Actions', value: 'actions', sortable: false },
                ],
                users: [],
                waitingForResponse: true,
                showDeleteDialog: false,
                userIdToDelete: null
            }
        },
        methods: {
            async fetchUsers() {
                try {
                    let response = await UsersService.getUsers();
                    this.users = response.data.data.users;
                } catch (error) {
                    console.log(error);
                }

                this.waitingForResponse = false;
            },
            goToUserDetails(payload) {
                this.$router.push(`/admin/users/edit/${payload.id}`);
            },
            openDeleteDialog(payload) {
                this.userIdToDelete = payload.id;
                this.showDeleteDialog = true;
            },
            closeDialog(id) {
                this.showDeleteDialog = false;
            },
            async deleteUser(id) {
                this.showDeleteDialog = false;
                this.waitingForResponse = true;

                try {
                    let response = await UsersService.deleteUser(id);
                    this.fetchUsers();
                } catch (error) {
                    console.log(error);
                }
            }
        }
    }
</script>
