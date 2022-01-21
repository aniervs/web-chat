<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<link rel="stylesheet" href="/css/app.css">

<div class="container">
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card chat-app">
                <div id="plist" class="people-list" style="height: 100vh; overflow: auto">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-search"></i></span>
                        </div>
                        <form action="/users/search/" method="post">
                            @csrf
                            <input type="text" class="form-control" placeholder="Search...">
                        </form>

                    </div>
                    <ul class="list-unstyled chat-list mt-2 mb-0">
                        @foreach($users as $user)
                            @if($user->id == $other_user->id)
                                <li class="clearfix active">
                            @else
                                <li class="clearfix">
                            @endif
                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="avatar">
                                    <a href="/messages/{{$user->id}}">
                                        <div class="about">
                                            <div class="name">{{$user->name}}</div>
                                        </div>
                                    </a>

                                </li>

                        @endforeach
                    </ul>
                </div>
                <div class="chat">
                    <div class="chat-header clearfix">
                        <div class="row">
                            <div class="col-lg-6">
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                                </a>
                                <div class="chat-about">
                                    <h6 class="m-b-0">{{$other_user->name}}</h6>
                                </div>
                            </div>
                            <div class="col-lg-6 hidden-sm text-right">
                                <a href="javascript:void(0);" class="btn btn-outline-secondary"><i class="fa fa-camera"></i></a>
                                <a href="javascript:void(0);" class="btn btn-outline-primary"><i class="fa fa-image"></i></a>
                                <a href="javascript:void(0);" class="btn btn-outline-info"><i class="fa fa-cogs"></i></a>
                                <a href="javascript:void(0);" class="btn btn-outline-warning"><i class="fa fa-question"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="chat-history" style="height: 100vh; overflow: auto">
                        <ul class="m-b-0">
                            @foreach($messages as $message)
                                <li class="clearfix">
                                    <div class="message-data text-right">

                                    </div>
                                    @if($message->sender->id == $other_user->id)
                                        <span class="message-data-time float-right">{{$message->created_at}}</span>
                                        <br>
                                        <div class="message other-message float-right">
                                            <p style="font-weight:bold">{{$other_user->name}}</p>
                                            <br>
                                            {{$message->body}}
                                        </div>
                                    @else
                                        <span class="message-data-time float-left">{{$message->created_at}}</span>
                                        <br>
                                        <div class="message my-message">
                                            <p style="font-weight:bold">You</p>
                                            <br>
                                            {{$message->body}}
                                        </div>
                                    @endif

                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="chat-message clearfix">
                        <div class="input-group mb-0">
                            <form class="send-message-form" action="/messages/{{$other_user->id}}/send" method="post">
                                @csrf

                                <label for="text"></label>
                                <input type="text" placeholder="Your message goes here..." name="text" id="text">

                                <input type="submit">
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
