@extends('layouts.app')

@section('content')

    <div class="container">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
    </div>



    <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="panel panel-default">
                <h1>Gemiddelde score</h1>
                <input id="rating" type="text" class="rating" data-size="md" value="{{round($comments->avg('rating'))}}"
                       disabled>

                <span class="input-group-btn">
                            <button type="button" class="btn btn-info" onclick="javascript:history.back()">Terug</button>
                </span>
            </div>
        </div>
    </div>




    <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            @foreach($comments as $comment)
                <div class="panel panel-default">
                    <h2><b>Geplaatst
                            door:</b>{{$comment->voornaam}} {{$comment->tussenvoegsel}} {{$comment->achternaam}}
                    </h2> {{$comment->created_at}}
                    <br>
                    {{$comment->comment}}
                    <br>
                    <input id="rating" type="text" class="rating" data-size="md" value="{{round($comment->rating)}}"
                           disabled>
                    <hr>
                    <form method="post" action="/deleteComment">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="comment_id" value="{{$comment->id}}">
                        <input type="hidden" name="user_id" value="{{$comment->user_id}}">
                        <span class="input-group-btn">
                            <button id="delete" class="btn btn-danger" type="submit">Delete</button>
                        </span>
                    </form>


                </div>
            @endforeach
        </div>
    </div>


    <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="panel panel-default">
                <form class="form-horizontal" method="post" action="/addComment">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="user_id" id="user_id" value="{{$id}}">
                    <label class="control-label" for="comment"></label>
                    <textarea class="form-control" id="comment" rows="10"
                              name="comment" required=""
                              placeholder="schrijf je commentaar hier" style="resize: vertical;"></textarea>

                    <br>
                    <div>
                        <label for="rating" class="control-label" style="color: black">Geef deze gast docent een
                            cijfer</label>
                        <input id="rating" name="rate" class="rating rating-loading" required>
                    </div>
                    <br>

                    <label class="control-label" for="postcomment"></label>

                    <button id="postcomment" name="postcomment" class="btn btn-primary">Comment
                    </button>

                </form>
            </div>


        </div>
    </div>
    <script>
        $('#delete').on('click', function (e) {
            e.preventDefault();
            var form = $(this).parents('form');
            swal({
                title: "Weet je het zeker?",
                text: "Deze actie is permanent!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ja, verwijder mijn account!",
                closeOnConfirm: false
            }, function (isConfirm) {
                if (isConfirm) form.submit();
            });
        });




    </script>

@endsection