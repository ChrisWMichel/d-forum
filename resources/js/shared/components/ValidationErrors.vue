<template>

    <div>
        <div
            class="invalid-feedback"
            v-for="error in errors"
            :key="key()"
        >
            {{error}}
        </div>
    </div>
</template>

<script>
export default {
    name: "ValidationErrors",
    props: ['errors'],
    methods:{
        key(){
            return `validation_error_${Math.random()}`;
        }
    }
}
</script>

<style scoped>
.is-invalid ~ div > .invalid-feedback{
    display: block;
    border-color: #b22222;
    background-image: none;
    font-size: .8em;
}
.invalid-feedback{
    color: #b22222;
    display: block;
}
</style>
