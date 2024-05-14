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
            $response = $this->client->request('GET', 'pet/findByStatus?status=available,pending,sold');
            $pets = json_decode($response->getBody()->getContents(), true);
            usort($pets, function($a, $b) {
                return $a['id'] <=> $b['id'];
            });

            return view('pets.index', compact('pets'));
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
                'photoUrls' => [$request->photoUrls],
                'status' => $request->status
            ];

            $response = $this->client->request('POST', 'pet', [
                'json' => $postData  // Dane przesyłane jako JSON
            ]);

            if ($response->getStatusCode() == 200) {
                return redirect()->route('pets.index')->with('success', 'Zwierzak dodany!');
            } else {
                return back()->withError('Nie udało się dodać zwierzaka')->withInput();
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
        \Log::info('Update data:', $request->all());
        try {
            $updateData = [
                'id' => $id,
                'name' => $request->name,
                'photoUrls' => [$request->photoUrls],
                'status' => $request->status
            ];

            $response = $this->client->request('PUT', "pet", [
                'json' => $updateData
            ]);
            \Log::info('API Response:', [
                'status' => $response->getStatusCode(),
                'body' => $response->getBody()->getContents()
            ]);

            if ($response->getStatusCode() == 200) {
                return redirect()->route('pets.index')->with('success', 'Dane zaktualizowano');
            } else {
                return back()->withError('nie udało się zaktualizować danych')->withInput();
            }
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }
    }
    public function show($id)
    {
        try {
            $response = $this->client->request('GET', "pet/{$id}");
            $pet = json_decode($response->getBody()->getContents(), true);

            return view('pets.show', compact('pet'));
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
