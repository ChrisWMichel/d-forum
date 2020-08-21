<template>

    <div>
        <app-navbar></app-navbar>

        <v-container style="margin-top: 5%; max-width: 1200px; align-content: center">
            <router-view></router-view>
        </v-container>
    </div>
</template>

<script>
import AppNavbar from "./home/AppNavbar";
export default {
    name: "Index",
    components: {AppNavbar}
}
</script>

<style >
    .container{
        max-width: 1400px;
        margin:auto;
        /*overflow: auto;*/
        padding: 0 2rem;
    }
</style>
