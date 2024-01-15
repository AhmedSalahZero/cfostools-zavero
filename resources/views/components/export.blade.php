<div class="kt-portlet__head-toolbar">
    <div class="kt-portlet__head-wrapper">
        <div class="kt-portlet__head-actions">
            &nbsp;
            @if ($href != '#')
                <a href={{$href}} class="btn  active-style btn-icon-sm {{$class}}">
                    <i class="fas fa-{{$icon}}"></i>
                    {{ __($firstButtonName) }}
                </a>
            @endif
            @if ($importHref != '#')
                <a href={{$importHref}} class="btn  active-style btn-icon-sm {{$class}}">
                    <i class="fas fa-file-import"></i>
                    {{ __('Upload Data') }}
                </a>
            @endif
            @if ($exportHref != '#')
                <a href={{$exportHref}} class="btn  active-style btn-icon-sm {{$class}}">
                    <i class="fas fa-file-export"></i>
                    {{ __('Export Data') }}
                </a>
            @endif
            @if ($exportTableHref != '#')
                <a href={{$exportTableHref}} class="btn  active-style btn-icon-sm {{$class}}">
                    <i class="fas fa-file-export"></i>
                    {{ __('Template Download') }}
                </a>
            @endif
            @if ($truncateHref != '#')
                <a href={{$truncateHref}} class="btn  active-style btn-icon-sm {{$class}}">
                    <i class="fas fa-file-export"></i>
                    {{ __('Delete All Data') }}
                </a>
            @endif
        </div>
    </div>
</div>
