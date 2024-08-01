<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ManageData;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Log;

class DataManagementController extends Controller
{


    /**
     *  view data list
     *
     * @param send id
     * @return  view with data of the data list
     */
    public function dataView()
    {
        $manage_data = ManageData::paginate();
        return view('admin.manageData.create', compact('manage_data'));
    }

    /**
     *  filter data on search
     *
     * @param send searchdata
     * @return  view filter data according to search key
     */
    public function filterData(Request $request)
    {
        $search = $request->search;
        $qry = ManageData::select('*');
        if (!empty($search)) {
            $qry->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            });
        }
        $manage_data = $qry->orderBy('id', 'DESC')->paginate();
        return view('admin.manageData.includes.view', compact('manage_data', 'search'));
    }


    /**
     *  fetch edit manage data
     *
     * @param send id
     * @return  view with data of the permission
     */
    public function dataEditView(Request $request)
    {
        
        $data = ManageData::where('id', $request->id)->first();
        return view('admin.manageData.includes.update', compact('data'))->render();
    }

    /**
     *  Update  data 
     *
     * @param send id
     * @return  message Update permission data according to permission id
     */
    public function dataUpdate(Request $request){
        ManageData::where('id', $request->id)->update([
            "name" => $request->name,
        ]);
        return response()->json(redirect()->back()->with('success', 'Data updated successfully'));
    }
   /**
     *  View all data detail
     *
     * @param  send id
     * @return  data from data to show all detail of the user
     */
    public function viewData($id){
        $data = ManageData::where('id',$id)->first();
        return view('admin.manageData.includes.detailview', compact('data'));
    }

    /**
     *  sync data 
     */
    public function dataSync()
    {

        $apiKey = env('LOOP_API_KEY');
        $baseUrl = 'https://api.loopsubscriptions.com/admin/2023-10/subscription';

        $pageNo = 1;
        $pageSize = 50; 

        do {
            sleep(3);
            $response = Http::withHeaders([
                'X-Loop-Token' => $apiKey,
                'accept' => 'application/json',
            ])->get($baseUrl, [
                'pageNo' => $pageNo,
                'pageSize' => $pageSize,
                // Add other query parameters as needed
            ]);
            //dd($response);
            if ($response->successful()) {
                $data = $response->json();
                $subscriptions = $data['data'];

                foreach ($subscriptions as $subscription) {
                    //dd($subscription);
                    $this->syncSubscription($subscription);
                }

                $pageInfo = $data['pageInfo'];
                $pageNo++;

                //$this->info("Processed page $pageNo");
                Log::info("Processed page " . $pageNo);
                sleep(1);
            } else {
                // $this->error('Failed to fetch Loop subscriptions.');

                dd($response);
                break;
            }
        } while ($pageInfo['hasNextPage']);
      
    }

    private function syncSubscription($subscription)
    {
        $shippingAddress = $subscription['shippingAddress'];
        $customer = $subscription['customer'];
        $line = $subscription['lines'][0] ?? null;

        ManageData::updateOrCreate(
            ['loop_subscriber_id' => $subscription['id']],
            [
                'shopify_id' => $customer['shopifyId'],
                'customer_email_address' => '',
                'customer_billing_address' => '',
                'customer_shipping_address' => json_encode($shippingAddress),
                'all_order_ids' => $subscription['originOrderShopifyId'],
                'join_date' => Carbon::parse($subscription['createdAt'])->toDateTimeString(),
                'next_billing_date' => $subscription['nextBillingDateEpoch']
                    ? Carbon::createFromTimestamp($subscription['nextBillingDateEpoch'])->toDateTimeString()
                    : null,
                'subscription_status' => $subscription['status'],
                'unique_customer_number' => $customer['id'],
                'last_golden_ticket' => null,
                //'customer_notes' => $subscription['cancellationComment'] ?? null,
                'customer_notes' =>  null,
                'type' => $line ? $line['productTitle'] : null,
                'status' => $subscription['lastPaymentStatus'],
            ]
        );
    }
}
