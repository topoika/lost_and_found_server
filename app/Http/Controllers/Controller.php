<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function get_users()
    {
        # code...
        $data = User::all()->makeHidden(["api_token"]);
        return response()->json($data);
    }
    public function get_user($id)
    {
        $data = User::find($id)->makeHidden(["api_token"]);
        return $data;
    }
}