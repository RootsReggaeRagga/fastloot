<div class="message-item">
    <div class="chat-ava" data-userid="{{$msg['userid']}}"
         style="background-image: url({{$msg['avatar']}});"></div>
    <div class="message-header">
        <div class="user-name">{{$msg['username']}}:</div>
        <div class="chat-message-time-created">{{$msg['time']}}</div>

    </div>
    <div class="message">{{$msg['messages']}}</div>
    <div class="clearfix"></div>
</div>