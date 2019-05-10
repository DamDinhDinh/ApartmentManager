<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\UseData;
use App\User;
use App\UsingService;

class Bill extends Model
{
    public function useData(){
        return $this->belongsTo(UseData::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function usingService(){
        return $this->belongsTo(UsingService::class);
    }

    public function doPayment($paidName, $paidMethod, $paidDate){
        // $user = User::find($userID);

        if(true){//user exist
            //first check business logical then do update to bill status

            $this->status = 1;
            $this->user_name = $paidName;
            $this->paid_method = $paidMethod;
            $this->paid_date = $paidDate;

            if($this->save()){// complete excute
                return 1;
            }else{//failed to excute
                return -2; //can not excute
            }
        }else{ // user not exist
            return -1; //user id invailid
        }
    }
}
