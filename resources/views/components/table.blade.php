<div class="kt-portlet kt-portlet--mobile">
    @if($tableTitle !== null)
        <div class="kt-portlet__head kt-portlet__head--lg">
            <div class="kt-portlet__head-label">
                <span class="kt-portlet__head-icon">
                    <i class="kt-font-secondary btn-outline-hover-danger fa fa-layer-group"></i>
                </span>

                <h3 class="kt-portlet__head-title">
                    {{ $tableTitle }}
                </h3>
            </div>
            {{-- Export --}}
            <x-export :class="$class" :href="$href" :importHref="$importHref" :exportHref="$exportHref" :exportTableHref="$exportTableHref" :icon="$icon" :firstButtonName="$firstButtonName" :truncateHref="$truncateHref"/>

        </div>
    @endif
    <div class="kt-portlet__body table-responsive">

        <!--begin: Datatable -->
        <table id="test" class="table table-striped- {{$tableClass}} table-bordered table-hover table-checkable  " >

            <thead>
                {{$table_header}}
            </thead>
            <tbody>
                {{$table_body}}
            </tbody>
        </table>

        <!--end: Datatable -->
    </div>
</div>
