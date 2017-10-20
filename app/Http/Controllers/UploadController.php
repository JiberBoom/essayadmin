<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use YuanChao\Editor\EndaEditor;

class UploadController extends Controller
{
    public function uploadeditor()
    {
        $data = EndaEditor::uploadImgFile('storage/uploads/editor');//试了好几遍才合适，坑

        return json_encode($data);
    }
}
