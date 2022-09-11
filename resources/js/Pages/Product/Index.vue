<template>
    <app-layout>
        <toolbar-title text="Selecionar Produtos"/>

        <div class="ml-16 mt-8">
            <v-row>
                <v-col
                    cols="12"
                    sm="6"
                    md="4"
                    lg="3"
                    v-for="product in products"
                    :key="product.id"
                    v-if="product.amount > 0"
                >
                    <product-card
                        :product="product"
                        @addProduct="addProduct"
                    >
                    </product-card>
                </v-col>
            </v-row>
        </div>

        <snack
            :snack-color="snackColor"
            :snackbar="snackbar"
            :text="text"
        ></snack>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import ProductCard from "@/Components/Product/ProductCard";
import ToolbarTitle from "@/Components/ToolbarTitle";
import Snack from "@/Components/Snack";
export default {
    name: "Index",
    components: {
        Snack,
        ToolbarTitle,
        ProductCard,
        AppLayout
    },
    props:{
        products:{
            type:Array,
            required:false,
            default:null,
        },
    },
    data: () => ({
        snackbar: false,
        text: '',
        snackColor:'red',
    }),
    methods:{
        addProduct(response){
            if(response.status === 200){
                this.text =  'Produto adicionado com sucesso!';
                this.snackColor = `#3E8742`;
            }else{
                this.text =  response;
                this.snackColor = 'red';
            }
            this.snackbar = true;

        }

    }
}
</script>

<style scoped>

</style>
