@extends("layouts.index")

@section( "roles-active" , "active" )


@section("main")

    @include('admin.roles.create')
    @php
        $openModal = request()->query('openModal');
    @endphp
    <div class="mt-3 card">

        <div class="table-responsive text-nowrap ">
            <table class="table table-hover ">
                <thead>
                <tr>
                    <th class="text-center">Name</th>
                    <th class="text-center">Nombre d'utilisateurs</th>
                    <th class="text-center">Actions</th>

                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @foreach( $roles as $role )
                    <tr>
                        <td class="text-center">{{$role->name}}</td>
                        <td class="text-center">
                            <span class="badge bg-primary rounded-pill">
                                {{ $role->users->count() }}
                            </span>
                        </td>
                        <td class="text-center">
                            <button
                                type="button"
                                class="btn btn-success text-white"
                                data-bs-toggle="modal"
                                data-bs-target="#modifierModal{{$role->id}}"
                            >
                                <i class="menu-icon tf-icons bx bx-pencil"></i>
                            </button>
                            @include('admin.roles.edit')

                            <button
                                type="button"
                                class="btn btn-info text-white"
                                data-bs-toggle="modal"
                                data-bs-target="#permissionsModal{{$role->id}}"
                            >
                                <i class="menu-icon tf-icons bx bx-key"></i>
                            </button>
                            @include('admin.roles.permissions')

                            <button
                                type="button"
                                class="btn btn-danger text-white"
                                data-bs-toggle="modal"
                                data-bs-target="#basicModal{{$role->id}}"
                            >
                                <i class="menu-icon tf-icons bx bx-trash"></i>
                            </button>
                            @include('admin.roles.delete')
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


    {{--     {{$roles->links()}}--}}

@endsection












