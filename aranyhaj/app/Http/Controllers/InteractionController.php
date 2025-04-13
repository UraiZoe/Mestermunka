<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Interaction;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class InteractionController extends Controller
{
    // Eseményhez való részvétel
    public function userParticipates()
    {
        // Lekérjük a felhasználó eseményeit
        $events = Auth::user()->interactions()->with('event.likes')->where('participation', 1)->get();

        // Frissítjük az események like számait
        foreach ($events as $interaction) {
            $interaction->event->likes_count = $interaction->event->likes->count();
        }

        return view('participates', compact('events'));
    }

    public function participateEvent(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
        ]);

        $interaction = Interaction::where('user_id', Auth::id())
            ->where('event_id', $request->event_id)
            ->first();

        // Ha létezik, és már lájkolta, akkor eltávolítjuk a lájkot
        if ($interaction) {
            if ($interaction->participation) {
                $interaction->participation = 0;
                $interaction->updated_at = now();
            } else {
                $interaction->participation = 1;
                $interaction->updated_at = now();
            }
            $interaction->save();
        } else {
            Interaction::create([
                'user_id' => Auth::id(),
                'event_id' => $request->event_id,
                'participation' => 1,
                'updated_at' => now(),
            ]);
        }

        return redirect()->back()->with('success', 'Sikeres művelet!');
    }
    // Esemény lájkolása
    public function likeEvent(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
        ]);

        $interaction = Interaction::where('user_id', Auth::id())
            ->where('event_id', $request->event_id)
            ->first();

        // Ha létezik, és már lájkolta, akkor eltávolítjuk a lájkot
        if ($interaction) {
            if ($interaction->liked) {
                $interaction->liked = 0;
                $interaction->updated_at = now();
            } else {
                $interaction->liked = 1;
                $interaction->updated_at = now();
            }
            $interaction->save();
        } else {
            Interaction::create([
                'user_id' => Auth::id(),
                'event_id' => $request->event_id,
                'liked' => 1,
                'updated_at' => now(),
            ]);
        }

        return redirect()->back()->with('success', 'Sikeres művelet!');
    }
}
