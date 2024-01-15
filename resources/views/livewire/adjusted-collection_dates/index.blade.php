<div>
{{-- Table Component ['href of Add Button'] & ['The Title Of The Table'] --}}

<div x-data="{ deleted: false }" x-init="
@this.on('delete_row', () => {
    if (deleted === false) setTimeout(() => { deleted = false }, 2500);
    deleted = true;
})"
x-show.transition.out.duration.1000ms="deleted" style="display: none; font-size: 1rem;" class="alert alert-danger" role="alert">
    {{ __('Item Deleted!') }}
</div>
<x-table :class="'hidden'" :tableTitle="__('Adjusted Collection Dates')">
{{-- Head Of The Table --}}
@slot('table_header')
<tr class="table-standard-color">
    <th>{{ __('Adjusted Date') }}</th>
    <th>{{ __('Days Count') }}</th>
    <th>{{ __('Control') }}</th>
</tr>
@endslot
{{-- Body Of The Table --}}
@slot('table_body')
@foreach ($adjusted_collection_dates as $adjusted)
    <tr>
        <td> {{$adjusted->date}} </td>
        <td>15</td>
        <td class="kt-datatable__cell--left kt-datatable__cell " data-field="Actions" data-autohide-disabled="false">
            <span style="overflow: visible; position: relative; width: 110px;">
                <a type="button" class="btn btn-secondary btn-outline-hover-brand btn-icon" title="Edit" href=""><i
                        class="fa fa-pen-alt"></i></a>
                <a type="button" class="btn btn-secondary btn-outline-hover-danger btn-icon" title="Delete" wire:click="delete({{$adjusted->id}})"><i
                        class="fa fa-trash-alt"></i></a>
            </span>
        </td>
    </tr>
@endforeach

@endslot
</x-table>
</div>
