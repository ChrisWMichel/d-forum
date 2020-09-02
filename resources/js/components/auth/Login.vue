<template>
    <div class="login">
        <div style="border: lightgray 1px solid; padding: 10px">
            <v-form
                style="margin-bottom: 20px"
                lazy-validation
            >
                <v-text-field
                    v-model="email"
                    label="Email"
                    type="email"
                    required
                    :class="[{'is-invalid': errorFor('email')}]"
                ></v-text-field>
                <validation-errors :errors="errorFor('email')"></validation-errors>

                <v-text-field
                    v-model="password"
                    label="Password"
                    required
                    :append-icon="show2 ? 'mdi-eye' : 'mdi-eye-off'"
                    :type="show2 ? 'text' : 'password'"
                    class=""
                    @click:append="show2 = !show2"
                    :class="[{'is-invalid': errorFor('password')}]"
                ></v-text-field>
                <validation-errors :errors="errorFor('password')"></validation-errors>

                <v-btn
                    type="submit"
                    color="info"
                    class="mr-4"
                    @click.prevent="login"
                    block
                    :disabled="loading"
                >
                    Login
                </v-btn>
            </v-form>
            <hr>
            <div class="btnGroup">
                No account yet?
                <router-link class="font-weight-bold" :to="{name:'register'}">Register</router-link>
            </div>
            <br>
            <div class="btnGroup">
                Forgot Password?
                <router-link class="font-weight-bold" :to="{name:'forgot'}">Email Password</router-link><!--name:'reset-password'-->
            </div>

        </div>
    </div>
</template>

<script>
import validationErrors from "../../shared/mixins/validationErrors";
import {logIn} from "../../shared/utils/auth";

export default {
    name: "login",
    mixins:[validationErrors],
    data(){
        return {
            show2: false,
            password:null,
            email:null,
            loading:false
        }
    },
    methods:{
        async login(){
            this.loading = true
            this.errors = null;
            try {
                await axios.get('/sanctum/csrf-cookie');
                await  axios.post('/login', {email:this.email, password:this.password});

                logIn();
                this.$store.dispatch('loadUser');
                this.$router.push({name:'home'});
            } catch (err){
                this.errors = err.response && err.response.data.errors;

            }

           this.loading = false;
        }
    }
}
</script>

<style scoped>
    .login{
        max-width:500px;
        /*margin-top: 60px;*/
        margin:auto;
        padding: 0 2rem;
    }
    .field{
        margin-bottom: 16px;
    }
    .btnGroup{
        font-size: .8em;
    }
</style>
