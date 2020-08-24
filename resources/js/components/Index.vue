<template>

    <div>
        <app-navbar></app-navbar>

        <v-container fluid grid-list-md style="margin-top: 5%; max-width: 1200px; align-content: center">
            <router-view></router-view>
        </v-container>

        <app-footer></app-footer>
    </div>
</template>

<script>
import AppNavbar from "./home/AppNavbar";
import AppFooter from "./home/AppFooter";
export default {
    name: "Index",
    components: {AppFooter, AppNavbar}
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
