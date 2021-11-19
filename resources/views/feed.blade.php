@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-center row mt-4 mb-2">
        <div class="col-md-3">
            <div class="card bg-gray mt-3">
                <div class="card-body text-center">
                    <img class="rounded-circle text-center" width="100px" src="{{ Auth::user()->social[0]->avatar ?? 'https://avatars.githubusercontent.com/u/47313528?v=4'}}">
                    <h4 class="text text-center mt-3">{{Auth::user()->name}}</h4>
                    <small class="text text-center">{{Auth::user()->social[0]->description && Auth::user()->social[0]->social_type == 'github' ? Auth::user()->social[0]->description : 'Developer in continuous progress'}}</small>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card p-2 bg-gray mt-3">
                <div class="card-body">
                    <form id="formFeed" action="{{ route('feed.create') }}" method="post">
                        @csrf
                        <textarea id="content" name="content" class="form-control" rows="2" placeholder="What are you thinking?" required></textarea>
                        <div class="mar-top clearfix">
                            <a class="btn btn-purple text-white btn-icon fa fa-video add-tooltip" href="#"></a>
                            <a class="btn btn-purple text-white btn-icon fa fa-camera add-tooltip" href="#"></a>
                            <a class="btn btn-purple text-white btn-icon fa fa-file add-tooltip" href="#"></a>
                            <button class="btn btn-sm btn-purple text-white float-right" type="submit">
                                <i class="fa fa-edit fa-fw"></i> Share
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="feed">
                @foreach ($posts as $post)
                    <div class="card border-card mt-4 p-y">
                        <div class="card-body">
                            <div>
                                <div class="d-flex flex-row justify-content-between align-items-center pb-2">
                                    <div class="d-flex flex-row align-items-center feed-text">
                                        <img class="rounded-circle" src="{{$post->user->social[0]->avatar && $post->user->social[0]->social_type == 'github' ? $post->user->social[0]->avatar : 'https://avatars.githubusercontent.com/u/47313528?v=4'}}" width="45">
                                        <div class="d-flex flex-column flex-wrap ml-2">
                                            <span class="font-weight-bold">{{$post->user->name}}</span>
                                            <span class="time text">{{$post->user->social[0]->description && $post->user->social[0]->social_type == 'github' ? $post->user->social[0]->description : 'Developer in continuous progress'}}</span>
                                            <span class="time text">{{$post->created_at->diffForHumans()}}</span>
                                        </div>
                                    </div>
                                    <div class="feed-icon">
                                        <i class="fa fa-ellipsis-v text"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 pb-3 border-bottom-purple">
                                @if (strpos($post->content, 'script'))
                                    {{htmlspecialchars_decode($post->content, ENT_QUOTES)}}
                                @else
                                    {!! htmlspecialchars_decode($post->content, ENT_QUOTES) !!}
                                @endif
                            </div>
                            <div class="d-flex justify-content-around mt-3">
                                <button type="button" class="btn bg-transparent text btn-actions btn-like" id="btn-like" data-post-id="{{$post->id}}">
                                    <i class="fa fa-thumbs-up text-actions"></i> Like <span class="badge badge" id="count-like"> {{$post->like->count()}} </span>
                                </button>
                                <button type="button" class="btn bg-transparent text btn-actions btn-comment" id="btn-comment" data-post-id="{{$post->id}}">
                                    <i class="fas fa-comments text-actions"></i> Comment
                                </button>
                                <button type="button" class="btn bg-transparent text btn-actions btn-share" id="btn-share" data-post-id="{{$post->id}}">
                                    <i class="fa fa-share text-actions"></i> Share
                                </button>
                                <button type="button" class="btn bg-transparent text btn-actions btn-send" id="btn-send" data-post-id="{{$post->id}}">
                                    <i class="far fa-paper-plane text-actions"></i> Send
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="mt-2">
                    {{$posts->links()}}
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-2 bg-gray mt-3">
                &nbsp;
            </div>
        </div>

        @if ($errors->feed->first('content'))
            <script>
                $(document).ready(() => alert('You must type something!'));
            </script>
        @endif
    </div>
</div>
@yield('content')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#formFeed').on('submit', function (e) {
            if ($('#content').val().trim() === '') {
                alert('You must type something!');
                return false;
            }
        });

        $('.btn-like').click(function() {
            $.ajax({
                type: "POST",
                url: `{{route('like.create')}}`,
                data: {
                    post_id: $(this).attr('data-post-id')
                },
                dataType: "JSON",
                success: (response) => {
                    if (response.status === 201 || response.status === 204) {
                        $(this).find('span#count-like').html(response.data);
                    }

                    $(this).attr('disabled', false);
                },
                beforeSend: () => {
                    $(this).attr('disabled', true);
                },
                error: (error) => {
                    $(this).attr('disabled', false);
                    console.log(error)
                    alert('deu ruim')
                }
            });
        });

    </script>
@endsection
