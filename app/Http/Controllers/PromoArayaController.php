<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use App\Models\Lead;

class PromoArayaController extends Controller
{
    //
    public function index()
    {
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

        return view('araya.index', compact('club', 'withClub'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'phone' => 'required|max:255',
            'email' => 'required|max:255',
            'club_id' => 'required',
            'time_call' => 'required'
        ], [
            'time_call.required' => 'Waktu dihubungi harus dipilih.'
        ]);

        $validateData['org_id'] = env('ORG_ID');
        if (isset($_GET['source'])) {
            $validateData['source'] = $_GET['source'];
            $validateData['source_sub'] = isset($_GET['sub']) ? $_GET['sub'] : null;
        } else {
            $validateData['source'] = 'website';
        }
        if (isset($_GET['type'])) {
            $validateData['type_promo'] = $_GET['type'];
        } else {
            $validateData['type_promo'] = 'araya';
        }
        $validateData['sales_id'] = '232';
        $validateData['createdAt'] = date('Y-m-d H:i:s');
        $validateData['updatedAt'] = date('Y-m-d H:i:s');

        if ($validateData['club_id'] == 14) { //araya
            $packageMembershipId = 1021;

        }

        $foundMember = DB::table('ua_mst_members')->whereRaw('email = "' . $validateData['email'] . '"')->whereRaw('deletedAt is null')->first();
        if (!isset($foundMember)) {
            $foundLead = DB::table('ua_mst_leads')->whereRaw('email = "' . $validateData['email'] . '"')->whereRaw('deletedAt is null')->first();
            if (!isset($foundLead)) {
                $modelLead = Lead::create($validateData);
            } else {
                $modelLead = $foundLead;
            }
            $leadsId = $modelLead->id;
        } else {
            $leadsId = $foundMember->leads_id;
            $foundMemberPackage = DB::table('ua_mst_members_packages')
                ->whereRaw('member_id = ' . $foundMember->id)
                ->whereRaw('package_membership_expired_date >= date_sub(now(), interval 6 month)')
                ->whereRaw('deletedAt is null')
                ->whereRaw('package_membership_id is not null')
                ->first();
            if (isset($foundMemberPackage)) {
                return back()->with('error', 'Maaf anda tidak memenuhi syarat & ketentuan untuk membeli promo araya.');
            }

            $foundTransaction = DB::table('ua_orders')
                ->whereRaw('member_id = ' . $foundMember->id)
                ->whereRaw('package_membership_id in (1021)')
                ->whereRaw('status = "paid"')
                ->first();
            if (isset($foundTransaction)) {
                return back()->with('error', 'Maaf anda sudah pernah membeli promo araya.');
            }
        }

        $packageMembership = DB::table('ua_package_memberships as a')
            ->selectRaw('a.*, c.name as shift_name')
            ->join('ua_mst_shifts as c', 'c.id', '=', 'a.shift_id')
            ->where('a.id', '=', $packageMembershipId)
            ->first();

        $response = Http::withBasicAuth('keys', 'secret')
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic some_base64_encrypted_key'
            ])
            ->post($this->getUrl('checkout-presale'), [
                'orgId' => env('ORG_ID'),
                'clubId' => $validateData['club_id'],
                'packageMembershipId' => $packageMembership->id,
                'leadId' => $leadsId,
                'email' => $validateData['email'],
                'phone' => $validateData['phone'],
                'name' => $validateData['name']
            ]);

        $jsonData = $response->json();
        $data = isset($jsonData['data']) ? $jsonData['data'] : [];

        // get employee (sales / fitness consultant)
        $response = Http::get($this->getUrl('presales/sales-employee?orgId=' . env('ORG_ID') . '&clubId=' . $validateData['club_id']));
        $salesData = $response->json();
        $salesList = [];

        if (count($salesData['data']) > 0) {
            /* foreach ($salesData['data'] as $row => $sales) {
                if (strtolower($sales['position']['name']) == 'fitness consultant') {
                    array_push($salesList, $sales);
                }
            };*/
        }
        // return view('araya.checkout', compact('packageMembership', 'leadsId', 'data', 'salesList'));
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

    public function order(Request $request)
    {
        if (isset($_POST['lead_id']) && isset($_POST['package_membership_id']) && isset($_POST['checkout_id'])) {
            $lead = DB::table('ua_mst_leads')->where('id', '=', $_POST['lead_id'])->first();

            $response = Http::withBasicAuth('keys', 'secret')
                ->withHeaders([
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Basic some_base64_encrypted_key'
                ])
                ->post($this->getUrl('presales'), [
                    'orgId' => env('ORG_ID'),
                    'clubId' => env('CLUB_ID'),
                    'checkoutId' => $_POST['checkout_id'],
                    'leadId' => $_POST['lead_id'],
                    'salesId' => '232',
                    'packageMembershipId' => $_POST['package_membership_id'],
                    'email' => $lead->email,
                    'phone' => $lead->phone,
                    'name' => $lead->name,
                ]);

            $jsonData = $response->json();
            $data = isset($jsonData['data']) ? $jsonData['data'] : [];

            //print("<pre>" . print_r($jsonData, true) . "</pre>");die();

            if ($response->successful()) {
                $url = $data['xendit_invoice_url'];
                return view('araya.order', compact('url'));
            } elseif ($response->failed()) {
            }
        }
    }
}
