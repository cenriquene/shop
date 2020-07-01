<template>
    <v-app id="inspire">
        <v-main>
            <v-form ref="form" v-model="valid">
                <v-container
                    class="fill-height"
                    fluid
                >
                    <v-row
                        align="center"
                        justify="center"
                    >
                        <v-col
                            cols="12"
                            sm="8"
                            md="4"
                        >
                            <v-card class="elevation-12">
                                <v-toolbar
                                    color="primary"
                                    dark
                                    flat
                                >
                                    <v-toolbar-title>Login</v-toolbar-title>
                                    <v-spacer></v-spacer>
                                </v-toolbar>
                                <v-card-text>
                                    <v-text-field
                                        required
                                        v-model="email"
                                        label="Email"
                                        prepend-icon="mdi-account"
                                        type="text"
                                        :rules="rules.email"
                                    ></v-text-field>

                                    <v-text-field
                                        required
                                        v-model="password"
                                        label="Password"
                                        prepend-icon="mdi-lock"
                                        type="password"
                                        :rules="[rules.required]"
                                    ></v-text-field>
                                </v-card-text>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn
                                        :disabled="email === '' || password === ''"
                                        block
                                        @click="login"
                                        color="primary">
                                        Login</v-btn>
                                </v-card-actions>
                                <v-alert
                                    :value="alert"
                                    color="error"
                                    dark
                                    border="top"
                                    icon="mdi-info"
                                    transition="scale-transition"
                                    >
                                    {{ message }}
                                    </v-alert>
                            </v-card>
                        </v-col>
                    </v-row>
                </v-container>
            </v-form>
        </v-main>
    </v-app>
</template>

<script>
    import SecureService from './../../services/SecureService';

    export default {
        data () {
            return {
                valid: false,
                alert: false,
                email: '',
                password: '',
                rules: {
                    required: value => !!value || 'Required field.',
                    email: [
                        v => !!v || 'E-mail is required',
                        v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
                    ]
                },
                message: ''
            }
        },
        methods:{
            async login() {
                this.alert = false;

                if ( !this.$refs.form.validate() ) {
                    return;
                }

                let payload = {
                    email       : this.email,
                    password    : this.password
                };

                try {
                    let response = await SecureService.login(payload);

                    response = response.data;
                    if ( !response.error ) {
                        window.token = response.token;
                        window.location.href = '/admin/users';
                    }

                    this.message = response.message;
                    this.alert = response.error;
                } catch (error) {
                    console.log(error);
                }
            }
        }
    }
</script>