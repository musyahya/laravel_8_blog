@extends('artikel/template/app')
@section('title', 'Artikel')

@section('content')
   <div class="card mt-4 shadow-sm">
        <img src="/upload/post/{{$artikel->sampul}}" height="400px" class="card-img-top" alt="...">
        <div class="card-body">
            <h3 class="card-title">{{$artikel->judul}}</h3>
            <small class="card-text">
                <span class="text-muted"><a href="/artikel-kategori/{{$artikel->kategori->slug}}">{{$artikel->kategori->nama}}</a></span>
                -
                <span class="text-muted">{{$artikel->created_at->diffForHumans()}}</span>
                -
                <span class="text-muted">Tag :</span>
                @foreach ($artikel->tag as $row)
                    @if ($loop->last)
                        <span class="text-muted"><a href="/artikel-tag/{{$row->slug}}">{{$row->nama}}</a></span>
                    @else
                        <span class="text-muted"><a href="/artikel-tag/{{$row->slug}}">{{$row->nama}},</a></span>
                    @endif
                @endforeach
            </small>
            <br>

            <small>Author : <span class="text-muted"><a href="/artikel-author/{{$artikel->user->id}}">{{$artikel->user->name}}</a></span></small>
            <hr>

            <p class="card-text">{!!$artikel->konten!!}</p>

            <a href="/like/{{$artikel->id}}" class="text-danger"><i class="fas fa-heart"></i> {{$like}} Like</a>
        </div>
    </div>

    <div id="disqus_thread" class="mt-4"></div>
    <script>
        /**
        *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
        *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
        /*
        var disqus_config = function () {
        this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
        this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
        };
        */
        (function() { // DON'T EDIT BELOW THIS LINE
        var d = document, s = d.createElement('script');
        s.src = 'https://blog-wwe7ssfgas.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
@endsection