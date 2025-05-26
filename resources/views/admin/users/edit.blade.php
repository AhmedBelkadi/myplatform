<div class="modal fade" id="modifierModal{{$user->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="modalCenterTitle">
                    <i class='bx bx-user-circle me-2'></i>Modifier l'utilisateur
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="post" action="{{ route('admin.users.update', $user->id) }}">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="nameBasic" class="form-label">
                                    <i class='bx bx-user me-1'></i>Nom complet
                                </label>
                                <input type="text" name="name" value="{{!old("name") ? $user->name : old("name")}}" 
                                    id="nameBasic" class="form-control" placeholder="Entrer le nom" />
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="emailBasic" class="form-label">
                                    <i class='bx bx-envelope me-1'></i>Email
                                </label>
                                <input type="email" name="email" value="{{!old("email") ? $user->email : old("email")}}" 
                                    id="emailBasic" class="form-control" placeholder="Entrer l'email" />
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="roleSelect" class="form-label">
                                    <i class='bx bx-user-pin me-1'></i>Rôle
                                </label>
                                <select name="role_id" id="roleSelect" class="form-select">
                                    <option value="">Sélectionner un rôle</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- <div class="form-group mb-3">
                                <label for="passwordBasic" class="form-label">
                                    <i class='bx bx-lock me-1'></i>Nouveau mot de passe
                                </label>
                                <input type="password" name="password" 
                                    id="passwordBasic" class="form-control" placeholder="Laisser vide pour ne pas changer" />
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> -->
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
