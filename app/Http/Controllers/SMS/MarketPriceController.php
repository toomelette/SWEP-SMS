<?php


namespace App\Http\Controllers\SMS;


use App\Http\Controllers\Controller;
use App\Http\Requests\SMS\MarketPrice\MarketPriceFormRequest;
use App\Models\SMS\MarketPrice;
use App\Swep\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MarketPriceController extends Controller
{
    public function create(){
        return view('sms.admin.market_price.create');
    }

    public function store(MarketPriceFormRequest $request){
        $mp = new MarketPrice();
        $mp->slug = Str::random();
        $mp->store = $request->store;
        $mp->geog_loc = $request->geog_loc;
        $mp->retail_raw = Helper::sanitizeAutonum($request->retail_raw);
        $mp->retail_refined = Helper::sanitizeAutonum($request->retail_refined);
        $mp->wholesale_raw = Helper::sanitizeAutonum($request->wholesale_raw);
        $mp->wholesale_refined = Helper::sanitizeAutonum($request->wholesale_refined);
        if($mp->save()){
            return '<div class="alert alert-success alert-dismissible  animate__animated animate__bounce">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        Price successfully encoded for <br><b>'.strtoupper($mp->store).'</b>
                    </div>';
        }else{
            abort(503,'Error saving price.');
        }
    }
}