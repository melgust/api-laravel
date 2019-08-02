<?php

namespace App\Http\Controllers;

use App\Model\Provider;
use App\Model\Product;
use Illuminate\Http\Request;
use Validator;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Provider::all();
        return response()->json([
            "ok" => true,
            "data" => $list,
        ]);
    }

    /**
     * Display the specified resource with your products.
     *
     * @return \Illuminate\Http\Response
     */
    public function products($id)
    {
        try {
            $row = Provider::find($id);
            $list = Product::select("tc_product.*")
                ->join("tc_provider", "tc_product.provider_id", "=", "tc_provider.provider_id")
                ->get();
            $row["products"] = $list;
            return response()->json([
                "ok" => true,
                "data" => $row
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                "ok" => false,
                "error" => $ex->getMessage(),
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function create()
    {
        //
    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'provider_name' => 'required|unique:tc_provider|max:250'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'error' => $validator->messages(),
            ]);
        }
        try {
            Provider::create($input);
            return response()->json([
                "ok" => true,
                "mensaje" => "Registro agregado con exito"
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                "ok" => false,
                "error" => $ex->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = Provider::find($id);
        return response()->json([
            "ok" => true,
            "data" => $row,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    /*public function edit(Provider $provider)
    {
        //
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'provider_name' => 'required|max:250'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'ok' => false,
                'error' => $validator->messages(),
            ]);
        }
        try {
            $provider = Provider::find($id);
            if ($provider == false) {
                return response()->json([
                    "ok" => false,
                    "error" => "El providero indicado no existe, no se puede actualizar",
                ]);
            }
            $provider->update($input);
            return response()->json([
                "ok" => true,
                "mensaje" => "Actualizacion realizada con exito",
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                "ok" => false,
                "error" => $ex->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $provider = Provider::find($id);
            if ($provider == false) {
                return response()->json([
                    "ok" => false,
                    "error" => "No se encontro",
                ]);
            }
            $provider->update([
                'estado' => $provider->estado == 1 ? 0 : 1,
            ]);
            return response()->json([
                "ok" => true,
                "mensaje" => "Actualizacion con exito",
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                "ok" => false,
                "error" => $ex->getMessage(),
            ]);
        }
    }
}
