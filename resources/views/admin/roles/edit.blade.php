<div class="modal fade" id="modifierModal{{$role->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCenterTitle">Modifier le role</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
    <form method="post" action="{{route("admin.roles.update",$role->id)}}">
        @method('PUT')
               @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameBasic" class="form-label">Name</label>
                                <input type="text" name="name"  value="{{!old("name") ? $role->name : old("name")}}" id="nameBasic" class="form-control" placeholder="Enter name" />
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-success">Modifier</button>
                    </div>
{{--<div class="row">--}}
{{--    <div class="col mb-3">--}}
{{--        <label for="nameBasic" class="form-label">Apogee</label>--}}
{{--        <input type="text" name="apogee"  value="{{!old("apogee") ? $role->apogee : old("apogee")}}" id="nameBasic" class="form-control" placeholder="Enter apogee" />--}}
{{--        @error('apogee')--}}
{{--        <span class="text-danger">{{ $message }}</span>--}}
{{--        @enderror--}}

{{--    </div>--}}








{{--                <div class="row g-2">--}}
{{--                    <div class="col mb-0">--}}
{{--                        <div class=" mt-2 mb-3">--}}
{{--                            <label for="nameBasic" class="form-label">Filiere</label>--}}
{{--                            <select name="id_filiere" id="id_filiere" class="form-select form-select">--}}
{{--                                <option value="{{ $role->filiere->id }}">{{ $role->filiere->name }}</option>--}}
{{--                                    @foreach($filieres as $filiere)--}}
{{--                                    @if($filiere->id==$role->filiere->id)--}}
{{--                                        @continue--}}
{{--                                    @endif--}}
{{--                                <option value="{{ $filiere->id }}" {{ old('id_filiere') == $filiere->id ? 'selected' : '' }}>--}}
{{--                                        {{ $filiere->name }}--}}
{{--                                    </option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            @error('id_filiere')--}}
{{--                            <span class="text-danger">{{ $message }}</span>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}







        </form>
  </div>
</div>
</div>
