<template>
    <v-toolbar dark color="#323D63" class="ml-16">
        <v-toolbar-title class="mx-auto">
            {{ text }}
        </v-toolbar-title>
    </v-toolbar>
</template>

<script>
export default {
    name: "ToolbarTitle",
    props:{
        text:String
    }
}
</script>

<style scoped>

</style>
