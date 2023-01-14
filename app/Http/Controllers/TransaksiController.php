<?php

namespace App\Http\Controllers;
use App\Models\Barang;
use App\Models\Supplier;
use App\Models\Transaksi;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $numberPage = 10;
        $barang = Barang::get();
        $list = Transaksi::with(['barang.supplier'])->paginate($numberPage)->withQueryString();
        return view('transaksi.index', compact('numberPage','list','barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create Transaksi';
        $action = route('transaksi.store');
        $method = 'POST';

        $barang = Barang::get();

        $data = compact('title', 'action', 'method' ,  'barang');
        return view('transaksi.form', $data);
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
                'barang_id'     => 'required',
                'code'          => 'required',
                'description'   => 'required'
            ];
            $customMessages = [
                'barang_id'     => 'required',
                'code'          => 'required',
                'description'   => 'required'
            ];

            request()->validate($rules, $customMessages);

            Transaksi::create([
                'barang_id'   => request('barang_id'),
                'code'          => request('code'),
                'description'   => request('description'),
            ]);
            DB::commit();
            alert()->success('Success', 'Data has been saved');
            return redirect()->route('transaksi.index');
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
        $title = 'Edit Transaksi';
        $barang = Barang::get();
        $list = Transaksi::find($id);
        $data = [
            'barang_id'     => $list->barang_id,
            'code'          => $list->code,
            'description'   => $list->description
        ];
        session()->flashInput(array_merge($data, old()));

        $action = route('transaksi.update', ['id' => $id]);
        $method = 'PUT';

        return view('transaksi.form',  compact('title', 'action', 'method','list', 'barang'));
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
                'barang_id'   => 'required',
                'code'          => 'required',
                'description'   => 'required'
            ];
            $customMessages = [
                'barang_id'    => 'required',
                'code'          => 'required',
                'description'   => 'required'
            ];
            request()->validate($rules, $customMessages);

            $list = Transaksi::find($id);
            $list->update([
                'barang_id'   => request('barang_id'),
                'code'          => request('code'),
                'description'   => request('description'),
            ]);
            DB::commit();
            alert()->success('Success', 'Data has been update');
            return redirect()->route('transaksi.index');
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
            Transaksi::find($id)->delete();
            DB::commit();
            alert()->success('Success', 'Data has been deleted');
            return redirect()->route('transaksi.index');
        } catch (\Exception $e) {
            DB::rollBack();
            alert()->error('Error', 'Data not deleted');
            return redirect()->back();
        }
    }
}
