<div class="modal fade" id="deletePermissionModal{{$permission->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white" id="modalCenterTitle">
                    <i class='bx bx-trash me-2'></i>Supprimer la permission
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <p class="text-center mb-0">
                    Êtes-vous sûr de vouloir supprimer la permission <strong>{{ $permission->name }}</strong> ?<br>
                    Cette action est irréversible.
                </p>
            </div>

            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class='bx bx-x me-1'></i>Annuler
                </button>
                <form method="POST" action="{{ route('admin.permissions.destroy', $permission->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class='bx bx-trash me-1'></i>Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
