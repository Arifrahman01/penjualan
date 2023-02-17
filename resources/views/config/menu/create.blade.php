
<div class="modal-content">
    <form id="form-comparison">
    <div class="modal-header">
        <h5 class="modal-title">Tambah Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">x</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="form-group col-md-2 col-lg-2">
                <label>Code*</label>
                <input type="text"
                    class="form-control form-control-sm @error('code') {{ 'is-invalid' }} @enderror"
                    name="code" value="{{ old('code') }}"
                    onkeyup="this.value = this.value.toUpperCase();" required maxlength="6">
                @error('code')
                    <div class="invalid-feedback">
                        {{ $errors->first('code') }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-6 col-lg-6">
                <label>Nama*</label>
                <input type="text"
                    class="form-control form-control-sm @error('name') {{ 'is-invalid' }} @enderror"
                    name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @enderror
            </div>
            <div class="form-group col-md-4 col-lg-4">
                <label>code Icon*</label>
                <input type="text"
                    class="form-control form-control-sm @error('icon') {{ 'is-invalid' }} @enderror"
                    name="icon" value="{{ old('icon') }}" required>
                @error('icon')
                    <div class="invalid-feedback">
                        {{ $errors->first('icon') }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-2 col-lg-2">
                <label>Position*</label>
                <input type="text"
                    class="form-control form-control-sm @error('code') {{ 'is-invalid' }} @enderror"
                    name="code" value="{{ old('code') }}"
                    onkeyup="this.value = this.value.toUpperCase();" required maxlength="6">
                @error('code')
                    <div class="invalid-feedback">
                        {{ $errors->first('code') }}
                    </div>
                @enderror
            </div>
        </div>
    
    </div>
</form>
    <div class="modal-footer">
        <button type="button" id="submit" class="btn btn-danger hidden"><i class="fa fa-save" aria-hidden="true"></i> Submit</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>

</div>
</script>