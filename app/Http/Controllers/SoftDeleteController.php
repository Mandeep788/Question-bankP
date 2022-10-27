<?php

namespace App\Http\Controllers;
use App\Models\Block;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SoftDeleteController extends Controller
{

    public function destroy($id)
    {
        Block::find($id)->delete();
        return redirect()->back();
    }

    public function restore($id)
    {
        Block::onlyTrashed()->find($id)->restore();
        return redirect()->back();
    }
}
