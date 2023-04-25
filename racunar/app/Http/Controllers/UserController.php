<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends ResultController
{
    public function prijava(Request $request)
    {
        $uspesno = Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        if($uspesno){
            $authUser = Auth::user(); //logged user
            $odgovor['name'] =  $authUser->name;
            $odgovor['token'] =  $authUser->createToken('Token')->plainTextToken;

            return $this->successed($odgovor, 'Uspesno ste se logovali. ');
        }
        else{
            return $this->unsuccessful('Autentifikacija neuspesna.', ['error'=>'Greska pri podacima za logovanje']);
        }
    }

    public function registracija(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',    //dont repeat
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return $this->unsuccessful('Greska pri validaciji', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $odgovor['name'] =  $user->name;

        return $this->successed($odgovor, 'Uspesno napravljen korisnik.');
    }
}
