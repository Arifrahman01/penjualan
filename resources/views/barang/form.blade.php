@extends('layouts.master', ['title' => $title])
@section('content')
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card card-primary">
                <form action="{{ $action }}" method="post" id="">
                    @method($method)
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="section-title">General</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3 col-lg-3">
                                <label for="">Supplier*</label>
                                <select class="form-control form-control-sm @error('supplier_id') 'is-invalid' @enderror"
                                    size="1" id="supplier_id" name="supplier_id"  required>
                                    <option value="">-Pilih Company-</option>
                                    @foreach ($supplier as $val)
                                        <option value="{{ $val->id }}"  {{ selected( old('supplier_id'), $val->id) }}>
                                            {{ '[' . $val->code . '] - ' . $val->description }}
                                        </option>
                                    @endforeach
                                    @error('supplier_id')
                                        <div class="invalid-feedback">
                                            {{ $errors->first('supplier_id') }}
                                        </div>
                                    @enderror
                                </select>
                            </div>
                            <div class="form-group col-md-3 col-lg-3">
                                <label>Code*</label>
                                <input type="text"
                                    class="form-control form-control-sm @error('code') {{ 'is-invalid' }} @enderror"
                                    name="code" value="{{ old('code') }}"
                                    onkeyup="this.value = this.value.toUpperCase();" required>
                                @error('code')
                                    <div class="invalid-feedback">
                                        {{ $errors->first('code') }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-3 col-lg-3">
                                <label>Description*</label>
                                <input type="text"
                                    class="form-control form-control-sm @error('description') {{ 'is-invalid' }} @enderror"
                                    name="description"
                                    value="{{ old('description') }}" required>
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $errors->first('description') }}
                                    </div>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-lg btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
