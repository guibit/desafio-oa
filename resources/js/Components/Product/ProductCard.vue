<template>
    <v-card
        class="mx-auto"
        max-width="344"
    >
        <v-img
            src="https://cdn.vuetifyjs.com/images/cards/sunshine.jpg"
            height="200px"
        ></v-img>

        <v-card-title class="d-flex justify-space-between">
            <span>
            {{ product.name }}
            </span>
            <span>
                R$: {{product.price}}
            </span>
        </v-card-title>

        <v-card-subtitle>
            Quantidade disponível:
            {{ product.amount }}
        </v-card-subtitle>

        <v-card-actions>
            <v-btn
                dark
                color="green darken-3"
                @click="addTrolley"
                :loading="loading"
            >
                <v-icon>mdi-cart-plus</v-icon>
                Adicionar ao Carrinho
            </v-btn>

            <v-spacer></v-spacer>

            <v-btn
                icon
                @click="show = !show"
            >
                <v-icon>{{ show ? 'mdi-chevron-up' : 'mdi-chevron-down' }}</v-icon>
            </v-btn>
        </v-card-actions>

        <v-expand-transition>
            <div v-show="show">
                <v-divider></v-divider>

                <v-card-text>
                    <span class="text-subtitle-2">Descrição:</span>
                    <p>
                        {{ product.description }}
                    </p>
                </v-card-text>
            </div>
        </v-expand-transition>
    </v-card>
</template>

<script>
import product from "@/Pages/Product";

export default {
    name: "ProductCard",
    props:{
        product:{
            type:Object,
            required:true,
        }
    },
    data: () => ({
        loading:false,
        show: false,
    }),
    methods:{
        addTrolley(){
            this.loading = true
            this.callAddProduct();
        },
        callAddProduct(){
            const _this = this;
            axios.post('/ordereds', {'product':this.product})
                .then(function (response){
                    _this.loading = false;
                    _this.$emit('addProduct',response)
                })
                .catch(function(erro){
                    _this.loading = false;
                    _this.$emit('addProduct',erro)
                })

        }
    }
}
</script>

<style scoped>

</style>
