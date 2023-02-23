@extends('layouts.app')

@section('content')
    <div class="row" style="margin-top: 8px;">
        <table class="table table-striped" id="userTable">
            <thead>
                <tr>
                    <th scope="col"># id</th>
                    <th scope="col">name</th>
                    <th scope="col">email</th>
                    <th scope="col">type</th>
                    <th scope="col">verified</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>
                        {{ $user->id }}
                    </td>
                    <td>
                        {{ $user->name }}
                    </td>
                    <td>
                        {{ $user->email }}
                    </td>
                    <td>
                        {{ $user->type }}
                    </td>
                    <td>
                        @if($user->email_verified_at != null)
                            yes
                        @else
                            no
                        @endif
                    </td>
                    <td>
                        @if($user->id != Auth::user()->id)
				            <form method="POST" action="{{ url('admin/' . $user->id) }}">
				                @method('delete')
				                @csrf
								<input id="iduser" name="iduser" class="hidden" value="{{ $user->id }}">
				                <input type="submit" class="link-delete" value="delete"/>
				            </form>
                        @endif
                    </td>
                    <td>
                        <form method="POST" action="{{ url('admin/' . $user->id . '/edit') }}">
				            @method('get')
			                @csrf
							<input id="iduser" name="iduser" class="hidden" value="{{ $user->id }}">
			                <input type="submit" class="link-delete" value="edit"/>
			            </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ url('admin/create') }}" class="btn btn-primary">Create user</a>
    </div>
@endsection