<template>
    <v-dialog v-model="dialog" persistent max-width="500">
        <v-card>
            <v-toolbar dark color="primary">
            </v-toolbar>
            <v-card-title class="headline">Delete {{ instance }}</v-card-title>
            <v-card-text>Are you shure to want to delete the selected object?</v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    color="secondary"
                    @click="emitCloseDialog">
                    CLOSE</v-btn>
                <v-btn
                    color="primary"
                    @click="emitConfirmDialog">
                    DELETE</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
    export default {
        props: {
            instance: {
                default: ''
            },
            dialog: {
                default: false
            },
            id: {
                default: null
            }
        },
        methods:{
            emitCloseDialog() {
                this.$emit('closeDialogClicked', this.id);
            },
            emitConfirmDialog() {
                this.$emit('confirmDialogClicked', this.id);
            }
        }
    }
</script>
