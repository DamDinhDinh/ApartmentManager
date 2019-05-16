<div class="bill-table">
		<div style="display: inline-block" class="row">
			<h3 name="table-name" class=" text-black font-weight-bold">{{ trans('headerLabel.bill_info') }}</h3>
		</div>
        <div class="row">
        <div class="col-md-6">
                <table style="text-align: center !important" class="table table-striped table-bordered table-hover thead-dark">
                        <tr>
                            <th width="30%">{{ trans('tableLabel.bill_id') }}</th>
                            <td width="70%">{{$bill->id}}</td>
                        </tr>
                        <tr>
                            <th width="30%">{{ trans('tableLabel.bill_name') }}</th>
                            <td width="70%">{{$bill->name}}</td>
                        </tr>
                        <tr>
                            <th width="30%">{{ trans('tableLabel.apartment_id') }}</th>
                            <td width="70%">{{$bill->usingService->apartment->id}}</a></td>
                        </tr>
                        <tr>
                            <th width="30%">{{ trans('tableLabel.apartment_name') }}</th>
                            <td width="70%">{{$bill->usingService->apartment->name}}</a></td>
                        </tr>
                        <tr>
                            <th width="30%">{{ trans('tableLabel.use_data_value') }}</th>
                            <td width="70%">{{$bill->useData->use_value}}</td>
                        </tr>
                        <tr>
                            <th width="30%">{{ trans('tableLabel.use_data_date') }}</th>
                            <td width="70%">{{$bill->useData->use_date}}</td>
                        </tr>
                        <tr>
                            <th width="30%">{{ trans('tableLabel.service_name') }}</th>
                            <td width="70%">{{$bill->usingService->service->name}}</td>
                        </tr>
                        <tr>
                            <th width="30%">{{ trans('tableLabel.service_price') }}</th>
                            <td width="70%">{{$bill->price}}</td>
                        </tr>
                        <tr>
                            <th width="30%">{{ trans('tableLabel.bill_discount') }}</th>
                            <td width="70%">{{$bill->discount}}</td>
                        </tr>
                        <tr>
                            <th width="30%">{{ trans('tableLabel.bill_vat') }}</th>
                            <td width="70%">{{$bill->vat}}</td>
                        </tr>
                        <tr>
                            <th width="30%">{{ trans('tableLabel.bill_sum') }}</th>
                            <td width="70%">{{$bill->sum}}</td>
                        </tr>
                </table>
        </div>
        <div class="col-md-6">
                <table style="text-align: center !important" class="table table-striped table-bordered table-hover thead-dark">
                <tr>
                        <th width="30%">{{ trans('tableLabel.bill_status') }}</th>
                        <td width="70%">
                            @php
                                if($bill->status == 0){
                                    echo trans('tableLabel.bill_not_paid_yet');
                                }else if($bill->status == 1){
                                    echo trans('tableLabel.bill_paid');
                                }
                            @endphp
                        </td>
                    </tr>
                    <tr>
                        <th width="30%">{{ trans('tableLabel.bill_paid_method') }}</th>
                        <td width="70%">
                            @php
                                if($bill->paid_method == 1){
                                    echo trans('tableLabel.bill_paid_by_cash');
                                }else if($bill->paid_method == 2){
                                    echo trans('tableLabel.bill_paid_by_credit_card');
                                }else{
                                    echo trans('tableLabel.bill_not_paid_yet');
                                }
                            @endphp
                        </td>
                    </tr>
                    <tr>
                        <th width="30%">{{ trans('tableLabel.bill_paid_date') }}</th>
                        <td width="70%">
                            @php
                                if($bill->paid_date != null){
                                    echo Carbon\Carbon::parse($bill->paid_date)->format('H:m d-m-Y ');
                                }else{
                                    echo trans('tableLabel.bill_not_paid_yet');
                                }
                            @endphp
                        </td>
                    </tr>
                    <tr>
                        <th width="30%">{{ trans('tableLabel.bill_user_paid') }}</th>
                        <td width="70%">
                            @php
                                if($bill->user_name != null){
                                    echo $bill->user_name;
                                }else{
                                    echo trans('tableLabel.bill_not_paid_yet');
                                }
                            @endphp
                        </td>
                    </tr>
                    <tr>
                        <th width="30%">{{ trans('tableLabel.bill_updated_at') }}</th>
                        <td width="70%">{{Carbon\Carbon::parse($bill->updated_at)->format('H:m d-m-Y')}}</td>
                    </tr>
                </table>
            </div>
		
        </div>
</div>