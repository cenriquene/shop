<template>
    <v-app id="sandbox">
        <v-navigation-drawer
            v-model="primaryDrawer.model"
            :clipped="primaryDrawer.clipped"
            :floating="primaryDrawer.floating"
            :mini-variant="primaryDrawer.mini"
            :permanent="primaryDrawer.type === 'permanent'"
            :temporary="primaryDrawer.type === 'temporary'"
            app
            overflow
        >
            <v-list-item class="px-2">
                <v-list-item-avatar size="70">
                    <v-img
                        src="https://iupac.org/wp-content/uploads/2018/05/default-avatar.png">
                    </v-img>
                </v-list-item-avatar>

                <v-list-item-content>
                <v-list-item-title></v-list-item-title>
                <v-list-item-subtitle>Administrator</v-list-item-subtitle>
                </v-list-item-content>
            </v-list-item>
            <v-list>
                <v-divider></v-divider>
                <v-list-item
                    router
                    exact
                    to="users">
                    <v-list-item-icon>
                        <v-icon>
                            people_alt
                        </v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>Users</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <v-list-item
                    router
                    exact
                    to="products">
                    <v-list-item-icon>
                        <v-icon>
                            add_business
                        </v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>Products</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <v-list-item
                    router
                    exact
                    to="sales">
                    <v-list-item-icon>
                        <v-icon>
                            shopping_cart
                        </v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>Sales</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar
            :clipped-left="primaryDrawer.clipped"
            app
        >
            <v-app-bar-nav-icon
                v-if="primaryDrawer.type !== 'permanent'"
                @click.stop="primaryDrawer.model = !primaryDrawer.model"
            ></v-app-bar-nav-icon>
            <v-toolbar-title>My Shop - Admin</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-menu offset-y>
                <template v-slot:activator="{ on }">
                    <v-btn
                    small
                    depressed
                    v-on="on"
                    >
                    <v-icon>person</v-icon>&nbsp;
                    {{ user_name }}
                    </v-btn>
                </template>
                <v-list>
                    <v-list-item>
                    <v-list-item-title @click="logout">Logout</v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>
        </v-app-bar>

        <v-main>
            <v-container >
                <router-view></router-view>
            </v-container>
        </v-main>

        <v-footer
            :inset="footer.inset"
            app
        >
            <span class="px-4">&copy; {{ new Date().getFullYear() }}</span>
        </v-footer>
    </v-app>
</template>

<script>
    export default {
        created() {

        },
        mounted() {

        },
        computed: {

        },
        data: () => ({
            user_name: 'HomeComponent',
            primaryDrawer: {
                model: null,
                type: 'default (no property)',
                clipped: false,
                floating: false,
                mini: false,
            },
            footer: {
                inset: true,
            }
        }),
        methods:{
            logout() {

            }
        }
    }
</script>