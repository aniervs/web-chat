<head>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <div class="container">
        <div class="row clearfix" style="height: 100%">
            <div class="col-lg-12">
                <div class="card chat-app">
                    <div id="plist" class="people-list" style="height: 100%; overflow-y: auto;">
                        <ul class="list-unstyled chat-list mt-2 mb-0" style="width: 100%">
                            @foreach($users as $user)
                                @if($user->id == $other_user->id)
                                    <li class="clearfix active" onclick="location.href='/messages/{{$user->id}}'">
                                @else
                                    <li class="clearfix" onclick="location.href='/messages/{{$user->id}}'">
                                @endif
                                        <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="avatar">
                                            <div class="about">
                                            <div class="name">{{$user->name}}
                                            </div>
                                        </div>
                                    </li>
    
                            @endforeach
                        </ul>
                    </div>
                    <div class="chat">
                        <div class="chat-header clearfix">
                            <div class="row">
                                <div class="col-lg-6">
                                    <a href="/users/{{$other_user->id}}" data-toggle="modal" data-target="#view_info">
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
                        <div class="chat-history" style="height: calc(100% - 200px); overflow: auto">
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
                                    <textarea name="text" id="text" style="width: calc(100% - 60px);">
                                    </textarea>
                                        
                                    <button type="submit" style="margin-left: 10px">
                                        <img src="{{asset('send-message.png')}}" alt="Save icon" style="width: 2em;"/>
                                        <br/>
                                    </button>
                                </form>
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>

