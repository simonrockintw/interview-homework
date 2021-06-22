<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新聞列表</title>

    <!--Google font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Yellowtail&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" type="text/css" href="/frontend/css/vendors/fontawesome.css">

    <!-- Animate icon -->
    <link rel="stylesheet" type="text/css" href="/frontend/css/vendors/animate.css">

    <!-- Themify icon -->
    <link rel="stylesheet" type="text/css" href="/frontend/css/vendors/themify-icons.css">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="/frontend/css/vendors/bootstrap.css">

    <!-- Theme css -->
    <link rel="stylesheet" type="text/css" href="/frontend/css/style.css">
</head>

<body class="theme-color-1">

<!-- breadcrumb start -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="page-title">
                    <h2>新聞</h2>
                </div>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">首頁</a></li>
                        <li class="breadcrumb-item active">新聞</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb End -->


<!-- section start -->
<section class="section-b-space blog-page ratio2_3">
    <div class="container">
        @foreach ($news as $new)
        <div class="row" style="border-top: 1px solid #dddddd; padding-top: 10px; padding-bottom: 10px;">
            <div class="col-12">
                    <div class="row float-start blog-media">
                        <div class="col-xl-12">
                            <div class="blog-right">
                                <div>
                                    <h6>{{ $new->published_at }}</h6>
                                    <a href="{{ route('news-show', $new->id) }}">
                                        <h4>{{ $new->title }}</h4>
                                    </a>
                                    <ul class="post-social">
                                        <li>作者 : {{ $new->author_name }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        @endforeach

        {{ $news->links() }}
    </div>
</section>
<!-- Section ends -->

</body>

</html>
