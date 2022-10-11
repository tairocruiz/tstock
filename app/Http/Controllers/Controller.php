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

    /**
     * * Stringfy the request->photo to a portable file name tha can de stored on database
     * @method wekapicha
     */
    public function WekaPicha($request, $onPublicPath, string $key = 'photo'){
        if ($request->file($key)) {
            //is_file()
            /*$request->validate([
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);*/

            $imageName = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('images/'.$onPublicPath), $imageName);
            $request->photo = $imageName;
            $this->image = $imageName;

        }
    }
}
