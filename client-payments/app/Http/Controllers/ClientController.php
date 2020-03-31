<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use Illuminate\Support\Facades\Log;

class ClientController extends Controller
{
    public function store(Request $request)
    {

        $client = new Client();
        $client->email = $request->email;

        $now = new \DateTime();
        $now->format('Y-m-d');
        $client->join_date = $now;



        $client->save();

        #Example of Log message. Look the file /app/storage/laravel.log
        Log::info($client);
    }

    public function list()
    {

        $clients = Client::select('clients.id', 'clients.email', 'clients.join_date')->orderBy('clients.id', 'desc')->get();
        return [
            'clients' => $clients
        ];
    }
}
