<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salon;
use Illuminate\View\View;

class SalonController extends Controller
{
    // Főoldalhoz szalonok listázása (owner nélkül)
    public function index(): View
    {
        $salons = Salon::select('id', 'salon_name', 'image_name', 'short_information', 'information', 'location')->get();
        return view('salons', compact('salons'));
    }

    // Összes szalon listázása (owner nélkül)
    public function listAllSalons(): View
    {
        $salons = Salon::select('id', 'salon_name', 'image_name', 'short_information', 'information', 'location')->get();
        return view('salons', ['salons' => $salons]);
    }

    // Külön metódus a szalon adatokhoz (owner nélkül)
    public function showSalonsDatas()
    {
        $salons = Salon::select('id', 'salon_name', 'image_name', 'short_information', 'information', 'location')->get();
        return view('salons', compact('salons'));
    }
    public function show($id)
    {
        $salon = Salon::findOrFail($id); // Az adott szalon keresése az ID alapján
        return view('events.salon', compact('salon'));
    }
}
