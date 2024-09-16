<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageContoller extends Controller
{
    public function ImageCreate()
    {
        return view('backend.pages.image.cropImage');
    }

    public function ImageCropAndStore(Request $request)
    {
        $image = $request->image;

        list($type, $image) = explode(';', $image);
        list(, $image)      = explode(',', $image);

        $image = base64_decode($image);
        $image_name = time() . '.png';
        $path = public_path('image/' . $image_name);

        file_put_contents($path, $image);

        return response()->json(['status' => true]);
    }

    public function ResizeImageCreate()
    {
        return view('backend.pages.image.resizeImage');
    }

    public function ResizeImageStore()
    {
        $data = $_POST['image'];
        $image_array_1 = explode(";", $data);
        $image_array_2 = explode(",", $image_array_1[1]);
        $data = base64_decode($image_array_2[1]);
        $image_name = time() . '.png';
        $path = public_path('image/' . $image_name);
        file_put_contents($path, $data);
        echo $image_name;
    }
}
