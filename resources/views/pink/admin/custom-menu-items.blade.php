@foreach($items as $item)
    <tr>
        <td style="text-align: left;">{{ $paddingLeft }} {!! Html::link(route('admin.menus.edit', ['menus' => $item->id]),$item->title) !!}
                                                         
        <td>{{ $item->url() }}</td>
        
        <td>
            {!! Form::open(['url' => route('admin.menus.destroy',['menus'=>$item->id]),'class'=>'form-horizontal','method'=>'POST']) !!}
            {{ method_field('DELETE') }}
            {!! Form::button('Удалить', ['class' => 'btn btn-french-5', 'type'=>'submit']) !!}
            {!! Form::close() !!}
        </td>
        
        
        @if($item->hasChildren())
            
                @include(env('THEME').'.admin.custom-menu-items', array('items'=>$item->children(),'paddingLeft'=>$paddingLeft.'--'))
           
        @endif
    </tr>


@endforeach

























