<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $numberPage = 10;
        $list = Supplier::search(request(['s']))->paginate($numberPage)->withQueryString();
        return view('supplier.index', compact('numberPage','list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create Supplier';
        $action = route('supplier.store');
        $method = 'POST';

        $data = compact('title', 'action', 'method');
        return view('supplier.form', $data);
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
                'code'          => 'required',
                'description'   => 'required'
            ];
            $customMessages = [
                'code'          => 'required',
                'description'   => 'required'
            ];

            request()->validate($rules, $customMessages);

            Supplier::create([
                'code'          => request('code'),
                'description'   => request('description'),
            ]);
            DB::commit();
            alert()->success('Success', 'Data has been saved');
            return redirect()->route('supplier.index');
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
        $list = Supplier::find($id);
        $data = [
            'code'          => $list->code,
            'description'   => $list->description
        ];
        session()->flashInput(array_merge($data, old()));

        $title = 'Edit Supplier';
        $action = route('supplier.update', ['id' => $id]);
        
        $method = 'PUT';
        $data = compact('title', 'action', 'method','list');
        return view('supplier.form', $data);
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
                'code'          => 'required',
                'description'   => 'required'
            ];
            $customMessages = [
                'code'          => 'required',
                'description'   => 'required'
            ];
            request()->validate($rules, $customMessages);

            $list = Supplier::find($id);
            $list->update([
                'code'          => request('code'),
                'description'   => request('description'),
            ]);
            DB::commit();
            alert()->success('Success', 'Data has been update');
            return redirect()->route('supplier.index');
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
            Supplier::find($id)->delete();
            DB::commit();
            alert()->success('Success', 'Data has been deleted');
            return redirect()->route('supplier.index');
        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error('Error', 'Data not deleted');
            return redirect()->back();
        }
    }
}
