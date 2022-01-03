<?php

namespace App\Http\Controllers;

use App\Models\Plantilla;
use Illuminate\Http\Request;

class TemplateController extends Controller
{

    public function getTemplate($id)
    {
        $template = Plantilla::find($id);
        return response()->json($template, 200);
    }

    public function deleteTemplate($id)
    {
        $template = Plantilla::find($id);
        $template->delete();
        return response(true, 200);
    }
}
