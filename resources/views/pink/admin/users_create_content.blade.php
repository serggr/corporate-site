<div id='content-page' class="content group">
    <div class='hentry group'>      
      
    {!! Form::open(['url' =>(isset($user->id)) ? route('admin.users.update',['users'=>$user->id]) :route('admin.users.store'),'class'=>'contact-form','method'=>'POST','enctype'=>'multipart/form-data']) !!}  
         
    <ul>
        <li class="text-field">
            <label for='name-contact-us'>
                <span class="label">Имя пользователя</span>
                <br />
                <span class="sublabel">Имя пользователя</span><br />
            </label>
            <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
            {!! Form::text('name',isset($user->name) ? $user->name : old('name'),['placeholder'=>'Введите имя пользователя']) !!}
            </div>
        </li>
        
        
        <li class="text-field">
            <label for='name-contact-us'>
                <span class="label">E-mail</span>
                <br />
                <span class="sublabel">E-mail пользователя</span><br />
            </label>
            <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
            {!! Form::text('email',isset($user->email) ? $user->email : old('email'),['placeholder'=>'Введите email пользователя']) !!}
            </div>
        </li>  
        
        <li class="text-field">
            <label for='name-contact-us'>
                <span class="label">Пароль</span>
                <br />
                <span class="sublabel">Пароль пользователя</span><br />
            </label>
            <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>                
            
            {!! Form::password('password') !!}
             
            </div>
        </li>         
        
        
<!--        <li class="text-field">
            <label for='name-contact-us'>
                <span class="label">Роль:</span>
                <br />
                <span class="sublabel">Роль пользователя</span><br />
            </label>
            <div class="input-prepend">
            {--{ Form::select('role', $role, isset($role->id) ? $role->id : '') }--}
            </div>
        </li>-->
        
        @if(isset($user->id))
            <input type='hidden' name='_method' value="PUT">
        @endif
                        
        <li class="submit-button">
            {!! Form::button('Сохранить', ['class'=>'btn btn-the-salmon-dance-5', 'type'=>'submit']) !!}
        </li>                
              
        
    </ul>
    
    {!! Form::close() !!}
    </div>
</div>

