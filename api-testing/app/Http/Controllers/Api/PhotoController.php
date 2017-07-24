<?php

use Illuminate\Routing\Controller;

class PhotoContoller extends Controller
{
    public function index()
    {
        $photos = Auth::user()->photos();
        $photos = $this->applyOptions($photos);

        return response()->json([
            'error' => false,
            'photos' => $photos->get()
        ], 200);
    }

    public function applyOptions($photos)
    {
        if($limit = Request::get('limit'))
            $photos->take($limit);
        return $photos;
    }
}
