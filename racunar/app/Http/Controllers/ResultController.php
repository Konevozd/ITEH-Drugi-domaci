<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function successed($podaci, $poruka)
    {
        $response = [
            'uspesno' => true,
            'podaci' => $podaci,
            'poruka' => $poruka
        ];

        return response()->json($response, 200);
    }

    public function unsuccessful($greska, $nizGresaka = [], $code = 404)
    {
        $response = [
            'uspesno' => false,
            'poruka' => $greska,
        ];

        if(!empty($nizGresaka))
            $response['podaci'] = $nizGresaka;
        
        return response()->json($response, $code);
    }

}
