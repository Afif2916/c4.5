<?php

namespace App\Http\Controllers;

use App\Models\DataTraining;
use Illuminate\Http\Request;
use PHPUnit\Framework\Error;
use Illuminate\Support\Facades\DB;
use App\Imports\DataTrainingImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\LoginController;
use Maatwebsite\Excel\Concerns\ToArray;
use PhpOffice\PhpSpreadsheet\Calculation\Information\ErrorValue;

use function PHPUnit\Framework\isEmpty;

class FungsiController extends Controller
{
    public function AllAttr()
    {
        $attr = DB::table('data_trainings')->count();
      return $attr;
    }

    public function jumlahData($fields)
    {
       if($fields == ''){
        $attr = DB::table('data_trainings')->count();
       } else {
        $attr = DB::table('data_trainings')->whereRaw($fields)->count();
       }
       //dd($fields);
       return $attr;
    }

    public function AllAttrYa()
    {
        $attr = DB::table('data_trainings')
        ->where('tepatwaktu', 'Ya')
        ->selectRaw('count(id) as cnt')
        ->pluck('cnt');
      return $attr[0];
    }

    public function AllAttrTidak()
    {
        $attr = DB::table('data_trainings')
        ->where('tepatwaktu', 'Tidak')
        ->selectRaw('count(id) as cnt')
        ->pluck('cnt');
      return $attr[0];
    }

    public function AttrbAsuransiYa()
    {
        $attr = DB::table('data_trainings')
        ->where('asuransi', 'Ya')
        ->selectRaw('count(id) as cnt')
        ->pluck('cnt');
      return $attr[0];
    }

    public function AttrbAsuransiTidak()
    {
        $attr = DB::table('data_trainings')
        ->where('asuransi', 'Tidak')
        ->selectRaw('count(id) as cnt')
        ->pluck('cnt');
      return $attr[0];
    }

    public function countingAsuransi($asuransiCondition, $tepatWaktuCondition)
    {
        $attr = DB::table('data_trainings')
        ->where('asuransi', $asuransiCondition)
        ->where('tepatwaktu',$tepatWaktuCondition)
        ->selectRaw('count(id) as cnt')
        ->pluck('cnt');
      return $attr[0];
    }

    
    public function AttrbyesstarYa()
    {
        $attr = DB::table('data_trainings')
        ->where('yesstar', 'Ya')
        ->selectRaw('count(id) as cnt')
        ->pluck('cnt');
      return $attr[0];
    }


    public function AttrbyesstarTidak()
    {
        $attr = DB::table('data_trainings')
        ->where('yesstar', 'Tidak')
        ->selectRaw('count(yesstar) as cnt')
        ->pluck('cnt');
      return $attr[0];
    }

    

    public function countingYesStar($yesStarCondition, $tepatWaktuCondition)
    {
        $attr = DB::table('data_trainings')
        ->where('yesstar', $yesStarCondition)
        ->where('tepatwaktu',$tepatWaktuCondition)
        ->selectRaw('count(id) as cnt')
        ->pluck('cnt');
      return $attr[0];  
    }  


    public function AttrbDestinasi($destinasi)
    {
        $attr = DB::table('data_trainings')
        ->where('destinasi', $destinasi)
        ->selectRaw('count(id) as cnt')
        ->pluck('cnt');
      return $attr[0];
    }

    public function countingDestinasi($destinasiCondition, $tepatWaktuCondition)
    {
        $attr = DB::table('data_trainings')
        ->where('destinasi', $destinasiCondition)
        ->where('tepatwaktu',$tepatWaktuCondition)
        ->selectRaw('count(id) as cnt')
        ->pluck('cnt');
      return $attr[0];  
    }  

    public function AttrbJumlahKiriman($jumlahKiriman)
    {
      $attr = DB::table('data_trainings')
      ->where('jumlahkiriman', $jumlahKiriman)
      ->selectRaw('count(id) as cnt')
      ->pluck('cnt');
    return $attr[0];
    }

    public function CountingJumlahKiriman($jumlahKirimanCondition , $tepatWaktuCondition)
    {
      $attr = DB::table('data_trainings')
      ->where('jumlahkiriman', $jumlahKirimanCondition)
      ->where('tepatwaktu',$tepatWaktuCondition)
      ->selectRaw('count(id) as cnt')
      ->pluck('cnt');
    return $attr[0];  
    }
    
    public function AttrbJenisKiriman($jenisKiriman)
    {
        $attr = DB::table('data_trainings')
        ->where('jeniskiriman', $jenisKiriman)
        ->selectRaw('count(id) as cnt')
        ->pluck('cnt');
      return $attr[0];
    }

    public function countingJenisKiriman($JenisKirimanCondition, $tepatWaktuCondition)
    {
        $attr = DB::table('data_trainings')
        ->where('jeniskiriman', $JenisKirimanCondition)
        ->where('tepatwaktu',$tepatWaktuCondition)
        ->selectRaw('count(id) as cnt')
        ->pluck('cnt');
      return $attr[0];  
    }  



    public function AttrbIsiKiriman($isiKiriman)
    {
        $attr = DB::table('data_trainings')
        ->where('isikiriman' ,$isiKiriman)
        ->selectRaw('count(id) as cnt')
        ->pluck('cnt');
      return $attr[0];
    }


    public function countingisiKiriman($isiKirimanCondition , $tepatWaktuCondition)
    {
        $attr = DB::table('data_trainings')
        ->where('isikiriman', $isiKirimanCondition)
        ->where('tepatwaktu',$tepatWaktuCondition)
        ->selectRaw('count(id) as cnt')
        ->pluck('cnt');
      return $attr[0];  
    }  
   

    

    function entropy($nilai1, $nilai2)
    {
        $total = $nilai1 + $nilai2;

        if($nilai1==0 or $nilai2==0){
			$entropy = 0;
		}else{
			$entropy = (-($nilai1/$total)*(log(($nilai1/$total),2))) + (-($nilai2/$total)*(log(($nilai2/$total),2)));
		}		
		//desimal 3 angka dibelakang koma
		$entropy = round($entropy, 3);	
   // echo " $nilai1 / $total + $nilai2 / $total $entropy <br>";
		return $entropy;
    }

     function Gain($attr1, $attr2 , $entropy1, $entropy2, $jumlahData, $entropy, $namaAtribut)
    {
        $gain = $entropy - ((($attr1/$jumlahData)*$entropy1) + (($attr2/$jumlahData)*$entropy2));
        $gain = round($gain, 3);

        $recordSama = DB::table('gain')
        ->where('attribut', $namaAtribut)
        ->get();
        
       
       
        DB::table('gain')->insert([
          'attribut' => $namaAtribut,
          'gain' => $gain
      ]);
    //    echo "$namaAtribut = $gain <br>";
        return $gain;
        
    }

     function Gain3($attr1, $attr2 , $attr3, $entropy1, $entropy2, $entropy3, $jumlahData, $entropy, $namaAtribut)
    {
        $gain = $entropy - ((($attr1/$jumlahData)*$entropy1) + (($attr2/$jumlahData)*$entropy2) + (($attr3/$jumlahData)*$entropy3));
       
        $gain = round($gain, 3);

        $recordSama = DB::table('gain')
        ->where('attribut', $namaAtribut)
        ->get();
        
       
         
          DB::table('gain')->insert([
            'attribut' => $namaAtribut,
            'gain' => $gain
          ]);

       
        return $gain;
    }

    public function cek_HeteroHomogen($field, $kondisi) {
        if($kondisi == ''){
            $sql = DB::table('data_trainings')->distinct()->select($field)->get();
        } else {
            $sql = DB::table('data_trainings')->whereRaw($kondisi)->distinct($field)->get();
        }
        if ($sql->count() == 1) {
            $nilai = "homogen";
        } else {
            $nilai = "heterogen";
        }

        return $nilai;
    }

    function hitung_gain($kasus , $atribut , $ent_all , $kondisi1 , $kondisi2 , $kondisi3 , $kondisi4){
		$data_kasus = '';
		if($kasus!=''){
			$data_kasus = $kasus." AND ";
		}
		//untuk atribut 2 nilai atribut	
		if($kondisi3==''){
			$j_tinggi1 = $this->jumlahData("$data_kasus tepatwaktu='Ya' AND $kondisi1");
			$j_rendah1 = $this->jumlahData("$data_kasus tepatwaktu='Tidak' AND $kondisi1");
			$jml1 = $j_tinggi1 + $j_rendah1;
			$j_tinggi2 = $this->jumlahData("$data_kasus tepatwaktu='Ya' AND $kondisi2");
			$j_rendah2 = $this->jumlahData("$data_kasus tepatwaktu='Tidak' AND $kondisi2");
			$jml2 = $j_tinggi2 + $j_rendah2;
    
			//hitung entropy masing-masing kondisi
			$jml_total = $jml1 + $jml2;
			$ent1 = $this->entropy($j_tinggi1 , $j_rendah1);
			$ent2 = $this->entropy($j_tinggi2 , $j_rendah2);
			$gain = $ent_all - ((($jml1/$jml_total)*$ent1) + (($jml2/$jml_total)*$ent2));
      $gain = round($gain, 3);
      //echo "$atribut $kasus ($ent_all- $jml1/$jml_total*$ent1 + $jml2/$jml_total*$ent2) = ($kondisi1 = Ya = $j_tinggi1 + Tidak = $j_rendah1) ($kondisi2 = Ya = $j_tinggi2 + Tidak = $j_rendah2) =  $gain <br>";
    //  echo "------------------------<br>";
   
		}
		//untuk atribut 3 nilai atribut
		else if($kondisi4==''){
			$j_tinggi1 = $this->jumlahData("$data_kasus tepatwaktu='Ya' AND $kondisi1");
			$j_rendah1 = $this->jumlahData("$data_kasus tepatwaktu='Tidak' AND $kondisi1");
			$jml1 = $j_tinggi1 + $j_rendah1;
			$j_tinggi2 = $this->jumlahData("$data_kasus tepatwaktu='Ya' AND $kondisi2");
			$j_rendah2 = $this->jumlahData("$data_kasus tepatwaktu='Tidak' AND $kondisi2");
			$jml2 = $j_tinggi2 + $j_rendah2;
			$j_tinggi3 = $this->jumlahData("$data_kasus tepatwaktu='Ya' AND $kondisi3");
			$j_rendah3 = $this->jumlahData("$data_kasus tepatwaktu='Tidak' AND $kondisi3");
			$jml3 = $j_tinggi3 + $j_rendah3;

     
			//hitung entropy masing-masing kondisi
			$jml_total = $jml1 + $jml2 + $jml3;
			$ent1 = $this->entropy($j_tinggi1 , $j_rendah1);
			$ent2 = $this->entropy($j_tinggi2 , $j_rendah2);
			$ent3 = $this->entropy($j_tinggi3 , $j_rendah3);			
			$gain = $ent_all - ((($jml1/$jml_total)*$ent1) + (($jml2/$jml_total)*$ent2) + (($jml3/$jml_total)*$ent3));	
            $gain = round($gain, 3);
         //   echo "$atribut $kasus   =  $gain <br>";
           // echo "($data_kasus $kondisi1(Ya=$j_tinggi1, Tidak=$j_rendah1) $kondisi2(Ya=$j_tinggi2, Tidak=$j_rendah2), $kondisi3(Ya=$j_tinggi3, Tidak=$j_rendah3))<br>";
            
          
		}
   
        $gain = round($gain, 3);
        DB::table('gain')->insert([
            'attribut' => $atribut,
            'gain' => $gain
        ]);
        

       
    }

    public function hitung_rasio($kasus , $atribut , $gain , $nilai1 , $nilai2 , $nilai3)
    {

        
        $data_kasus = '';
        if($kasus!=''){
            $data_kasus = $kasus. " AND ";
        }
            DB::table('rasio_gain')->truncate();
      $opsi11 = $this->jumlahData("$data_kasus ($atribut='$nilai2' OR $atribut='$nilai3')");
			$opsi12 = $this->jumlahData("$data_kasus $atribut='$nilai1'");
			$tot_opsi1=$opsi11+$opsi12;
			$opsi21 = $this->jumlahData("$data_kasus ($atribut='$nilai3' OR $atribut='$nilai1')");
			$opsi22 = $this->jumlahData("$data_kasus $atribut='$nilai2'");
			$tot_opsi2=$opsi21+$opsi22;
			$opsi31 = $this->jumlahData("$data_kasus ($atribut='$nilai1' OR $atribut='$nilai2')");
			$opsi32 = $this->jumlahData("$data_kasus $atribut='$nilai3'");
			$tot_opsi3=$opsi31+$opsi32;	
            
      //hitungsplit
      $opsi1 = (-($opsi11/$tot_opsi1)*(log(($opsi11/$tot_opsi1),2))) + (-($opsi12/$tot_opsi1)*(log(($opsi12/$tot_opsi1),2)));
      $opsi2 = (-($opsi21/$tot_opsi2)*(log(($opsi21/$tot_opsi2),2))) + (-($opsi22/$tot_opsi2)*(log(($opsi22/$tot_opsi2),2)));
      $opsi3 = (-($opsi31/$tot_opsi3)*(log(($opsi31/$tot_opsi3),2))) + (-($opsi32/$tot_opsi3)*(log(($opsi32/$tot_opsi3),2)));
      
      
      $opsi1 = round($opsi1,3);
			$opsi2 = round($opsi2,3);
			$opsi3 = round($opsi3,3);	
         
      $rasio1 = $gain/$opsi1;
			$rasio2 = $gain/$opsi2;
			$rasio3 = $gain/$opsi3;

      $rasio1 = round($rasio1,3);
			$rasio2 = round($rasio2,3);
			$rasio3 = round($rasio3,3);

 //       echo "(-($opsi11/$tot_opsi1)*(log(($opsi11/$tot_opsi1),2))) + (-($opsi12/$tot_opsi1)*(log(($opsi12/$tot_opsi1),2))) = $opsi1 <br>";
 //       echo "$gain/$opsi1 = $rasio1";
  //    echo "Opsi 1 : <br>jumlah ".$nilai2."/".$nilai3." = ".$opsi11.
  //    "<br>jumlah ".$nilai1." = ".$opsi12.
 //     "<br>Split = ".$opsi1.
 //     "<br>Rasio = ".$rasio1."<br>";
 //   echo "Opsi 2 : <br>jumlah ".$nilai3."/".$nilai1." = ".$opsi21.
 //     "<br>jumlah ".$nilai2." = ".$opsi22.
 //     "<br>Split = ".$opsi2.
 //     "<br>Rasio = ".$rasio2."<br>";
 //   echo "Opsi 3 : <br>jumlah ".$nilai1."/".$nilai2." = ".$opsi31.
  //    "<br>jumlah ".$nilai3." = ".$opsi32.
  //    "<br>Split = ".$opsi3.
    //  "<br>Rasio = ".$rasio3."<br>";

            DB::table('rasio_gain')->insert([
                'opsi' => 'opsi1',
                'cabang1' => $nilai2,
                'cabang2' => $nilai2.",".$nilai3,
                'rasio_gain' => $rasio1
            ]);
            DB::table('rasio_gain')->insert([
                'opsi' => 'opsi2',
                'cabang1' => $nilai2,
                'cabang2' => $nilai3.",".$nilai1,
                'rasio_gain' => $rasio2
            ]);
            DB::table('rasio_gain')->insert([
                'opsi' => 'opsi3',
                'cabang1' => $nilai3,
                'cabang2' => $nilai1.",".$nilai2,
                'rasio_gain' => $rasio3
            ]);

            $row_max = DB::table('rasio_gain')
                        ->select(DB::raw('MAX(rasio_gain) as max_rasio'))
                        ->first();
    
            $max_rasio = $row_max->max_rasio;
    
            $row = DB::table('rasio_gain')
                        ->where('rasio_gain', $max_rasio)
                        ->first();
            
            $opsiMax = [
                        $row->cabang1,
                        $row->cabang2,
                       ];

     
    return $opsiMax;
    }


    public function maxRasio()
    {
        $row_max = DB::table('rasio_gain')
        ->select(DB::raw('MAX(rasio_gain) as max_rasio'))
        ->first();
    
    $max_rasio = $row_max->max_rasio;
    
    $row = DB::table('rasio_gain')
        ->where('rasio_gain', $max_rasio)
        ->first();
    
    $opsiMax = [
        $row->column2,
        $row->column3
    ];
    
    return $opsiMax;


    }
    


    
}
