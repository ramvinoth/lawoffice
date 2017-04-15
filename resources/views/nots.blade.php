
<div class="panel panel-default up-arrow">
    <div class="panel-heading text-center">Notifications <span id="notiClose" class="pull-right" onclick="jQuery('#notifications').html('')"><i class="fa fa-close"></i></span></div>

    <div class="panel-body">
            <ul class="list-group">
                  @foreach($nots as $not)
                        <li class="list-group-item">
                               {{ $not->data['name'] }} &nbsp; {{ $not->data['message'] }} <span class="pull-right">{{ $not->created_at->diffForHumans() }}</span>
                        </li>
                  @endforeach
            </ul>
    </div>
</div>
