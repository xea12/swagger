<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;

class PetController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'https://petstore.swagger.io/v2/']);
    }

    public function index()
    {
        try {
            $response = $this->client->request('GET', 'pet/findByStatus?status=available');
            $pets = json_decode($response->getBody()->getContents(), true); // Dekoduj bezpośrednio jako tablicę
            usort($pets, function($a, $b) {
                return $a['id'] <=> $b['id'];  // Sortuj malejąco
            });

            return view('pets.index', compact('pets')); // Zmień 'dataArray' na 'pets' dla spójności
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }
    }
    public function store(Request $request)
    {
        try {
            $postData = [
                'id' => $request->id,
                'name' => $request->name,
                'photoUrls' => [$request->photoUrls],  // Zakładając, że 'photoUrls' jest pojedynczym URL jako string
                'status' => $request->status  // 'available', 'pending', 'sold'
            ];

            $response = $this->client->request('POST', 'pet', [
                'json' => $postData  // Dane przesyłane jako JSON
            ]);

            if ($response->getStatusCode() == 200) {
                return redirect()->route('pets.index')->with('success', 'Pet added successfully!');
            } else {
                return back()->withError('Failed to add pet')->withInput();
            }
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }
    }

    public function create()
    {
        return view('pets.create');
    }

    public function edit($id)
    {
        try {
            $response = $this->client->request('GET', "pet/{$id}");
            $pet = json_decode($response->getBody()->getContents(), true);

            return view('pets.edit', compact('pet'));
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $updateData = [
                'id' => $id,
                'name' => $request->name,
                'photoUrls' => [$request->photoUrls],
                'status' => $request->status
            ];

            $response = $this->client->request('PUT', "pet/{$id}", [
                'json' => $updateData
            ]);

            return redirect()->route('pets.index')->with('success', 'Pet updated successfully!');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }
    }


    public function destroy($id)
    {
        $response = $this->client->request('DELETE', "pet/{$id}");
        return redirect()->route('pets.index');
    }
}
