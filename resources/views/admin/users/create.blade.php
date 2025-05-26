<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#etudiantsModal"><i class="bx bx-plus me-sm-1"></i>Ajouter un utilisateur</button>
<div class="modal fade" id="etudiantsModal" tabindex="-1" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Ajouter un Utilisateur</h5>
            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
            ></button>
        </div>
           <form method="post" action="{{route("admin.users.store")}}">
               @csrf
                <div class="modal-body">
                       <div class="row">
                           <div class="col mb-3">
                               <label for="nameBasic" class="form-label">Name</label>
                               <input type="text" value="{{ old("name_a") }}" name="name_a" id="nameBasic" class="form-control" placeholder="Enter name" />
                               @error("name_a")
                               <span class="text-danger" >{{$message}}</span>
                               @enderror
                           </div>
                       </div>

                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="emailBasic" class="form-label">Email</label>
                            <input type="email" id="emailBasic"  value="{{ old("email_a") }}" name="email_a" class="form-control" placeholder="enter email" />
                            @error("email_a")
                            <span class="text-danger" >{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-3 mt-3">
                                <label for="roleSelect" class="form-label">
                                    <i class='bx bx-user-pin me-1'></i>Rôle
                                </label>
                                <select name="role_id" id="roleSelect" class="form-select">
                                    <option value="">Sélectionner un rôle</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="emailBasic" class="form-label">password</label>
                            <input type="password" id="emailBasic"   value="{{ old("password") }}" name="password" class="form-control" placeholder="Enter Password" />
                            @error("password")<span class="text-danger" >{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="emailBasic" class="form-label">Repeat password</label>
                            <input type="password" id="emailBasic"   value="{{ old("password_confirmation") }}" name="password_confirmation" class="form-control" placeholder="Repeat Password" />
                            @error("password_confirmation")<span class="text-danger" >{{$message}}</span>@enderror
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
        </form>
    </div>
</div>
</div>
