@php
    $tableId = 'kt_table_1';
@endphp
<script>
    let tableId = 'kt_table_1';

</script>
<style>
    .dt-buttons.btn-group{
        display:flex;
        align-items:flex-start ; 
        justify-content:flex-end ;
        margin-bottom:1rem;
    }
    .btn-border-radius{
        border-radius:10px !important;
    }
</style>
<div class="table-custom-container position-relative  ">

<x-tables.basic-view    class="position-relative  main-table-class" id="{{ $tableId }}">
    <x-slot name="filter">
        @include('admin.sharing-links.filter' , [
            'type'=>'filter'
        ])
    </x-slot>

    <x-slot name="export">
        @include('admin.sharing-links.export' , [
            'type'=>'export'
        ])
    </x-slot>


    <x-slot name="headerTr" >
        <tr class="header-tr "  data-model-name="{{ $modelName }}">
        @if($hasChildRows)
            {{-- <th class="view-table-th header-th trigger-child-row-1" >
                {{ __('Expand') }}
            </th> --}}
            @endif 

            <th class="view-table-th header-th" data-db-column-name="id" data-is-relation="0" class="header-th" data-is-json="0">
                {{ __('#') }}
            </th>
            <th class="view-table-th header-th" data-db-column-name="user_name" data-relation-name="" data-is-relation="0" class="header-th" data-is-json="0">
                {{ __('User Name') }}
            </th>

             <th class="view-table-th header-th" data-db-column-name="link" data-relation-name="" data-is-relation="0" class="header-th" data-is-json="0">
                {{ __('Shareable Link') }}
            </th>

             <th class="view-table-th header-th" data-db-column-name="link" data-relation-name="" data-is-relation="0" class="header-th" data-is-json="0">
                {{ __('Number Of Views') }}
            </th>

             <th class="view-table-th header-th" data-db-column-name="" data-relation-name="shareable" data-is-relation="0" class="header-th" data-is-json="0">
                {{ __('Model Type') }}
            </th>

            <th data-db-column-name="delivery_days" data-is-relation="0" data-relation-name="" class="header-th view-table-th" data-is-json="0">
                {{ __('Active') }}
            </th>
            
             <th class="view-table-th header-th" data-db-column-name="name" data-is-relation="1" data-relation-name="creator" class="header-th" data-is-json="0">
                {{ __('Creator Name') }}
            </th>
              <th class="view-table-th header-th" data-db-column-name="created_at" data-is-relation="0"  class="header-th" data-is-json="0">
                {{ __('Created At') }}
            </th>
            {{--
            <th class="view-table-th header-th" data-db-column-name="updated_at" data-is-relation="0"  class="header-th" data-is-json="0">
                {{ __('Update At') }}
            </th> --}}


            <th class="view-table-th"  class="header-th">
                {{ __('Actions') }}
            </th>
        </tr>

    </x-slot>

    <x-slot name="js">
        <script >
      
    window.addEventListener('DOMContentLoaded', function() {
        (function() {

             // Add event listener for opening and closing details

            
 
                 "use strict";
                var KTDatatablesDataSourceAjaxServer = function() {

	            var initTable1 = function() {
                    var tableId = '#'+ "{{ $tableId }}" ;
                   
		var table = $(tableId);
		// begin first table
		table.DataTable(
            {

                
                       dom: 'Bfrtip',
                // "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "ajax": {
                    "url": "{{ $getDataRoute }}"
                    , "type": "GET"
                    , "dataSrc": "data", // they key in the jsom response from the server where we will get our data
                    "data": function(d) {
                        // tableId +'_filter'+ ' label input'
                        d.search_input = $(getSearchInputSelector(tableId)).val();
                         d.user_name = $('#filter_user_name').val();
                    }

                }
                , "processing": false 
                , "ordering": false
                , "serverSide": true,
                "responsive":true
                , "pageLength": 25
                , "columns": [
                    {
                        data: 'id' , searchable: false
                        , orderable: false
                    }
                    ,

                    {
                        render: function(d, b, row) {
                            return row['user_name']
                        } ,
                        data:'id',
                        className:'editable'
                    }, 

                    {
                        render: function(d, b, row) {
                            // return " " ;
                            return row['link' ]
                        } ,
                        data:'id',
                        className:'editable'
                    }, 

                     {
                        render: function(d, b, row) {
                            // return " " ;
                            return row['number_of_views' ]
                        } ,
                        data:'id',
                        className:'editable'
                    }, 

                    {
                        render: function(d, b, row) {
                            return row['shareableTypeName']
                        } ,
                        data:'id',
                        className:'editable'
                    },
                    {
                        data: 'is_active' , searchable: false
                        , orderable: false,
                        className:"text-center"
                    },
                    
                    {
                        data: 'creator_name' , searchable: false
                        , orderable: false,
                        className:"text-center"
                    }
                    , {
                        data: 'created_at_formatted'  , searchable: false
                        , orderable: false,
                        className:'text-nowrap'
                    }
                    // , 
                    // {
                    //     data: 'updated_at_formatted'  , searchable: false
                    //     , orderable: false
                    // }
                    , {
                        data:'id'
                        , searchable: false
                        , orderable: false,
                        className:"text-center",
                        render: function(d, b, row) {
                            let result = '';
                            if(row.is_active)
                            {
                                result+= ` <a data-toggle="modal" data-target="#sharing_link_model_${row.id}" data-model-name="{{$modelName}}" data-table-id="${tableId.replace('#','')}" data-record-id="${row.id}"   class="btn btn-sm btn-clean cursor-pointer btn-icon btn-icon-md" title="{{ __('Share') }}">
                                       <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <mask id="mask-2" fill="white">
            <use xlink:href="#path-1"/>
        </mask>
        <g id="bound"/>
        <path d="M15.6274517,4.55882251 L14.4693753,6.2959371 C13.9280401,5.51296885 13.0239252,5 12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L14,10 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C13.4280904,3 14.7163444,3.59871093 15.6274517,4.55882251 Z" id="Combined-Shape" fill="#000000"/>
    </g>
</svg>
                        </a>`;
                            }
                            else{
                                result+= ` <a data-toggle="modal" data-target="#sharing_link_model_${row.id}" data-model-name="{{$modelName}}" data-table-id="${tableId.replace('#','')}" data-record-id="${row.id}"   class="btn btn-sm btn-clean cursor-pointer btn-icon btn-icon-md" title="{{ __('Share') }}">
                                       <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <mask id="mask-2" fill="white">
                                                        <use xlink:href="#path-1"/>
                                                    </mask>
                                                    <g id="bound"/>
                                                    <path d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z" id="Mask" fill="#000000"/>
                                                </g>
                                            </svg>
                                        </a>`;
                            }
                            result += `    <a data-model-name="{{$modelName}}" data-table-id="${tableId.replace('#','')}" data-record-id="${row.id}"   class="btn btn-sm btn-clean delete-record-btn btn-icon btn-icon-md" title="{{ __('Delete') }}">
                          <i class="la la-trash icon-lg"></i>
                        </a>`;
                            return result
                        
                        ;
                        }
                    }
                ]
                , columnDefs: [
                    {
                        targets: 0,
                        defaultContent :'salah'
                        , className: 'red reset-table-width'
                    }
                ],
                buttons:[
                 
                    {
                        "attr":{
                            'data-table-id':tableId.replace('#',''),
                            // 'id':'test'
                        },
                        "text":  '<svg style="margin-right:10px;position:relative;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect id="bound" x="0" y="0" width="24" height="24"/><path d="M5,4 L19,4 C19.2761424,4 19.5,4.22385763 19.5,4.5 C19.5,4.60818511 19.4649111,4.71345191 19.4,4.8 L14,12 L14,20.190983 C14,20.4671254 13.7761424,20.690983 13.5,20.690983 C13.4223775,20.690983 13.3458209,20.6729105 13.2763932,20.6381966 L10,19 L10,12 L4.6,4.8 C4.43431458,4.5790861 4.4790861,4.26568542 4.7,4.1 C4.78654809,4.03508894 4.89181489,4 5,4 Z" id="Path-33" fill="#000000"/></g></svg>' + '{{ __("Filter") }}',
                        'className':'btn btn-bold btn-secondary filter-table-btn  flex-1 flex-grow-0 btn-border-radius do-not-close-when-click-away',
                        "action":function(){
                            $('#filter_form-for-'+tableId.replace('#','')).toggleClass('d-none');
                        }
                    }
                    ,{
                        "text":  '<svg style="margin-right:10px;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect id="bound" x="0" y="0" width="24" height="24"/><path d="M17,8 C16.4477153,8 16,7.55228475 16,7 C16,6.44771525 16.4477153,6 17,6 L18,6 C20.209139,6 22,7.790861 22,10 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,9.99305689 C2,7.7839179 3.790861,5.99305689 6,5.99305689 L7.00000482,5.99305689 C7.55228957,5.99305689 8.00000482,6.44077214 8.00000482,6.99305689 C8.00000482,7.54534164 7.55228957,7.99305689 7.00000482,7.99305689 L6,7.99305689 C4.8954305,7.99305689 4,8.88848739 4,9.99305689 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,10 C20,8.8954305 19.1045695,8 18,8 L17,8 Z" id="Path-103" fill="#000000" fill-rule="nonzero" opacity="0.3"/><rect id="Rectangle" fill="#000000" opacity="0.3" transform="translate(12.000000, 8.000000) scale(1, -1) rotate(-180.000000) translate(-12.000000, -8.000000) " x="11" y="2" width="2" height="12" rx="1"/><path d="M12,2.58578644 L14.2928932,0.292893219 C14.6834175,-0.0976310729 15.3165825,-0.0976310729 15.7071068,0.292893219 C16.0976311,0.683417511 16.0976311,1.31658249 15.7071068,1.70710678 L12.7071068,4.70710678 C12.3165825,5.09763107 11.6834175,5.09763107 11.2928932,4.70710678 L8.29289322,1.70710678 C7.90236893,1.31658249 7.90236893,0.683417511 8.29289322,0.292893219 C8.68341751,-0.0976310729 9.31658249,-0.0976310729 9.70710678,0.292893219 L12,2.58578644 Z" id="Path-104" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 2.500000) scale(1, -1) translate(-12.000000, -2.500000) "/></g></svg>' + '{{ __("Export") }}',
                        'className':'btn btn-bold btn-secondary  flex-1 flex-grow-0 btn-border-radius ml-2 do-not-close-when-click-away',
                        "action":function(){
                            $('#export_form-for-'+tableId.replace('#','')).toggleClass('d-none');
                        }
                    },

                ]
                , createdRow: function(row, data, dataIndex, cells) {
                    // console.log(data);
                    $(row).addClass('edit-info-row').attr('data-model-id',data.id).attr('data-model-name','{{ $modelName }}');
                    $(cells).filter(".editable").attr('contenteditable',true);
                    const message = data.is_active ? "{{ __('Deactive') }}" : "{{ __('Active') }}" ; 
                    const alertMessage = data.is_active  ? "{{ __('This Sharable Link Is Active Now .. Deactive It ?') }}" : "{{ __('This Sharable Link Is Deactive Now .. Activite it ?') }}" 
                    $(row).append(`
                    <!-- Modal -->
<div class="modal fade modal-for-edit-sharing-link" id="sharing_link_model_${data.id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">{{ __('Shareable Link') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <form id="edit-sharable-form-id-${data.id}"   data-sharing-link-id="${data.id}"  class="create-shareable-link">
      <h5 >${alertMessage}</h5>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
            <button data-sharing-link-id="${data.id}" type="button" class="btn btn-primary submit-edit-modal-class ">${message}</button>
      </div>

      
      </div>
      
      </form>
    </div>
  </div>
</div>
                    `)

                },
                drawCallback:function(settings)
                {
                    reinitializeSelect2();
                }
                


            }

        );
	};

	return {

		//main function to initiate the module
		init: function() {
			initTable1();
		},

	};

}();

jQuery(document).ready(function() {
	KTDatatablesDataSourceAjaxServer.init();
});
        })(jQuery);
    });
function getSearchInputSelector(tableId)
{
    return tableId +'_filter'+ ' label input' ;
}

// $(document).ready(function(){

// })


        </script>
    </x-slot>
@push('js')
    
<script>
        $(function(){
                    $(document).on('click','.submit-edit-modal-class',function(e){
                        $('.submit-edit-modal-class').prop('disabled',true);
                         e.preventDefault();
                         const formData = {
                             sharing_id:$(this).closest('form').data('sharing-link-id'),
                         }

                         $.ajax({
                             url:"{{ route('admin.toggle.sharing.links' , getCurrentCompanyId()) }}",
                             type:'post',
                             data:formData,
                             success:function(res){
                            $('#'+tableId).DataTable().ajax.reload(null,false);

                        },
                        error:function(){
                       
                         
                        },
                        complete:function(){
                               $('.submit-edit-modal-class').prop('disabled',false);
                               $('.modal-for-edit-sharing-link').modal('hide');
                        }
                         });
                        });
        })
</script>
@endpush
</x-tables.basic-view>
</div>

