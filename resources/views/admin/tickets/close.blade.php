<div class="modal fade" id="closeModal{{$ticket->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title text-white" id="modalCenterTitle">
                    <i class='bx bx-door-open me-2'></i>Résolu le ticket
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="post" action="{{ route('admin.tickets.close', $ticket->id) }}">
                @csrf
                @method('PUT')
                

                <div class="modal-footer bg-light pt-4">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class='bx bx-x me-1'></i>Annuler
                    </button>
                    <button type="submit" class="btn btn-warning">
                        <i class='bx bx-door-open me-1'></i>Résolu le ticket
                    </button>
                </div>
            </form>
        </div>
    </div>
</div> 