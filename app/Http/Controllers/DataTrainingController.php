<?php

namespace App\Http\Controllers;

use App\Models\DataTraining;
use Illuminate\Http\Request;
use PHPUnit\Framework\Error;
use Illuminate\Support\Facades\DB;
use App\Imports\DataTrainingImport;
use App\Imports\DataUjiImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FungsiController;
use Maatwebsite\Excel\Concerns\ToArray;
use PhpOffice\PhpSpreadsheet\Calculation\Information\ErrorValue;
use function PHPUnit\Framework\isEmpty;

class DataTrainingController extends Controller
{

   
  private $FungsiController;

  public function __construct(FungsiController $FungsiController)
  {
      $this->FungsiController = $FungsiController;
  }

    public function home()
    {
        return view('home');
    }

    public function index()
    {

        $data = DB::table('data_trainings')->get();

        return view('datatraining', [
           "data_training" => $data
        ]);
    }

    
    public function Store(Request $request)
    {
        
         $data = DataTraining::create([
            'resi' => $request->resi,
            'asuransi' => $request->asuransi,
            'yesstar' => $request->yesstar,
            'destinasi' => $request->destinasi,
            'jumlahkiriman' => $request->jumlahkiriman,
            'jeniskiriman' => $request->jeniskiriman,
            'isikiriman' => $request->isikiriman,
            'tepatwaktu' => $request->tepatwaktu
         ]);
          
          return redirect()->back()->with('status', 'Data Training Sudah ditambahkan');
        
    }
    
    public function mining()
    {
        $data = DB::table('data_trainings')->get();

        return view('mining', [
            "data_training" => $data
        ]);
    }

    public function tampildata($id)
    {
    
        $data = DataTraining::find($id);
        return view('editdata', ['data' => $data]);   
    }
    
    public function update(Request $request, $id)
    {
            $data = DataTraining::find($id);
            $data->asuransi = $request->input('asuransi');
            $data->yesstar = $request->input('yesstar');
            $data->destinasi = $request->input('destinasi');
            $data->jeniskiriman = $request->input('jeniskiriman');
            $data->jumlahkiriman = $request->input('jumlahkiriman');
            $data->isikiriman = $request->input('isikiriman');
            $data->tepatwaktu = $request->input('tepatwaktu');
            $data->update();
            return redirect('datatraining')->with('status', 'Data Training Berhasil Diubah');  
    }

    public function destroy($id)
    {
        DB::table('data_trainings')->where('id', $id)->delete();
        return redirect()->back()->with('status','Data training Berhasil Di hapus');
    }

    
    public function hapusData()
    {
      DB::table('data_trainings')->truncate();
      DB::table('gain')->truncate();
      DB::table('rasio_gain')->truncate();
      return redirect()->back()->with('status','Data training Berhasil Di hapus');
    }

     public function hapusPohon()
    {
      DB::table('pohonkeputusans')->truncate();
      return redirect()->back()->with('status','Pohon Keputusan Berhasil Di hapus');
    }
    
    

     function hasilMining()
    {        
      $query = DB::table('pohonkeputusans')->get();
      $id = DB::table('pohonkeputusans')->pluck('id')->toArray();
        $AllAttr = $this->FungsiController->AllAttr();
        $AllAttrYa = $this->FungsiController->AllAttrYa();
        $AllAttrTidak = $this->FungsiController->AllAttrTidak();
        $AllAttrEntropy = $this->FungsiController->entropy($this->FungsiController->AllAttrYa(), $this->FungsiController->AllAttrTidak());

        $asuransiYa = $this->FungsiController->AttrbAsuransiYa();
        $asuransiYa1 = $this->FungsiController->countingAsuransi('Ya' , 'Tidak');
        $asuransiYa2 = $this->FungsiController->countingAsuransi('Ya', 'Ya');
        $entropy = $this->FungsiController->entropy($asuransiYa1, $asuransiYa2);
        $asuransiTidak = $this->FungsiController->AttrbAsuransiTidak();
        $asuransiTidak1 = $this->FungsiController->countingAsuransi('Tidak', 'Ya');
        $asuransiTidak2 = $this->FungsiController->countingAsuransi('Tidak', 'Tidak');
        $entropyTidak = $this->FungsiController->entropy($asuransiTidak1, $asuransiTidak2);
        $asuransiGain = $this->FungsiController->Gain($asuransiYa, $asuransiTidak, $entropy, $entropyTidak, $AllAttr, $AllAttrEntropy, 'asuransi');

        $yesstarYa = $this->FungsiController->AttrbyesstarYa();
        $yesstarYa1 = $this->FungsiController->countingYesStar('Ya', 'Ya');
        $yesstarYa2 = $this->FungsiController->countingYesStar('Ya', 'Tidak');
        $entropyYesstar = $this->FungsiController->entropy($yesstarYa1, $yesstarYa2);
        $yesstarTidak = $this->FungsiController->AttrbyesstarTidak();
        $yesstarTidak1 = $this->FungsiController->countingYesStar('Tidak', 'Ya');
        $yesstarTidak2 = $this->FungsiController->countingYesStar('Tidak', 'Tidak');
        $entropyYesstarTidak = $this->FungsiController->entropy($yesstarTidak1, $yesstarTidak2);
        $yesstarGain = $this->FungsiController->Gain($yesstarYa, $yesstarTidak, $entropyYesstar, $entropyYesstarTidak, $AllAttr, $AllAttrEntropy, 'yesstar');
     
        $attrGeneral = $this->FungsiController->AttrbJenisKiriman('General');
        $attrGeneralYa = $this->FungsiController->countingJenisKiriman('General', 'Ya');
        $attrGeneralTidak =$this->FungsiController->countingJenisKiriman('General', 'Tidak');
        $entropyGeneral = $this->FungsiController->entropy($attrGeneralYa, $attrGeneralTidak);
        $attrGeneral = $this->FungsiController->AttrbJenisKiriman('General');
        $attrGeneralYa = $this->FungsiController->countingJenisKiriman('General', 'Ya');
        $attrGeneralTidak =$this->FungsiController->countingJenisKiriman('General', 'Tidak');
        $entropyGeneral = $this->FungsiController->entropy($attrGeneralYa, $attrGeneralTidak);
        $attrHighValue = $this->FungsiController->AttrbJenisKiriman('High Value');
        $attrHighValueYa = $this->FungsiController->countingJenisKiriman('High Value', 'Ya');
        $attrHighValueTidak =$this->FungsiController->countingJenisKiriman('High Value', 'Tidak');
        $entropyHighValue = $this->FungsiController->entropy($attrHighValueYa, $attrHighValueTidak);
        $attrDangerousGoods = $this->FungsiController->AttrbJenisKiriman('Dangerous Goods');
       
        $attrDangerousGoodsYa = $this->FungsiController->countingJenisKiriman('Dangerous Goods', 'Ya');
        $attrDangerousGoodsTidak =$this->FungsiController->countingJenisKiriman('Dangerous Goods', 'Tidak');
        $entropyDangerousGoods = $this->FungsiController->entropy($attrDangerousGoodsYa, $attrDangerousGoodsTidak);
        $jenisKirimanGain = $this->FungsiController->Gain3($attrGeneral, $attrHighValue , $attrDangerousGoods, $entropyGeneral, $entropyHighValue, $entropyDangerousGoods, $AllAttr, $AllAttrEntropy, 'jeniskiriman');
      
        $attrJabodetabek = $this->FungsiController->AttrbDestinasi('Jabodetabek');
        $attrJabodetabekYa = $this->FungsiController->countingDestinasi('Jabodetabek', 'Ya');
        $AttrbJabodetabekTidak =$this->FungsiController->countingDestinasi('Jabodetabek', 'Tidak');
        $entropyJabodetabek = $this->FungsiController->entropy($attrJabodetabekYa, $AttrbJabodetabekTidak);
        $attrLuarPulau = $this->FungsiController->AttrbDestinasi('Luar Pulau');
        $attrLuarPulauYa = $this->FungsiController->countingDestinasi('Luar Pulau', 'Ya');
        $attrLuarPulauTidak =$this->FungsiController->countingDestinasi('Luar Pulau', 'Tidak');
        $entropyLuarPulau = $this->FungsiController->entropy($attrLuarPulauYa, $attrLuarPulauTidak);
        $attrDalamPulau = $this->FungsiController->AttrbDestinasi('Dalam Pulau');
        $attrDalamPulauYa = $this->FungsiController->countingDestinasi('Dalam Pulau', 'Ya');
        $attrDalamPulauTidak =$this->FungsiController->countingDestinasi('Dalam Pulau', 'Tidak');
        $entropyDalamPulau = $this->FungsiController->entropy($attrDalamPulauYa, $attrDalamPulauTidak);
        $destinasiGain = $this->FungsiController->Gain3($attrJabodetabek, $attrLuarPulau , $attrDalamPulau, $entropyJabodetabek, $entropyLuarPulau, $entropyDalamPulau, $AllAttr, $AllAttrEntropy, 'destinasi');
     

        $attrJumlahKiriman1 = $this->FungsiController->AttrbJumlahKiriman('Satu');
        $attrJumlahKirimanYa1 = $this->FungsiController->countingJumlahKiriman('Satu', 'Ya');
        $attrJumlahKirimanTidak1 =$this->FungsiController->countingJumlahKiriman('Satu', 'Tidak');
        $entropyJumlahKiriman1 = $this->FungsiController->entropy($attrJumlahKirimanYa1, $attrJumlahKirimanTidak1);
        $attrJumlahKiriman2 = $this->FungsiController->AttrbJumlahKiriman('Lebihdarisatu');
        $attrJumlahKirimanYa2 = $this->FungsiController->countingJumlahKiriman('Lebihdarisatu', 'Ya');
        $attrJumlahKirimanTidak2 =$this->FungsiController->countingJumlahKiriman('Lebihdarisatu', 'Tidak');
        $entropyJumlahKiriman2 = $this->FungsiController->entropy($attrJumlahKirimanYa2, $attrJumlahKirimanTidak2);
        $jumlahKirimangain = $this->FungsiController->Gain($attrJumlahKiriman1, $attrJumlahKiriman2, $entropyJumlahKiriman1, $entropyJumlahKiriman2, $AllAttr, $AllAttrEntropy, 'jumlahkiriman');

      


        $attrDokumen = $this->FungsiController->AttrbIsiKiriman('Dokumen');
        $attrDokumenYa = $this->FungsiController->countingIsiKiriman('Dokumen', 'Ya');
        $attrDokumenTidak =$this->FungsiController->countingIsiKiriman('Dokumen', 'Tidak');
        $entropyDokumen = $this->FungsiController->entropy($attrDokumenYa, $attrDokumenTidak);
        $attrPaket = $this->FungsiController->AttrbIsiKiriman('Paket');
        $attrPaketYa = $this->FungsiController->countingIsiKiriman('Paket', 'Ya');
        $attrPaketTidak =$this->FungsiController->countingIsiKiriman('Paket', 'Tidak');
        $entropyPaket = $this->FungsiController->entropy($attrPaketYa, $attrPaketTidak);
        $isiKirimangain = $this->FungsiController->Gain($attrDokumen, $attrPaket, $entropyDokumen, $entropyPaket, $AllAttr, $AllAttrEntropy, 'isikiriman');

      $max_gain = DB::table('gain')->max('gain');
      $maxGain = DB::table('gain')->where('gain', $max_gain)->first();
      $Gain = $maxGain->attribut;
      $Gain2 = $maxGain->gain;

      $newGain = DB::table('gain')->get();



      
     
      $this->pembentukanPohon("","");
 
       
       return view('hasilmining', [
        "entropy" => $entropy,
        'asuransiYa' => $asuransiYa,
        'asuransiYa1' => $asuransiYa1,
        'asuransiYa2' => $asuransiYa2,
        'asuransiTidak' => $asuransiTidak,
        'asuransiTidak1' => $asuransiTidak1,
        'asuransiTidak2' => $asuransiTidak2,
        'entropyTidak' => $entropyTidak,
        'yesstarYa' => $yesstarYa,
        'yesstarYa1' => $yesstarYa1,
        'yesstarYa2' => $yesstarYa2,
        'entropyYesstar' => $entropyYesstar,
        'yesstarTidak' => $yesstarTidak,
        'yesstarTidak1' => $yesstarTidak1,
        'yesstarTidak2' => $yesstarTidak2,
        'entropyYesstarTidak' => $entropyYesstarTidak,
        'AllAttr' => $AllAttr,
        'AllAttrYa' => $AllAttrYa,
        'AllAttrTidak' => $AllAttrTidak,
        'AllEntropy' => $AllAttrEntropy,
        'attrJabodetabek'=> $attrJabodetabek,
        'attrJabodetabekYa' => $attrJabodetabekYa,
        'attrbJabodetabekTidak' => $AttrbJabodetabekTidak,
        'entropyJabodetabek' => $entropyJabodetabek,
        'attrLuarPulau' => $attrLuarPulau,
        'attrLuarPulauYa' => $attrLuarPulauYa,
        'attrLuarPulauTidak' => $attrLuarPulauTidak,
        'entropyLuarPulau' => $entropyLuarPulau,
        'attrDalamPulau' => $attrDalamPulau,
        'attrDalamPulauYa' => $attrDalamPulauYa,
        'attrDalamPulauTidak' => $attrDalamPulauTidak,
        'entropyDalamPulau' => $entropyDalamPulau,
        'attrDokumen' => $attrDokumen,
        'attrDokumenYa' => $attrDokumenYa,
        'attrDokumenTidak' => $attrDokumenTidak,
        'entropyDokumen' => $entropyDokumen,
        'attrPaket' => $attrPaket,
        'attrPaketYa' => $attrPaketYa,
        'attrPaketTidak' => $attrPaketTidak,
        'entropyPaket' => $entropyPaket,
        'attrGeneral' => $attrGeneral,
        'attrGeneralYa' => $attrGeneralYa,
        'attrGeneralTidak' => $attrGeneralTidak,
        'entropyGeneral' => $entropyGeneral,
        'attrHighValue' => $attrHighValue,
        'attrHighValueYa' => $attrHighValueYa,
        'attrHighValueTidak' => $attrHighValueTidak,
        'entropyHighValue' => $entropyHighValue,
        'attrDangerousGoods' => $attrDangerousGoods,
        'attrDangerousGoodsYa' => $attrDangerousGoodsYa,
        'attrDangerousGoodsTidak' => $attrDangerousGoodsTidak,
        'entropyDangerousGoods' => $entropyDangerousGoods,
        'attrJumlahKiriman1' => $attrJumlahKiriman1,
        'attrJumlahKirimanYa1' => $attrJumlahKirimanYa1,
        'attrJumlahKirimanTidak1' => $attrJumlahKirimanTidak1,
        'entropyJumlahKiriman1' => $entropyJumlahKiriman1,
        'attrJumlahKiriman2' => $attrJumlahKiriman2,
        'attrJumlahKirimanYa2' => $attrJumlahKirimanYa2,
        'attrJumlahKirimanTidak2' => $attrJumlahKirimanTidak2,
        'entropyJumlahKiriman2' => $entropyJumlahKiriman2,
        'asuransiGain' =>$asuransiGain,
        'yesstarGain' =>$yesstarGain,
        'jumlahKirimangain' => $jumlahKirimangain,
        'destinasiGain' => $destinasiGain,
        'jenisKirimanGain' => $jenisKirimanGain,
        'isiKirimangain' => $isiKirimangain,
        'maxgain' => $Gain,
        'gain' =>$Gain2,
        'gain1'=> $newGain,
        'query' =>$query,
        'id' => $id
    ]);
    }

   


    public function rules()
    {
      return [
        'file' => 'required'
      ];
    }

    public function import(Request $request)
    {
      $request = Excel::import(new DataTrainingImport,request()->file('file'));

      if($request == isEmpty()){
        return redirect()->back()->with('status', 'Mohon Pilih File Exccel');
      }else {
      return redirect()->back()->with('status', 'Data Training Sudah ditambahkan');
      }
    }

    public function importDataUji(Request $request)
    {
      $request = Excel::import(new DataUjiImport,request()->file('file'));

      if($request == isEmpty()){
        return redirect()->back()->with('status', 'Mohon Pilih File Exccel');
      }else {
      return redirect()->back()->with('status', 'Data Uji Sudah ditambahkan');
      }
    }

    public function cek_nilaiAtribut($field , $kondisi){     
      $hasil = [];

      if ($kondisi == '') {
         $results = DB::table('data_trainings')
                    ->select(DB::raw("DISTINCT($field)"))
                    ->get();
      } else {
              $results = DB::table('data_trainings')
                ->select(DB::raw("DISTINCT($field)"))
                ->whereRaw($kondisi)
                ->get();
              }

              $hasil = $results->pluck($field)->toArray();

              return $hasil;
    }	

    function cek_nilaiAtributJumlahKiriman($field , $kondisi){     
      $hasil = array();
      if($kondisi==''){
        $sql = DB::table('data_trainings')->distinct()->select($field)->count();				
      }else{
        $sql = DB::table('data_trainings')->distinct()->select($field)->where($field, '=','$kondisi' )->count();				
      }
      $query = DB::table('data_trainings')
              ->select($field)
              ->distinct()
              ->where($kondisi);

              $data = $query->get();
              $hasil = [];
              $a = 0;

            foreach ($data as $row) {
                  $hasil[$a] = $row->$field;
                  $a++;
            }

            return $hasil;
    }	
    


    



    public function pohonKeputusan()
    {
       $rule = DB::table('pohonkeputusans')->get();


       return view('pohonkeputusan', [
        'rule' => $rule
       ]);
   
    }

    public function cek_heterohomogen($field , $kondisi){
      //sql disticnt
      if($kondisi==''){
        $sql = DB::table('data_trainings')->distinct()->pluck($field);;					
      }else{
        $sql = DB::table('data_trainings')
                    ->select(DB::raw("DISTINCT($field)"))
                    ->where($kondisi)
                    ->get();					
      }
      //jika jumlah data 1 maka homogen
      if ($sql->count() == 1) {                      
        $nilai = "homogen";
      }else{
        $nilai = "heterogen";
      }		
      return $nilai;
    }	

    
   function proses_DT($parent , $kasus_cabang1 , $kasus_cabang2){	
 
      $this->pembentukanPohon($parent , $kasus_cabang1);	
      
      $this->pembentukanPohon($parent , $kasus_cabang2);		
  
    }	

    function pangkas($parent, $kasus, $leaf) {
      $pangkas = DB::table('pohonkeputusans')
                  ->where('parent', $parent)
                  ->where('keputusan', $leaf)
                  ->get();

      
      $row_pangkas = DB::table('pohonkeputusans')
                  ->where('parent', $parent)
                  ->where('keputusan', $leaf)
                  ->get();
                 foreach($row_pangkas as $row)
                  {
                     $row->id; 
                     $row->parent;
                     $row->akar;
                     $row->keputusan;
                  }
      $jumlah_pangkas = DB::table('pohonkeputusans')
                        ->where('parent', $parent)
                        ->where('keputusan', $leaf)
                        ->count(); 
        if($jumlah_pangkas == 0){
          DB::table('pohonkeputusans')->insert([
            'parent' => $parent,
            'akar' => $kasus,
            'keputusan' => $leaf,
        ]);
       

        }else{
          DB::table('pohonkeputusans')->where('id', $row->id)->delete();

          $exPangkas = explode(" AND ", $parent);
          $jmlEXpangkas = count($exPangkas);
          $temp=array();
          for($a=0;$a<($jmlEXpangkas-1);$a++){
            $temp[$a]=$exPangkas[$a];
          }
          $imPangkas = implode(" AND ",$temp);
			    $akarPangkas = $exPangkas[$jmlEXpangkas-1];
			    $que_pangkas = DB::table('pohonkeputusans')
                          ->where('parent', $imPangkas)
                          ->where('keputusan', $leaf)
                          ->get();
		  	  foreach($que_pangkas as $row)
          {
           $row->parent;
           $row->keputusan;
          }
          $jumlah_pangkas = DB::table('pohonkeputusans')
                        ->where('parent', $parent)
                        ->where('keputusan', $leaf)
                        ->count();  

          if($jumlah_pangkas == 0){
          DB::table('pohonkeputusans')->insert([
            'parent' => $parent,
            'keputusan' => $leaf,
            'akar' => $kasus,
          ]);
      
        } else {

          $this->pangkas($imPangkas,$akarPangkas,$leaf);
          }
      }
      
    }
   

   function pembentukanPohon($N_parent, $kasus){
    if($N_parent != ''){
      $kondisi = $N_parent." AND ". $kasus;
    } else {
      $kondisi = $kasus;
      
    }


    $cek = $this->FungsiController->cek_HeteroHomogen('tepatwaktu', $kondisi);
    if($cek == 'homogen'){
      $keputusan = DB::table('data_trainings')
                  ->select('tepatwaktu')
                  ->whereRaw($kondisi)
                  ->distinct()
                  ->value('tepatwaktu');
               //   echo"$N_parent<br> $kasus<br> $keputusan <br><br><br><br><br><br><br>";
      $this->pangkas($N_parent, $kasus, $keputusan);

      

    }else if($cek == 'heterogen'){
      $jumlah = $this->FungsiController->jumlahData($kondisi);
      if($jumlah < 11 ) {
       
        $NYa = $kondisi." AND tepatwaktu='Ya'";
				$NTidak = $kondisi." AND tepatwaktu='Tidak'";
    
				$jumlahYa = $this->FungsiController->jumlahData("$NYa");
				$jumlahTidak = $this->FungsiController->jumlahData("$NTidak");
        if($jumlahYa <= $jumlahTidak){
					$keputusan = 'Tidak';
				}else{
					$keputusan = 'Ya';
				}	
        //echo"$N_parent<br> $kasus<br> $keputusan <br><br><br><br><br><br><br>";
        $this->pangkas($N_parent, $kasus, $keputusan); 
        
      }
      else{
        $kondisi_tepatwaktu='';
        if($kondisi!=''){
          $kondisi_tepatwaktu = $kondisi." AND ";
        }
     
     
    
        $jml_Ya = $this->FungsiController->jumlahData("$kondisi_tepatwaktu tepatwaktu='Ya'");
        $jml_Tidak = $this->FungsiController->jumlahData("$kondisi_tepatwaktu tepatwaktu='Tidak'");
        $jml_Total = $jml_Ya + $jml_Tidak;
 
        
        $entropy_all = $this->FungsiController->entropy($jml_Ya, $jml_Tidak);
        
        $nilai_asuransi = array();
				$nilai_asuransi = $this->cek_nilaiAtribut('asuransi',$kondisi);								
				$jml_asuransi = count($nilai_asuransi);	

				$nilai_yesstar = array();
				$nilai_yesstar = $this->cek_nilaiAtribut('yesstar',$kondisi);								
				$jml_yesstar = count($nilai_yesstar);

				$nilai_destinasi = array();
				$nilai_destinasi = $this->cek_nilaiAtribut('destinasi',$kondisi);								
				$jml_destinasi = count($nilai_destinasi);

				$nilai_jumlahkiriman = array();
				$nilai_jumlahkiriman = $this->cek_nilaiAtribut('jumlahkiriman',$kondisi);								
				$jml_jumlahkiriman = count($nilai_jumlahkiriman);

				$nilai_jeniskiriman = array();
				$nilai_jeniskiriman = $this->cek_nilaiAtribut('jeniskiriman',$kondisi);								
				$jml_jeniskiriman = count($nilai_jeniskiriman);	

        $nilai_isikiriman = array();
				$nilai_isikiriman = $this->cek_nilaiAtribut('isikiriman',$kondisi);								
				$jml_isikiriman = count($nilai_isikiriman);	
              
        DB::table('gain')->truncate();
        
        if($jml_asuransi!=1){
					$NA1asuransi="asuransi='$nilai_asuransi[0]'";
					$NA2asuransi="asuransi='$nilai_asuransi[1]'";
					$this->FungsiController->hitung_gain($kondisi , "asuransi" , $entropy_all , $NA1asuransi , $NA2asuransi , "" , "" , "");
        
				} 

        if($jml_jumlahkiriman!=1){
					$NA1jumlahkiriman="jumlahkiriman='$nilai_jumlahkiriman[0]'";
					$NA2jumlahkiriman="jumlahkiriman='$nilai_jumlahkiriman[1]'";
					$this->FungsiController->hitung_gain($kondisi , "jumlahkiriman" , $entropy_all , $NA1jumlahkiriman , $NA2jumlahkiriman , "" , "" , "");
        
				} 

        if($jml_yesstar!=1){
					$NA1yesstar="yesstar='$nilai_yesstar[0]'";
					$NA2yesstar="yesstar='$nilai_yesstar[1]'";
					$this->FungsiController->hitung_gain($kondisi , "yesstar" , $entropy_all , $NA1yesstar , $NA2yesstar , "" , "" , "");
				}

        if($jml_destinasi!=1){
					$NA1destinasi="destinasi='$nilai_destinasi[0]'";
					$NA2destinasi="";
					$NA3destinasi="";
					if($jml_destinasi==2){
						$NA2destinasi="destinasi='$nilai_destinasi[1]'";
           
					}else if ($jml_destinasi==3){
						$NA2destinasi="destinasi='$nilai_destinasi[1]'";
						$NA3destinasi="destinasi='$nilai_destinasi[2]'";
					}
					$this->FungsiController->hitung_gain($kondisi , "destinasi" , $entropy_all , $NA1destinasi, $NA2destinasi, $NA3destinasi, "" , "");
				}

        if($jml_isikiriman!=1){
					$NA1isikiriman="isikiriman='$nilai_isikiriman[0]'";
					$NA2isikiriman="isikiriman='$nilai_isikiriman[1]'";
					$this->FungsiController->hitung_gain($kondisi , "isikiriman" , $entropy_all , $NA1isikiriman , $NA2isikiriman , "" , "" , "");
				}

        if($jml_jeniskiriman!=1){
					$NA1jeniskiriman="jeniskiriman='$nilai_jeniskiriman[0]'";
					$NA2jeniskiriman="";
					$NA3jeniskiriman="";
					if($jml_jeniskiriman==2){
						$NA2jeniskiriman="jeniskiriman='$nilai_jeniskiriman[1]'";
					}else if ($jml_jeniskiriman==3){
						$NA2jeniskiriman="jeniskiriman='$nilai_jeniskiriman[1]'";
						$NA3jeniskiriman="jeniskiriman='$nilai_jeniskiriman[2]'";
					}
					$this->FungsiController->hitung_gain($kondisi , "jeniskiriman" , $entropy_all , $NA1jeniskiriman, $NA2jeniskiriman, $NA3jeniskiriman, "" , "");
				}

       
         
        

       

        $max_gain = DB::table('gain')->max('gain');
        $data = DB::table('gain')->where('gain', $max_gain)->first();
        $maxAttribut = $data->attribut ?? '';
        $maxGain = DB::table('gain')->where('gain', $max_gain)->value('gain');

      
    
     if($maxAttribut == 'asuransi'){
          $this->proses_DT($kondisi , "($maxAttribut='Ya')" , "($maxAttribut='Tidak')");

        } else if ($maxAttribut == 'yesstar') {
          $this->proses_DT($kondisi , "($maxAttribut='Ya')" , "($maxAttribut='Tidak')");
      
        }else if($maxAttribut == 'destinasi') {
          if ($jml_destinasi == 3){
              $cabang = array();
              $cabang = $this->FungsiController->hitung_rasio($kondisi, 'destinasi', $maxGain, $nilai_destinasi[0], $nilai_destinasi[1], $nilai_destinasi[2]);
              $exp_cabang = explode(",",$cabang[1]);
              $this->proses_DT($kondisi,"($maxAttribut='$cabang[0]')","($maxAttribut='$exp_cabang[0]' OR $maxAttribut='$exp_cabang[1]')");
          }

          else if($jml_destinasi==2){
						$this->proses_DT($kondisi,"($maxAttribut='$nilai_destinasi[0]')","($maxAttribut='$nilai_destinasi[1]')");
					} 

        }
        
        else if($maxAttribut == 'jeniskiriman'){
          if ($jml_jeniskiriman == 3) {
            $cabang = array();
            $cabang = $this->FungsiController->hitung_rasio($kondisi, 'jeniskiriman', $maxGain, $nilai_jeniskiriman[0], $nilai_jeniskiriman[1], $nilai_jeniskiriman[2]);
            $exp_cabang = explode(",",$cabang[1]);
            $this->proses_DT($kondisi,"($maxAttribut='$cabang[0]')","($maxAttribut='$exp_cabang[0]' OR $maxAttribut='$exp_cabang[1]')");
          }
          else if($jml_jeniskiriman==2){
						$this->proses_DT($kondisi,"($maxAttribut='$nilai_jeniskiriman[0]')" , "($maxAttribut='$nilai_jeniskiriman[1]')");
					} 
        } 
        
        else if($maxAttribut == 'isikiriman'){
          $this->proses_DT($kondisi , "($maxAttribut='Dokumen')" , "($maxAttribut='Paket')");
        
        } else if($maxAttribut == 'jumlahkiriman'){
          $this->proses_DT($kondisi , "($maxAttribut='Satu')" , "($maxAttribut='Lebihdarisatu')");
       
        }
 
        

      
      }

    }

  }


 









  public function bentukTree() 
  {
    
    $query = DB::table('pohonkeputusans')->get();

    $id = DB::table('pohonkeputusans')->pluck('id')->toArray();


    
    
    return view('tree', [
      'query' => $query,
      'id' => $id
    ]);
  }


  public function showDecisionTree()
    {
        $pohon_keputusan = DB::table('pohonkeputusans')->orderBy('id')->get();
        $temp_rule = [''];

        return view('tree', compact('pohon_keputusan', 'temp_rule'));
    }





    public function hitungAkurasi()
    {
         // error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
          $query = DB::table('data_ujis')->get();
          $id_rule = array();
          $it = 0;
  
          foreach ($query as $bar) {
            $n_resi = $bar->resi;
            $n_asuransi = $bar->asuransi;
            $n_yesstar = $bar->yesstar;
            $n_destinasi = $bar->destinasi;
            $n_jumlahkiriman = $bar->jumlahkiriman;
            $n_jeniskiriman = $bar->jeniskiriman;
            $n_isikiriman = $bar->isikiriman;
            $n_tepatwaktuasli = $bar->tepatwaktu_asli;
           
            $sql = DB::table('pohonkeputusans')->get();
            $keputusan = "";
            $id_rule = [];
  
            foreach ($sql as $row) {
              if ($row->parent != '') {
                $rule = $row->akar . " AND " . $row->parent;
            } else {
                $rule = $row->parent;
               
            }
          
                  $rule = str_replace("<=", " k ", $rule);
                  $rule = str_replace("=", " s ", $rule);
                  $rule = str_replace(">", " l ", $rule);
                
            
                  $rule = str_replace("asuransi", "'$n_asuransi'", $rule);
                  $rule = str_replace("yesstar", "'$n_yesstar'", $rule);
                  $rule = str_replace("destinasi", "'$n_destinasi'", $rule);
                  $rule = str_replace("jumlahkiriman", "$n_jumlahkiriman", $rule);
                  $rule = str_replace("jeniskiriman", "'$n_jeniskiriman'", $rule);
                  $rule = str_replace("isikiriman", "'$n_isikiriman'", $rule);
                  
                  $rule = str_replace("'", "", $rule);
                  
                  
                  $rule=str_replace("Dalam Pulau","DalamPulau",$rule);
		              $rule=str_replace("Luar Pulau","LuarPulau",$rule);
                  $rule=str_replace("High Value","HighValue",$rule);
                  $rule=str_replace("Dangerous Goods","DangerousGoods",$rule);
                  
                  $explodeAND = explode(" AND ", $rule);
                  $jmlAND = count($explodeAND);
                  
                  
                  $explodeAND = str_replace("(", "", $explodeAND);
                  $explodeAND = str_replace(")", "", $explodeAND);
                 
               
                  $bolAND = array();
                  $n = 0;
                  
                  while ($n < $jmlAND) {
                    //explode or
                    $explodeOR = explode(" OR ", $explodeAND[$n]);
                
                    $jmlOR = count($explodeOR);
                    $bol = array();
                    $a = 0;
                    
                    while($a < $jmlOR) {
                      $exrule2 = explode(" ", $explodeOR[$a]);
                      $parameter = $exrule2[1];
                    
                      if ($parameter == 's') {
                        //pecah  dengan s
                        $explodeRule = explode(" s ", $explodeOR[$a]);

                        //nilai true false    	
                        if ($explodeRule[0] == $explodeRule[1]) {
                         
                            $bol[$a] = "Benar";
                        } else if ($explodeRule[0] != $explodeRule[1]) {
                            $bol[$a] = "Salah";
                        }
                    } else if ($parameter == 'k') {
                        //pecah  dengan k
                        $explodeRule = explode(" k ", $explodeOR[$a]);
                        //nilai true false
                        if ($explodeRule[0] <= $explodeRule[1]) {
                            $bol[$a] = "Benar";
                        } else {
                            $bol[$a] = "Salah";
                        }
                    } else if ($parameter == 'l') {
                        //pecah dengan s
                        $explodeRule = explode(" l ", $explodeOR[$a]);
                        //nilai true false
                        if ($explodeRule[0] > $explodeRule[1]) {
                            $bol[$a] = "Benar";
                        } else {
                            $bol[$a] = "Salah";
                        }
                    }
  
                    $a++;
                    }
                   
                    //isi false
                    $bolAND[$n] = "Salah";
                    $b = 0;
      
                    while($b < $jmlOR){
                      
                      if($bol[$b] == "Benar") {
                        $bolAND[$n] = "Benar";
                      }
                      $b++;
                     
                    }
                    $n++;
                  }
              
                  
  
                 //isi boolrule 
                 $boolRule = "Benar";
                 $a = 0;
                 while ($a < $jmlAND) {
                  //jika ada yang salah boolrule diganti salah
                  if ($bolAND[$a] == "Salah") {
                      $boolRule = "Salah";
                  }
  
                  $a++;
              }
             
              
              if ($boolRule == "Benar") {
                $keputusan = $row->keputusan;
                $id_rule[$it] = $row->id;
            }
              
            if ($keputusan == '') {
              $que = DB::table('pohonkeputusans')->select('parent')->get();
              $jml = array();
              $exParent = array();
              $i = 0;
             
              foreach ($que as $row_baris) {
                $exParent = explode(" AND ", $row_baris->parent);
                $jml[$i] = count($exParent);
                $i++;
                $maxParent = max($jml);
             

                $sql_query = DB::table('pohonkeputusans')->get();
                foreach ($sql_query as $row_bar) {
                  $explP = explode(" AND ", $row_bar->parent);
                  $jmlT = count($explP);
                  if ($jmlT == $maxParent) {
                    $keputusan = $row_bar->keputusan;
                    $id_rule[$it] = $row_bar->id;  
                  }
                }
              }
            }
         
      }
  
          $it++;
         
          DB::table('data_ujis')->where('id', $bar->id)->update(['tepatwaktu_prediksi' => $keputusan]);
      }
   
      $dataUji = DB::table('data_ujis')->get();
      $dataLatih = DB::table('data_trainings')->get();

    foreach ($dataUji as $row) {
      $tepatwaktu_asli = $row->tepatwaktu_asli;
      $tepatwaktu_prediksi = $row->tepatwaktu_prediksi;  
      if ($tepatwaktu_asli == $tepatwaktu_prediksi) {
        $ketepatan = 'Benar';
    } else {
        $ketepatan = 'Salah';
    }
          }
      $jumlah = $dataUji->count();
      $TP = 0;
      $FN = 0;
      $TN = 0;
      $FP = 0;
      $kosong = 0;
  
      foreach ($dataUji as $row) {
        $asli = $row->tepatwaktu_asli;
        $prediksi = $row->tepatwaktu_prediksi;
        if ($asli == 'Ya' && $prediksi == 'Ya') {
            $TP++;
        } else if ($asli == 'Ya' && $prediksi == 'Tidak') {
            $FN++;
        } else if ($asli == 'Tidak' && $prediksi == 'Tidak') {
            $TN++;
        } else if ($asli == 'Tidak' && $prediksi == 'Ya') {
            $FP++;
        } else if ($prediksi == '') {
            $kosong++;
        }
        }

          $jumlahDataUji = count($dataUji);
          $jumlahDataLatih = count($dataLatih);

       
          $tepat = ($TP + $TN);
          $tidak_tepat = ($FP + $FN + $kosong);
          $akurasi = ($tepat / $jumlahDataUji) * 100; // accuracy
          $laju_error = ($tidak_tepat / $jumlahDataUji) * 100; //error rate
          $sensitivitas = ($TP / ($TP + $FN)) * 100;//recall
          $spesifisitas = ($TP / ($TP + $FP)) * 100;//precision
       //   echo "TP = $TP <br>
         //       TN = $TN <br>
           //     FN = $FN <br>
            //    FP = $FP <br>
             //   Akurasi = $akurasi <br>
              //  recall = $sensitivitas <br>
               // precision = $spesifisitas";
          //dd($TP, $TN, $FN, $FP, $akurasi, $sensitivitas, $jumlahDataUji);
         
          $akurasi = round($akurasi, 2);
          $laju_error = round($laju_error, 2);
          $sensitivitas = round($sensitivitas, 2);
          $spesifisitas = round($spesifisitas, 2);
         
          $no = 1;
         
  
          return view('akurasi', [
            'datauji' => $dataUji,
            'akurasi' => $akurasi,
            'laju_error' => $laju_error,
            'sensitivitas' => $sensitivitas,
            'no' => $no,
            'ketepatan' =>$ketepatan,
            'spesifisitas' =>$spesifisitas, 
            'jumlahDataUji' => $jumlahDataUji,
            'jumlahDataLatih' => $jumlahDataLatih
           
          ]);
  
    }  

  public function ujiRule()
  {

    $dataUji = DB::table('data_ujis')->get();

    return view('ujirule', [
      'datauji' => $dataUji
    ]);
  }

  public function prosesPrediksi(Request $request)
  { 
    $resi = $request->input('resi');
    $asuransi = $request->input('asuransi');
    $yesstar = $request->input('yesstar');
    $destinasi = $request->input('destinasi');
    $jeniskiriman = $request->input('jeniskiriman');
    $jumlahkiriman = $request->input('jumlahkiriman');
    $isikiriman = $request->input('isikiriman');

   

    $results = DB::table('pohonkeputusans')->get();
    $id_rule = "";
    $keputusan = "";  
    foreach ($results as $row) {
      if ($row->parent != '') {
          $rule = $row->parent." AND ".$row->akar;
         
      } else {
          $rule = $row->akar;
      }


    
  
      $rule = str_replace("<=", " k ", $rule);
      $rule = str_replace("=", " s ", $rule);
      $rule = str_replace(">", " l ", $rule);
  
      $rule = str_replace("asuransi", "'$asuransi'", $rule);
      $rule = str_replace("yesstar", "'$yesstar'", $rule);
      $rule = str_replace("destinasi", "'$destinasi'", $rule);
      $rule = str_replace("jeniskiriman", "$jeniskiriman", $rule);
      $rule = str_replace("jumlahkiriman", "'$jumlahkiriman'", $rule);
      $rule = str_replace("isikiriman", "'$isikiriman'", $rule);
  
      $rule = str_replace("'", "", $rule);
      $rule=str_replace("Dalam Pulau","DalamPulau",$rule);
		  $rule=str_replace("Luar Pulau","LuarPulau",$rule);
      $rule=str_replace("High Value","HighValue",$rule);
      $rule=str_replace("Dangerous Goods","DangerousGoods",$rule);
  
      $explodeAND = explode(" AND ", $rule);
      $jmlAND = count($explodeAND);
  
      $explodeAND = str_replace("(", "", $explodeAND);
      $explodeAND = str_replace(")", "", $explodeAND);
  
      $bolAND = [];
      $n = 0;
  
      while ($n < $jmlAND) {
          $explodeOR = explode(" OR ", $explodeAND[$n]);
          $jmlOR = count($explodeOR);
          $bol = [];
          $a = 0;
  
          while ($a < $jmlOR) {
              $exrule2 = explode(" ", $explodeOR[$a]);
              $parameter = $exrule2[1];
  
              if ($parameter == 's') {
                  $explodeRule = explode(" s ", $explodeOR[$a]);
  
                  if ($explodeRule[0] == $explodeRule[1]) {
                      $bol[$a] = "Benar";
                  } else {
                      $bol[$a] = "Salah";
                  }
              } else if ($parameter == 'k') {
                  $explodeRule = explode(" k ", $explodeOR[$a]);
  
                  if ($explodeRule[0] <= $explodeRule[1]) {
                      $bol[$a] = "Benar";
                  } else {
                      $bol[$a] = "Salah";
                  }
              } else if ($parameter == 'l') {
                  $explodeRule = explode(" l ", $explodeOR[$a]);
  
                  if ($explodeRule[0] > $explodeRule[1]) {
                      $bol[$a] = "Benar";
                  } else {
                      $bol[$a] = "Salah";
                  }
              }
  
              $a++;
          }
  
          $bolAND[$n] = "Salah";
          $b = 0;
  
          while ($b < $jmlOR) {
              if ($bol[$b] == "Benar") {
                  $bolAND[$n] = "Benar";
              }
  
              $b++;
          }
  
          $n++;
      }
  
      $boolRule = "Benar";
      $a = 0;
  
      while ($a < $jmlAND) {
          if ($bolAND[$a] == "Salah") {
            $boolRule = "Salah";
          }
  
          $a++;
      }
  
      if ($boolRule == "Benar") {
          $keputusan = $row->keputusan;
          $id_rule = $row->id;
      }
  }
  
  if ($keputusan == '') {
      $query = DB::table('pohonkeputusans')->select('parent')->get();
      $jml = [];
      $exParent = [];
      $i = 0;
      foreach ($query as $bar) {
          $exParent = explode(" AND ", $bar->parent);
          $jml[$i] = count($exParent);
          $i++;
      }
      if ($keputusan == '') {
        $que = DB::table('pohonkeputusans')->select('parent')->get();
        $jml = [];
        $exParent = [];
        $i = 0;
        foreach ($que as $bar) {
            $exParent = explode(" AND ", $bar->parent);
            $jml[$i] = count($exParent);
            $i++;
        }
        $maxParent = max($jml);
        $sql_query = DB::table('pohonkeputusans')->get();
        foreach ($sql_query as $bar_row) {
            $explP = explode(" AND ", $bar_row->parent);
            $jmlT = count($explP);
            if ($jmlT == $maxParent) {
                $keputusan = $bar_row->keputusan;
                $id_rule = $bar_row->id;
            }
        }
    }
    

      
      
  
      $maxParent = max($jml);
      $sql_query = DB::table('pohonkeputusans')->get();
  
      foreach ($sql_query as $bar_row) {
          $explP = explode(" AND ", $bar_row->parent);
          $jmlT = count($explP);
  
          if ($jmlT == $maxParent) {
              $keputusan = $bar_row->keputusan;
              $id_rule = $bar_row->id;
            }
              
        }
        DB::table('hasil_prediksi')->insert([
          'resi' => $resi,
          'asuransi' => $asuransi,
          'yesstar' => $yesstar,
          'destinasi' => $destinasi,
          'jeniskiriman' => $jeniskiriman,
          'jumlahkiriman' => $jumlahkiriman,
          'isikiriman' => $isikiriman,
          'hasil' => $keputusan
      ]);

      } else {
        
       

        DB::table('hasil_prediksi')->insert([
          'resi' => $resi,
          'asuransi' => $asuransi,
          'yesstar' => $yesstar,
          'destinasi' => $destinasi,
          'jeniskiriman' => $jeniskiriman,
          'jumlahkiriman' => $jumlahkiriman,
          'isikiriman' => $isikiriman,
          'hasil' => $keputusan
            ]);
      }
  
    $row_bar = DB::table('pohonkeputusans')->where('id', $id_rule)->first();
     $rule_terpilih = "IF " . $row_bar->parent . " AND " . $row_bar->akar . " THEN Tepatwaktu = " . $row_bar->keputusan;


     return view('hasilprediksi', [
        'resi' => $resi,
        'asuransi' => $asuransi,
        'yesstar' => $yesstar,
        'destinasi' => $destinasi,
        'jeniskiriman'=> $jeniskiriman,
        'jumlahkiriman' => $jumlahkiriman,
        'isikiriman' => $isikiriman,
        'hasil' => $keputusan,
        'rule' => $rule_terpilih
     ]);
  
    }


    public function prediksi()
    {
      return view('prediksi');
    }

    public function hapusDatauji()
    {
      DB::table('data_ujis')->truncate();

      return redirect()->back()->with('status','Data uji berhasil di hapus');
    }

}