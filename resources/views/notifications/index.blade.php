@extends('layouts.app')
@section('title','我的通知')
@section('content')
    <div class="container">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                 <div class="panel-body">
                     <h3 class="text-center">
                         <span class="glyphicon glyphicon-bell"></span>我的通知
                     </h3>
                     @if($notifications->count())
                         <div class="notification-list">
                     @foreach($notifications as $notification)
                              @include('notifications.types._' . snake_case(class_basename($notification->type)))
                         @can('is_admin',$notification)
                              {{--@include('notifications.types._' . snake_case(class_basename($notification->type)))--}}
                         @endcan
                         @endforeach
                         {!! $notifications->render() !!}

                         </div>
                     @else
                         <div class="empty-block">暂无消息通知</div>
                         @endif
                 </div>
            </div>
        </div>
    </div>
@stop