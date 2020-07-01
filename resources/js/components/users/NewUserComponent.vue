<template>
    <div>
        <layout-component title="New User">
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
                            <v-col cols="12" lg="6">
                                <v-text-field
                                    label="Password"
                                    outlined
                                    required
                                    :rules="[rules.required]"
                                    v-model="password"
                                    :loading="waitingForResponse"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" lg="6">
                                <v-text-field
                                    label="Confirm Password"
                                    outlined
                                    required
                                    :rules="[rules.required]"
                                    v-model="confirmPassword"
                                    :loading="waitingForResponse"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="12" class="text-right">
                                <v-btn
                                    color="accent"
                                    large
                                    :loading="waitingForResponse"
                                    @click="createUser"
                                >CREATE USER</v-btn>
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
        },
        computed: {

        },
        data () {
            return {
                valid: false,
                firstName: '',
                lastName: '',
                password: '',
                confirmPassword: '',
                email: '',
                rules:{
                    required: value => !!value || 'Required field.',
                    email: [
                        v => !!v || 'E-mail is required',
                        v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
                    ]
                },
                waitingForResponse: false
            }
        },
        methods:{
            async createUser() {
                if ( !this.validateBeforeSubmit() ) {
                    return;
                }

                this.waitingForResponse = true;

                let payload = {
                    name            : `${this.firstName} ${this.lastName}`,
                    first_name      : this.firstName,
                    last_name       : this.lastName,
                    email           : this.email,
                    password        : this.password,
                    confirmPassword : this.confirmPassword
                };

                try {
                    let response = await UsersService.createUser(payload);
                    this.$router.go(-1);
                } catch (error) {
                    console.log(error);
                }
                this.waitingForResponse = false;
            },
            validateBeforeSubmit() {
                if( this.password !== this.confirmPassword ) {
                    console.log('password does not match');
                    return false;
                }

                return this.$refs.form.validate();
            }
        }
    }
</script>
