<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class PotatoDiseaseController extends Controller
{
    public function detect(Request $request)
    {
        
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        $client = new Client();
        $response = $client->post('http://127.0.0.1:5000/inference', [
            'multipart' => [
                [
                    'name'     => 'image',
                    'contents' => fopen($request->file('image')->getPathname(), 'r'),
                    'filename' => $request->file('image')->getClientOriginalName(),
                ],
            ],
        ]);
    
        $result = json_decode($response->getBody()->getContents(), true);

        
        $imageUrl = $result['image_url'];
        $detections = $result['detections'];
    
        return view('public.potatodisease_result', [
            'detections' => $detections,
            'image_url' => $imageUrl,
        ]);
    }
}
