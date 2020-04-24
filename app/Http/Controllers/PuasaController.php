<?php

namespace App\Http\Controllers;

use App\Puasa;
use League\Fractal\Manager;
use Illuminate\Http\Request;
use League\Fractal\Resource\Item;
use App\Transformers\PuasaTransformer;

class PuasaController extends Controller
{
    public function index(Puasa $Puasa)
    {
        return response()->json($Puasa->byTahun()->toArray());
    }

    public function store(Request $request)
    {
        $addPuasa = new Puasa;
        $addPuasa->tkhMula = $request->input("tkhMula");
        $addPuasa->tkhTamat = $request->input("tkhTamat");
        $addPuasa->save();

        $fractal = new Manager;
        $resource = new Item($addPuasa, new PuasaTransformer);
        $transform = $fractal->createData($resource);

        return response()->json($transform->toArray(), 201);
    }
}
