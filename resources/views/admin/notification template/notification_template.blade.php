@extends('layouts.app',['activePage' => 'notification_template'])

@section('title','Notification Template')

@section('content')

<section class="section">
    @if (Session::has('msg'))
    <script>
        var msg = "<?php echo Session::get('msg'); ?>"
        $(window).on('load', function()
        {
            iziToast.success({
                message: msg,
                position: 'topRight'
            });
        });
    </script>
    @endif
    <div class="section-header">
        <h1>{{__('Notification Template')}}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ url('admin/home') }}">{{__('Dashboard')}}</a></div>
            <div class="breadcrumb-item">{{__('Notification template')}}</div>
        </div>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
                <div class="row">
                    @php
                        if (session::has('locale'))
                        {
                            $lang = session()->get('locale');
                            if ($lang == 'spanish')
                            {
                                $item = App\Models\NotificationTemplate::where('title','book order')->first();
                                $item->mail_content = $item->spanish_mail_content;
                                $item->notification_content = $item->spanish_notification_content;
                            }
                            else
                            {
                                $item = App\Models\NotificationTemplate::where('title','book order')->first();
                            }
                        }
                        else
                        {
                            $item = App\Models\NotificationTemplate::where('title','book order')->first();
                        }
                    @endphp
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <ul class="nav nav-pills nav-pills-rose nav-pills-icons flex-column" role="tablist">
                                    @foreach ($data as $value)
                                        <li class="nav-item">
                                            <a class="nav-link mt-1 w-100 h-100 {{ $loop->iteration == 1 ? 'active show' : '' }}" onclick="notificationTemplateEdit({{ $value->id }}) , getStatus({{ $value->id }})" data-toggle="tab" href="#link110" role="tablist">{{ $value->title }}</a>
                                        </li>
                                        @php
                                        $status = App\Models\NotificationTemplate::where('id',$value->id)->where('vendor_id',$value->vendor_id)->first();
                                        @endphp
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-md-8">
                                <div class="tab-content">
                                    <div class="tab-pane active show" id="link110">
                                        <form method="post"  action="{{ 'notification_template/'.$item->id }}" class="edit_notification_template_form">
                                            @csrf
                                            @method('PUT')
                                            {{--  @dump($status)  --}}
                                            <div class="row">
                                                <div class="col">
                                                    <h4 id="heading">{{ $item->title }}</h4>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="usr">{{__('Title')}}</label>
                                                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $item->title }}" id="title" style="width:100%; text-transform: none" readonly>

                                                        @error('title')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="usr">{{__('Subject')}}</label>
                                                        <input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" value="{{ $item->subject }}" id="subject" style="width:100%; text-transform: none">

                                                        @error('subject')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="usr">{{__('Notification content')}}</label>
                                                        <textarea name="notification_content" id="notification_content" name="notification_content" class="form-control" cols="30" rows="10" style="text-transform: none">{{ $item->notification_content }}</textarea>

                                                        @error('notification_content')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="usr">{{__('mail content')}}</label>
                                                        <textarea name="mail_content" class="form-control textarea_editor" cols="10" rows="10" id="mail_content" style="text-transform: none">{{ $item->mail_content }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            {{--  @isset($notificationTemplate)

                                            @dump($notificationTemplate)
                                            @endisset  --}}
                                            <div class="row">
                                                <div class="col">
                                                    <div id="statusCheck" class="form-group">
                                                      <label for="{{__('verification_phone')}}">{{__('Status')}}</label><br>
                                                      <label class="switch">
                                                          <input type="checkbox"
                                                          @if(isset($statusChecks) && $statusChecks == 1)
                                                            checked
                                                            @else
                                                              @if ($statusCheck == 1)
                                                                  checked
                                                              @endif
                                                          @endif  name="status" >
                                                          <div class="slider"></div>
                                                      </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <div class="text-center">
                                                            <input type="submit" value="{{__('Save')}}" class="btn btn-primary">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
<script>
  function getStatus(id) {
    $.ajax({
        type:'post',
        url:'/getNotificationStatus',
        data:{_token:'<?php echo csrf_token() ?>', id:id},
        success:function(data){
          console.log(data.statusChecks);
          if(data.statusChecks == 1){
            var status ='checked';
          }
          else{
            var status = '';
          }
          $("#statusCheck").empty();
          var txt1 = "<label >Status</label><br>";
          var text2 = '<label class="switch"><input type="checkbox" '+status+'  name="status" ><div class="slider"></div></label>';
          $("#statusCheck").append(txt1, text2);

       }
     });
  }
</script>
