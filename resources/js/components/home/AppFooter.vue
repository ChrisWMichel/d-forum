<template>
<!--    <v-card height="150">-->
    <div class="container footCont">
            <v-footer
                absolute
                class="font-weight-medium white--text"
                color="#385F73"
                dark
            >
                <v-col
                    class="text-center footer"
                    cols="12"
                >
                    {{ new Date().getFullYear() }} — <strong>Discuss Programming Forum</strong>
                </v-col>
            </v-footer>

    </div>

<!--    </v-card>-->
</template>

<script>
export default {
name: "AppFooter"
}
</script>

<style scoped>
    .footer{
        color: #9bb1ba;
    }
    .footCont{
        margin-top: 5%;
    }
</style>
