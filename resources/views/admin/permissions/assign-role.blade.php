<div class="modal fade" id="assignRoleModal{{$permission->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="modalCenterTitle">
                    <i class='bx bx-user-check me-2'></i>Assigner des rôles
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="post" action="{{ route('admin.permissions.assign-roles', $permission->id) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                        
                            <div class="row">
                                @foreach($roles as $role)
                                    <div class="col-md-6 mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input role-checkbox" 
                                                   type="checkbox" 
                                                   name="roles[]" 
                                                   value="{{ $role->id }}"
                                                   id="role-{{$permission->id}}-{{$role->id}}"
                                                   {{ $permission->roles->contains($role->id) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="role-{{$permission->id}}-{{$role->id}}">
                                                {{ $role->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class='bx bx-x me-1'></i>Annuler
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class='bx bx-save me-1'></i>Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('select-all-roles-{{$permission->id}}').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('#assignRoleModal{{$permission->id}} .role-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
</script>
@endpush 