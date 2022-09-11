<template>
    <v-btn
        small
        @click="$emit('click')"
        color="#132A57"
        dark
        class="ml-4"
        :class="{ 'opacity-25': processing}"
        :disabled="processing"
    >
        {{ text }}
    </v-btn>

</template>

<script>
export default {
    props: {
        processing: Boolean,
        text: String
    },
    name: "btn-action"
}
</script>

<style scoped>

</style>
