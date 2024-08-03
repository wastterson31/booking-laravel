<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ApiController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'http://127.0.0.1:5000']);
    }

    public function getResource()
    {
        $response = $this->client->get('/api/v1/resource');
        $data = json_decode($response->getBody(), true);
        return response()->json($data);
    }

    public function createResource(Request $request)
    {
        $response = $this->client->post('/api/v1/resource', [
            'json' => [
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'stock' => $request->input('stock')
            ]
        ]);
        $data = json_decode($response->getBody(), true);
        return response()->json($data, $response->getStatusCode());
    }
}
