<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Grupoempresa;
use App\Models\Plantilla;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use ZipArchive;
use DOMDocument;

class TemplateListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user_type = Session::get('type');
        $id = Session::get('id');
        $templates = Plantilla::all();

        $title = 'Asesor';
        if($user_type == 'estudiante')
        {
            $row = Estudiante::where('user_id',$id)->first();
            $ge_id = $row->grupoempresa_id;
            if($ge_id == null)
            {
                $title = '[Sin grupo empresa]';
            }
            else
            {
                $row = Grupoempresa::where('id',$ge_id)->first();
                $title = $row->nombre_largo;
            }
        }
        return view('template',['user_type' => $user_type, 'title' => $title, 'template_list' => $templates]);
    }

    private function readDocx($filePath)
    {
        // Create new ZIP archive
        $zip = new ZipArchive;
        $dataFile = 'word/document.xml';
        // Open received archive file
        if (true === $zip->open($filePath))
        {
            // If done, search for the data file in the archive
            if (($index = $zip->locateName($dataFile)) !== false)
            {
                // If found, read it to the string
                $data = $zip->getFromIndex($index);
                // Close archive file
                $zip->close();
                // Load XML from a string
                // Skip errors and warnings
                $xml = new DOMDocument("1.0", "utf-8");
                $xml->loadXML($data, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING|LIBXML_PARSEHUGE);
                $xml->encoding = "utf-8";
                // Return data without XML formatting tags
                $output =  $xml->saveXML();
                $output = str_replace("w:","",$output);

                return $output;
            }
            $zip->close();
        }
        // In case of failure return empty string
        return "";
    }

    public function uploadFile()
    {
        if (isset($_FILES['docfile']))
        {
            if ( $_FILES['docfile']['error'] === UPLOAD_ERR_OK )
            {
                $content = $this->readDocx($_FILES['docfile']['tmp_name']);
                if ( strlen($content) > 0 )
                {
                    $name = $this->uniqueName($_FILES['docfile']['name']);
                    $id = $this->uploadDataBase($name, $content);
                    if ($id !== -1)
                    {
                        return redirect(route('template-editor-id',['id' => $id]));
                    }
                }
                else
                {
                    return 'archivo corrupto';
                }
            }
        }
        return 'hubo un error';
    }

    private function uniqueName($name)
    {
        $newname = str_replace(".docx", "", $name);
        if (Plantilla::where('nombre',$newname)->count() > 0)
        {
            $num = 1;
            $incrementalname = $newname . '(1)';
            while (Plantilla::where('nombre',$incrementalname)->count() > 0)
            {
                $num++;
                $incrementalname = $newname . '(' . $num . ')';
            }
            return $incrementalname;
        }
        return $newname;
    }

    private function uploadDataBase($name, $content)
    {
        $template = new Plantilla();
        $template->nombre = $name;
        $template->html_code = $content;
        if ( $template->save() ) {
            $id = $template->id;
        } else {
            $id = -1;
        }
        return $id;
    }


}
