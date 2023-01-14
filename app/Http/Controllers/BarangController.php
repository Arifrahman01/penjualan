<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Supplier;


use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;


class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $numberPage = 10;
        $supplier = Supplier::get();
        $list = Barang::with('supplier')
        ->search(request(['s','a']))->paginate($numberPage)->withQueryString();
        return view('barang.index', compact('numberPage','list','supplier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create Barang';
        $action = route('barang.store');
        $method = 'POST';

        $supplier = Supplier::get();

        $data = compact('title', 'action', 'method' ,  'supplier');
        return view('barang.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $rules = [
                'supplier_id'   => 'required',
                'code'          => 'required',
                'description'   => 'required'
            ];
            $customMessages = [
                'supplier_id'    => 'required',
                'code'          => 'required',
                'description'   => 'required'
            ];

            request()->validate($rules, $customMessages);

            Barang::create([
                'supplier_id'   => request('supplier_id'),
                'code'          => request('code'),
                'description'   => request('description'),
            ]);
            DB::commit();
            alert()->success('Success', 'Data has been saved');
            return redirect()->route('barang.index');
        } catch (ValidationException $e) {
            DB::rollBack();
            alert()->error('Error', $e->validator->errors()->first());
            return redirect()->back()->withInput(request()->all())
                ->withErrors($e->validator->errors());
        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error('Error', $e->getMessage());
            return redirect()->back()->withInput(request()->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $list = Barang::find($id);
        $data = [
            'supplier_id'   => $list->supplier_id,
            'code'          => $list->code,
            'description'   => $list->description
        ];
        session()->flashInput(array_merge($data, old()));

        $title = 'Edit Barang';
        $action = route('barang.update', ['id' => $id]);
        
        $method = 'PUT';
        $supplier = Supplier::get();
        $data = compact('title', 'action', 'method', 'supplier', 'list');
        return view('barang.form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $rules = [
                'supplier_id'   => 'required',
                'code'          => 'required',
                'description'   => 'required'
            ];
            $customMessages = [
                'supplier_id'    => 'required',
                'code'          => 'required',
                'description'   => 'required'
            ];
            request()->validate($rules, $customMessages);

            $list = Barang::find($id);
            $list->update([
                'supplier_id'   => request('supplier_id'),
                'code'          => request('code'),
                'description'   => request('description'),
            ]);
            DB::commit();
            alert()->success('Success', 'Data has been update');
            return redirect()->route('barang.index');
        } catch (ValidationException $e) {
            DB::rollBack();
            alert()->error('Error', $e->validator->errors()->first());
            return redirect()->back()->withInput(request()->all())
                ->withErrors($e->validator->errors());
        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error('Error', $e->getMessage());
            return redirect()->back()->withInput(request()->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            Barang::find($id)->delete();
            DB::commit();
            alert()->success('Success', 'Data has been deleted');
            return redirect()->route('barang.index');
        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error('Error', 'Data not deleted');
            return redirect()->back();
        }
    }
}
