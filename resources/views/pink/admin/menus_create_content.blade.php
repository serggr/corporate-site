<div id="content-page" class="content group">
    <div class="hentry group">
        
        {!! Form::open(['url' => (isset($menu->id)) ? route('admin.menus.update', ['menus' => $menu->id]) :  
        route('admin.menus.store'),'class'=>'contact-form','method'=>'POST','enctype'=>'multipart/form-data']) !!} 
        <ul>
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Заголовок:</span>
                    <br />
                    <span class="sublabel">Заголовок пункта</span>
                    <br />
                </label>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                {!! Form::text('title',isset($menu->title) ? $menu->title : old('title'),['placeholder'=>'Введите название страницы']) !!}
                </div>                                                   
            </li>
            
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Родительский пункт меню:</span>
                    <br />
                    <span class="sublabel">Родитель:</span>
                    <br />
                </label>
                <div class="input-prepend">
                {!! Form::select('parent', $menus, isset($menu->parent) ? $menu->parent : null) !!}
                </div>                                                   
            </li> 
        </ul>
        
        <h1>Тип меню:</h1>
        <div id="accordion">
            
            <h3>{!! Form::radio('type', 'customLink',(isset($type) && $type == 'customLink') ? TRUE : FALSE) !!}
                <span class="label">Пользовательская ссылка:</span></h3>
                <div>
                <ul>
                    <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Путь для ссылки:</span>
                            <br />
                            <span class="sublabel">Путь для ссылки</span>
                            <br />
                        </label>
                        <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                            
                            {!! Form::text('custom_link', isset($menu->path) ?  $menu->path : old('custom_link'),['placeholder'=>'Введите ссылку на страницу']) !!}                        
                            
                        </div>                                                   
                    </li> 
                    <div style="clear: both"></div>
                </ul>
                </div>
            
            <h3>{!! Form::radio('type', 'blogLink',(isset($type) && $type == 'blogLink') ? TRUE : FALSE) !!}
                <span class="label">Раздел Блог:</span></h3>
                <div>
                <ul>
                    <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Ссылка на категорию блога:</span>
                            <br />
                            <span class="sublabel">Ссылка на категорию блога</span>
                            <br />
                        </label>
                        <div class="input-prepend">
                           @if($categories)                           
                              {!! Form::select('category_alias', $categories,(isset($option) && $option) ? $option : FALSE,['placeholder' => 'Не используется']) !!} 
                           @endif 
                        </div>                                                   
                    </li> 
                    <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Ссылка на материал блога:</span>
                            <br />
                            <span class="sublabel">Ссылка на материал блога</span>
                            <br />
                        </label>
                        <div class="input-prepend"> 
                              {{ Form::select('article_alias', $articles) }}
                        </div>                                                   
                    </li> 
                    <div style="clear: both"></div>
                </ul>
                </div>
            
            <h3>{!! Form::radio('type', 'portfolioLink',(isset($type) && $type == 'portfolioLink') ? TRUE : FALSE) !!}
                <span class="label">Раздел портфолио:</span></h3>
                <div>
                <ul>
                    <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Ссылка на запись портфолио:</span>
                            <br />
                            <span class="sublabel">Ссылка на запись портфолио</span>
                            <br />
                        </label>
                        <div class="input-prepend">
                                                      
                              {{ Form::select('portfolio_alias', $portfolios) }} 
                            
                        </div>                                                   
                    </li> 
                    <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Портфолио:</span>
                            <br />
                            <span class="sublabel">Портфолио</span>
                            <br />
                        </label>
                        <div class="input-prepend"> 
                              {{ Form::select('filter_alias', $filters) }}
                        </div>                                                   
                    </li> 
                    <div style="clear: both"></div>
                </ul>
                </div>
        </div>
        
        
        @if(isset($menu->id))
            <input type="hidden" name="_method" value='PUT'>
        @endif
        <ul>
            <li class="submit-button">
                {!! Form::button('Сохранить', ['class' => 'btn btn-french-5', 'type'=>'submit']) !!}
            </li>
        </ul>
        
        {!! Form::close() !!}
    </div>    
</div>

<script>
//    jQuery(function($){
//        $('#accordion').accordion({
//            activate: function(e, obj){
//                obj.newPanel.prev().find('input[type=radio]').attr('checked','checked') ;             
//            }
//        });
//    })
</script>