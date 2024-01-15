@extends('layouts.dashboard')
@section('css')
<x-styles.commons></x-styles.commons>
@endsection
@section('sub-header')
<x-main-form-title :id="'main-form-title'" :class="''">{{$pageTitle }}</x-main-form-title>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        
            <div class="kt-portlet">
          
                
                <div class="kt-portlet__body">
        @include('admin.income-statement.view-table' )
        </div>
</div>
</div>
</div>
@endsection
@section('js')
<x-js.commons></x-js.commons>
<script>
        $(function(){
                $(document).on('blur','.editable',function(){
                        var columnIndex = this._DT_CellIndex  ? this._DT_CellIndex.column : 0 ;
                        var tdData = $(this).closest('table').find('.header-th').eq(columnIndex)[0] ;
                        var dataTableId = $(this).closest('table.main-table-class').attr('id')  ;
                        var modelName = $(this).parent().data('model-name') || $(this).data('model-name');
                        var modelId = $(this).parent().data('model-id') || $(this).data('model-id');
                        var columnName = $(tdData).data('db-column-name') || $(this).data('db-column-name');
                        var isRelation = $(tdData).data('is-relation') || $(this).data('is-relation');
                        var isCollectionRelation = $(tdData).data('is-collection-relation') || $(this).data('is-collection-relation');
                        var collectionItemId = $(tdData).data('collection-item-id') || $(this).data('collection-item-id');
                        var isJson = $(tdData).data('is-json');
                        var relationName = $(tdData).data('relation-name') || $(this).data('relation-name');
                        var data = $(this).text();
               
                        $.ajax({
                                url:"{{ route('admin.edit.table.cell',getCurrentCompanyId()) }}",
                                data:{
                                        "_token":"{{ csrf_token() }}",
                                        "isRelation":isRelation ,
                                        "columnName":columnName ,
                                        "relationName":relationName,
                                        "data":data,
                                        'modelName':modelName,
                                        'modelId':modelId,
                                        'isJson':isJson,
                                        "dataTableId":dataTableId,
                                        "isCollectionRelation":isCollectionRelation,
                                        "collectionItemId":collectionItemId
                                },
                                type:"POST",
                                success:function(response){
                                        $('#'+response.dataTableId).DataTable().ajax.reload( null, false )
                                }
                        })
                });
        })
</script>


@endsection
