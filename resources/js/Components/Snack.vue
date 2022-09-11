<template>
    <v-snackbar
        v-model="snackbar"
        :color="snackColor"
    >
        {{ text }}

        <template v-slot:action="{ attrs }">
            <v-btn
                text
                v-bind="attrs"
                @click="snackbar = false"
            >
                Fechar
            </v-btn>
        </template>
    </v-snackbar>
</template>

<script>
export default {
    name: "Snack",
    props:{
        snackbar:Boolean,
        text:String,
        snackColor:String,
    }
}
</script>

<style scoped>

</style>
