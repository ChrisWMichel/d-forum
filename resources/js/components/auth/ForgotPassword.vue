<template>
    <div class="forgot">
        <div style="border: lightgray 1px solid; padding: 10px">
            <h4>Forgot Password</h4>
            <v-form
                autocomplete="off"
                style="margin-bottom: 20px"
                lazy-validation
            >
                <v-text-field
                    v-model="email"
                    label="Email"
                    type="email"

                ></v-text-field>
                <h4 v-if="message">{{message}}</h4>
              <!--  v-validate="'required|email|max:255'"-->
                <v-btn
                    type="submit"
                    color="info"
                    class="mr-4"
                    @click.prevent="resetPassword"
                    block
                    :disabled="disabled"
                >
                    Submit
                </v-btn>
            </v-form>

        </div>
    </div>
</template>

<script>
export default {
    name: "Reset",
    data(){
        return{
            email:null,
            message: null,
            disabled: false
        }
    },
    // computed: {
    //     token() {
    //         let token = document.head.querySelector('meta[name="csrf-token"]');
    //         return token.content
    //     }
    // },
    methods:{
        async resetPassword(){
            if(this.email){
              //await axios.post('/password/email', {email:this.email})
              await axios.post('/api/reset-password', {email:this.email})
              .then(resp => {
                  console.log('resp', resp);
                  this.message = resp.data.message;
                  this.email = '';
                  this.disabled = true;
              })

            } else {
                this.message = 'Enter an email before submitting.'
            }
        }
    }
}
</script>

<style scoped>
    .forgot{
        max-width:500px;
        /*margin-top: 60px;*/
        margin:auto;
        padding: 0 2rem;
    }
</style>
