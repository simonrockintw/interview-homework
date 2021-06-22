@extends('layouts.app')

@section('title', __('app.News'))

@section('content-header')
    <li class="breadcrumb-item"><a href="/">{{__('app.HomePage')}}</a></li>
    <li class="breadcrumb-item active">{{__('app.NewsPage')}}</li>
@endsection

@section('style')
    <link rel="stylesheet" href="/dist/plugins/bootstrap-switch/css/bootstrap4/bootstrap-switch.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="/dist/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- summernote -->
    <link rel="stylesheet" href="/dist/plugins/summernote/summernote-bs4.min.css">
@endsection

@section('script')
    <script src="/dist/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script src="/dist/plugins/moment/moment.min.js"></script>
    <script src="/ctl/news/create.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="/dist/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="/dist/plugins/summernote/summernote-bs4.min.js"></script>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="form-horizontal row">
                <div class="col-md-12">
                    <label class="col-form-label">{{ __('app.Edit') }}</label>
                    <a href="{{ route('news.index') }}" class="btn btn-default float-right"><i class="fas fa-list"> </i> 列表</a>
                </div>
            </div>
        </div>
        <form class="form-horizontal" method="post" action="{{ route('news.update', $news->id) }}">
            @csrf
            @method('PATCH')
            <div class="card-body">
                @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{{ Session::get('success') }}</strong>
                        @php
                            Session::forget('success');
                        @endphp
                    </div>
                @endif

                @if(Session::has('failed'))
                    <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{{ Session::get('failed') }}</strong>
                        @php
                            Session::forget('failed');
                        @endphp
                    </div>
                @endif
                <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label text-right asterisk">{{ __('app.Title') }}</label>
                    <div class="input-group col-sm-8">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-pen"></i></span>
                        </div>
                        <input type="text" id="title" name="title" class="form-control" placeholder="輸入 {{ __('app.Title') }}" maxlength="100" value="{{ $news->title }}" required>
                    </div>
                    @if ($errors->has('title'))
                        <div class=" col-sm-2">
                            <span class="text-danger">{{ $errors->first('title') }}</span>
                        </div>
                    @endif
                </div>
                <div class="form-group row">
                    <label for="authorName" class="col-sm-2 col-form-label text-right asterisk">{{ __('app.AuthorName') }}</label>
                    <div class="input-group col-sm-8">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-pen"></i></span>
                        </div>
                        <input type="text" id="authorName" name="authorName" class="form-control" placeholder="輸入 {{ __('app.AuthorName') }}" maxlength="100" value="{{ $news->author_name }}" required>
                    </div>
                    @if ($errors->has('authorName'))
                        <div class=" col-sm-2">
                            <span class="text-danger">{{ $errors->first('authorName') }}</span>
                        </div>
                    @endif
                </div>
                <div class="form-group row">
                    <label for="publishedAt" class="col-sm-2 col-form-label text-right asterisk">{{ __('app.PublishedAt') }}</label>
                    <div class="input-group date col-sm-8" id="publishedAt" data-target-input="nearest">
                        <div class="input-group-prepend" data-target="#publishedAt">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                        <input type="text" class="form-control datetimepicker-input" data-target="#publishedAt" data-toggle="datetimepicker" name="publishedAt" class="form-control" placeholder="輸入 {{ __('app.PublishedAt') }}" value="{{ $news->published_at }}">
                    </div>
                    @if ($errors->has('publishedAt'))
                        <div class=" col-sm-2">
                            <span class="text-danger">{{ $errors->first('publishedAt') }}</span>
                        </div>
                    @endif
                </div>
                <div class="form-group row">
                    <label for="status" class="col-sm-2 col-form-label text-right">{{ __('app.Display') }}</label>
                    <div class="col-sm-8">
                        <input type="checkbox" id="display" name="display" value="1" @if ($news->display === 1) checked @endif>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="content" class="col-sm-2 col-form-label text-right">{{ __('app.Content') }}</label>
                    <div class="input-group col-sm-8">
                        <textarea name="content" id="content">
                            {!! $news->content !!}
                        </textarea>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <div class="row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary float-right">提交</button>
                    </div>
                </div>
            </div>
            <!-- /.card-footer -->
        </form>
    </div>
@endsection
