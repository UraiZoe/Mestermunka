<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salon;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OwnerController extends Controller
{
    public function index()
    {
        $salons = Salon::where('owner_id', Auth::id())->get();

        return view('owner.dashboard', ['salons' => $salons]);
    }

    public function createEventPage()
    {
        $salons = Salon::where('owner_id', Auth::id())->get();
        return view('owner.create-event', compact('salons'));
    }

    public function editSalon($salonId)
    {
        $salon = Salon::where('id', $salonId)
                  ->where('owner_id', auth()->id())
                  ->firstOrFail();
        Log::info('Szalon módosítása', ['salon_id' => $salon->salon_name, 'owner_id' => auth()->id()]);
        
        return view('owner.edit-salon', compact('salon'));
    }

    public function updateSalon(Request $request, $salonId)
    {
        $salon = Salon::where('id', $salonId)
                    ->where('owner_id', auth()->id())
                    ->firstOrFail();

            $request->validate([
                'salon_name' => 'required|string|max:20',
                'image_name' => 'nullable|string|max:500',
                'short_information' => 'required|string|max:100',
                'information' => 'required|string',
                'location' => 'required|string|max:150',
             ]);

        $salon->salon_name = $request->salon_name;
        $salon->location = $request->location;
        $salon->short_information = $request->short_information;
        $salon->information = $request->information;
        $salon->image_name = $request->image_name;

        $salon->save();

        return redirect()->route('owner.dashboard')->with('success', 'Szalon sikeresen módosítva!');
    }

    public function createEvent(Request $request)
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

    public function editEvent($id)
    {
        $event = Event::findOrFail($id);
        if ($event->owner_id != auth()->id()) {
            return redirect()->route('owner.dashboard')->with('error', 'Nem szerkesztheti ezt az eseményt.');
        }
        return view('owner.edit_event', compact('event'));
    }
    public function updateEvent(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        if ($event->owner_id != auth()->id()) {
            return redirect()->route('owner.dashboard')->with('error', 'Nem módosíthatja ezt az eseményt.');
        }

        $request->validate([
            'title' => 'required|string|max:50',
            'location' => 'nullable|string|max:150',
            'short_information' => 'nullable|string',
            'information' => 'nullable|string',
            'image_name' => 'nullable|string|max:500',
            'starts_at' => 'required|date',
        ]);

        $event->title = $request->title;
        $event->location = $request->location;
        $event->short_information = $request->short_information;
        $event->information = $request->information;
        $event->starts_at = $request->starts_at;

        if (!empty($request->image_name)) {
            $event->image_name = $request->image_name;
        }

        $event->save();

        return redirect()->route('owner.dashboard')->with('success', 'Esemény sikeresen frissítve!');
    }

    public function deleteEvent($id)
    {
        $event = Event::findOrFail($id);

        if ($event->owner_id != auth()->id()) {
            return redirect()->route('owner.dashboard')->with('error', 'Nem törölheti ezt az eseményt.');
        }

        $event->delete();
        return redirect()->route('owner.dashboard')->with('success', 'Esemény sikeresen törölve!');
    }
}