@extends("layouts.index")

@section("permissions-active", "active")

@section("main")
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold"><i class='bx bx-key me-2'></i>Gestion des permissions</h4>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPermissionModal">
            <i class="bx bx-plus me-1"></i>Ajouter une permission
        </button>
    </div>

    @include('admin.permissions.create')

    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-center">Nom</th>
                        <th class="text-center">Rôles associés</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($permissions as $permission)
                        <tr>
                            <td class="text-center">{{ $permission->name }}</td>
                            <td class="text-center">
                                @foreach($permission->roles as $role)
                                    <span class="badge bg-primary rounded-pill me-1">
                                        {{ $role->name }}
                                    </span>
                                @endforeach
                            </td>
                            <td class="text-center">
                                <button
                                    type="button"
                                    class="btn btn-info text-white btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#assignRoleModal{{$permission->id}}"
                                >
                                    <i class="menu-icon tf-icons bx bx-user-check"></i>
                                </button>

                                <button
                                    type="button"
                                    class="btn btn-success text-white btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editPermissionModal{{$permission->id}}"
                                >
                                    <i class="menu-icon tf-icons bx bx-pencil"></i>
                                </button>

                                <button
                                    type="button"
                                    class="btn btn-danger text-white btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deletePermissionModal{{$permission->id}}"
                                >
                                    <i class="menu-icon tf-icons bx bx-trash"></i>
                                </button>

                                @include('admin.permissions.assign-role', ['permission' => $permission])
                                @include('admin.permissions.edit', ['permission' => $permission])
                                @include('admin.permissions.delete', ['permission' => $permission])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection












