<template>
    <div>
        <layout-component title="Edit User">
            <template v-slot:content>
                <v-form ref="form" v-model="valid">
                    <v-container>
                        <v-row>
                            <v-col cols="12" lg="6">
                                <v-text-field
                                    label="First Name"
                                    outlined
                                    required
                                    v-model="firstName"
                                    :loading="waitingForResponse"
                                    :rules="[rules.required]"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" lg="6">
                                <v-text-field
                                    label="Last Name"
                                    outlined
                                    required
                                    v-model="lastName"
                                    :loading="waitingForResponse"
                                    :rules="[rules.required]"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12">
                                <v-text-field
                                    label="Email"
                                    outlined
                                    required
                                    v-model="email"
                                    :loading="waitingForResponse"
                                    :rules="rules.email"
                                ></v-text-field>
                            </v-col>
                             <v-col cols="12" class="text-right">
                                <v-btn
                                    color="accent"
                                    large
                                    :loading="waitingForResponse"
                                    @click="updateUser"
                                >UPDATE USER</v-btn>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-form>
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
            this.userId = this.$route.params.id;
            this.fetchUser();
        },
        computed: {

        },
        data () {
            return {
                userId: null,
                valid: false,
                firstName: '',
                lastName: '',
                email: '',
                rules:{
                    required: value => !!value || 'Required field.',
                    email: [
                        v => !!v || 'E-mail is required',
                        v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
                    ]
                },
                waitingForResponse: true
            }
        },
        methods: {
            async fetchUser() {
                try {
                    let response = await UsersService.getUser(this.userId);
                    this.user = response.data.data.user;

                    this.firstName = this.user.first_name;
                    this.lastName = this.user.last_name;
                    this.email = this.user.email;

                    console.log(this.user);
                } catch (error) {
                    console.log(error);
                }

                this.waitingForResponse = false;
            },
            async updateUser() {
                if ( !this.validateBeforeSubmit() ) {
                    return;
                }

                this.waitingForResponse = true;

                let payload = {
                    name        : `${this.firstName} ${this.lastName}`,
                    first_name  : this.firstName,
                    last_name   : this.lastName,
                    email       : this.email
                };

                try {
                    let response = await UsersService.updateUser(this.userId, payload);
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
