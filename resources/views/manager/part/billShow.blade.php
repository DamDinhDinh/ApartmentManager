<div class="bill-table">
		<div style="display: inline-block" class="row">
			<h3 name="table-name" class=" text-black font-weight-bold">{{ trans('headerLabel.bill_info') }}</h3>
		</div>
		
		<table style="text-align: center !important" class="table table-striped table-bordered .table-hover thead-dark">
			<tr>
				<th width="30%">{{ trans('tableLabel.bill_id') }}</th>
				<td width="70%">{{$bill->id}}</a></td>
			</tr>
			<tr>
				<th width="30%">{{ trans('tableLabel.bill_name') }}</th>
				<td width="70%">{{$bill->name}}</a></td>
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
				<td width="70%">{{$bill->useData->use_value}}</a></td>
            </tr>
            <tr>
				<th width="30%">{{ trans('tableLabel.use_data_date') }}</th>
				<td width="70%">{{$bill->useData->use_date}}</a></td>
            </tr>
            <tr>
				<th width="30%">{{ trans('tableLabel.service_name') }}</th>
				<td width="70%">{{$bill->usingService->service->name}}</a></td>
            </tr>
            <tr>
                <th width="30%">{{ trans('tableLabel.service_price') }}</th>
                <td width="70%">{{$bill->price}}</a></td>
            </tr>
            <tr>
                <th width="30%">{{ trans('tableLabel.bill_discount') }}</th>
                <td width="70%">{{$bill->discount}}</a></td>
            </tr>
            <tr>
                <th width="30%">{{ trans('tableLabel.bill_vat') }}</th>
                <td width="70%">{{$bill->vat}}</a></td>
            </tr>
            <tr>
                <th width="30%">{{ trans('tableLabel.bill_sum') }}</th>
                <td width="70%">{{$bill->sum}}</a></td>
            </tr>
            <tr>
                <th width="30%">{{ trans('tableLabel.bill_status') }}</th>
                <td width="70%">{{$bill->status}}</a></td>
            </tr>
            <tr>
                <th width="30%">{{ trans('tableLabel.bill_paid_method') }}</th>
                <td width="70%">{{$bill->paid_method}}</a></td>
            </tr>
            <tr>
                <th width="30%">{{ trans('tableLabel.bill_paid_date') }}</th>
                <td width="70%">{{$bill->paid_date}}</a></td>
            </tr>
            <tr>
                <th width="30%">{{ trans('tableLabel.bill_updated_at') }}</th>
                <td width="70%">{{$bill->updated_at}}</a></td>
            </tr>
		</table>
</div>