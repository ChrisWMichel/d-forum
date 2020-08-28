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
            },
            original: true
        }
    },
    mounted(){
        this.form = this.data;
    },
    created() {
        console.log('created')
        this.$store.commit('setOriginalQuestion', {'body':this.data.body, 'title':this.data.title})
    },
    methods:{
        cancel(){
            console.log('original1', this.original);
            if(this.original){
                const origin = this.$store.getters.getOriginalQuest;
                this.form.body = origin.body;
                this.form.title = origin.title;
                this.original = true;
            }
            this.$store.commit('isEditing', false);
        },
        update(){
            axios.patch(`/api/question/${this.form.id}`, this.form )
                .then(resp => {
                    this.original = false
                    this.cancel()
                })
        }
    }
}
</script>

<style scoped>

</style>
