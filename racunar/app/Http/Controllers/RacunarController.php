<?php

namespace App\Http\Controllers;

use App\Http\Resources\RacunarResurs;
use App\Models\Racunar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RacunarController extends ResultController
{
    public function index()
    {
        $racunari = Racunar::all();
        return $this->successed(RacunarResurs::collection($racunari),'Svi racunari');
    }

    public function store(Request $request)
    {
        $input = $request->all();   //save all from request in input

        $validator = Validator::make($input, [
            'proizvodjacID' => 'required',
            'model' => 'required',
            'tipID' => 'required',
            'specifikacija' => 'required',
        ]);

        if ($validator->fails())
            return $this->unsuccessful($validator->errors());

        $novRacunar = Racunar::create($input);

        return $this->successed(new RacunarResurs($novRacunar), 'Uspesno kreiran novi racunar');
    }

    public function show($id)
    {
        $racunar = Racunar::find($id);

        if(is_null($racunar))
            return $this->unsuccessful('Racunar sa trazenim id-em ne postoji');
        
        return $this->successed(new RacunarResurs($racunar),'Racunar nadjen sa trazenim id-em');
        //zasto ne moze konkatenacija, tj. spajanje stringova, da ubacim id u poruku
    }

    public function update(Request $request, $id)
    {
        $stari = Racunar::find($id);

        if(is_null($stari))
            return $this->unsuccessful('Racunar sa trazenim id-em ne postoji');

        $validator = Validator::make($request->all(), [
            'proizvodjacID' => 'required',
            'model' => 'required',
            'tipID' => 'required',
            'specifikacija' => 'required',
        ]);

        if ($validator->fails())
            return $this->unsuccessful($validator->errors());

        $input = $request->all();

        $stari->proizvodjacID = $input['proizvodjacID'];
        $stari->model = $input['model'];
        $stari->tipID = $input['tipID'];
        $stari->specifikacija = $input['specifikacija'];
        
        $stari->save();

        return $this->successed(new RacunarResurs($stari), 'Uspesno azuriran racunar ' + $id);
    }

    public function destroy($id)
    {
        $racunar = Racunar::find($id);

        if(is_null($racunar))
            return $this->unsuccessful('Racunar sa trazenim id-em ne postoji');
        
        $racunar->delete();

        return $this->successed([],'Uspesno obrisan racunar');
    }
}
