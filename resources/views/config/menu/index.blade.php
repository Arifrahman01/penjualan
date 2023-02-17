@extends('layouts.master', ['title' => 'Configuration Menu'])
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h5>Filter</h5>
                </div>
                <div class="card-body">
                    <form action="">
                        <div class="row">
                            <div class="col-md-3 col-lg-3">
                                <label for="">Searching</label>
                                <input type="text" name="s" id="s" class="form-control form-control-sm"
                                    placeholder="Search : Code, Description">
                            </div>
                            <div class="col-md-9 text-right">
                                <br>
                                <button onclick="filterUrl()" class="text-right btn btn-primary"><i class="fa fa-search">
                                        Filter</i></button>
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
                    <button class="modal-button btn btn-primary" onclick="modalForm('/config/create_menu')" role="button" data-toggle="modal" data-target="#modal-lg" data-backdrop="static"> <i class="fa fa-plus-circle"></i> Menu </button>
                 
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width:50px;">#</th>
                                    <th>Code</th>
                                    <th>Description</th>
                                    <th>Suplaier</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>
    </div>
@endsection
