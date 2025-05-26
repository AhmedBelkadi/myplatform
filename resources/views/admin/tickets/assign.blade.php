<div class="modal fade" id="assignModal{{$ticket->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="modalCenterTitle">
                    <i class='bx bx-user-plus me-2'></i>Assigner le ticket
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="post" action="{{ route('admin.tickets.assign', $ticket->id) }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <p class="mb-3">
                                <strong>Sujet du ticket :</strong> {{ $ticket->subject }}
                            </p>
                            <div class="mb-3">
                                <label for="support_id" class="form-label">
                                    <i class='bx bx-user-check me-1'></i>Sélectionner un agent de support
                                </label>
                                <select name="support_id" id="support_id" class="form-select @error('support_id') is-invalid @enderror" required>
                                    <option value="">Choisir un agent...</option>
                                    @foreach($supports as $support)
                                        <option value="{{ $support->id }}" 
                                                {{ old('support_id', $ticket->assigned_to) == $support->id ? 'selected' : '' }}>
                                            {{ $support->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('support_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class='bx bx-x me-1'></i>Annuler
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class='bx bx-check me-1'></i>Assigner
                    </button>
                </div>
            </form>
        </div>
    </div>
</div> 