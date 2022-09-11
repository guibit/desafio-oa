<template>
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <inertia-link v-if="$page.props.user" href="/dashboard" class="text-sm text-gray-700 underline">
                Dashboard
            </inertia-link>

            <template v-else>
                <v-btn
                    :href="route('login')"
                    outlined
                    color="#405990"
                >
                    Login
                </v-btn>

                <v-btn
                    :href="route('register')"
                    outlined
                    color="#405990"
                >
                    Registrar

                </v-btn>
            </template>
        </div>

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center sm:justify-start sm:pt-0">
                <v-img max-width="300px" src="/img/logo.png">
                </v-img>

            </div>
        </div>
    </div>
</template>

<style scoped>

</style>

<script>
    export default {
        props: {
            canLogin: Boolean,
            canRegister: Boolean,
            laravelVersion: String,
            phpVersion: String,
        }
    }
</script>
