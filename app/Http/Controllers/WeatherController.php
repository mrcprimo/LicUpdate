<?php

namespace App\Http\Controllers;
use App\Services\FirebaseService;

class WeatherController extends Controller
{
    protected $firebase;

    public function __construct(FirebaseService $firebase)
    {
        $this->firebase = $firebase->getDatabase();
    }

    public function store()
    {
        $newPost = $this->firebase
            ->getReference('Weather_history')
            ->push([
                'title' => 'Hello Firebase',
                'body' => 'This is synced from Laravel!',
            ]);

        return response()->json($newPost->getValue());
    }

    public function index()
    {
        $data = $this->firebase->getReference('Weather_history')->getValue();
        return response()->json($data);
    }
}
