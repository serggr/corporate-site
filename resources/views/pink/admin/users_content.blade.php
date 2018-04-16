<div id="content-page" class="content group">
    <div class="hentry group">
        <h3 class="title_page">Пользователи</h3>
<!--        <form action="{{ route('admin.permissions.store') }}" method="POST">
            {{ csrf_field() }}-->
            
            <div class="short-table white">
                <table style="width:100%">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Login</th>
                        <th>Role</th>
                        <th>Удалить</th>
                    </thead>
                    @if($users)
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{!! Html::link(route('admin.users.edit',['users' => $user->id]),$user->name) !!}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->login }}</td>
                            <td>{{ $user->roles->implode('name',', ') }}</td>
                            <td>
                                {!! Form::open(['url'=>route('admin.users.destroy',['users'=>$user->id]) ]) !!}
                                {!! method_field('DELETE') !!}
                                {!! Form::button('Удалить', ['class' => 'btn btn-french-5', 'type'=>'submit']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                    @endif

                </table>
            </div>
            {!! Html::link(route('admin.users.create'),'Добавить пользователя',['class' => 'btn btn-the-salmon-dance-3']) !!}
            
            
            
<!--        </form>        -->
    </div>
</div>

















