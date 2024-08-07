<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerBilling;
use App\Models\MasterBilling;
use App\Models\Payment;
use App\Models\PaymentDetail;
use App\Models\PaymentPaidDetail;
use App\Models\SetupProgram;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(request(),Carbon::now()->format('Y-m'));
        $dates = CustomerBilling::select('billing_date')->distinct()->get();
        $now = Carbon::now();
        $from_mo = Carbon::parse($dates[0]->billing_date);
        $month_arr = new Collection();
        $monthDiff = ($now->format('Y') - $from_mo->format('Y')) * 12 + ($now->format('m') - $from_mo->format('m')) + 1;
        $months = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
        for ($i = 0; $i < $monthDiff; $i++){
            $month  = $from_mo->format('m')+$i;
            $year   = $from_mo->format('Y');
            $monthsBetween = $month % 12;
            if($month > 12){
                $yearsBetween = floor($month / 12);
                if($monthsBetween > 0){
                    if($monthsBetween < 10){
                        $month_current = '0'.$monthsBetween;
                    } else {
                        $month_current = $monthsBetween;
                    }
                    // $month_current = $monthsBetween;
                    $year_current = $year+$yearsBetween;
                } else {
                    $month_current = 12;
                    $year_current = $year+$yearsBetween-1;
                }
            } else {
                if($month < 10){
                    $month_current = '0'.$month;
                } else {
                    $month_current = $month;
                }
                $year_current = $year;
            }
            $month_arr->push((object)['key' => $year_current.'-'.$month_current, 'value' => $year_current.'-'.$months[$month_current-1]]);
        }

        $users = Customer::with(['billings.consumption',
        'billings'=> function ($query) use ($now) {
            $query->selectRaw("*, TIMESTAMPDIFF(MONTH, CONCAT(billing_date, '-20'), '$now') AS late")->whereNull('pay_date');
        }])->whereHas('billings', function ($query) {
            $query->whereNull('pay_date');
        })->get();

        if(request()->periode){
            $periode = request()->periode;
        } else {
            $periode = Carbon::now()->format('Y-m');
        }
        $paid = Payment::where('payment','LIKE', '%'.$periode.'%')->with('detail.billing','customer')->get();

        // dd($paid,$periode);

        return view('pages.payment.index',[
            'data'      => $users,
            'paid'      => $paid,
            'setup'     => SetupProgram::where('id',1)->first(),
            'filters'   => $month_arr,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }

    public function payment(Request $request,$unique_id)
    {
        $a = '';
        $validate = $this->validate($request, [
            'billing_id' => 'required|array|min:1',
        ]);
        // if(count(request()->billing_id) > 0){
        //     foreach(request()->billing_id as $billing){
        //         $a .= 'billing id : '.$billing.', ';
        //     }
        // }
        // dd($unique_id,$request,$a,$validate);
        $now = Carbon::now();
        $get = Customer::where('encrypted_id',$unique_id)->with(['billings.consumption',
        'billings'=> function ($query) use ($now,$request) {
            // $query->selectRaw("*, TIMESTAMPDIFF(MONTH, CONCAT(billing_date, '-20'), '$now') AS late")->whereNull('pay_date');
            $query->selectRaw("*, TIMESTAMPDIFF(MONTH, CONCAT(billing_date, '-20'), '$now') AS late")->whereIn('id',$request->billing_id);
        }])
        ->first();
        // dd($get);
        // dd(count($get->billings));
        $data = '';
        if(count($get->billings)){
            // $this->show_kwitansi($get);
            $now = Carbon::now();
            $setup = SetupProgram::where('id',1)->first();
            $payment = Payment::create([
                'customer_id'   => $get->id,
                'created_by'    => auth()->user()->id,
                'payment'       => $now,
                'encrypted_id'  => md5($get->id.Carbon::now())
            ]);

            foreach($get->billings as $billing){
                $fines = 1 * $setup->fine_fee;
                CustomerBilling::where('id',$billing->id)->update([
                    'fines'     => $fines,
                    'pay_date'  => $now
                ]);

                PaymentDetail::create([
                    'payment_id'    => $payment->id,
                    'billing_id'    => $billing->id,
                    'fines'         => $fines,
                    'administration_fee'    => $setup->administration_fee,
                    'price'         => $billing->price_total,
                    'late'          => $billing->late,
                    'total'         => $setup->administration_fee+$fines+$billing->price_total,
                ]);
            }
            $data = Payment::with('detail.billing.consumption','customer')->where('id',$payment->id)->first();

            $billing_periode = $payment->payment;
            $billing_month = explode("-",$billing_periode)[1];
            $billing_date = '';
            switch ($billing_month) {
                case "01":
                    $billing_date = "Januari ".explode("-",$billing_periode)[0];
                    break;
                case "02":
                    $billing_date = "Februari ".explode("-",$billing_periode)[0];
                    break;
                case "03":
                    $billing_date = "Maret ".explode("-",$billing_periode)[0];
                    break;
                case "04":
                    $billing_date = "April ".explode("-",$billing_periode)[0];
                    break;
                case "05":
                    $billing_date = "Mei ".explode("-",$billing_periode)[0];
                    break;
                case "06":
                    $billing_date = "Juni ".explode("-",$billing_periode)[0];
                    break;
                case "07":
                    $billing_date = "Juli ".explode("-",$billing_periode)[0];
                    break;
                case "08":
                    $billing_date = "Agustus ".explode("-",$billing_periode)[0];
                    break;
                case "09":
                    $billing_date = "September ".explode("-",$billing_periode)[0];
                    break;
                case "10":
                    $billing_date = "Oktober ".explode("-",$billing_periode)[0];
                    break;
                case "11":
                    $billing_date = "November ".explode("-",$billing_periode)[0];
                    break;
                case "12":
                    $billing_date = "Desember ".explode("-",$billing_periode)[0];
                    break;
                default:
                    $billing_date = "-";
            }

            // return view('layouts.kwitansi',[
            //     'setup'         => $setup,
            //     'data'          => $data,
            //     'billing_date'  => $billing_date
            // ])->with('success','created');
        }

        return redirect('payment/index')->with('success','created');
    }

    public function print($unique_id)
    {
        $data = Payment::where('encrypted_id',$unique_id)->with('detail.billing','customer','pays')->first();
        $setup = SetupProgram::where('id',1)->first();
        // dd($data);
        return view('layouts.kwitansi',[
            'data' => $data,
            'setup'=> $setup,
        ])->with('success','created');
    }

    public function pays($unique_id, Request $request)
    {
        if(!$request->amount) {
            return response()->json([
                'status'    => 200,
                'message'   => 'Hanya Print',
            ]);
        }
        $data = Payment::where('encrypted_id',$unique_id)->first();
        if((int)$data->paid + (int)$request->amount > (int)$data->total){
            $paid = (int)$data->total;
            if((int)$data->paid > 0){
                $amount = (int)$data->total - (int)$data->paid;
            } else {
                $amount = (int)$data->total;
            }
        } else {
            $paid = (int)$data->paid + (int)$request->amount;
            $amount = (int)$request->amount;
        }
        $data->update([
            'paid'  => $paid
        ]);
        $insert = PaymentPaidDetail::create([
            'payment_id'    => $data->id,
            'payment_amount'=> $amount
        ]);
        if($insert){
            return response()->json([
                'status'    => 200,
                'message'   => 'Insert Success',
            ]);
        }
        return response()->json([
            'status'    => 500,
            'message'   => 'Insert Failed',
        ]);
    }

    public function get($unique_id){
        $data = Payment::where('encrypted_id',$unique_id)->with('detail.billing','customer','pays')->first();
        // dd($data);
        return response()->json([
            'status'    => 200,
            'message'   => 'Data Billing '.$data->customer->house_no." Tanggal ".$data->payment,
            'data'      => $data,
            'token_'    => csrf_token()
        ]);
    }

    public function sync(){
        $array_data = array();
        $datas = Payment::where('total',0)->with('detail')->get();
        if(count($datas) > 0){
            foreach($datas as $data){
                $total = 0;
                foreach($data->detail as $detail){
                    $total = $total + $detail->total;
                }
                $data->update([
                    'total' => $total
                ]);
                // array_push($array_data,$total);
            }
            return response()->json([
                'icon'  => 'success',
                'title' => 'Success!',
                'text'  => 'Sync Sukses'
            ]);
        } else {
            return response()->json([
                'icon'  => 'info',
                'title' => 'Info!',
                'text'  => 'Tidak ada data untuk di Sync'
            ]);
        }

        return response()->json([
            'icon'  => 'warning',
            'title' => 'Error!',
            'text'  => 'Sync Gagal'
        ]);
    }
}
