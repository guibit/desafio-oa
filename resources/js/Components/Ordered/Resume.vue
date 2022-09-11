<template>
    <v-dialog
        v-model="dialog"
        fullscreen
        width="500"
    >
        <v-card>
            <v-toolbar
                dark
                color="#323D63"
            >
                <v-btn
                    icon
                    dark
                    @click="$emit('closeDialog')"
                >
                    <v-icon>mdi-close</v-icon>
                </v-btn>
                <v-toolbar-title>Resumo do pedido</v-toolbar-title>

            </v-toolbar>

            <v-container class="mt-8" fluid>
                <v-data-table
                    class=""
                    :headers="headers"
                    :items="ordered.product"
                    no-data-text="Nenhum produto adicionado."
                    hide-default-footer
                    :items-per-page="-1"
                >
                    <!--INPUT  QUANTIDADE -->
                    <template v-slot:item.amount="{ item }">
                        <v-col cols="12" md="4" offset-md="4" class="d-flex justify-center">
                            {{item.pivot.quantity}}
                        </v-col>
                    </template>
                    <!-- VALOR UNITARIO -->
                    <template v-slot:item.price="{ item }">
                        R$: {{item.price}}
                    </template>
                    <!--  VALOR TOTAL -->
                    <template v-slot:item.total_value="{ item }">
                        R$:
                        {{ item.pivot.quantity * item.price }}
                    </template>
                    <!-- REMOVER-->
                    <template v-slot:item.action="{ item }">
                        <v-btn
                            @click="removeProcut(item)"
                            :loading="loading"
                        >
                            <v-icon>mdi-trash-can-outline</v-icon>
                        </v-btn>
                    </template>
                </v-data-table>
                <v-divider></v-divider>

                <v-card-actions class="mt-3 d-flex justify-center">
                    <strong>
                        Valor Total - R$: {{ordered.price}}
                    </strong>
                </v-card-actions>

                <v-textarea
                    v-model="ordered.note"
                    readonly
                    label="Observações"
                    full-width
                >
                </v-textarea>
            </v-container>
        </v-card>
    </v-dialog>

</template>

<script>
export default {
    name: "Resume",
    props:{
        dialog:Boolean,
        ordered:Object,
    },
    data(){
        return{
            headers: [
                { text: 'Produto', value: 'name'},
                { text: 'Quantidade', value: 'amount' ,align:"center"},
                { text: 'Categoria', value: 'category'},
                { text: 'Valor', value: 'price' },
                { text: 'Valor Total', value: 'total_value' },
            ],
        }
    }
}
</script>

<style scoped>

</style>
