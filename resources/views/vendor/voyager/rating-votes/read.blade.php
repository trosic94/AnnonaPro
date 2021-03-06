@extends('voyager::master')

@section('page_title', __('voyager::generic.view').' '.$dataType->display_name_singular)

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> {{ __('voyager::generic.viewing') }} {{ ucfirst($dataType->display_name_singular) }} &nbsp;

        @can('edit', $dataTypeContent)
            <a href="{{ route('voyager.'.$dataType->slug.'.edit', $dataTypeContent->getKey()) }}" class="btn btn-info">
                <span class="glyphicon glyphicon-pencil"></span>&nbsp;
                {{ __('voyager::generic.edit') }}
            </a>
        @endcan
        @can('delete', $dataTypeContent)
            @if($isSoftDeleted)
                <a href="{{ route('voyager.'.$dataType->slug.'.restore', $dataTypeContent->getKey()) }}" title="{{ __('voyager::generic.restore') }}" class="btn btn-default restore" data-id="{{ $dataTypeContent->getKey() }}" id="restore-{{ $dataTypeContent->getKey() }}">
                    <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">{{ __('voyager::generic.restore') }}</span>
                </a>
            @else
                <a href="javascript:;" title="{{ __('voyager::generic.delete') }}" class="btn btn-danger delete" data-id="{{ $dataTypeContent->getKey() }}" id="delete-{{ $dataTypeContent->getKey() }}">
                    <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">{{ __('voyager::generic.delete') }}</span>
                </a>
            @endif
        @endcan

        <a href="{{ route('voyager.'.$dataType->slug.'.index') }}" class="btn btn-warning">
            <span class="glyphicon glyphicon-list"></span>&nbsp;
            {{ __('voyager::generic.return_to_list') }}
        </a>
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content read container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered" style="padding-bottom:5px;">

                    <div class="panel-heading" style="border-bottom:0;">
                        <h3 class="panel-title">@lang('shop_admin.title_product_rating'):</h3>
                    </div>

                    <div class="panel-body" style="padding-top:0;">
                    
                        <div><label class="text-bold">@lang('shop_admin.title_customer'):</label> <span><a href="/{{ setting('admin.adm_url') }}/users/{{ $productRatingsAndComments->u_id }}">{{ $productRatingsAndComments->u_name }} {{ $productRatingsAndComments->u_last_name }}</a></span></div>
                        <div><label class="text-bold">@lang('shop_admin.title_ip'):</label> <span>{{ $productRatingsAndComments->rv_user_ip }}</span></div>
                        <div><label class="text-bold">@lang('shop_admin.title_product'):</label> <span><a href="/{{ setting('admin.adm_url') }}/products/{{ $productRatingsAndComments->p_id }}">{{ $productRatingsAndComments->p_title }}</a></span></div>

                        <hr>

                        <div><label class="text-bold">@lang('shop_admin.title_product_rate'):</label> <span>{{ $productRatingsAndComments->ro_name }}</span></div>
                        <div><label class="text-bold">@lang('shop_admin.title_product_rate_value'):</label> <span>{{ $productRatingsAndComments->rv_rating_value }}</span></div>

                        <hr>

                        <div><label class="text-bold">@lang('shop_admin.title_product_comment'):</label> <span>{{ $productRatingsAndComments->rv_comment }}</span></div>

                        <div><label class="text-bold">@lang('shop_admin.title_status'):</label> <span>
                            @if($productRatingsAndComments->rv_comment_status == 1)
                                <span class="label label-info">@lang('shop_admin.title_on')</span>
                            @else
                                <span class="label label-warning">@lang('shop_admin.title_Off')</span>
                            @endif
                        </span></div>

                        <hr>

                        <div><label class="text-bold">@lang('shop_admin.title_created_at'):</label> <span>{{ $productRatingsAndComments->rv_created_at }}</span></div>
                        <div><label class="text-bold">@lang('shop_admin.title_updated_at'):</label> <span>{{ $productRatingsAndComments->rv_updated_at }}</span></div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Single delete modal --}}
    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager::generic.close') }}"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> {{ __('voyager::generic.delete_question') }} {{ strtolower($dataType->display_name_singular) }}?</h4>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('voyager.'.$dataType->slug.'.index') }}" id="delete_form" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger pull-right delete-confirm"
                               value="{{ __('voyager::generic.delete_confirm') }} {{ strtolower($dataType->display_name_singular) }}">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop

@section('javascript')
    @if ($isModelTranslatable)
        <script>
            $(document).ready(function () {
                $('.side-body').multilingual();
            });
        </script>
        <script src="{{ voyager_asset('js/multilingual.js') }}"></script>
    @endif
    <script>
        var deleteFormAction;
        $('.delete').on('click', function (e) {
            var form = $('#delete_form')[0];

            if (!deleteFormAction) {
                // Save form action initial value
                deleteFormAction = form.action;
            }

            form.action = deleteFormAction.match(/\/[0-9]+$/)
                ? deleteFormAction.replace(/([0-9]+$)/, $(this).data('id'))
                : deleteFormAction + '/' + $(this).data('id');

            $('#delete_modal').modal('show');
        });

    </script>
@stop
