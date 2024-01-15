                @foreach(getIntervalFormatted() as $intervalName=>$intervalNameFormatted)
				<li class="nav-item nav-item-interval-name" data-interval-name="{{ $intervalName }}">
                    <a onclick="return false;" class="nav-link {{ $intervalName == 'monthly'?'active':'' }}" data-toggle="tab" href="#kt_apps_contacts_view_tab_2{{ $intervalName }}" role="tab">
                        <i class="flaticon2-checking"></i>{{ $intervalNameFormatted.__(' Report') }}
                    </a>
                </li>
			@endforeach

@once
@push('js')
<script>
$(document).on('click', '.nav-item-interval-name', function() {
        const intervalName = $(this).data('interval-name')
		$('.kt_table_with_no_pagination_no_fixed.' + intervalName).DataTable().columns.adjust().draw()
    })
	
</script>
@endpush
@endonce
