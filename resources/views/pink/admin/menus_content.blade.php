<div id="content-page" class="content-group">
    <div class="hentry group">
        <h3 class="title_page">Пользователи</h3>
        
        <div class="short-table white">
            <table style="width: 100%" cellspacing='0' cellpadding='0'>
                <thead>
                    <th>Name</th>
                    <th>Link</th>
                    <th>Удалить</th> 
                </thead>
                
                @if($menus)                
                    @include(env('THEME').'.admin.custom-menu-items',array('items'=> $menus->roots(), 'paddingLeft' => ''))
                @endif
            </table>
        </div>
        {!! Html::link(route('admin.menus.create'),'Добавить пункт',['class' => 'btn btn-the-salmon-dance-3']) !!}
    </div>
</div>


























