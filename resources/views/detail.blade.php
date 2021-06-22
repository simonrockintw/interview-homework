<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ $news->title }}</title>

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

<!--section start-->
<section class="blog-detail-page section-b-space ratio2_3">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 blog-detail">
                <h3>{{ $news->title }}</h3>
                <ul class="post-social">
                    <li>發佈時間 : {{ $news->published_at }}</li>
                    <li>作者 : {{ $news->author_name }}</li>
                </ul>
                <p>
                    {!! $news->content !!}
                </p>
            </div>
        </div>
    </div>
</section>
<!--Section ends-->

</body>

</html>
