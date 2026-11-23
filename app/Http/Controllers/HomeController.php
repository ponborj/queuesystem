<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display the main page.
     */
    public function index()
    {
        // obter lista de filas ativas para empresa do usuario logado
        $queues = $this->getQueuesList();

        $data = [
            'subtitle' => 'Home',
            'queues' => $queues,
        ];

        return view('home', $data);
    }

    public function getQueuesList()
    {
        return Queue::where('id_company', Auth::user()->id_company)
            ->where('active', true)
            ->withCount('tickets') // contando o número de tickets para cada fila
            ->get()->sortBy('name');
    }
}
