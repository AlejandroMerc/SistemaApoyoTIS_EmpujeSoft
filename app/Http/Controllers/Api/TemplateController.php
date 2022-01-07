<?php

namespace App\Http\Controllers\Api;

use App\Models\Plantilla;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
