<template>
    <v-container>
        <v-form
            @submit.prevent = 'update'
        >
            <v-text-field
                v-model="form.title"
                label="Title"
                type="text"
                required
            ></v-text-field>
            <v-row align="center">

               <!-- <v-col cols="12">
                    <v-autocomplete
                        v-model="form.category_id"
                        :items="categories"
                        item-value="id"
                        item-text="name"
                        dense
                        filled
                        label="Select Category"
                    ></v-autocomplete>
                </v-col>-->
            </v-row>
            <vue-simplemde v-model="form.body"  /> <!--ref="markdownEditor"-->


        <v-card-actions>
            <v-btn icon medium color="orange"  @click="cancel">
                <v-icon>mdi-cancel</v-icon>
                Cancel
            </v-btn>
            <v-spacer></v-spacer>

            <v-btn icon medium color="teal" type="submit">
                <v-icon >mdi-content-save</v-icon>
                Save
            </v-btn>
        </v-card-actions>


        </v-form>
    </v-container>
</template>

<script>
export default {
    name: "EditQuestion",
    props:['data'],
    data(){
        return {
            form:{
                title: null,
                body: null
            }
        }
    },
    mounted(){
        this.form = this.data;
    },
    created() {

    },
    methods:{
        cancel(){
            this.$store.commit('isEditing', false);
        },
        update(){
            axios.patch(`/api/question/${this.form.id}`, this.form )
                .then(resp => this.cancel())
        }
    }
}
</script>

<style scoped>

</style>
