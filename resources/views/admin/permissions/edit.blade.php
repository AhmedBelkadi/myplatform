<div class="modal fade" id="editPermissionModal{{$permission->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white" id="modalCenterTitle">
                    <i class='bx bx-edit me-2'></i>Modifier la permission
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="post" action="{{ route('admin.permissions.update', $permission->id) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="name{{$permission->id}}" class="form-label">
                                <i class='bx bx-tag me-1'></i>Nom de la permission
                            </label>
                            <input type="text" 
                                   name="name" 
                                   id="name{{$permission->id}}" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   placeholder="Entrer le nom de la permission"
                                   value="{{ old('name', $permission->name) }}" 
                                   required />
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        
                    </div>
                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class='bx bx-x me-1'></i>Annuler
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class='bx bx-save me-1'></i>Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
