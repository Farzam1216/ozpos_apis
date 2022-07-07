<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Models\Order;
use App\Models\PromoCode;
use Illuminate\Http\Request;
use App\Models\WalletPayment;
use App\Models\GeneralSetting;
use Bavix\Wallet\Models\Wallet;
// use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Bavix\Wallet\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\TwilioModel;

class vendorUserController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
     $vendor = Vendor::where('user_id',Auth::user()->id)->first();
     $users = User::where('vendor_id', $vendor->id)->whereHas('roles', function($q){
              $q->where('title','!=','admin')->where('title','!=','vendor');
          })
          ->get();
      return view('vendor.user.user',compact('users'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      $roles = Role::where('title', 'pos_user')->orWhere('title', 'kitchen_user')->get();
      return view('vendor.user.create_user',compact('roles'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      $request->validate([
          'name' => 'bail|required|max:255',
          'email_id' => 'bail|required|unique:users',
          'password' => 'bail|required|min:6',
          'phone' => 'bail|required|numeric|digits_between:6,12'
      ]);
      $data = $request->all();
      if (isset($data['status']))
      {
          $data['status'] = 1;
      }
      else
      {
          $data['status'] = 0;
      }
      $data['is_verified'] = 1;
      $data['password'] = Hash::make($data['password']);
      $data['image'] = 'noimage.png';
      $vendor = Vendor::where('user_id',Auth::user()->id)->first();
      $data['vendor_id'] =$vendor->id;
      $user = User::create($data);
      $user->roles()->sync($request->input('roles', []));
      return redirect('vendor/vendoruser')->with('msg','user added successfully');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      $user = User::find($id);
      $orders = Order::where('user_id',$user->id)->get();
      $pending_orders = Order::where([['user_id',$user->id],['order_status','PENDING']])->get();
      $approve_orders = Order::where([['user_id',$user->id],['order_status','APPROVE']])->get();
      $complete_orders = Order::where([['user_id',$user->id],['order_status','COMPLETE']])->get();
      return view('vendor.user.show_user',compact('user','orders','approve_orders','pending_orders','complete_orders'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      $roles = Role::get();
      $user = User::find($id);
      return view('vendor.user.edit_user',compact('user','roles'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
      $request->validate([
          'name' => 'bail|required|max:255',
          'phone' => 'bail|required|numeric|digits_between:6,12'
      ]);
      $data = $request->all();
      $user = User::find($id);
      if($data['password'] != null)
      {
          $request->validate([
              'password' => 'bail|min:6',
          ]);
          $data['password'] = Hash::make($data['password']);
      }
      else
      {
          $data['password'] = $user->password;
      }
      $vendor = Vendor::where('user_id',Auth::user()->id)->first();
      $data['vendor_id'] =$vendor->id;
      if($user->id != 1){
          $user->update($data);
      }
      $user->roles()->sync($request->input('roles', []));
      return redirect('vendor/vendoruser')->with('msg','User Updated Successfully');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(User $user)
  {
      if($user->id != 1){
          $promoCodes = PromoCode::all();
          foreach ($promoCodes as $promoCode)
          {
              $vIds = explode(',',$promoCode->customer_id);
              if(count($vIds) > 0)
              {
                  if (($key = array_search($promoCode->customer_id, $vIds)) !== false)
                  {
                      unset($vIds[$key]);
                      $promoCode->customer_id = implode(',',$vIds);
                  }
                  $promoCode->save();
              }
          }
          $user->delete();
          return response(['success' => true]);
      }
  }

  public function change_status(Request $request)
  {
      $data = User::find($request->id);

      if($data->status == 0)
      {
          $data->status = 1;
          $data->save();
          return response(['success' => true]);
      }
      if($data->status == 1)
      {
          $data->status = 0;
          $data->save();
          return response(['success' => true]);
      }
  }

  public function user_wallet(Request $request,$user_id)
  {
      $user = User::find($user_id);
      $user->deposit = Transaction::with('wallet')->where([['payable_id',$user_id],['type','deposit']])->sum('amount');
      $user->withdraw = Transaction::with('wallet')->where([['payable_id',$user_id],['type','withdraw']])->sum('amount');
      $currency = GeneralSetting::first()->currency_symbol;
      $transactions = Transaction::with('wallet')->where('payable_id',$user_id)->orderBy('id','DESC')->get();
      if(isset($request->date_range)){
          $date = explode(' - ',$request->date_range);
          $transactions = Transaction::with('wallet')->whereBetween('created_at', [$date[0], $date[1]])->where('payable_id',$user_id)->orderBy('id','DESC')->get();
      }
      foreach ($transactions as $transaction) {
          $transaction->payment_details = WalletPayment::where('transaction_id',$transaction->id)->first();
          $transaction->date = Carbon::parse($transaction->created_at);
      }
      return view('vendor.user.user_wallet',compact('transactions','user','currency'));
  }

  public function add_wallet(Request $request)
  {
      $request->validate([
          'amount' => 'bail|required|numeric',
      ]);
      $data = $request->all();
      $user = User::find($data['user_id']);
      $deposit = $user->deposit($data['amount']);
      $transction = array();
      $transction['transaction_id'] = $deposit->id;
      $transction['payment_type'] = 'LOCAL';
      $transction['payment_token'] = $request->payment_token;
      $transction['added_by'] = 'admin';
      WalletPayment::create($transction);
      return redirect()->back();
  }

  public function twilioIndex(Request $request)
  {
        $vendor = Vendor::where('user_id',Auth::user()->id)->first();
        $twillio = TwilioModel::where('vendor_id' , $vendor->id)->first();
        return view('vendor.vendor_twillo.index',compact('twillio'));
  }

  public function twilioStore(Request $request)
  {
        $data = $request->all();
        $vendor = Vendor::where('user_id',Auth::user()->id)->first();
        $twillio = TwilioModel::where('vendor_id' , $vendor->id)->first();
        if (isset($data['vendorstatus'])) {
          $data['vendorstatus'] = 1;
        } else {
          $data['vendorstatus'] = 0;
        }

        if (isset($data['email'])) {
          $data['email'] = 1;
        } else {
            $data['email'] = 0;
        }

        if (isset($data['sms'])) {
          $data['sms'] = 1;
        } else {
            $data['sms'] = 0;
        }
        if($twillio){

            $twillio->vendor_id = $vendor->id;
            $twillio->sid= $request->sid;
            $twillio->token = $request->token;
            $twillio->number = $request->number;
            $twillio->adminstatus = $request->adminstatus;
            $twillio->vendorstatus = $data['vendorstatus'];
            $twillio->email = $data['email'];
            $twillio->sms =  $data['sms'];



              $twillio->save();
        }
        else{
            $twillio = new TwilioModel();
            $twillio->vendor_id = $vendor->id;
            $twillio->sid= $request->sid;
            $twillio->token = $request->token;
            $twillio->number = $request->number;
            $twillio->adminstatus = $request->adminstatus;
            $twillio->vendorstatus = $data['vendorstatus'];
            $twillio->email = $data['email'];
            $twillio->sms =  $data['sms'];
            $twillio->save();
        }
        return redirect()->back();
  }

}
