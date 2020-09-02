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
            <div class="col-md-8">

                <div class="panel panel-bordered" style="padding-bottom:5px;">

                    <div class="panel-heading" style="border-bottom:0;">
                        <h3 class="panel-title">@lang('shop_admin.title_content'):</h3>
                    </div>

                    <div class="panel-body" style="padding-top:0;">

                        <div><label class="text-bold">@lang('shop_admin.title_title'):</label> <span>{{ $pageDATA->pag_title }}</span></div>

                        <hr>

                        <div><label class="text-bold">@lang('shop_admin.title_excerpt'):</label></div>
                        <div>{!! $pageDATA->pag_excerpt !!}</div>
                        <br>
                        <div><label class="text-bold">@lang('shop_admin.title_body'):</label></div>
                        <div>{!! $pageDATA->pag_body !!}</div>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="panel panel-bordered" style="padding-bottom:5px;">

                    <div class="panel-heading" style="border-bottom:0;">
                        <h3 class="panel-title">@lang('shop_admin.title_info'):</h3>
                    </div>

                    <div class="panel-body" style="padding-top:0;">

                        <div><label class="text-bold">@lang('shop_admin.title_user'):</label> <span>{{ $pageDATA->usr_name }} {{ $pageDATA->usr_last_name }}</span></div>

                        <hr>

                        <div>
                            <label class="text-bold">@lang('shop_admin.title_status'):</label> 
                            <span>
                                @if($pageDATA->pag_status == 'PUBLISHED')
                                    <span class="label label-info">@lang('shop_admin.title_on')</span>
                                @else
                                    <span class="label label-warning">@lang('shop_admin.title_off')</span>
                                @endif
                            </span>
                        </div>

                        <hr>

                        <div><label class="text-bold">@lang('shop_admin.title_slug'):</label> <span>{{ $pageDATA->pag_slug }}</span></div>
                        <div><label class="text-bold">@lang('shop_admin.title_meta_description'):</label> <span>{{ $pageDATA->pag_meta_description }}</span></div>
                        <div><label class="text-bold">@lang('shop_admin.title_meta_keywords'):</label> <span>{{ $pageDATA->pag_meta_keywords }}</span></div>
                        <hr>
                        <div><label class="text-bold">@lang('shop_admin.title_created_at'):</label> <span>{{ date('d.m.Y H:i:s', strtotime($pageDATA->pag_created_at)) }}</span></div>
                        <div><label class="text-bold">@lang('shop_admin.title_published_at'):</label> <span>{{ date('d.m.Y H:i:s', strtotime($pageDATA->pag_updated_at)) }}</span></div>
                        <hr>
                        <div><label class="text-bold">@lang('shop_admin.title_image'):</label></div>
                        <div>
                            @if ($pageDATA->pag_image != null)
                            <img src="/storage/{{ $pageDATA->pag_image }}" class="img100">
                            @endif
                        </div>

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

@php
    // echo '<pre>';
    // print_r($pageDATA);
    // echo '</pre>';
@endphp

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
