@extends('layouts.master', ['title' => 'Transaksi'])
@php
$page = Request::get('page') ? Request::get('page') : 1;
$no = ($page-1) * $numberPage + 1;
$search = Request::get('s');
@endphp
@section('content')
<div class="row">
  <div class="col-12 col-md-12 col-lg-12">
    <div class="card card-primary">
      <div class="card-body p-10">
        <a href="{{ route("transaksi.create") }}" class="btn btn-primary">
          Create
        </a>
        <div class="table-responsive mt-3">
          <table class="table table-bordered table-sm">
            <thead>
              <tr>
                <th class="text-center" style="width:50px;">#</th>
                <th>Code</th>
                <th>Description</th>
                <th>Barang</th>
                <th>Supplier</th>
                <th>Date Transaction</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($list as $key => $val)
              <tr>
                <td class='align-middle text-center'>{{ $no++ }}</td>
                <td class='align-middle'>{{ $val->code }}</td>
                <td class='align-middle'>{{ $val->description }}</td>
                <td class='align-middle'>{{ '['.($val->barang->code ?? '----' ).'] - ' .($val->barang->description ?? 'Not Found') }}</td>
                <td class='align-middle'>{{ '['.($val->barang->supplier->code ?? '----' ).'] - ' .($val->barang->supplier->description ?? 'Not Found') }}</td>
                <td class='align-middle'>{{ $val->created_at }}</td>
                <td class='align-middle'>
                  <a href="{{ route('transaksi.edit', ['id' => $val->id]) }}" class="btn btn-sm btn-primary" type="button"><i
                    class='fas fa-edit'></i></a>
                  <a href="{{ route('transaksi.destroy', ['id' => $val->id]) }}" onclick="deleteConfirmation(event)" class="btn btn-sm btn-danger" type="button"><i
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