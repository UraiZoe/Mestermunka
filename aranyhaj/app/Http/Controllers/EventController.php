<?php
namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Események adatainak betöltése
    public function showEventsDatas()
    {
        $events = Event::withCount([
            'likes as likes_count',
            'participants as participants_count'
        ])->get();

        return view('events', compact('events'));
    }

    // Egy esemény részletes megjelenítése
    public function show($id)
    {
        $event = Event::withCount([
            'likes as likes_count',
            'participants as participants_count'
        ])->findOrFail($id);

        return view('events.program', compact('event'));
    }

    // Like egy eseményre
    public function likeEvent(Request $request)
    {
        $event = Event::find($request->event_id);
        if ($event) {
            // Vagy logikát alkalmazhatsz, pl. új "like" rekordot hozol létre, ha nem akarod közvetlenül módosítani a likes_count-t
            $event->likes_count += 1;
            $event->save();

            return response()->json([
                'status' => 'success',
                'likes_count' => $event->likes_count
            ]);
        }

        return response()->json(['status' => 'error', 'message' => 'Esemény nem található.'], 404);
    }

    // Résztvevőként való regisztrálás egy eseményhez
    public function participateEvent(Request $request)
    {
        $event = Event::find($request->event_id);
        if ($event) {
            $event->participants_count += 1;
            $event->save();

            return response()->json([
                'status' => 'success',
                'participants_count' => $event->participants_count
            ]);
        }

        return response()->json(['status' => 'error', 'message' => 'Esemény nem található.'], 404);
    }

    // Esemény létrehozása
    public function create()
    {
        return view('events.create');
    }

    // Esemény mentése
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:50',
            'location' => 'nullable|string|max:150',
            'short_information' => 'nullable|string',
            'information' => 'nullable|string',
            'image_name' => 'nullable|string|max:500',
            'starts_at' => 'required|date',
            'salon_id' => 'required|exists:salons,id',
        ]);

        $event = new Event();
        $event->owner_id = auth()->id();
        $event->title = $request->title;
        $event->location = $request->location;
        $event->short_information = $request->short_information;
        $event->information = $request->information;
        $event->starts_at = $request->starts_at;
        $event->salon_id = $request->salon_id;

        if (!empty($request->image_name)) {
            $event->image_name = $request->image_name;
        }

        $event->save();

        return redirect()->route('owner.dashboard')->with('success', 'Esemény sikeresen létrehozva!');
    }

    // Esemény frissítése
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:50',
            'location' => 'nullable|string|max:150',
            'short_information' => 'nullable|string',
            'information' => 'nullable|string',
            'image_name' => 'string|max:500',
            'starts_at' => 'required|date',
        ]);

        $event = Event::findOrFail($id);
        $event->update($request->all());

        return redirect()->route('owner.dashboard')->with('success', 'Esemény sikeresen frissítve!');
    }

    // Esemény törlése
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('owner.dashboard')->with('success', 'Esemény sikeresen törölve!');
    }

    public function showEventDetails($eventId)
    {
        $event = Event::findOrFail($eventId);

        $likes = $event->likes()->with('user')->get();
        $participants = $event->participants()->with('user')->get();

        return view('owner.event-details', compact('event', 'likes', 'participants'));
    }
}