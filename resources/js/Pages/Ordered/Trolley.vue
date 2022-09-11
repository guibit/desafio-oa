<template>
    <app-layout>
        <toolbar-title text="Meu carrinho"/>
        <span v-if="!products" class="d-flex justify-center mt-16">
                Nenhum produto adicionado ao carrinho.
        </span>
        <v-container class="ml-16 mt-8" fluid>
            <v-data-table
                class=""
                :headers="headers"
                :items="products"
                no-data-text="Nenhum produto adicionado."
                hide-default-footer
                :items-per-page="-1"
            >
                <!--INPUT  QUANTIDADE -->
                <template v-slot:item.amount="{ item }">
                    <v-col cols="12" md="4" offset-md="4" class="d-flex justify-center">
                        <v-text-field
                            class="mt-4 shrink "
                            label="Qnt"
                            v-model="item.quantity"
                            :value="1"
                            min="1"
                            :max="item.amount"
                            solo
                            dense
                            hide-details
                            suffix="UN."
                            type="number"
                        >
                        </v-text-field>
                    </v-col>
                    <span class="d-flex justify-center m-3">
                        Quantidade Disponível: {{item.amount}}
                    </span>
                </template>
                <!-- VALOR UNITARIO -->
                <template v-slot:item.price="{ item }">
                    R$: {{item.price}}
                </template>
                <!--  VALOR TOTAL -->
                <template v-slot:item.total_value="{ item }">
                    R$:
                    {{ item.quantity * item.price }}
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

            <v-textarea
                v-model="note"
                label="Observações"
                full-width
            >
            </v-textarea>

            <v-row class="d-flex justify-center">
                <v-btn
                    class="mt-16"
                    dark
                    color="#323d63"
                    @click="submit"

                >
                    Finalizar Pedido
                </v-btn>
            </v-row>
        </v-container>
        <snack
            :snack-color="snackColor"
            :snackbar="snackbar"
            :text="text"
        />

    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import ToolbarTitle from "@/Components/ToolbarTitle";
export default {
    name: "Trolley",
    components: {ToolbarTitle, AppLayout},
    props:{
        products: {
            type:Array,
            required:false,
            default:null
        },
        ordered_id:Number,
    },
    data(){
        return{
            headers: [
                { text: 'Produto', value: 'name'},
                { text: 'Quantidade', value: 'amount' ,align:"center"},
                { text: 'Categoria', value: 'category'},
                { text: 'Valor', value: 'price' },
                { text: 'Valor Total', value: 'total_value' },
                { text: 'Remover', value:'action'}
            ],
            loading:false,
            snackbar:false,
            snackColor:'red',
            text:'',
            note:'',

        }
    },
    methods:{
        removeProcut(item){
            this.loading = true;
            const _this =this;
            axios.put(this.route('ordereds.update', {'id': this.ordered_id}),{
                'product':item
            })
                .then(function (response){
                    _this.products = _this.products.filter(e=>e.id !== item.id)
                    _this.loading = false;
                })
                .catch(function(erro){
                    _this.snackbar = true;
                    _this.text = erro;
                    _this.loading = false;
                })
        },
        callProcut(){
            for(let i=0; i<this.products.length ;i++ ){
                this.$set(this.products[i], 'quantity', 1)
            }
        },
        submit(){
            this.$inertia.post('/trolley',{
                'products':this.products,
                'ordered_id':this.ordered_id,
                'note':this.note,
            })

        }
    },
    mounted() {
        this.callProcut();
    }
}
</script>

<style scoped>

</style>
