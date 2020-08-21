<template>
    <div class="register">
        <div style="border: lightgray 1px solid; padding: 10px">
            <v-form
                style="margin-bottom: 20px"
                lazy-validation
            >
                <v-text-field
                    type="text"
                    name="first_name"
                    label="First Name"
                    v-model="user.first_name"
                    :class="[{'is-invalid': errorFor('first_name')}]"
                ></v-text-field>
                <validation-errors :errors="errorFor('first_name')"></validation-errors>

                <v-text-field
                    type="text"
                    name="last_name"
                    label="Last Name"
                    v-model="user.last_name"
                    :class="[{'is-invalid': errorFor('last_name')}]"
                ></v-text-field>
                <validation-errors :errors="errorFor('last_name')"></validation-errors>

                <v-text-field
                    v-model="user.email"
                    label="Email"
                    required
                    :class="[{'is-invalid': errorFor('email')}]"
                ></v-text-field>
                <validation-errors :errors="errorFor('email')"></validation-errors>

                <v-text-field
                    v-model="user.password"
                    label="Password"
                    required
                    :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                    :type="show1 ? 'text' : 'password'"
                    class=""
                    @click:append="show1 = !show1"
                    :class="[{'is-invalid': errorFor('password')}]"
                ></v-text-field>
                <validation-errors :errors="errorFor('password')"></validation-errors>

                <v-text-field
                    v-model="user.password_confirmation"
                    label="Confirm Password"
                    required
                    :append-icon="show2 ? 'mdi-eye' : 'mdi-eye-off'"
                    :type="show2 ? 'text' : 'password'"
                    class=""
                    @click:append="show2 = !show2"
                    :class="[{'is-invalid': errorFor('password_confirm')}]"
                ></v-text-field>
                <validation-errors :errors="errorFor('password_confirm')"></validation-errors>

                <v-btn
                    type="submit"
                    color="info"
                    class="mr-4"
                    @click.prevent="register"
                    block
                    :disabled="loading"
                >
                    Login
                </v-btn>
            </v-form>
            <hr>
            <div class="btnGroup">
                Already have an account?
                <router-link class="font-weight-bold" :to="{name:'login'}">Login</router-link>
            </div>

        </div>
    </div>
</template>

<script>
import validationErrors from "../../shared/mixins/validationErrors";
import {logIn} from "../../shared/utils/auth";

export default {
    name: "Register",
    mixins: [validationErrors],
    data(){
        return {
            show2: false,
            show1:false,
            user:{
                first_name: null,
                last_name: null,
                email:null,
                password:null,
                password_confirmation: null
            },
            loading:false
        }
    },
    methods:{
       async register(){
            this.loading = true;
            this.errors = null;
            try{

                const response = await axios.post('/register',this.user);

                if(response.status === 201){
                    logIn();
                    this.$store.dispatch('loadUser');
                    this.$router.push({name:'home'});
                }
            } catch (err) {
                this.errors = err.response && err.response.data.errors;
                console.log('errors', this.errors);
            }
            this.loading = false;
        }
    }
}
</script>

<style scoped>
    .register{
        max-width:500px;
        /*margin-top: 60px;*/
        margin:auto;
        padding: 0 2rem;
    }
    .btnGroup{
        font-size: .8em;
    }
</style>
