<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Libraries\BaseApi;

class StudentController extends Controller
{


    public function index(Request $request)
    {
        // mengambil data dari input search
        $search = $request->search;

        //memanggil libraries BaseApi method nya index dengan mengirim parameter1 berupa path data dari API nya, paramater 2 data untuk mengisi search_nama API nya
        $data = (new BaseApi)->index('/api/students', ['search_nama' => $search]);
        
        // ambil reponse jsonnya
        $students = $data->json();
        // dd($students);
        // kirim hasil pengambilan data ke blade index
        return view('index')->with(['students' => $students ['data']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=[
        'nama' => $request->nama,
        'nis' => $request->nis,
        'rombel' => $request->rombel,
        'rayon' => $request->rayon,
        ];
        $proses = (new BaseApi)->store('/api/students/tambah-data',$data);
        if ($proses->failed()) {
            $errors = $proses->json('data');
            return redirect()->back()->with(['errors' => $errors]);
        }else{
            return redirect('/')->with('success','berhasil menambahkan data baru ke student API');
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
        $data = (new BaseApi)->edit('/api/students/'.$id);
        if ($data->failed()){
            //kalau gagal proses dta di atas ambil deskripsi err dari json property 
        $errors = $data->json(['data']);
            return redirect()->back()->with(['errors' => $errors]);
        }else {
            //kalau berhasil , ambil data dari jsonnya
            $student = $data->json(['data']);
            //alihin ke blade edit dengan mengirim data $student di atas agar bisa di gunakan blade
            return view('edit')->with(['student' => $student]);
        }
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
        //data yang akan di kirim (request ke rest apinya)
        $payload = [
            'nama' => $request->nama, 
            'nis' =>$request->nis,
            'rombel' =>$request->rombel,       
           'rayon' =>$request->rayon,
        ];
        //panggil method update dari base api kirim endpoint (route update dari rest apinya  dan data playoad di atas)
        $proses = (new BaseApi)->update('/api/students/update/'.$id, $payload);
        if ($proses->failed()) {
            //kalau ggagl, balikin lagi sama pesan errors dari json nya
            $errors = $proses->json('data');
            return redirect()->back()->with(['errors' =>$errors]);
        }else{
            //berhasil balikin ke halaman paling awal dengan pesan
            return redirect('/')->with('success', 'Berhasil mengubah data siswa dari API');
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
        $proses =(new BaseApi)->delete('/api/students/delete/'.$id);
        if ($proses->failed()) {
            //kalau ggagl, balikin lagi sama pesan errors dari json nya
            $errors = $proses->json('data');
            return redirect()->back()->with(['errors' =>$errors]);
        }else{
            //berhasil balikin ke halaman paling awal dengan pesan
            return redirect('/')->with('success', 'Berhasil hapus data sementara dari APIw');
        }
    }
    public function trash()
    {
        $proses = (new BaseApi)->trash('/api/students/show/trash');
        if ($proses->failed()){
            $errors = $proses->json('daata');
            return redirect()->back()->with(['errors'=>$errors]);
        }else {
            $studentsTrash = $proses->json('data');
            return view ('trash')->with (['studentsTrash'=>$studentsTrash]);
        }
    }

    public function permanent($id)
    {
        $proses = (new BaseApi)->permanent('/api/students/trash/delete/permanent/'.$id);
        if ($proses->failed()) {
            $errors = $proses->json ('data');
            return redirect()->back()->with(['errors' => $errors]);
        }else {
            return redirect()->with(['Success', 'Berhasil menghapus data secara permanent']);  
        }
    }

    public function restore($id)
    {
        $proses = (new baseApi)->restore('/api/students/trash/restore/'.$id);
        if ($proses->failed()){
            $errors = $proses->json('data');
            return redirect('/')->with(['errors' => $errors]);
        }else{
            return redirect('/')->with(['success','berhasil mengembalikan data dari sampah']);
        }
    }
}