<template>
    <div>
        <v-container fluid>
            <v-row  no-gutters justify="center">
                <v-col cols="12" lg="10">
                    <v-card>
                        <v-toolbar extended color="primary">
                            <v-toolbar-title>
                                <span class="headline"><b style="color:#fff">{{title}}</b></span>
                            </v-toolbar-title>
                            <v-spacer></v-spacer>
                            <div>
                                <slot name="toolbar"></slot>
                            </div>
                        </v-toolbar>
                        <v-card-text :style="`min-height: ${height}px`" fluid>
                            <slot name="content"></slot>
                        </v-card-text>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>
<script>
    export default {
        name: 'LayoutComponent',
        props: {
            title: {
                default:''
            },
            height: {
                default: '336'
            }
        }
    }
</script>
<style scoped>
</style>