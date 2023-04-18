<?php


namespace App\Models\SMS;


use App\Models\SMS\Form3a\Form3aDetails;
use App\Models\SMS\Form4\Form4Details;
use App\Models\SMS\Form4a\Form4aDetails;
use Auth;
use Illuminate\Database\Eloquent\Model;

class WeeklyReports extends Model
{
    public static function boot()
    {
        parent::boot();
        static::updating(function($a){
            $a->user_updated = Auth::user()->user_id;
            $a->ip_updated = request()->ip();
            $a->updated_at = \Carbon::now();
        });

        static::creating(function ($a){
            $a->user_created = Auth::user()->user_id;
            $a->ip_created = request()->ip();
            $a->created_at = \Carbon::now();
        });
    }
    protected $table = 'weekly_reports';

    public function cropYear(){
        return $this->belongsTo(CropYears::class,'crop_year','slug');
    }

    public function sugarMill(){
        return $this->belongsTo(SugarMills::class,'mill_code','slug');
    }

    public function details(){
        return $this->hasMany(WeeklyReportDetails::class, 'weekly_report_slug','slug');
    }

    public function seriesNosForm1(){
        return $this->hasMany(WeeklyReportSeriesPcs::class, 'weekly_report_slug','slug');
    }

    public function form3bIssuancesOfMro(){
        return $this->hasMany(Form3b\IssuancesOfMro::class,'weekly_report_slug','slug');
    }
    public function form3bDeliveries(){
        return $this->hasMany(Form3b\Deliveries::class,'weekly_report_slug','slug');
    }

    public function form3bServedMros(){
        return $this->hasMany(Form3b\ServedSros::class,'weekly_report_slug','slug');
    }



    public function form5IssuancesOfSro(){
        return $this->hasMany(Form5\IssuancesOfSro::class,'weekly_report_slug','slug');
    }
    public function form5Deliveries(){
        return $this->hasMany(Form5\Deliveries::class,'weekly_report_slug','slug');
    }

    public function form5ServedSros(){
        return $this->hasMany(Form5\ServedSros::class,'weekly_report_slug','slug');
    }

    public function form5aIssuancesOfSro(){
        return $this->hasMany(Form5a\IssuancesOfSro::class,'weekly_report_slug','slug');
    }
    public function form5aDeliveries(){
        return $this->hasMany(Form5a\Deliveries::class,'weekly_report_slug','slug');
    }

    public function form5aServedSros(){
        return $this->hasMany(Form5a\ServedSros::class,'weekly_report_slug','slug');
    }

    public function form1(){
        return $this->hasOne(Form1\Form1Details::class,'weekly_report_slug','slug');
    }

    public function prevForm1(){
        $prev = WeeklyReports::query()
            ->where('crop_year','=',$this->crop_year)
            ->where('mill_code','=',$this->mill_code)
            ->where('report_no','=',$this->report_no-1)
            ->first();
        return $prev->form1 ?? null;
    }

    public function toDateForm1(){
        $fieldsToSum =  [
            'manufactured', 'A', 'B', 'C', 'C1', 'D', 'DX', 'DE', 'DR', 'total_issuance', 'prev_manufactured', 'prev_A', 'prev_B', 'prev_C', 'prev_C1', 'prev_D', 'prev_DX', 'prev_DE', 'prev_DR', 'prev_total_issuance', 'tdc', 'gtcm', 'lkgtc_gross', 'share_planter', 'share_miller', 'tds','egtcm', 'lkgtc_gross_syrup',
        ];
        foreach ($fieldsToSum as $key => $field){
            $fieldsToSum[$key] = ' sum('.$field.') as '.$field;
        }
        $fields = implode(',',$fieldsToSum);
        $toDate = WeeklyReports::query()
            ->selectRaw($fields.', status ')
            ->leftJoin('form1_details','form1_details.weekly_report_slug','=','weekly_reports.slug')
            ->where('crop_year','=',$this->crop_year)
            ->where('mill_code','=',$this->mill_code)
            ->where('report_no','<=',$this->report_no * 1)
            ->where(function($query){
                $query->where('status','=',1)
                ->orWhere('status','=',null);
            })
          ->first();

        return $toDate ?? null;
    }

    public function form1ToDateAsOf($report_no){
        $fieldsToSum =  [
            'manufactured', 'A', 'B', 'C', 'C1', 'D', 'DX', 'DE', 'DR', 'total_issuance', 'prev_manufactured', 'prev_A', 'prev_B', 'prev_C', 'prev_C1', 'prev_D', 'prev_DX', 'prev_DE', 'prev_DR', 'prev_total_issuance', 'tdc', 'gtcm', 'lkgtc_gross', 'share_planter', 'share_miller', 'tds','egtcm', 'lkgtc_gross_syrup',
        ];
        foreach ($fieldsToSum as $key => $field){
            $fieldsToSum[$key] = ' sum('.$field.') as '.$field;
        }
        $fields = implode(',',$fieldsToSum);
        $toDate = WeeklyReports::query()
            ->selectRaw($fields)
            ->leftJoin('form1_details','form1_details.weekly_report_slug','=','weekly_reports.slug')
            ->where('crop_year','=',$this->crop_year)
            ->where('mill_code','=',$this->mill_code)
            ->where('report_no','<=',$report_no*1)
            ->where(function($q){
                $q->where('status','=',1)
                    ->orWhere('status','=',null);
            })
            ->first();
//        dd($toDate);
        return $toDate ?? null;
    }



    public function form2(){
        return $this->hasOne(Form2\Form2Details::class,'weekly_report_slug','slug');
    }

    public function form3a(){
        return $this->hasOne(Form3aDetails::class,'weekly_report_slug','slug');
    }

    public function form3aToDateAsOf($report_no){
        $fieldsToSum = [
            'carryOver', 'receipts', 'withdrawals', 'transferToRefinery', 'prev_carryOver', 'prev_receipts', 'prev_withdrawals', 'prev_transferToRefinery',
        ];
        foreach ($fieldsToSum as $key => $field){
            $fieldsToSum[$key] = ' sum('.$field.') as '.$field;
        }
        $fields = 'weekly_report_slug, '.implode(',',$fieldsToSum);
        $toDate = WeeklyReports::query()
            ->selectRaw($fields)
            ->leftJoin('form3a_details','form3a_details.weekly_report_slug','=','weekly_reports.slug')
            ->where('crop_year','=',$this->crop_year)
            ->where('mill_code','=',$this->mill_code)
            ->where('report_no','<=',$report_no * 1)
            ->where(function($q){
                $q->where('status','=',1)
                    ->orWhere('status','=',null);
            })
            ->first();

        return $toDate ?? null;
    }

    public function form4(){
        return $this->hasOne(Form4Details::class,'weekly_report_slug','slug');
    }


    public function form4ToDateAsOf($report_no){
        $fieldsToSum = [
            'carryOver', 'receipts', 'withdrawals', 'transferToRefinery', 'prev_carryOver', 'prev_receipts', 'prev_withdrawals', 'prev_transferToRefinery',
        ];
        foreach ($fieldsToSum as $key => $field){
            $fieldsToSum[$key] = ' sum('.$field.') as '.$field;
        }
        $fields = 'weekly_report_slug, '.implode(',',$fieldsToSum);
        $toDate = WeeklyReports::query()
            ->selectRaw($fields)
            ->leftJoin('form4_details','form4_details.weekly_report_slug','=','weekly_reports.slug')
            ->where('crop_year','=',$this->crop_year)
            ->where('mill_code','=',$this->mill_code)
            ->where('report_no','<=',$report_no * 1)
            ->where(function($q){
                $q->where('status','=',1)
                    ->orWhere('status','=',null);
            })
            ->first();

        return $toDate ?? null;
    }

    public function form4a(){
        return $this->hasOne(Form4aDetails::class,'weekly_report_slug','slug');
    }

    public function form4aToDateAsOf($report_no){
        $fieldsToSum = [
             'carryOver', 'receipts', 'withdrawals', 'transferToRefinery', 'prev_carryOver', 'prev_receipts', 'prev_withdrawals', 'prev_transferToRefinery',
        ];
        foreach ($fieldsToSum as $key => $field){
            $fieldsToSum[$key] = ' sum('.$field.') as '.$field;
        }
        $fields = 'weekly_report_slug, '.implode(',',$fieldsToSum);
        $toDate = WeeklyReports::query()
            ->selectRaw($fields)
            ->leftJoin('form4a_details','form4a_details.weekly_report_slug','=','weekly_reports.slug')
            ->where('crop_year','=',$this->crop_year)
            ->where('mill_code','=',$this->mill_code)
            ->where('report_no','<=',$report_no * 1)
            ->where(function($q){
                $q->where('status','=',1)
                    ->orWhere('status','=',null);
            })
            ->first();

        return $toDate ?? null;
    }
    public function form3aSubsidiaries(){
        return $this->hasMany(Subsidiaries::class,'weekly_report_slug','slug')->where('sugarType','=','MOLASSES');
    }

    public function form4Subsidiaries(){
        return $this->hasMany(Subsidiaries::class,'weekly_report_slug','slug')->where('sugarType','=','RAW');
    }

    public function form4aSubsidiaries(){
        return $this->hasMany(Subsidiaries::class,'weekly_report_slug','slug')->where('sugarType','=','REFINED');
    }


    public function form2ToDateAsOf($report_no){
        $fieldsToSum = [
            'weekly_report_slug', 'carryOver', 'coveredBySro', 'notCoveredBySro', 'otherMills', 'imported', 'melted', 'rawWithdrawals', 'prev_refinedCarryOver', 'prodDomestic', 'prodImported', 'prodReturn', 'prev_carryOver', 'prev_coveredBySro', 'prev_notCoveredBySro', 'prev_otherMills', 'prev_imported', 'prev_melted', 'prev_rawWithdrawals', 'prev_prodDomestic', 'prev_prodImported', 'prev_prodReturn',
        ];
        foreach ($fieldsToSum as $key => $field){
            $fieldsToSum[$key] = ' sum('.$field.') as '.$field;
        }
        $fields = implode(',',$fieldsToSum);

        $toDate = WeeklyReports::query()
            ->selectRaw($fields)
            ->leftJoin('form2_details','form2_details.weekly_report_slug','=','weekly_reports.slug')
            ->where('crop_year','=',$this->crop_year)
            ->where('mill_code','=',$this->mill_code)
            ->where('report_no','<=',$report_no*1)
            ->where(function($q){
                $q->where('status','=',1)
                    ->orWhere('status','=',null);
            })
            ->first();

        return $toDate ?? null;
    }

    public function form3(){
        return $this->hasOne(Form3\Form3Details::class,'weekly_report_slug','slug');
    }


    public function form3ToDateAsOf($report_no){
        $fieldsToSum = [
            'manufacturedRaw', 'rao', 'manufacturedRefined','raoRefined' , 'sharePlanter', 'shareMiller', 'refineryMolasses', 'prev_manufacturedRaw', 'prev_rao', 'prev_manufacturedRefined','prev_raoRefined' ,'prev_sharePlanter', 'prev_shareMiller', 'prev_refineryMolasses',
        ];
        foreach ($fieldsToSum as $key => $field){
            $fieldsToSum[$key] = ' sum('.$field.') as '.$field;
        }
        $fields = implode(',',$fieldsToSum);

        $toDate = WeeklyReports::query()
            ->selectRaw($fields)
            ->leftJoin('form3_details','form3_details.weekly_report_slug','=','weekly_reports.slug')
            ->where('crop_year','=',$this->crop_year)
            ->where('mill_code','=',$this->mill_code)
            ->where('report_no','<=',$report_no * 1)
            ->where(function($q){
                $q->where('status','=',1)
                    ->orWhere('status','=',null);
            })
            ->first();

        return $toDate ?? null;
    }

    public function form3Withdrawals(){
        return $this->hasMany(Form3b\Deliveries::class,'weekly_report_slug','slug');
    }


    public function form5Withdrawals(){
        return $this->hasMany(Form5\Deliveries::class,'weekly_report_slug','slug')->whereNull('refining');
    }
    public function form5WithdrawalsForRefining(){
        return $this->hasMany(Form5\Deliveries::class,'weekly_report_slug','slug')->whereNotNull('refining');
    }


    //SERIES NOS
    public function seriesNos(){
        return $this->hasMany(SeriesNos::class,'weekly_report_slug','slug');
    }
    public function rawSeriesNos(){
        return $this->hasMany(SeriesNos::class,'weekly_report_slug','slug')->where('type','=','RAW');
    }

    public function refinedSeriesNos(){
        return $this->hasMany(SeriesNos::class,'weekly_report_slug','slug')->where('type','=','REFINED');
    }

    public function molassesSeriesNos(){
        return $this->hasMany(SeriesNos::class,'weekly_report_slug','slug')->where('type','=','MOLASSES');
    }

    public function savedSignatories(){
        return $this->hasMany(SignatoriesSaved::class,'weekly_report_slug','slug');
    }


    public function requestsForCancellation(){
        return $this->hasMany(RequestsForCancellation::class,'weekly_report_slug','slug');
    }

    public function requestsForCancellationNoAction(){
        return $this->hasMany(RequestsForCancellation::class,'weekly_report_slug','slug')->where('approved_at','=',null);
    }

    public function reportStatus(){
        return $this->hasMany(Status::class,'weekly_report_slug','slug');
    }

}