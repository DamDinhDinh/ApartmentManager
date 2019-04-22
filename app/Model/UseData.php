<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\UsingService;
use App\Model\Bill;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UseData extends Model
{
    public function usingService(){
        return $this->belongsTo(UsingService::class);
    }

    public function bill(){
        return $this->hasOne(Bill::class);
    }

    public function prevMonthValue(){
        $carbon = Carbon::parse($this->use_date);
        $carbon = $carbon->subMonth();

        $year = $carbon->year;
        $prevMonth = $carbon->month;

        $value = UseData::where('using_service_id', '=', $this->using_service_id)->whereYear('use_date', '=', $year)->whereMonth('use_date', '=', $prevMonth)->value('use_value_curr');

        return $value != null ? $value : 0;
    }
}
