<template>
    <app-layout>
        <toolbar-title text="Meus Pedidos"/>
        <v-container class="ml-16 mt-8" fluid>
            <v-data-table
                :items="ordereds"
                :headers="header"
                @click:row="openOrdered"
                no-data-text="Nenhum pedido adicionado."
                hide-default-footer
                :items-per-page="-1"
            >
                <template v-slot:item.price="{item}">
                    R$: {{ item.price}}
                </template>
                <template v-slot:item.win="{item}">
                    <span v-if="item.win">
                        Pedido fechado
                    </span>
                    <span v-else>
                        Pedido aberto
                    </span>
                </template>

            </v-data-table>

            <Resume
                v-if="ordered"
                @closeDialog="closeDialog"
                :dialog="dialog"
                :ordered="ordered"
            />
        </v-container>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import ToolbarTitle from "@/Components/ToolbarTitle";
import Resume from "@/Components/Ordered/Resume";
export default {
    name: "MyOrdereds",
    components: {Resume, ToolbarTitle, AppLayout},
    props:{
        ordereds:Array,
    },
    data(){
        return {
            header:[
                { text:"Código", value:"id"},
                { text:"Valor total do pedido", value:"price"},
                { text:"Fechado", value:"win"},
            ],
            dialog:false,
            products:[],
            ordered:null,
        }
    },
    methods:{
        openOrdered(item){
            this.ordered = item;
            this.dialog = true;

        },
        closeDialog(){
            this.dialog = false;
            this.ordered = null;
        }
    }
}
</script>

<style scoped>

</style>
