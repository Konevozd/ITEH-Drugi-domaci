<?php

namespace App\Http\Controllers;

use App\Http\Resources\TipResurs;
use App\Models\Tip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TipController extends ResultController
{
    public function index()
    {
        $tipovi = Tip::all();
        // return TipResurs::collection($tipovi);
        return $this->successed(TipResurs::collection($tipovi),'Svi tipovi');
    }

    public function store(Request $request)
    {
        $input = $request->all();   //save all from request in input

        $validator = Validator::make($input, [
            'tip' => 'required|string|max:100',
        ]);

        if ($validator->fails())
            return $this->unsuccessful($validator->errors());

        $novTip = Tip::create($input);

        return $this->successed(new TipResurs($novTip), 'Uspesno kreiran novi tip');
    }

    public function show($tipID)
    {
        $tip = Tip::find($tipID);

        if(is_null($tip))
            return $this->unsuccessful('Tip sa trazenim id-em ne postoji');
        
        return $this->successed(new TipResurs($tip),'Tip sa trazenim id-em ');
    }

    public function update(Request $request, $id)
    {
        $stari = Tip::find($id);

        if(is_null($stari))
            return $this->unsuccessful('Tip sa id:' + $id + ' ne postoji');

        $validator = Validator::make($request->all(), [
            'tip' => 'required|string|max:100',
        ]);

        if ($validator->fails())
            return $this->unsuccessful($validator->errors());

        $input = $request->all();

        $stari->tip = $input['tip'];
        
        $stari->save();

        return $this->successed(new TipResurs($stari), 'Uspesno azuriran tip');
    }

    public function destroy($id)
    {
        $tip = Tip::find($id);

        if(is_null($tip))
            return $this->unsuccessful('Tip sa id: ' + $id + ' ne postoji');
        
        $tip->delete();

        return $this->successed([],'Uspesno obrisan tip');
    }
}
