<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Log;


class GuestController extends Controller
{
    public function index()
    {
        Log::info('GuestController@index called');
        $clubId = "";
        $withClub = false;
        if (isset($_GET['club'])) {
            $foundClub = DB::table('ua_mst_clubs')->whereRaw('id = ' . $_GET['club'])->whereRaw('org_id = 13')->whereRaw('deletedAt is null')->first();
            if (isset($foundClub)) {
                $club = DB::table('ua_mst_clubs')->whereRaw('id = ' . $_GET['club'])->whereRaw('org_id = 13')->whereRaw('deletedAt is null and is_deleted = 0')->get();
                $withClub = true;
            } else {
                $club = DB::table('ua_mst_clubs')->whereRaw('org_id = 13')->whereRaw('deletedAt is null and is_deleted = 0')->get();
            }
        } else {
            $club = DB::table('ua_mst_clubs')->whereRaw('org_id = 13')->whereRaw('deletedAt is null and is_deleted = 0')->get();
        }

        return view('guest.index', compact('club', 'withClub'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validateData = $request->validate([
            'name' => 'max:255',
            'phone' => 'max:255',
            'email' => 'max:255',
            'club_id' => 'nullable',
            'time_call' => 'nullable'
        ]);
    
        // Tambahkan data tambahan
        $validateData['org_id'] = env('ORG_ID');
        $validateData['source'] = $request->query('source', 'website');
        $validateData['source_sub'] = $request->query('sub', null);
        $validateData['type_promo'] = $request->query('type', 'free trial');
        $validateData['createdAt'] = now();
        $validateData['updatedAt'] = now();
    
        // Cek apakah email sudah terdaftar sebagai member
        $foundMember = DB::table('ua_mst_members')
            ->where('email', $validateData['email'])
            ->whereNull('deletedAt')
            ->first();
    
        if (!isset($foundMember)) {
            // Jika tidak ditemukan sebagai member, cek apakah email sudah terdaftar sebagai lead
            $foundLead = DB::table('ua_mst_leads')
                ->where('email', $validateData['email'])
                ->whereNull('deletedAt')
                ->first();
    
            if (!isset($foundLead)) {
                // Jika tidak ditemukan sebagai lead, buat lead baru
                $modelLead = Lead::create($validateData);
            } else {
                // Jika ditemukan sebagai lead, gunakan data lead yang ada
                $modelLead = $foundLead;
            }
            $leadsId = $modelLead->id;
        } else {
            // Jika ditemukan sebagai member, gunakan leads_id dari member
            $leadsId = $foundMember->leads_id;
        }
    
        // Kirim request ke API untuk generate QR
        $response = Http::withBasicAuth('keys', 'secret')
            ->withHeaders([
                'Content-Type' => 'application/json',
            ])
            ->post($this->getUrl('leads/generate-qr?'), [
                'leadId' => $leadsId,
            ]);
    
        if ($response->successful()) {
            $jsonData = $response->json();
            $data = $jsonData['data'] ?? [];
        } else {
            return back()->with('error', 'Failed to generate QR code.');
        }
    
        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('message', 'IT WORKS!');
    }
    

    private function getUrl($key = NULL)
    {
        $server = env('APP_ENV');
        $url = '';
        if ($server == 'local') {
            $url = 'http://localhost:8080/api/' . $key;
        } elseif ($server == 'trial') {
            $url = 'https://dev-fwapi.fitnessworks.co.id/api/' . $key;
        } elseif ($server == 'production') {
            $url = 'https://fwapi.fitnessworks.co.id/api/' . $key;
        }
        return $url;
    }
}
