@extends('layouts.app')

@section('content-header')
    <li class="breadcrumb-item"><a href="/backend">{{__('app.HomePage')}}</a></li>
    <li class="breadcrumb-item active">{{__('app.NewsPage')}}</li>
@endsection

@section('style')
    <link rel="stylesheet" href="/dist/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="/dist/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/dist/plugins/bootstrap-switch/css/bootstrap4/bootstrap-switch.min.css">
    <link rel="stylesheet" href="/dist/plugins/daterangepicker/daterangepicker.css">

    <style>
        .dropdown-toggle::after {
            display: none;
        }
        .btn-default, .btn-default:hover, .btn-default:active, .btn-default:visited {
            background-color: #FFFFFF !important;
            border-color: #FFFFFF;
        }
    </style>
@endsection

@section('script')
    <script src="/dist/plugins/datatables/jquery.dataTables.js"></script>
    <script src="/dist/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
    <script src="/dist/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/dist/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="/dist/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script src="/dist/plugins/moment/moment.min.js"></script>
    <script src="/dist/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="/ctl/news/index.js"></script>
@endsection

@section('content')
    <div class="card">
        <input id="config" type="hidden" data-endpoint="{{ route('news-record') }}">
        <input id="config_update" type="hidden" data-endpoint="{{ url()->current() }}">
        <div class="card-header" id="filter_box">
            <form class="form-horizontal">
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <div class="input-group">
                                <label class="col-sm-2 col-form-label text-sm-right">{{ __('app.CreatedAt') }}</label>
                                <div class="col-sm-7 input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                    </div>
                                    <input type="text" class="form-control float-right" id="match-range">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label text-sm-right"> </label>
                            <div class="col-sm-7 input-group">
                                <a class="btn btn-primary ctl-search"><i class="fas fa-search"></i>搜索</a> &nbsp;
                                <a class="btn btn-default" style="background-color: #f8f9fa;border-color: #ddd;color: #444;" href="{{ route('news.index') }}"><i class="fas fa-undo"></i>重置</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <div class="input-group">
                                <a href="{{ route('news.create') }}" class="btn btn-success float-right"><i class="fas fa-plus"></i>{{ __("app.Add") }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>


        <div class="card-body">
            <table id="news-list" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th class="text-sm-center">{{ __('app.No') }}</th>
                    <th class="text-sm-center">{{ __('app.AuthorName') }}</th>
                    <th class="text-sm-center">{{ __('app.Title') }}</th>
                    <th class="text-sm-center">{{ __('app.CreatedAt') }}</th>
                    <th class="text-sm-center">{{ __('app.UpdatedAt') }}</th>
                    <th class="text-sm-center">{{ __('app.PublishedAt') }}</th>
                    <th class="text-sm-center">{{ __('app.Display') }}</th>
                    <th class="text-sm-center all">{{__('app.Functions')}}</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection
