<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#etudiantsModal"><i class="bx bx-plus me-sm-1"></i>Ajouter un role</button>
<div class="modal fade" id="etudiantsModal" tabindex="-1" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Ajouter un Role</h5>
            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
            ></button>
        </div>
           <form method="post" action="">
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
