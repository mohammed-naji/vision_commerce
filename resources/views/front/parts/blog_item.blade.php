<div class="blog__item">
    <div class="blog__item__pic">
        <a href="{{ route('site.blog_single', $item->slug) }}">
        <img src="{{ $item->image }}" alt="">
    </a>
    </div>
    <div class="blog__item__text">
        <ul>
            <li><i class="fa fa-calendar-o"></i>
            {{ $item->created_at->format('M d, Y') }}                                        </li>
            <li><i class="fa fa-comment-o"></i> {{ $item->comments->count() }}</li>
        </ul>
        <h5><a href="{{ route('site.blog_single', $item->slug) }}">{{ $item->title }}</a></h5>
        <p>{{ Str::words($item->content, 10, ' ...') }}</p>
        <a href="{{ route('site.blog_single', $item->slug) }}" class="blog__btn">READ MORE <span class="arrow_right"></span></a>
    </div>
</div>
