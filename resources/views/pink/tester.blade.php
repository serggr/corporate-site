{!! $testers->render() !!}


@foreach($testers as $tester)
  {!! $tester->title."<br>" !!}
@endforeach


{{dump($testers)}}


