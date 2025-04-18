<?php

namespace App\Http\Controllers;

use App\Mail\WarningMail;
use App\Services\FirebaseService;
use Illuminate\Support\Facades\Mail;

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

    public function latest_threshold()
    {
        $latestRecord = $this->firebase
            ->getReference('Weather_history')
            ->orderByKey()           // Or orderByChild('timestamp') if you're using timestamps
            ->limitToLast(1)
            ->getValue();

        return $latestRecord;
    }

    public function index()
    {
        $data = $this->firebase->getReference('Weather_history')->getValue();
        return response()->json($data);
    }
}
