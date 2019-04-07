<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Siswa;

class SiswaController extends Controller
{
    public function index(){
        return view('siswa.index');
    }
    public function get(){
        $d['siswas'] = Siswa::orderby('id', 'DESC')->get();
        return view('siswa.getDataTable', $d);
    }
    public function save(Request $r){
        $siswa = new Siswa;
        $siswa->nis = $r->input('nis');
        $siswa->nama = $r->input('nama');
        $siswa->kelas = $r->input('kelas');
        $foto = $r->file('foto');

        $siswa->foto = $foto->getClientOriginalName();
        $foto->move(public_path('UploadedFile/foto/'),$foto->getClientOriginalName());

        $siswa->save();
        echo "sukses";
    }
    public function getSiswa($id){
        $data = Siswa::find($id);
        echo json_encode($data);
    }
    public function update(Request $r, $id){
        $siswa = Siswa::find($id);
        $siswa->nis = $r->input('nis');
        $siswa->nama = $r->input('nama');
        $siswa->kelas = $r->input('kelas');
        $foto = $r->file('foto');

        if(!empty($foto)){
            $siswa->foto = $foto->getClientOriginalName();
            $foto->move(public_path('UploadedFile/foto/'),$foto->getClientOriginalName());
        }

        $siswa->save();
        echo "sukses";
    }
    public function delete($id){
        $siswa = Siswa::find($id);
        $siswa->delete();
        echo "sukses";
    }
}
