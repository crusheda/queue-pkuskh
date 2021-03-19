<?php

namespace App\Http\Controllers\antrian\poli;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;
use App\Models\queue_poli;
use App\Models\set_queue_poli;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Redirect;

class queuePoliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('pages.antrian.poli.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tgl = Carbon::now()->isoFormat('D');
        $bln = Carbon::now()->isoFormat('MM');
        $thn = Carbon::now()->isoFormat('Y');

        $show = DB::table('queue_poli')
            ->join('set_queue_poli', 'queue_poli.kode_queue', '=', 'set_queue_poli.id')
            ->select('queue_poli.id','queue_poli.no_rm','queue_poli.nama','set_queue_poli.nama_queue','queue_poli.queue','queue_poli.inden','queue_poli.tgl_queue')
            ->where('queue_poli.deleted_at', null)
            ->where('queue_poli.tgl_visite', null)
            // ->where('queue_poli.kode_queue', $poli)
            ->where('queue_poli.no_rm', $request->no_rm)
            ->orderBy('queue_poli.no_rm','ASC')
            // ->groupBy('set_queue_poli.nama_queue')
            ->first();

            if ($show != null) {
                $query = DB::table('queue_poli')
                ->select('kode_queue')
                ->where('deleted_at', null)
                ->where('tgl_visite', null)
                ->where('no_rm', $request->no_rm)
                ->orderBy('queue_poli.id','ASC')
                ->first();

                if ($query != null) {
                    $dataku = DB::table('queue_poli')
                        ->join('set_queue_poli', 'queue_poli.kode_queue', '=', 'set_queue_poli.id')
                        ->select('queue_poli.id','queue_poli.no_rm','queue_poli.nama','set_queue_poli.nama_queue','queue_poli.queue','queue_poli.inden','queue_poli.tgl_queue')
                        ->where('queue_poli.deleted_at', null)
                        ->where('queue_poli.tgl_visite', null)
                        // ->where('queue_poli.kode_queue', $poli)
                        ->where('queue_poli.kode_queue', $query->kode_queue)
                        ->whereYear('queue_poli.tgl_queue', '=',$thn)
                        ->whereMonth('queue_poli.tgl_queue', '=',$bln)
                        ->whereDay('queue_poli.tgl_queue', '=',$tgl)
                        ->orderBy('queue_poli.queue','ASC')
                        // ->groupBy('set_queue_poli.nama_queue')
                        ->first();
                }
            }

        if ($show == null) {
            return Redirect::back()->with('message','Data Pasien Tidak Ditemukan.');
        } else {
            $data = [
                'show' => $show,
                'queue' => $dataku,
                'kode' => $request->no_rm,
            ];
            return view('pages.antrian.poli.queue')->with('list', $data);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function apiFindQueue($id)
    {
        $tgl = Carbon::now()->isoFormat('D');
        $bln = Carbon::now()->isoFormat('MM');
        $thn = Carbon::now()->isoFormat('Y');

        $query = DB::table('queue_poli')
            ->select('kode_queue')
            ->where('deleted_at', null)
            ->where('tgl_visite', null)
            ->where('no_rm', $id)
            ->orderBy('queue_poli.id','ASC')
            ->first();

        $data = DB::table('queue_poli')
            ->join('set_queue_poli', 'queue_poli.kode_queue', '=', 'set_queue_poli.id')
            ->select('queue_poli.id','queue_poli.no_rm','queue_poli.nama','set_queue_poli.nama_queue','queue_poli.queue','queue_poli.inden','queue_poli.tgl_queue')
            ->where('queue_poli.deleted_at', null)
            ->where('queue_poli.tgl_visite', null)
            // ->where('queue_poli.kode_queue', $poli)
            ->where('queue_poli.kode_queue', $query->kode_queue)
            ->whereYear('queue_poli.tgl_queue', '=',$thn)
            ->whereMonth('queue_poli.tgl_queue', '=',$bln)
            ->whereDay('queue_poli.tgl_queue', '=',$tgl)
            ->orderBy('queue_poli.queue','ASC')
            // ->groupBy('set_queue_poli.nama_queue')
            ->first();

        return response()->json($data, 200);
    }
}
