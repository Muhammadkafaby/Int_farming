<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class chatbotController extends Controller
{
    public function uploads(Request $request)
    {
        
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048',
            'confirmation' => 'required|in:Saya mengerti akan risiko tersebut',
        ]);
    
        $client = new Client();
        $response = $client->post('http://127.0.0.1:11436/upload', [
            'multipart' => [
                [
                    'name'     => 'file',
                    'contents' => fopen($request->file('file')->getPathname(), 'r'),
                    'filename' => $request->file('file')->getClientOriginalName(),
                ],
            ],
        ]);
    
        $result = json_decode($response->getBody()->getContents(), true);
        $msg = $result['message'] ?? 'Upload berhasil.';
        $file_name = $result['filename'] ?? null;
        
        return redirect()->route('chatbot_upload')->with([
            'message' => $msg,
            'file_name' => $file_name,
        ]);
    }    

    public function ask(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
        ]);

        $client = new Client();
        $response = $client->post('http://127.0.0.1:11436/ask_pdf', [
            'json' => [
                'query' => $request->question,
            ],
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        $answer = $result['answer'];

        return response()->json([
            'answer' => $answer,
        ]);
    }
}
