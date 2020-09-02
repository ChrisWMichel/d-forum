<template>
    <div class="reset">
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
                ></v-text-field>
                <v-text-field
                    v-model="password"
                    label="Password"
                    required
                    :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                    :type="show1 ? 'text' : 'password'"
                    class=""
                    @click:append="show1 = !show1"
                ></v-text-field>

                <v-text-field
                    v-model="password_confirmation"
                    label="Confirm Password"
                    required
                    :append-icon="show2 ? 'mdi-eye' : 'mdi-eye-off'"
                    :type="show2 ? 'text' : 'password'"
                    class=""
                    @click:append="show2 = !show2"
                ></v-text-field>
                <div style="color: red" v-for="(error, index) in errors" :key="index">{{error}}</div>

                <v-btn
                    type="submit"
                    color="info"
                    class="mr-4"
                    @click.prevent="resetPassword"
                    block
                    :disabled="loading"
                >
                    Reset Password
                </v-btn>
            </v-form>

        </div>
    </div>
</template>

<script>
export default {
    name: "ResetPasswordForm",
    data(){
        return {
            show2: false,
            show1:false,
            password:null,
            password_confirmation: null,
            email:null,
            loading:false,
            errors: []
        }
    },
    computed: {
        token() {
            let token = document.head.querySelector('meta[name="csrf-token"]');
            return token.content
        }
    },
    methods:{
        async resetPassword(){
            this.loading = true;
            this.errors = null;
            try{

                 await axios.post('/api/reset/password/', {
                     token:this.$route.params.token,
                     email:this.email,
                     password:this.password,
                     password_confirmation:this.password_confirmation
                 })
                .then(resp => {
                    if(resp.status === 201){
                        this.$router.push({name:'login'});
                    }

                })


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
    .reset{
        max-width:500px;
        /*margin-top: 60px;*/
        margin:auto;
        padding: 0 2rem;
    }

</style>
