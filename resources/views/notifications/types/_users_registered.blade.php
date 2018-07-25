<div class="media">
     <div class="avatar pull-left">
         <a href="{{ route('users.show',$notification->data['id']) }}">
             <img class="media-pbject img-thumbnail" alt="{{ $notification->data['name'] }}"
             src="{{ $notification->data['avatar'] }}" style="width: 48px; height: 48px;">
         </a>
     </div>

    <div class="infos">
       <div class="media-heading">
           <a href="{{ route('users.show',$notification->data['id']) }}">{{ $notification->data['name'] }}</a>
           注册了
           <a href="{{ route('users.show',$notification->data['id']) }}">{{ $notification->data['email'] }}</a>
           <span class="meta pull-right" title="{{ $notification->created_at }}">
               <span class="glyphicon glyphicon-clock" aria-hidden="true"></span>
               {{ $notification->created_at->diffForHumans() }}
           </span>
       </div>
    </div>
</div>
<hr>