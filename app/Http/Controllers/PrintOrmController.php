<?php
namespace App\Http\Controllers;

use App\Models\Orm;
use App\Models\DetOrm;
use Illuminate\Support\Facades\DB;

class PrintOrmController extends Controller
{
    public function print($id)
    {
        $orm = Orm::where("orm", $id)->with(['cdcRel', 'adnRel', 'sitioRel', 'responsableRel', 'compradorRel','detormRel'])->first();
        $detalles = DetOrm::where('orm', $id)->get();
        
        if (!$orm) {
            abort(404, 'ORM no encontrado');
        }        
        
        return view('pages.acquisitions.print-orm', compact('orm', 'detalles'));
    }
}