<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $image;
    protected $icon;

    /**
     * * Stringfy the request->photo to a portable file name tha can de stored on database
     * @method wekapicha
     */
    public function WekaPicha($request, $onPublicPath, string $key){
        if ($key == 'photo'){
            if ($request->file($key)) {
                $imageName = time().'.'.$request->$key->extension();
                $request->$key->move(public_path('images/'.$onPublicPath), $imageName);
                $request->$key = $imageName;
                $this->image = $imageName;
            }
        }
        if ($key == 'icon'){
            if ($request->file($key)) {
                $request->validate([
                    'icon' => 'image|mimes:jpeg,png,jpg,gif,svg',
                ]);
                $imageName = $request->file($key)->store('');
                $request->$key->move(public_path('images/'.$onPublicPath), $imageName);
                $request->$key = $imageName;
                $this->icon = $imageName;
            }
        }


    }
}
