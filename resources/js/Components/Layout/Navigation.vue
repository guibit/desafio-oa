<template>
    <v-navigation-drawer
        fixed
        permanent
        expand-on-hover
    >
        <v-list-item>
            <v-list-item-content>
                <v-list-item-title class="mx-auto">
                    <jet-application-mark></jet-application-mark>
                </v-list-item-title>
            </v-list-item-content>
        </v-list-item>

        <v-divider></v-divider>

        <v-list
            dense
            nav
        >
            <v-list-item
                active-color="red"
                v-for="item in items"
                :key="item.title"
                v-if="consumer === item.consumer || item.consumer === null"
                :href="route(item.route)"
                link
            >
                <v-list-item-icon class="d-flex justify-center">
                    <v-icon :color="route().current(item.route)?'#323D63':null">{{ item.icon }}</v-icon>
                </v-list-item-icon>

                <v-list-item-content>
                    <v-list-item-title>{{ item.title }}</v-list-item-title>
                </v-list-item-content>
            </v-list-item>

            <!--LOGOUT-->
            <v-list-item
                @click="logout()"
                link
            >
                <v-list-item-icon class="d-flex justify-center">
                    <v-icon>mdi-logout</v-icon>
                </v-list-item-icon>

                <v-list-item-content>
                    <v-list-item-title>Desconectar</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
        </v-list>
    </v-navigation-drawer>
</template>

<script>
import JetApplicationMark from "@/Jetstream/ApplicationMark";


export default {
    name: "Navigation",
    components: {
        JetApplicationMark,
    },
    data () {
        return {
            items: [
                { title: 'Dashboard', icon: 'mdi-view-dashboard' ,route:'dashboard',consumer:null},
                { title: 'Cadastrar Produtos', icon: 'mdi-package-variant-plus' ,route:'products.create',consumer:false},
                { title: 'Meus Produtos', icon: 'mdi-package-variant' ,route:'user.products',consumer:false},
                { title: 'Produtos', icon: 'mdi-package-variant' ,route:'products.index',consumer: true},
                { title: 'Carrinho', icon: 'mdi-cart-variant' ,route:'ordered.show',consumer: true},
                { title: 'Meus Pedidos', icon: 'mdi-playlist-check' ,route:'ordereds.index',consumer: true},
            ],
            consumer:false,
        }
    },
    methods: {
        logout() {
            this.$inertia.post(route('logout'));
        },
        verifyConsumer(){
            this.consumer = this.$page.props.user.type === "Consumidor"
        }
    },
    mounted() {
        this.verifyConsumer();
    }
}
</script>

<style scoped>
.v-list-item-active{
    color: green !important;
}


</style>
