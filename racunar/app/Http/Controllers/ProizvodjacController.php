<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProizvodjacResurs;
use App\Models\Proizvodjac;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProizvodjacController extends ResultController
{
    public function index()
    {
        $proizvodjaci = Proizvodjac::all();
        return $this->successed(ProizvodjacResurs::collection($proizvodjaci),'Svi proizvodjaci');
    }

    public function store(Request $request)
    {
        $input = $request->all();   //save all from request in input

        $validator = Validator::make($input, [
            'proizvodjac' => 'required|string|max:100',
        ]);

        if ($validator->fails())
            return $this->unsuccessful($validator->errors());

        $novProizvodjac = Proizvodjac::create($input);

        return $this->successed(new ProizvodjacResurs($novProizvodjac), 'Uspesno kreiran novi racunarski proizvodjac');
    }

    public function show($id)
    {
        $proizvodjac = Proizvodjac::find($id);

        if(is_null($proizvodjac))
            return $this->unsuccessful('Proizvodjac sa trazenim id-em ne postoji');
        
        return $this->successed(new ProizvodjacResurs($proizvodjac),'Proizvodjac sa trazenim id-em');
    }

    public function update(Request $request, $id)
    {
        $stari = Proizvodjac::find($id);

        if(is_null($stari))
            return $this->unsuccessful('Proizvodjac sa trazenim id-em ne postoji');

        $validator = Validator::make($request->all(), [
            'proizvodjac' => 'required|string|max:100',
        ]);

        if ($validator->fails())
            return $this->unsuccessful($validator->errors());

        $input = $request->all();

        $stari->proizvodjac = $input['proizvodjac'];
        
        $stari->save();

        return $this->successed(new ProizvodjacResurs($stari), 'Uspesno azuriran proizvodjac ' + $id);
    }

    public function destroy($id)
    {
        $proizvodjac = Proizvodjac::find($id);

        if(is_null($proizvodjac))
            return $this->unsuccessful('Proizvodjac sa trazenim id-em ne postoji');
        
        $proizvodjac->delete();

        return $this->successed([],'Uspesno obrisan proizvodjac');
    }
}
