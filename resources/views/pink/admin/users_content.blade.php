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
                            <td>{!! Html::link(route('admin.users.edit',['users' => $user->id])) !!}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->login }}</td>
                            <td>{{ $user->roles->implode('name',', ') }}</td>
                            <td>
                                {!! Form::open(['url'=>route('admin.users.destroy',['users'=> ) ]) !!}
                                {!! method_field('DELETE') }}
                                {!! Form::button('Удалить') !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                    @endif

                </table>
            </div>
            {!! Html::link(route('admin.users.create'),'Добавить пользователя',['
            
            
<!--        </form>        -->
    </div>
</div>

















