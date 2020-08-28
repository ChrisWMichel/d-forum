<template>
    <v-container>
        <v-form
            @submit.prevent = 'create'
        >
            <v-text-field
                v-model="form.title"
                label="Title"
                type="text"
                required
            ></v-text-field>
            <v-row align="center">

                <v-col cols="12">
                    <v-autocomplete
                        v-model="form.category_id"
                        :items="categories"
                        item-value="id"
                        item-text="name"
                        dense
                        filled
                        label="Select Category"
                    ></v-autocomplete>
                </v-col>
            </v-row>
            <vue-simplemde v-model="form.body"  /> <!--ref="markdownEditor"-->



            <v-btn
                color="success"
                class="mr-4"
                type="submit"
            >
                Create
            </v-btn>

        </v-form>
    </v-container>
</template>

<script>
export default {
    name: "create",
    data(){
        return {
            errors:{},
            form:{
                title: null,
                category_id: null,
                body:null
            }
        };
    },
    computed:{
        categories(){
            return  this.$store.getters.getCat;
        }
    },
    methods:{
       async create(){
           const user = this.$store.getters.getUser;
           this.form.user_id = user.id;
           await axios.post('/api/question', this.form)
                .then(resp => this.$router.push(resp.data.path))
                .catch(error => (this.errors = error.response.data))
        }
    }
}
</script>

<style scoped>

</style>
