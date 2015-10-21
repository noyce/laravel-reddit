@extends('layouts/default')

@section('scripts')
    <link rel="stylesheet" href="{{ URL::asset('assets/css/jquery.upvote.css') }}">
    <script type="text/javascript" src="{{ URL::asset('assets/js/jquery.upvote.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.jscroll.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.topic').upvote();

            $('.vote').on('click', function (e) {
                e.preventDefault();
                var $button = $(this);
                var postId = $button.data('post-id');
                var value = $button.data('value');
                $.post('votes', {postId:postId, value:value}, function(data) {
                    if (data.status == 'success')
                    {
                        //
                    }
                }, 'json');
            });
        });
    </script>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            @if($errors->any())
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <h1>Searching: {{ $post->subreddit->name }}</h1>
            <div class="scroll">
                @if(count($posts) < 1)
                    There are no matches
                @endif

                @foreach($posts as $post)
                    @include('partials/post')
                @endforeach

            </div>
        </div>

        <div class="col-md-4">
            @include('partials/post_sidebar')
        </div>
    </div>
@stop