<div class="apartment-table">
		<div style="display: inline-block" class="row">
			<h3 name="table-name" class=" text-black font-weight-bold">{{ trans('headerLabel.apartment_info') }}</h3>
		</div>
		
		<table style="text-align: center !important" class="table table-striped table-bordered .table-hover thead-dark">
			<tr>
				<th width="30%">{{ trans('tableLabel.id') }}</th>
				<td width="70%">{{$apartment->id}}</a></td>
			</tr>
			<tr>
				<th width="30%">{{ trans('tableLabel.apartment_name') }}</th>
				<td width="70%">{{$apartment->name}}</a></td>
			</tr>
			<tr>
				<th width="30%">{{ trans('tableLabel.apartment_address') }}</th>
				<td width="70%">{{$apartment->address}}</a></td>
			</tr>
		</table>
</div>