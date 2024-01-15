@php
    $tableId = 'kt_table_1';
@endphp
<style>
    /* table.dataTable.dtr-inline.collapsed > tbody > tr > td.dtr-control::before, table.dataTable.dtr-inline.collapsed > tbody > tr > th.dtr-control::before,
    .dataTables_wrapper table.dataTable.dtr-inline.collapsed > tbody > tr.parent > td:first-child::before
    {
        content:none ;
    } */
 .modal-backdrop{
     display:none !important;
 }
 .main-with-no-child{
     background-color:rgb(238, 238, 238) !important;
     font-weight:bold;
 }
  .is-sub-row td.sub-text-bg{
     background-color:#aedbed !important;
     color:black !important;

 }
 .sub-numeric-bg{
     text-align:center;

 }
 .is-sub-row td.sub-numeric-bg , 
 .is-sub-row td.sub-text-bg
 {
    background-color: #0e96cd !important;
    color: white !important;

 }
 .header-tr{
     background-color:#046187 !important;
 }
    .dt-buttons.btn-group{
        display:flex;
        align-items:flex-start ; 
        justify-content:flex-end ;
        margin-bottom:1rem;
    }
    		.is-sales-rate, .is-sales-rate td{
				background-color: #046187 !important;
				color: white !important;
			}
            .dataTables_wrapper .dataTable th, .dataTables_wrapper .dataTable td{
                font-weight: bold;
                color:black;
            }
            a[data-toggle="modal"]{
                color:#046187 !important;
            }

    .btn-border-radius{
        border-radius:10px !important;
    }
</style>
    {{-- <form method="post" action="{{ route('admin.store.income.statement.report',['company'=>getCurrentCompanyId()]) }}"> --}}
    @csrf
    <input type="hidden" id="editable-by-btn" value="1">
<div class="table-custom-container position-relative  ">
    <input type="hidden" value="{{ $incomeStatement->id }}" id="model-id">
    <input type="hidden" id="cost-of-goods-id"  value="{{ \App\Models\IncomeStatementItem::COST_OF_GOODS_ID }}">
    <input type="hidden" id="sales-growth-rate-id"  value="{{ \App\Models\IncomeStatementItem::SALES_GROWTH_RATE_ID }}">
    <input type="hidden" id="sales-revenue-id"  value="{{ \App\Models\IncomeStatementItem::SALES_REVENUE_ID }}">
    <input type="hidden" id="gross-profit-id"  value="{{ \App\Models\IncomeStatementItem::GROSS_PROFIT_ID }}">
    <input type="hidden" id="market-expenses-id"  value="{{ \App\Models\IncomeStatementItem::MARKET_EXPENSES_ID }}">
    <input type="hidden" id="sales-and-distribution-expenses-id"  value="{{ \App\Models\IncomeStatementItem::SALES_AND_DISTRIBUTION_EXPENSES_ID }}">
    <input type="hidden" id="general-expenses-id"  value="{{ \App\Models\IncomeStatementItem::GENERAL_EXPENSES_ID }}">
    <input type="hidden" id="earning-before-interest-taxes-depreciation-amortization-id"  value="{{ \App\Models\IncomeStatementItem::EARNING_BEFORE_INTEREST_TAXES_DEPRECIATION_AMORTIZATION_ID }}">
    <input type="hidden" id="earning-before-interest-taxes-id"  value="{{ \App\Models\IncomeStatementItem::EARNING_BEFORE_INTEREST_TAXES_ID }}">
    <input type="hidden" id="financial-income-or-expenses-id"  value="{{ \App\Models\IncomeStatementItem::FINANCIAL_INCOME_OR_EXPENSE_ID }}">
    <input type="hidden" id="earning-before-taxes-id"  value="{{ \App\Models\IncomeStatementItem::EARNING_BEFORE_TAXES_ID }}">
    <input type="hidden" id="corporate-taxes-id"  value="{{ \App\Models\IncomeStatementItem::CORPORATE_TAXES_ID }}">
    <input type="hidden" id="net-profit-id"  value="{{ \App\Models\IncomeStatementItem::NEXT_PROFIT_ID }}">
    <input type="hidden" id="sales-rate-maps"  value="{{ json_encode(\App\Models\IncomeStatementItem::salesRateMap()) }}">
    <script>
        let sales_rates_maps = document.getElementById('sales-rate-maps').value;
     const sales_rate_maps = JSON.parse(sales_rates_maps) ;
     function getKeyByValue(object, value) {
  return Object.keys(object).find(key => object[key] === value);
}

    </script>



<x-tables.basic-view  :form-id="'store-report-form-id'" :wrap-with-form="true" :form-action="route('admin.store.income.statement.report',['company'=>getCurrentCompanyId()])"  class="position-relative table-with-two-subrows main-table-class" id="{{ $tableId }}">
    <x-slot name="filter">
        @include('admin.income-statement.report.filter' , [
            'type'=>'filter'
        ])
    </x-slot>

    <x-slot name="export">
        @include('admin.income-statement.report.export' , [
            'type'=>'export'
        ])
    </x-slot>


    <x-slot name="headerTr" >
        <tr class="header-tr "  data-model-name="{{ $modelName }}">
            <th class="view-table-th header-th trigger-child-row-1" >
                {{ __('Expand') }}
            </th>

            <th class="view-table-th header-th" data-db-column-name="id" data-is-relation="0" class="header-th" data-is-json="0">
                {{ __('Actions') }}
            </th>
            <th class="view-table-th header-th" data-is-collection-relation = "0" data-collection-item-id = "0" data-db-column-name="name" data-relation-name="BussinessLineName" data-is-relation="1" class="header-th" data-is-json="0">
                {{ __('Name') }}
                {{-- {!!  !!} --}}
            </th>
            <input type="hidden" name="dates[]" value="{{ json_encode(array_keys($incomeStatement->getIntervalFormatted())) }}" id="dates">
            @foreach($incomeStatement->getIntervalFormatted() as $defaultDateFormate=>$interval)
             <th data-date="{{ $defaultDateFormate }}" class="view-table-th header-th" data-is-collection-relation = "0" data-collection-item-id = "0" data-db-column-name="name" data-relation-name="ServiceCategory" data-is-relation="1" class="header-th" data-is-json="0">
                {{ $interval }}
            </th>
            @endforeach 
        </tr>

    </x-slot>

    <x-slot name="js">
        <script >
      
    window.addEventListener('DOMContentLoaded', function() {
        (function($) {
                  function formatsubrow1(d,dates) {
                      
    // `d` is the original data object for the row
    let subtable = `<table id="subtable-1-id${d.id}" class="subtable-1-class table table-striped-  table-hover table-checkable position-relative dataTable no-footer dtr-inline" > <thead style="display:none"><tr><td></td><td></td><td></td><td></td><td></td>
    <td></td> <td></td><td></td>  `;
    for(date in dates){
     subtable+=    ' <td> </td>';
    }
     subtable+=` </tr> </thead> `;
     
     subtable+= '</table>';
    return (subtable);
    }
    
  

 
  
 
    // Add event listener for opening and closing details
    $(document).on('click', '.trigger-child-row-1', function (e) {
    const parentId = $(e.target.closest('tr')).data('model-id');
    var parentRow = $(e.target).parent() ;
     var subRows = parentRow.nextAll('tr.add-sub.maintable-1-row-class'+parentId) ;
    
     subRows.toggleClass('d-none');
     if(subRows.hasClass('d-none')){
         parentRow.find('td.trigger-child-row-1').html('+');
     }
     else if(!subRows.length){
         // if parent row has no sub rows then remove + or - 
         parentRow.find('td.trigger-child-row-1').html('×');
     }
     else{
         parentRow.find('td.trigger-child-row-1').html('-');
     }
    
    });

                 "use strict";
                var KTDatatablesDataSourceAjaxServer = function() {

	            var initTable1 = function() {
                    var tableId = '#'+ "{{ $tableId }}" ;
                   
		var table = $(tableId);
        let data = $('#dates').val();
        data = JSON.parse(data);
        window['dates'] = data;
        const columns = [];
        columns.push( {
                        data: 'order' , searchable: false
                        , orderable: false,
                        className:'trigger-child-row-1 cursor-pointer sub-text-bg' ,
                        render:function(d,b,row){
                            if(! row.isSubItem && row.has_sub_items){
                            return '+';
                            } 
                            return '';
                        }
                    });
                    columns.push({
                        render: function(d, b, row) {
                            let modelId = $('#model-id').val();
                            
                            if(! row.isSubItem && row.has_sub_items){
                                elements  = `<a data-is-subitem="0" data-income-statement-item-id="${row.id}" data-income-statement-id="${modelId}" class="d-block mb-2" href="#" data-toggle="modal" data-target="#add-sub-modal${row.id}">{{ __('Add') }}</a> `;
                                if(row.sub_items.length){
                                    elements += `<a data-is-subitem="0" data-income-statement-item-id="${row.id}" data-income-statement-id="${modelId}" class="d-block  text-danger" href="#" data-toggle="modal" data-target="#delete-sub-modal${row.id}">{{ __('Delete') }}</a> `
                                }
                                return elements ;
                            }
                            else if(row.isSubItem){
                                console.log(row);
                                return `<a data-is-subitem="1" class="d-block mb-2" href="#" data-toggle="modal" data-target="#edit-sub-modal${row.id}">{{ __('Edit') }}</a> <a class="d-block mb-2 text-danger" href="#" data-toggle="modal" data-target="#delete-sub-modal${row.id}">{{ __('Delete') }}</a>`
                            }
                            return '';
                        } ,
                        data:'order'
                         ,className:'cursor-pointer sub-text-bg',
                    });
                    columns.push({
                        render: function(d, b, row) {
                            this.currentRow = row ;
                            if(row.isSubItem){
                                return row.pivot.sub_item_name;
                            }
                            return row['name']
                            
                        } ,
                        data:'order',
                        className:'sub-text-bg text-nowrap editable editable-text '  
                    });
                    for(let i = 0 ; i<data.length ; i++){
                        columns.push(
                            {
                        render: function(d, b, row,setting) {
                            date = data[i];
                        if(row.isSubItem && row.pivot.payload){
                            var payload = JSON.parse(row.pivot.payload); 
                            return payload[date] ? number_format(payload[date]) : 0;
                        }
                        if(row.has_sub_items){
                            let total = get_total_of_object(row.sub_items,date ) ;
                            return row.sub_items ? number_format(total) : 0
                        }
                        // if(row.sub_items && row.sub_items[0]){
                        //     var payload = row.sub_items[0].pivot.payload ;
                        //     return   payload ? JSON.parse(payload)[date] : 0; 
                        // }
             
                        return 0
                        
                        } ,
                        data:'order',
                        className:'sub-numeric-bg text-nowrap editable editable-date date-'+data[i]
                    
                        })
                    }
                    
                     
		// begin first table
		table.DataTable(
            {

                
                       dom: 'Bfrtip',
                // "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "ajax": {
                    "url": "{{ $getDataRoute }}"
                    , "type": "post"
                    , "dataSrc": "data", // they key in the jsom response from the server where we will get our data
                    "data": function(d) {
                        d.search_input = $(getSearchInputSelector(tableId)).val();
                    }

                }
                , "processing": false ,
                "scrollX":true
                , "ordering": false,
                'paging':false
                , "serverSide": true,
                "responsive":false
                , "pageLength": 25
                , "columns": columns
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
                        "text":  '<svg style="margin-right:10px;position:relative;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect id="bound" x="0" y="0" width="24" height="24"/><path d="M5,4 L19,4 C19.2761424,4 19.5,4.22385763 19.5,4.5 C19.5,4.60818511 19.4649111,4.71345191 19.4,4.8 L14,12 L14,20.190983 C14,20.4671254 13.7761424,20.690983 13.5,20.690983 C13.4223775,20.690983 13.3458209,20.6729105 13.2763932,20.6381966 L10,19 L10,12 L4.6,4.8 C4.43431458,4.5790861 4.4790861,4.26568542 4.7,4.1 C4.78654809,4.03508894 4.89181489,4 5,4 Z" id="Path-33" fill="#000000"/></g></svg>' + '{{ __("Analysis") }}',
                        'className':'btn btn-bold btn-secondary filter-table-btn  flex-1 flex-grow-0 btn-border-radius do-not-close-when-click-away',
                        "action":function(){
                            // alert();
                            $('#filter_form-for-'+tableId.replace('#','')).toggleClass('d-none');
                        }
                    },
          
                    {
                        "attr":{
                            'data-table-id':tableId.replace('#',''),
                            // 'id':'test'
                        },
                        "text":  '<svg style="margin-right:10px;position:relative;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect id="bound" x="0" y="0" width="24" height="24"/><path d="M5,4 L19,4 C19.2761424,4 19.5,4.22385763 19.5,4.5 C19.5,4.60818511 19.4649111,4.71345191 19.4,4.8 L14,12 L14,20.190983 C14,20.4671254 13.7761424,20.690983 13.5,20.690983 C13.4223775,20.690983 13.3458209,20.6729105 13.2763932,20.6381966 L10,19 L10,12 L4.6,4.8 C4.43431458,4.5790861 4.4790861,4.26568542 4.7,4.1 C4.78654809,4.03508894 4.89181489,4 5,4 Z" id="Path-33" fill="#000000"/></g></svg>' + '{{ __("Interval View") }}',
                        'className':'btn btn-bold btn-secondary filter-table-btn ml-2 flex-1 flex-grow-0 btn-border-radius do-not-close-when-click-away',
                        "action":function(){
                            // alert();
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

                    var incomeStatementId= data.isSubItem ? data.pivot.income_statement_id  : $('#model-id').val() ;
                    var incomeStatementItemId = data.isSubItem ? data.pivot.income_statement_item_id  : data.id ;
                    var subItemName =data.isSubItem ? data.pivot.sub_item_name  : '' ;
                     $(cells).filter(".editable").attr('contenteditable',true)
                    .attr('data-income-statement-id',incomeStatementId)
                    .attr('data-main-model-id',incomeStatementId)
                    .attr('data-income-statement-item-id',incomeStatementItemId)
                    .attr('data-main-row-id',incomeStatementItemId)
                    .attr('data-sub-item-name',subItemName)
                    .attr('data-table-id' , "{{$tableId}}")
                    if(data.isSubItem ){
                    $(row).addClass('edit-info-row').addClass('add-sub maintable-1-row-class'+(incomeStatementItemId))
                        $(row).addClass('d-none is-sub-row '  );
                 
                        if(data.pivot && data.pivot.is_depreciation_or_amortization){
                            $(row).addClass('is-depreciation-or-amortization')
                        }

                                          $(cells).filter('.editable.editable-date').each(function(index,dateDt){
                        var filterDate = $(dateDt).attr("class").split(/\s+/).filter(function(classItem){
                            return classItem.startsWith('date-');
                        })[0];
                        filterDate = filterDate.split('date-')[1];
                        var hiddenInput = `<input type="hidden" name="value[${incomeStatementId}][${incomeStatementItemId}][${subItemName}][${filterDate}]" data-date="${filterDate}" data-parent-model-id="${incomeStatementItemId}" value="${($(dateDt).html().replace(/(<([^>]+)>)/gi, "").replace(/,/g, ""))}" > `;
                        $(dateDt).after(hiddenInput);
                        $(hiddenInput).trigger('change');
                    });

                    $(cells).filter('.editable.editable-text').each(function(index,textDt){
                           var hiddenInput = `<input type="hidden"   name="incomeStatementItemName[${incomeStatementId}][${incomeStatementItemId}][${subItemName}]" value="${$(textDt).html()}" > `;
                        $(textDt).after(hiddenInput);
                      })

                    }
                    
                    else{
                        if(!data.has_sub_items ){
                      
                            $(row).addClass('main-with-no-child').attr('data-model-id',data.id);
                         
                                    $(cells).filter('.editable.editable-date').each(function(index,dateDt){
                        var filterDate = $(dateDt).attr("class").split(/\s+/).filter(function(classItem){
                            return classItem.startsWith('date-');
                        })[0];
                        filterDate = filterDate.split('date-')[1];

                        var hiddenInput = `<input type="hidden" name="valueMainRowWithoutSubItems[${incomeStatementId}][${incomeStatementItemId}][${filterDate}]" data-date="${filterDate}" data-parent-model-id="${incomeStatementItemId}" value="${($(dateDt).html().replace(/(<([^>]+)>)/gi, "").replace(/,/g, ""))}" > `;
                        $(dateDt).after(hiddenInput);
                    });
                            let dependOn = JSON.parse(data.depends_on) ;
                            if(dependOn.length)
                            {
                                $(row).attr('data-depends-on',dependOn.join(','))
                            }
                            $(cells).each(function(index,cell){
                            $(cell).removeClass('editable').removeClass('editable-text').attr('contenteditable',false)
                        });


                           if(data.is_sales_rate){
                                $(row).addClass('is-sales-rate');
                            }

                        }
                     
                        else{
                            $(row).addClass('is-main-with-sub-items');
                            if(data.is_main_for_all_calculations){
                                $(row).addClass('is-main-for-all-calculations');
                            }
                               $(cells).filter('.editable.editable-date').each(function(index,dateDt){
                        var filterDate = $(dateDt).attr("class").split(/\s+/).filter(function(classItem){
                            return classItem.startsWith('date-');
                        })[0];
                             

                        filterDate = filterDate.split('date-')[1];
                        var hiddenInput = `<input type="hidden" class="main-row-that-has-sub-class" name="valueMainRowThatHasSubItems[${incomeStatementId}][${incomeStatementItemId}][${filterDate}]" data-date="${filterDate}" data-parent-model-id="${incomeStatementItemId}" value="${($(dateDt).html().replace(/(<([^>]+)>)/gi, "").replace(/,/g, ""))}" > `;
                        $(dateDt).after(hiddenInput);
                    });

                               $(cells).each(function(index,cell){
                            $(cell).removeClass('editable').removeClass('editable-text').attr('contenteditable',false)
                        });

                        if(data.has_depreciation_or_amortization){
                            nameAndDepreciationIfExist = ` <div class="append-names mt-2" data-id="${data.id}">

                <div class="form-group how-many-item d-flex text-nowrap" data-id="${data.id}" data-index="0">
                   <div>
                        <label class="form-label">{{ __('Name') }}</label>
                        <input name="sub_items[0][name]" type="text" value="" class="form-control">
                    </div>
                    <div class="form-check mt-2">
  <label class="form-check-label"  style="margin-top:3px;display:block" >
    {{ __('Is Depreciation Or Amortization') }}
  </label>

  <input class="form-check-input" type="checkbox" value="1" name="sub_items[0][is_depreciation_or_amortization]"  checked style="width:16px;height:16px;margin-left:-0.05rem;left:50%;">
  
</div>
                </div>
            </div>`;
                        }
                        else{
          nameAndDepreciationIfExist = ` <div class="append-names mt-2" data-id="${data.id}">

                <div class="form-group how-many-item" data-id="${data.id}" data-index="0">
                    <label class="form-label">{{ __('Name') }}</label>
                    <input name="sub_items[0][name]" type="text" value="" class="form-control">
                </div>
            </div>`;

                        }

                         $(row).addClass('edit-info-row').addClass('add-sub maintable-1-row-class'+(data.id)).attr('data-model-id',data.id).attr('data-model-name','{{ $modelName }}')
                    .append(`
                    <div class="modal fade" id="add-sub-modal${data.id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">{{ __('Add Sub Item For') }} ${data.name} </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add-sub-item-form${data.id}" class="submit-sub-item" action="{{ route('admin.store.income.statement.report',['company'=>getCurrentCompanyId()]) }}">
            
            <label class="label ">{{ __('How Many Items ?') }}</label>
            <input type="hidden" name="income_statement_item_id"  value="${data.id}">
            <input  type="hidden" name="income_statement_id"  value="{{ $incomeStatement->id }}">

            <input data-id="${data.id}" class="form-control how-many-class only-greater-than-zero-allowed" type="number" value="1">
          
           ${nameAndDepreciationIfExist}
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close')  }}</button>
        <button type="button" class="btn btn-primary save-sub-item" data-id="${data.id}">{{ __('Save') }}</button>
      </div>
    </div>
  </div>
    </div>

                    `)

                        }
                     

                    }
                    
                       

                    
                    ;
                    $(cells).filter(".editable").attr('contenteditable',true);
                    

                },
                drawCallback:function(settings)
                {
                            var dates = "{{ json_encode(array_keys($incomeStatement->getIntervalFormatted())) }}";
                            dates = dates.replace(/(&quot\;)/g,"\"")

                    if($('.is-main-for-all-calculations').length){
                        var mainRowWithSubItems = null ;
                        $('.is-main-for-all-calculations').each(function(index,mainRow){
                            if(!mainRowWithSubItems){
                                var modelId = $(mainRow).data('model-id');
                                if($(mainRow).nextAll('.is-sub-row.maintable-1-row-class'+modelId).length ){
                                    mainRowWithSubItems = mainRow
                                }
                                
                            }
                            
                        });
                        if(mainRowWithSubItems)
                        {
                       
                             dates = JSON.parse(dates) ;
                                for(date of dates){
                                    $(mainRowWithSubItems).next('tr').find('input[data-date="' + date +'"]').trigger('change');   
                                }
                                
                        }
                       

                    }

                        updateAllMainsRowPercentageOfSales(dates)

                },
                initComplete:function(settings,json){
                    
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
    
$(document).on('click','.save-sub-item',function(e){
    e.preventDefault();
    let id = $(this).data('id');
    let form = document.getElementById('add-sub-item-form'+id);

        var formData = new FormData(form);

        $.ajax({
            type: 'POST',
            url: $(form).attr('action'),
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function(res) {
                // alert('good')
                $('.main-table-class').DataTable().ajax.reload( null, false )
                if(res.status)
                {

                    Swal.fire({
                        icon: 'success',
                        title: res.message,
                        // text: 'تمت العملية بنجاح',
                        // footer: '<a href="">Why do I have this issue?</a>'
                    })
                }
                else
                {
                    Swal.fire({
                        icon: 'error',
                        title: res.message,
                        text: 'حدث خطا اثناء تنفيذ العملية',
                        // footer: '<a href="">Why do I have this issue?</a>'
                    })
                }
            },
            error: function(data) {
                $('#imagedisplay').html("<h2>this file type is not supported</h2>");
            }
        });
});
$(document).on('blur','.editable',function(){
    $(this).next('input').val($(this).text().replace(/(<([^>]+)>)/gi, "").replace(/,/g, "")).trigger('change');
    $('.main-table-class').DataTable().columns.adjust();

});
$(document).on('change','.is-sub-row input',function(e){
    let grossProfitId = $('#gross-profit-id').val();
    let costOfGoodsId = $('#cost-of-goods-id').val();
    let salesRevenueId = $('#sales-revenue-id').val();
    let financialIncomeOrExpenses = $('#financial-income-or-expenses-id').val();
    let corporateTaxesId = $('#corporate-taxes-id').val();

        let marketExpensesId = $('#market-expenses-id').val();
     let salesAndDistributionExpensesId = $('#sales-and-distribution-expenses-id').val();
     let generalExpensesId = $('#general-expenses-id').val();

    let parentModelId = $(this).data('parent-model-id') ;
    let date = $(this).data('date');

    if(date && parentModelId)
    {
        updateParentMainRowTotal(parentModelId , date); 
    }
    if(parentModelId == salesRevenueId || parentModelId == costOfGoodsId)
    {

        updateGrowthRateForSalesRevenue(date);
        updateGrossProfit(date);

    }
    if(parentModelId == marketExpensesId || parentModelId == salesAndDistributionExpensesId || parentModelId == generalExpensesId  ){
           updateEarningBeforeIntersetTaxesDepreciationAmortization( date);
    }

    if(parentModelId == financialIncomeOrExpenses )
    {
        updateEarningBeforeTaxes(date);
    }

     if(parentModelId == corporateTaxesId )
    {
        updateNetProfit(date);
    }
        updatePercentageOfSalesFor(parentModelId,date);
        updateAllMainsRowPercentageOfSales()

    
});

function updateGrowthRateForSalesRevenue(currentDate){
    
    let dates = getDates();
     let previousDate = getPreviousDate(dates , currentDate);
    if(previousDate){
         let salesRevenueId = $('#sales-revenue-id').val();
         let salesGrowthRateId = $('#sales-growth-rate-id').val(); 
        let currentTotalSalesRevenueValue = parseFloat($('.is-main-with-sub-items[data-model-id="'+salesRevenueId+'"]').find('input[data-date="'+currentDate+'"]').val());
        let previousTotalSalesRevenueValue = parseFloat($('.is-main-with-sub-items[data-model-id="'+salesRevenueId+'"]').find('input[data-date="'+previousDate+'"]').val());
        let salesRevenueGrowthRate = currentTotalSalesRevenueValue ? ((currentTotalSalesRevenueValue - previousTotalSalesRevenueValue)/previousTotalSalesRevenueValue )*100 : 0 ;
        $('.main-with-no-child[data-model-id="'+salesGrowthRateId+'"]').find('input[data-date="'+ currentDate +'"]').val(salesRevenueGrowthRate).trigger('change');
        $('.main-with-no-child[data-model-id="'+salesGrowthRateId+'"]').find('td.date-'+currentDate).html(number_format(salesRevenueGrowthRate,2) + ' %');
    }

    return number_format(0 , 2) + ' %' ;


}
function getPreviousDate(dates , currentDate){
    let index = dates.indexOf(currentDate);
    if(index == 0)
    {
        return null ;
    }
    return dates[index-1];

}
function getDates(){
    var dates = "{{ json_encode(array_keys($incomeStatement->getIntervalFormatted())) }}";
    dates = dates.replace(/(&quot\;)/g,"\"");
    return JSON.parse(dates);
}

$(document).on('change','.main-with-no-child input',function(e){
    let rowId = $(this).data('parent-model-id');
     let grossProfitId = $('#gross-profit-id').val();
     let earningBeforeInterestTaxesDepreciationAmortizationId = $('#earning-before-interest-taxes-depreciation-amortization-id').val();
     let earningBeforeInterestTaxesId = $('#earning-before-interest-taxes-id').val();
     let earningBeforeTaxesId = $('#earning-before-taxes-id').val();
     let date = $(this).data('date');
     if(rowId == grossProfitId ){
         updateEarningBeforeIntersetTaxesDepreciationAmortization( date);
    }
    else if(rowId == earningBeforeInterestTaxesId){
        updateEarningBeforeTaxes(date);
    }
       else if(rowId == earningBeforeTaxesId){
        updateNetProfit(date);
    }
    updatePercentageOfSalesFor(rowId,date);
});
// function getSalesRateMaps()
// {
    
// }

function updateNetProfit(date){
    let earningBeforeTaxesId = $('#earning-before-taxes-id').val();
    let corporateTaxesId = $('#corporate-taxes-id').val();
    let netProfitId = $('#net-profit-id').val();
    let netProfitRow = $('.main-with-no-child[data-model-id="'+ netProfitId +'"]');
    let earningBeforeTaxesValueAtDate = $('.main-with-no-child[data-model-id="'+ earningBeforeTaxesId +'"]').find('td.date-'+date).next('input').val();
    let corporateTaxesValueAtDate = $('.is-main-with-sub-items[data-model-id="'+ corporateTaxesId +'"]').find('td.date-'+date).next('input').val();
    netprofitAtDate = earningBeforeTaxesValueAtDate-corporateTaxesValueAtDate ;
    netProfitRow.find('td.date-'+date).html(number_format(netprofitAtDate));
    netProfitRow.find('td.date-'+date).next('input').val(netprofitAtDate).trigger('change');
}
function updateEarningBeforeTaxes(date)
{
    let earningBeforeInterstTaxesId = $('#earning-before-interest-taxes-id').val();
    let financialIncomeOrExpensesId = $('#financial-income-or-expenses-id').val();
    let earningBeforeTaxesId = $('#earning-before-taxes-id').val();
    let earningBeforeTaxesIdRow = $('.main-with-no-child[data-model-id="'+ earningBeforeTaxesId +'"]');
    let earningBeforeInterstTaxesValueAtDate = $('.main-with-no-child[data-model-id="'+ earningBeforeInterstTaxesId +'"]').find('td.date-'+date).next('input').val();
    let financialIncomeOrExpensesValueAtDate = $('.is-main-with-sub-items[data-model-id="'+ financialIncomeOrExpensesId +'"]').find('td.date-'+date).next('input').val();
    earningBeforeTaxesAtDate = earningBeforeInterstTaxesValueAtDate-financialIncomeOrExpensesValueAtDate ;
    earningBeforeTaxesIdRow.find('td.date-'+date).html(number_format(earningBeforeTaxesAtDate));
    earningBeforeTaxesIdRow.find('td.date-'+date).next('input').val(earningBeforeTaxesAtDate).trigger('change');
    updateNetProfit(date);
}
function updateEarningBeforeIntersetTaxesDepreciationAmortization(date)
{
     let grossProfitId = $('#gross-profit-id').val();
     let marketExpensesId = $('#market-expenses-id').val();
     let salesAndDistributionExpensesId = $('#sales-and-distribution-expenses-id').val();
     let generalExpensesId = $('#general-expenses-id').val();
     let costOfGoodsId = $('#cost-of-goods-id').val();
     let earningBeforeInterstTaxesDepreciationAmortizationId = $('#earning-before-interest-taxes-depreciation-amortization-id').val();
    let earningBeforeInterestTaxesDepreciationAmortizationRow = $('.main-with-no-child[data-model-id="'+ earningBeforeInterstTaxesDepreciationAmortizationId +'"]');
    let grossProfitAtDate = parseFloat($('.main-with-no-child[data-model-id="'+ grossProfitId +'"]').find('td.date-'+date).next('input').val());
    let marketExpensesAtDate = parseFloat($('.is-main-with-sub-items[data-model-id="'+ marketExpensesId +'"]').find('td.date-'+date).next('input').val());
    let salesAndDistributionExpensesAtDate = parseFloat($('.is-main-with-sub-items[data-model-id="'+ salesAndDistributionExpensesId +'"]').find('td.date-'+date).next('input').val());
    let generalExpensesAtDate = parseFloat($('.is-main-with-sub-items[data-model-id="'+ generalExpensesId +'"]').find('td.date-'+date).next('input').val());

    let depreciationForCostOfGoodsSold = $('.is-main-with-sub-items[data-model-id="'+ costOfGoodsId +'"]').nextAll('tr.is-depreciation-or-amortization.maintable-1-row-class'+costOfGoodsId) ;
    let totalDepreciationForCostOfGoodsSoldAtDate =0; 
    for(depreciationRow of depreciationForCostOfGoodsSold){
        totalDepreciationForCostOfGoodsSoldAtDate += parseFloat($(depreciationRow).find('td.date-'+date).next('input').val());
    }


    let depreciationForMarketExpenses = $('.is-main-with-sub-items[data-model-id="'+ marketExpensesId +'"]').nextAll('tr.is-depreciation-or-amortization.maintable-1-row-class'+marketExpensesId) ;
    let totalDepreciationForMarketExpensesAtDate =0; 
    for(depreciationRow of depreciationForMarketExpenses){
        totalDepreciationForMarketExpensesAtDate += parseFloat($(depreciationRow).find('td.date-'+date).next('input').val());
    }

    let depreciationForSalesAndDistributionExpense = $('.is-main-with-sub-items[data-model-id="'+ salesAndDistributionExpensesId +'"]').nextAll('tr.is-depreciation-or-amortization.maintable-1-row-class'+salesAndDistributionExpensesId) ;
    let totalDepreciationForSalesAndDistributionExpenseAtDate =0; 
    for(depreciationRow of depreciationForSalesAndDistributionExpense){
        totalDepreciationForSalesAndDistributionExpenseAtDate += parseFloat($(depreciationRow).find('td.date-'+date).next('input').val());
    }

    let depreciationForGeneralExpenses = $('.is-main-with-sub-items[data-model-id="'+ generalExpensesId +'"]').nextAll('tr.is-depreciation-or-amortization.maintable-1-row-class'+generalExpensesId) ;
    let totalDepreciationForGeneralExpensesAtDate =0; 
    for(depreciationRow of depreciationForGeneralExpenses){
        totalDepreciationForGeneralExpensesAtDate += parseFloat($(depreciationRow).find('td.date-'+date).next('input').val());
    }
    let totalDepreciationsAtDate =  totalDepreciationForGeneralExpensesAtDate + totalDepreciationForSalesAndDistributionExpenseAtDate + totalDepreciationForMarketExpensesAtDate + totalDepreciationForCostOfGoodsSoldAtDate
    let earningBeforeInterestTaxesAtDate = grossProfitAtDate-marketExpensesAtDate- salesAndDistributionExpensesAtDate-generalExpensesAtDate ;
    let earningBeforeInterstTaxesDepreciationAmortizationAtDate =earningBeforeInterestTaxesAtDate + totalDepreciationsAtDate;
    earningBeforeInterestTaxesDepreciationAmortizationRow.find('td.date-'+date).html(earningBeforeInterstTaxesDepreciationAmortizationAtDate);
    earningBeforeInterestTaxesDepreciationAmortizationRow.find('input[data-date="'+ date +'"]').val(earningBeforeInterstTaxesDepreciationAmortizationAtDate).trigger('change');
    updateEarningBeforeInterestTaxesDepreciationAmortizationId(earningBeforeInterestTaxesAtDate, date)

}
function updateEarningBeforeInterestTaxesDepreciationAmortizationId(earningBeforeInterestTaxesWithoutDepreciationAtDate , date){
    let EarningBeforeInterestTaxesId =  $('#earning-before-interest-taxes-id').val();
    let earningBeforeInterestTaxesRow = $('.main-with-no-child[data-model-id="'+ EarningBeforeInterestTaxesId +'"]');
        earningBeforeInterestTaxesRow.find('td.date-'+date).html(earningBeforeInterestTaxesWithoutDepreciationAtDate);
       earningBeforeInterestTaxesRow.find('input[data-date="'+ date +'"]').val(earningBeforeInterestTaxesWithoutDepreciationAtDate).trigger('change');
}
function updateParentMainRowTotal(parentModelId,date)
{
    let parentElement = $('tr.is-main-with-sub-items[data-model-id="'+  parentModelId +'"] ') ;
   let total = 0 ;
     parentElement.nextAll('.maintable-1-row-class'+parentModelId).each(function(index,subRow){
         var subRowTdValue = parseFloat($(subRow).find('td.date-'+date).next('input').val());
        total+= subRowTdValue ;
    })
    parentElement.find('td.date-'+date).next('input').val(total);
    parentElement.find('td.date-'+date).html(number_format(total));
}
function updateGrossProfit(date)
{
    let grossProfitId = $('#gross-profit-id').val();
    let costOfGoodsId = $('#cost-of-goods-id').val();
    let salesReveueId = $('#sales-revenue-id').val();
    let grossProfitRow = $('.main-with-no-child[data-model-id="'+ grossProfitId +'"]');
    let salesRevenueValueAtDate = $('.is-main-with-sub-items[data-model-id="'+ salesReveueId +'"]').find('td.date-'+date).next('input').val();
    let costOfGoodsValueAtDate = $('.is-main-with-sub-items[data-model-id="'+ costOfGoodsId +'"]').find('td.date-'+date).next('input').val();
    grossProfitAtDate = salesRevenueValueAtDate-costOfGoodsValueAtDate ;
    grossProfitRow.find('td.date-'+date).html(number_format(grossProfitAtDate));
    grossProfitRow.find('input[data-date="'+ date +'"]').val(grossProfitAtDate).trigger('change');
}

$(document).on('click','.save-form',function(e){
    e.preventDefault();
    form = document.getElementById('store-report-form-id');



        var formData = new FormData(form);

        $.ajax({
            type: 'POST',
            url: $(form).attr('action'),
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function(res) {
                $('.main-table-class').DataTable().ajax.reload( null, false )

                if(res.status)
                {
                    Swal.fire({
                        icon: 'success',
                        title: res.message,
                        text: 'تمت العملية بنجاح',
                        // footer: '<a href="">Why do I have this issue?</a>'
                    }).then(function(){
                   
                    })
                }
                else
                {
                    Swal.fire({
                        icon: 'error',
                        title: res.message,
                        text: 'حدث خطا اثناء تنفيذ العملية',
                        // footer: '<a href="">Why do I have this issue?</a>'
                    })
                }
            },
            error: function(data) {
                $('#imagedisplay').html("<h2>this file type is not supported</h2>");
            }
        });
 
})


$(document).on('keyup','.how-many-class',function(){
    let index = $(this).data('id');
    let oldHowMany = parseInt($('.old-how-many[data-id="'+ index +'"]').val());
    let currentHowMany = parseInt($('.how-many-class[data-id="'+ index +'"]').val());
    let currentHowManyInstances = $('.how-many-item[data-id="'+ index +'"]').length;
    if(currentHowMany<1){
        currentHowMany =1 ;
    }
    if(currentHowManyInstances == currentHowMany ){
        return ;
    }
    if(currentHowManyInstances >= currentHowMany){
        $('.how-many-item[data-id="'+ index +'"]').each(function(index,val){
            var order = index + 1  ; 
            
            if(order > currentHowMany){
            
                $(val).remove();
            }
        })
    }
    else{
        let numberOfNewInstances = currentHowMany - currentHowManyInstances ;
        for(i = 0 ; i< numberOfNewInstances ; i++){
            var lastInstanceClone = $('.how-many-item[data-id="'+ index +'"]:last-of-type').clone(true);
            var lastItemIndex = parseInt($('.how-many-item[data-id="'+ index +'"]:last-of-type').data('index'));
            $(lastInstanceClone).attr('data-index',lastItemIndex+1)

            lastInstanceClone.find('input').each(function(i,v){
                if($(v).attr('type') == 'text'){
                  $(v).val('');
                }
                $(v).attr('name' , $(v).attr('name').replace(lastItemIndex,lastItemIndex+1));
            }) 
            $('.append-names[data-id="'+ index +'"]').append(lastInstanceClone);
            
        }

    }

});

});
        })(jQuery);
    });
function getSearchInputSelector(tableId)
{
    return tableId +'_filter'+ ' label input' ;
}
function updateAllMainsRowPercentageOfSales(dates = null)
{
    if(!dates){
          dates = "{{ json_encode(array_keys($incomeStatement->getIntervalFormatted())) }}";
                            dates = dates.replace(/(&quot\;)/g,"\"")
                                        
                             dates = JSON.parse(dates) ;
    }
               

    $('.is-main-with-sub-items').each(function(index,val){
                            var mainRowId = $(val).data('model-id');
                            dates = Array.isArray(dates) ? dates : JSON.parse(dates);
                            for(date of dates){
                                updatePercentageOfSalesFor(mainRowId,date,false);
                            }
                        })

}
function updatePercentageOfSalesFor(rowId , date,mainRowIsSub = true){

    let salesRevenueId = $('#sales-revenue-id').val();
    let rateMainRowId = sales_rate_maps[rowId];
    let mainRowValue = 0;
    let salesRevenueValue =0;
    if(mainRowIsSub){
       mainRowValue  = parseFloat($('.main-with-no-child[data-model-id="'+ rowId +'"]').find('input[data-date="'+ date +'"]').val());
     salesRevenueValue =parseFloat($('.is-main-with-sub-items[data-model-id="'+ salesRevenueId +'"]').find('input[data-date="'+ date + '"]').val());
     
    }
    else{
            mainRowValue = parseFloat($('.is-main-with-sub-items[data-model-id="'+ rowId +'"]').find('input[data-date="'+ date +'"]').val());
         salesRevenueValue = parseFloat($('.is-main-with-sub-items[data-model-id="'+ salesRevenueId +'"]').find('input[data-date="'+ date + '"]').val());
    
    }
    let salesPercentage = salesRevenueValue ? mainRowValue /salesRevenueValue * 100 : 0 ; 
    $('.main-with-no-child.is-sales-rate[data-model-id="'+rateMainRowId+'"]').find('input[data-date="'+ date +'"]').val(salesPercentage);
    $('.main-with-no-child.is-sales-rate[data-model-id="'+rateMainRowId+'"]').find('td.date-'+date).html(number_format(salesPercentage,2) +' %');

}



        </script>
    </x-slot>

</x-tables.basic-view>

</div>
{{-- <button>Save</button> --}}
    {{-- </form> --}}

