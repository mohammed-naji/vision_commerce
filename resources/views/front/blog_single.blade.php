@extends('front.master')

@section('title', $blog->title . ' | ' . env('APP_NAME'))

@section('content')

    @include('front.parts.inner-hero')

    <!-- Blog Details Hero Begin -->
    <section class="blog-details-hero set-bg" data-setbg="{{ $blog->image }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog__details__hero__text">
                        <h2>{{ $blog->id }} - {{ $blog->title }}</h2>
                        <ul>
                            <li>{{ $blog->created_at->format('F d, Y') }}</li>
                            <li>{{ $blog->comments->count() }} Comments</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Hero End -->

    <!-- Blog Details Section Begin -->
    <section class="blog-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5 order-md-1 order-2">
                    <div class="blog__sidebar">
                        <div class="blog__sidebar__search">
                            <form action="#">
                                <input type="text" placeholder="Search...">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div>
                        <div class="blog__sidebar__item">
                            <h4>Categories</h4>
                            <ul>
                                <li><a href="#">All</a></li>
                                <li><a href="#">Beauty (20)</a></li>
                                <li><a href="#">Food (5)</a></li>
                                <li><a href="#">Life Style (9)</a></li>
                                <li><a href="#">Travel (10)</a></li>
                            </ul>
                        </div>
                        <div class="blog__sidebar__item">
                            <h4>Recent News</h4>
                            <div class="blog__sidebar__recent">
                                <a href="#" class="blog__sidebar__recent__item">
                                    <div class="blog__sidebar__recent__item__pic">
                                        <img src="img/blog/sidebar/sr-1.jpg" alt="">
                                    </div>
                                    <div class="blog__sidebar__recent__item__text">
                                        <h6>09 Kinds Of Vegetables<br /> Protect The Liver</h6>
                                        <span>MAR 05, 2019</span>
                                    </div>
                                </a>
                                <a href="#" class="blog__sidebar__recent__item">
                                    <div class="blog__sidebar__recent__item__pic">
                                        <img src="img/blog/sidebar/sr-2.jpg" alt="">
                                    </div>
                                    <div class="blog__sidebar__recent__item__text">
                                        <h6>Tips You To Balance<br /> Nutrition Meal Day</h6>
                                        <span>MAR 05, 2019</span>
                                    </div>
                                </a>
                                <a href="#" class="blog__sidebar__recent__item">
                                    <div class="blog__sidebar__recent__item__pic">
                                        <img src="img/blog/sidebar/sr-3.jpg" alt="">
                                    </div>
                                    <div class="blog__sidebar__recent__item__text">
                                        <h6>4 Principles Help You Lose <br />Weight With Vegetables</h6>
                                        <span>MAR 05, 2019</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="blog__sidebar__item">
                            <h4>Search By</h4>
                            <div class="blog__sidebar__item__tags">
                                <a href="#">Apple</a>
                                <a href="#">Beauty</a>
                                <a href="#">Vegetables</a>
                                <a href="#">Fruit</a>
                                <a href="#">Healthy Food</a>
                                <a href="#">Lifestyle</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-7 order-md-1 order-1">
                    <div class="blog__details__text">
                        {{ $blog->content }}
                    </div>

                    <div class="comments">
                        @foreach ($blog->comments as $comment)
                        <div class="media">
                            <img src="https://ui-avatars.com/api/?name={{ $comment->user->name }}" class="mr-3" alt="...">
                            <div class="media-body">
                                <h5 class="mt-0">{{ $comment->user->name }}</h5>
                                <small>{{ $comment->created_at->diffForHumans() }}</small>
                                <p>{{ $comment->comment }}</p>
                            </div>
                        </div>
                        @endforeach

                        @if (Auth::check())
                            <form id="comment_form" action="" class="mt-5">
                                <h2>Add New Comment</h2>
                                <textarea class="form-control" rows="4"></textarea>
                                <div class="text-right">
                                    <button class="btn btn-success mt-3">Post Comment</button>
                                </div>
                            </form>
                        @else
                            <p>To add comment please <a href="{{ route('login') }}">login</a> first</p>
                        @endif


                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->

    <!-- Related Blog Section Begin -->
    <section class="related-blog spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related-blog-title">
                        <h2>Post You May Like</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($related as $item)
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        @include('front.parts.blog_item')
                    </div>
                @endforeach


            </div>
        </div>
    </section>
    <!-- Related Blog Section End -->
@stop


@section('scripts')

<script>

    $('#comment_form').submit(function(e) {
        e.preventDefault();

        var c = $('#comment_form textarea').val();
        var b_id = '{{ $blog->id }}';

        $.ajax({
            type: 'post',
            url: '{{ route("site.add_comment") }}',
            data: {
                _token: '{{ csrf_token() }}',
                comment: c,
                blog_id: b_id
            }
        })

    })

</script>

@stop
