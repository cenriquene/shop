<template>
    <div>
        <v-container>
            <v-row justify="end">
                <v-col cols="12" md="8" lg="8">
                    <v-text-field
                        v-model="search"
                        append-icon="mdi-magnify"
                        label="Search"
                        single-line
                        hide-details
                    ></v-text-field>
                </v-col>
            </v-row>
        </v-container>
        <v-data-table
            :headers="headers"
            :items="items"
            :search="search"
        >
            <template v-slot:item.actions="{ item }">
                <v-menu offset-y>
                    <template v-slot:activator="{ on }">
                        <v-btn
                            color="primary"
                            v-on="on"
                            dark
                            icon
                            small
                        >
                            <v-icon>more_vert</v-icon>
                        </v-btn>
                    </template>
                    <v-list>
                        <v-list-item
                            v-for="(option, index) in options"
                            :key="`${option.actions}-${index}`"
                            @click="executeOption(item, option.emit)">
                            <v-list-item-title>{{option.title}}</v-list-item-title>
                        </v-list-item>
                    </v-list>
                </v-menu>
            </template>
        </v-data-table>
    </div>
</template>

<script>
    export default {
        name: 'TableComponent',
        props: {
            headers: {
                default: () => []
            },
            items: {
                default: () => []
            },
            options: {
                default: () => [
                    {'action': 'update', 'title': 'Edit', 'emit': 'editClicked'},
                    {'action': 'delete', 'title': 'Delete', 'emit': 'deleteClicked'}
                ]
            },
        },
        data () {
            return {
                search: '',
            }
        },
        methods: {
            executeOption(payload, emit) {
                this.$emit(emit, payload);
            }
        }
    }
</script>