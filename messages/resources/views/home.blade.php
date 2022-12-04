@extends('layouts.app')

@section('content')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Send comments</div>
                <div class="card-body">
                    <form id="comment-form" method="post" action="{{ route('parent_messages_create') }}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" >
                        <input type="hidden" name="user_name" value="{{ Auth::user()->name }}" >
                        <div class="mb-3">
                            <textarea class="form-control" name="text" placeholder="Write something from your heart..!"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<br>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Comments</div>
                <div class="card-body comment-container" >
                    @foreach($parent_messages as $comment)
                        <div class="well">
                            <i><b>Name - {{ $comment->user_name }} </b></i>
                            <br>
                            <span> Text -  {{ $comment->text }} </span>
                            <div style="margin-left:10px;">
                                <a style="cursor: pointer;" cid="{{ $comment->id }}" name_a="{{ Auth::user()->name }}" token="{{ csrf_token() }}" class="reply">Reply</a>&nbsp;
                                <a style="cursor: pointer;"  class="delete-comment" token="{{ csrf_token() }}" comment-did="{{ $comment->id }}" >Delete</a>
                                <a style="cursor: pointer;"  class="like-comment" comment-id="{{ $comment->id }}" token="{{ csrf_token() }}">Like</a>
                                @foreach($likes_result as $like_result)
                                @if($comment->id == $like_result['id'])
                                <b style="cursor: pointer;" id="likes" class="likes">{{$like_result['count'] }}</b>
                                @endif
                                @endforeach
                                <a style="cursor: pointer;"  class="dont-like-comment" token="{{ csrf_token() }}" >Don't Like</a>
                                <div class="reply-form">
                                </div>
                                @foreach($comment->childMessages as $rep)
                                    @if($comment->id === $rep->id_parent_message)
                                        <div class="well">
                                            <i><b>Name - {{ $rep->user_name }} </b></i>
                                            <br>
                                            <span> Text - {{ $rep->text }} </span>
                                            <div style="margin-left:10px;">
                                                <a rname="{{ Auth::user()->name }}" rid="{{ $comment->id }}" style="cursor: pointer;" class="reply-to-reply" token="{{ csrf_token() }}">Reply</a>
                                                <a did="{{ $rep->id }}" class="delete-reply" token="{{ csrf_token() }}" >Delete</a>
                                                <a style="cursor: pointer;"  class="like-comment" comment-id="{{ $rep->id}}" token="{{ csrf_token() }}">Like</a>
                                                @foreach($likes_result as $like_result)
                                                    @if($rep->id == $like_result['id'])
                                                        <b style="cursor: pointer;" id="likes" class="likes">{{$like_result['count'] }}</b>
                                                    @endif
                                                @endforeach
                                                <a style="cursor: pointer;"  class="dont-like-comment" token="{{ csrf_token() }}" >Don't Like</a>

                                            </div>
                                            <div class="reply-to-reply-form">
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/main.js') }}">
@endsection
