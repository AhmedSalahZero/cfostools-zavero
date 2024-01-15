<x-form.modal :title="__('Export Options')" :table-id="$tableId" :type="'export'" action="{{ $exportRoute}}">

                @include('admin.sharing-links.options' , [
                    'type'=>'export'
                ] )

                <x-form.select :label="__('Format')" :name="'format'" :options="getExportFormat()"></x-form.select>
                
               <x-form.filter-btn :type="'export'" :id="'export-btn-id'" :datatable-id="$tableId" :btn-title="__('Export')">
               
               </x-form.filter-btn>

               </x-form.modal>