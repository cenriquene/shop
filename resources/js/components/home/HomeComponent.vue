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
            <v-list
                dense
                nav
            >
                <v-divider></v-divider>
                <v-list-item link @click="logout">
                    <v-list-item-icon>
                        <v-icon>
                            power_settings_new
                        </v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>Logout</v-list-item-title>
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
            user_name:'HomeComponent',
            primaryDrawer: {
                model: null,
                type: 'default (no property)',
                clipped: false,
                floating: false,
                mini: false,
            },
            footer: {
                inset: true,
            },
            pathPrefix:'/secure/',
        }),
        methods:{
            goTo(path) {
                this.$router.push({path});
            },
            logout() {

            }
        }
    }
</script>