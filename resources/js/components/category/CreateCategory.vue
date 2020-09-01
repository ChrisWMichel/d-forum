<template>
    <v-container>
        <v-form @submit.prevent="submit" class="mb-2">
            <v-text-field
                v-model="form.name"
                label="Category Name"
                type="text"
                required
            ></v-text-field>
            <div  v-if="errors">
                <v-alert type="error" v-for="(error, index) in errors.name" :key="index">{{error}}</v-alert>
               <!-- <div class="errors" v-for="(error, index) in errors.name" :key="index">{{error}}</div>-->
            </div>
            <v-btn type="submit" color="pink" v-if="editCategory">Update</v-btn>
            <v-btn type="submit" color="teal" :disabled="disabled" v-else>Create</v-btn>

        </v-form>
        <v-card>
            <v-toolbar color="indigo" dark>
                <v-toolbar-title>Categories</v-toolbar-title>
            </v-toolbar>
            <div v-for="(category,index) in categories" :key="category.id">
                <v-list-item>
                    <v-list-item-action>
                        <v-btn icon small @click="editCat(index)">
                            <v-icon color="orange">mdi-pencil</v-icon>
                        </v-btn>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>{{category.name}}</v-list-item-title>
                    </v-list-item-content>
                    <v-list-item-action>
                        <v-btn icon small>
                            <v-icon color="red" @click="deleteCategory(category.id, index)">mdi-delete-forever</v-icon>
                        </v-btn>
                    </v-list-item-action>
                </v-list-item>
                <v-divider></v-divider>
            </div>
        </v-card>
    </v-container>
</template>

<script>
export default {
    name: "CreateCategory",
    data(){
        return{
            editCategory:null,
            form:{
                name:null
            },
            catID:null,
            errors:[]
        }
    },
    computed:{
        categories(){
            return  this.$store.getters.getCat;
        },
        disabled(){
            return !this.form.name;
        }
    },
    methods:{
        deleteCategory(id, index){
            axios.delete(`/api/category/${id}`)
                .then(resp => {
                    this.$store.commit('deleteCategory', index);
                })
        },
        submit(){
            this.editCategory ? this.updateCat() : this.addCategory();
        },
        editCat(index){
            this.form.name = this.categories[index].name;
            this.catID = this.categories[index].id
            this.editCategory = true;
        },
        async addCategory(){
            this.errors = [];
            if(this.form){
                await axios.post('/api/category', this.form)
                .then(resp => {
                    this.form.name = '';
                    this.$store.commit('unshiftCat', resp.data);
                }).catch(err => {
                        this.errors = err.response.data.errors;
                    })
            }
        },
       async updateCat(){
            await axios.patch(`/api/category/${this.catID}`, this.form)
                .then(resp =>{
                    this.$store.commit('updateCategory', resp.data)
                    this.form.name = null;
                    this.editCategory=null;
                    this.catID = null;
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
