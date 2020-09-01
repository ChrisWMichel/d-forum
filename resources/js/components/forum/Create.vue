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
            <div  v-if="errors">
                <div class="errors" v-for="(error, index) in errors.title" :key="index">{{error}}</div>
            </div>
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
                    <div  v-if="errors">
                        <div class="errors" v-if="errors.category_id">Category needs to be selected.</div>
                    </div>
                </v-col>

            </v-row>
            <vue-simplemde v-model="form.body"  /> <!--ref="markdownEditor"-->
            <div  v-if="errors">
                <div class="errors" v-if="errors.body">Don't forget to ask a question!</div>
            </div>
            <v-btn
                color="success"
                class="mr-4"
                type="submit"
                :disabled="disabled"
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
            errors:null,
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
        },
        disabled(){
            return !(this.form.title && this.form.category_id && this.form.body)
        }
    },
    methods:{
       async create(){
           this.errors = null;
           const user = this.$store.getters.getUser;
           this.form.user_id = user.id;
           await axios.post('/api/question', this.form)
                .then(resp => this.$router.push(resp.data.path))
                .catch(error => {
                    this.errors = error.response.data.errors
                    console.log('errors', this.errors)
                })
        }
    }
}
</script>

<style scoped>
    .errors{
        color: red;
    }

</style>
