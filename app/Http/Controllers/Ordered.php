<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\OrderedRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class Ordered extends Controller
{
    /**
     * @return \Inertia\Response
     */
    public function index(UserRepositoryInterface $repository)
    {
        $user = Auth::user();
        $ordereds = $user->ordereds()->with('product')->get();


        return Inertia::render('Ordered/MyOrdereds',[
            'ordereds'=> $ordereds,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * Adiciona o produto a um pedido aberto
     * Se não tem produto aberto, então cria
     */
    public function store(Request $request)
    {
        $product = $request->product;
        $id = Auth::user()->id;

        $ordered = \App\Models\Ordered::firstOrNew([
            'user_id'=>$id,
            'win'=>null
        ]);
        $ordered->save();
        $ordered->product()->attach($product["id"]);

        return response('ok',200);
    }

    /**
     * Display the specified resource.
     *
     * @return \Inertia\Response
     * Mostrar o carrinho.
     * Pegar o pedido aberto e seus produtos
     */
    public function show(OrderedRepositoryInterface $model)
    {
        $id = Auth::user()->id;
        $ordered = $model->findOneBy([
            'user_id'=>$id,
            'win'=>null,
        ]);
        $product = null;
        $ordered_id = null;

        if($ordered !== null){
            $product = $ordered->product;
            $ordered_id = $ordered->id;
        }

        return Inertia::render('Ordered/Trolley',[
            'products'=>$product,
            'ordered_id'=>$ordered_id
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * Desanexar o produto do pedido
     */
    public function update(Request $request, $id,OrderedRepositoryInterface $model)
    {
        $ordered = $model->find($id);
        $product_id = $request->product['id'];

        $ordered->product()->detach($product_id);
        return response($ordered->product,200);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * Calcular a quantidade de produto restante
     * Salvar o pedido
     */
    public function save(Request $request, OrderedRepositoryInterface $ordered_repository, ProductRepositoryInterface $product_repository)
    {
        $price = 0 ;
        $ordered = $ordered_repository->find($request->ordered_id);
        $ordered->note = $request->note;

        foreach ($request->products as $product_request){

            $product = $product_repository->find($product_request["id"]);
            $product->amount -= $product_request["quantity"];
            $product->save();

            $pivot = $ordered->product->find($product_request["id"])->pivot;
            $pivot->quantity = $product_request["quantity"];
            $pivot->save();

            $price += $product_request["price"]*$product_request["quantity"];

        }

        $ordered->price = $price;
        $ordered->win = true;
        $ordered->save();

        return Redirect::route('ordereds.index');
    }
}
