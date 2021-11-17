@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-center row mt-4 mb-5">
        <div class="col-md-12">
            <div class="panel p-2">
                <div class="panel-body">
                    <textarea class="form-control" rows="2" placeholder="What are you thinking?"></textarea>
                    <div class="mar-top clearfix">
                        <a class="btn btn-purple text-white btn-icon fa fa-video add-tooltip" href="#"></a>
                        <a class="btn btn-purple text-white btn-icon fa fa-camera add-tooltip" href="#"></a>
                        <a class="btn btn-purple text-white btn-icon fa fa-file add-tooltip" href="#"></a>
                        <button class="btn btn-sm btn-purple text-white float-right" type="submit"><i class="fa fa-edit fa-fw"></i> Share</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="feed p-2">

                @foreach ($posts as $post)
                    <div class="bg-white border-card mt-2">
                        <div>
                            <div class="d-flex flex-row justify-content-between align-items-center p-2 border-bottom">
                                <div class="d-flex flex-row align-items-center feed-text px-2"><img class="rounded-circle" src="{{$post->user->social[0]->avatar ?? 'https://avatars.githubusercontent.com/u/47313528?v=4'}}" width="45">
                                    <div class="d-flex flex-column flex-wrap ml-2"><span class="font-weight-bold">{{$post->user->name}}</span><span class="text-black-50 time">{{$post->created_at->diffForHumans()}}</span></div>
                                </div>
                                <div class="feed-icon px-2"><i class="fa fa-ellipsis-v text-black-50"></i></div>
                            </div>
                        </div>
                        <div class="p-2 px-3"><span>{{$post->content}}</span></div>
                        <div class="d-flex justify-content-end socials p-2 py-3"><i class="fa fa-thumbs-up"></i><i class="fa fa-comments-o"></i><i class="fa fa-share"></i></div>
                    </div>

                    <!--
                    <div class="bg-white border-card mt-2">
                        <div>
                            <div class="d-flex flex-row justify-content-between align-items-center p-2 border-bottom">
                                <div class="d-flex flex-row align-items-center feed-text px-2"><img class="rounded-circle" src="https://fakeimg.pl/300/" width="45">
                                    <div class="d-flex flex-column flex-wrap ml-2"><span class="font-weight-bold">Thomson ben</span><span class="text-black-50 time">40 minutes ago</span></div>
                                </div>
                                <div class="feed-icon px-2"><i class="fa fa-ellipsis-v text-black-50"></i></div>
                            </div>
                        </div>
                        <div class="feed-image p-2 px-3"><img class="img-fluid img-responsive" src="https://fakeimg.pl/300/"></div>
                        <div class="d-flex justify-content-end socials p-2 py-3"><i class="fa fa-thumbs-up"></i><i class="fa fa-comments-o"></i><i class="fa fa-share"></i></div>
                    </div>
                    -->
                @endforeach

                <div class="mt-2">
                    {{$posts->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@yield('content')
    <script>
        $(document).ready(() => {
        })
    </script>
@endsection
