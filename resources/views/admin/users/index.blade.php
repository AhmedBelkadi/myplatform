@extends("layouts.index")

@section( "users-active" , "active" )


@section("main")


    @include('admin.users.create')

    @php
        $openModal = request()->query('openModal');
    @endphp
    <div class="mt-3 card">

        <div class="table-responsive text-nowrap ">
            <table class="table table-hover ">
                <thead>
                <tr>
                    <th class="text-center" >Name</th>
                    <th class="text-center" >Email</th>
                    <th class="text-center" >Role</th>
                    <!-- <th class="text-center" >Last login</th> -->
                    <!-- <th class="text-center" >Two-step</th> -->
                    <th class="text-center" >Joined Date</th>
                    <th  class="text-center"  >Actions</th>

                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @foreach( $users as $user )
                    <tr>
                        <td class="text-center" >{{$user->name}}</td>
                        <td class="text-center" >{{$user->email}}</td>
                        <td class="text-center" >{{ $user->role->name ?? 'Aucun rôle' }}</td>
                        <td class="text-center" >{{ $user->created_at->format('d/m/Y') }}</td>
                        <td class="text-center">
                            <button
                                    type="button"
                                    class="btn btn-success text-white"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modifierModal{{$user->id}}"
                            >
                                <i class="menu-icon tf-icons bx bx-pencil"></i>

                            </button>
                            @include('admin.users.edit', ['roles' => $roles])
                            <button
                                    type="button"
                                    class="btn btn-danger text-white"
                                    data-bs-toggle="modal"
                                    data-bs-target="#basicModal{{$user->id}}"
                            >
                                <i class="menu-icon tf-icons bx bx-trash"></i>

                            </button>
                            @include('admin.users.delete')


                        </td>
                        <!-- <td class="text-center" >--</td> -->
                        <!-- <td class="text-center" >--</td> -->
                        <!-- <td class="text-center" >
                            @if ($user->is_active)
                                <span class="">Actif</span>
                            @else
                                <span class="">Inactif</span>
                            @endif
                        </td> -->

                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>



@endsection












