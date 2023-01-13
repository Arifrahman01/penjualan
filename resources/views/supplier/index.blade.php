@extends('layouts.master', ['title' => 'Master Supplier'])
@php
$page = Request::get('page') ? Request::get('page') : 1;
$no = ($page-1) * $numberPage + 1;
$search = Request::get('c');
@endphp
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
        <h5>Filter</h5>
      </div>
      <div class="card-body">
        <form action="">
          <input type="hidden" name="page" id="page" value="{{ $page }}">
          <div class="row">

            <div class="col-md-5">
              <label for="">Searching</label>
              <input type="text" name="c" id="c" class="form-control form-control-sm" placeholder="Search : Code, Description" value="{{ $search }}">
            </div>
            <div class="col-md-7 text-right">
              <br>
              <button onclick="filterUrl()" class="text-right btn btn-primary"><i class="fa fa-search"> Filter</i></button>
            </div>
          </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12 col-md-12 col-lg-12">
    <div class="card card-primary">
      <div class="card-body p-10">
        <a href="{{ route("supplier.create") }}" class="btn btn-primary">
          Create
        </a>
        <div class="table-responsive mt-3">
          <table class="table table-bordered table-sm">
            <thead>
              <tr>
                <th class="text-center" style="width:50px;">#</th>
                <th>Code</th>
                <th>Description</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($list as $key => $val)
              
              <tr>
                <td class='align-middle text-center'>{{ $no++ }}</td>
                <td class='align-middle'>{{ $val->code }}</td>
                <td class='align-middle'>{{ $val->description }}</td>
                <td class='align-middle'>
                  <a href="{{ route('supplier.edit', ['id' => $val->id]) }}" class="btn btn-sm btn-primary" type="button"><i
                    class='fas fa-edit'></i></a>
                  <a href="{{ route('supplier.destroy', ['id' => $val->id]) }}" onclick="deleteConfirmation(event)" class="btn btn-sm btn-danger" type="button"><i
                      class='fas fa-trash-alt'></i></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <span>{{ number_format((($page-1) * $numberPage + 1),0). ' - ' . number_format(($no-1),0) .' Of Over '.number_format($list->total(),0).' Result' }} </span>
      </div>

      <div class="card-footer">
        {!! $list->links() !!}
    </div>
      </div>
    </div>
  </div>
</div>
@endsection