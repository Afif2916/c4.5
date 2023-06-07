@extends('layout/main')




@section('content')


<div class="card shadow mb-4">
    <div class="card-body text-center">
    <div class="table-responsive">
        <hr>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <h4>Pohon Keputusan</h4>
            <hr>
       
            @foreach ($pohon_keputusan as $pohon)
    @php
        $rule = $pohon->parent !== '' ? $pohon->parent . " AND " . $pohon->akar : $pohon->akar;
        $rule = str_replace("OR", "/", $rule);
        $exRule = explode(" AND ", $rule);
        $jml_ExRule = count($exRule);
        $jml_temp = count($temp_rule);
        $ll= 0

        for ($i = 0; $i < $jml_ExRule; $i++) {
            if ($temp_rule[$i] == $exRule[$i]) {
                $temp_rule[$i] = $exRule[$i];
                $exRule[$i] = "---- ";
            } else {
                $temp_rule[$i] = $exRule[$i];
            }

            if ($i == ($jml_ExRule - 1)) {
                $t = $i;
                while ($t < $jml_temp) {
                    $temp_rule[$t] = "";
                    $t++;
                }
            }

            if ($i == ($jml_ExRule - 1)) {
                $strip = '';
                for ($x = 1; $x <= $i; $x++) {
                    $strip .= "---- ";
                }
                $keputusan = DB::table('pohon_keputusan')->where('id', $pohon->id)->value('keputusan');

                if ($exRule[$i - 1] == "---- ") {
                    echo "<font color='#336699'><b>" . $exRule[$i] . "</b></font> <i>Maka prestasi = </i><strong>" . $keputusan . " (" . $pohon->id . ")</strong>";
                } elseif ($exRule[$i - 1] != "---- ") {
                    echo "<br>" . $strip . "<font color='#336699'><b>" . $exRule[$i] . "</b></font> <i>Maka prestasi = </i><strong>" . $keputusan . "  (" . $pohon->id . ")</strong>";
                }
            } elseif ($i == 0) {
                if ($ll == 1) {
                    echo "<font color='#336699'><b>" . $exRule[$i] . "</b></font> <b>: ?</b>";
                } else {
                    echo $exRule[$i] . " ";
                }
            } else {
                if ($exRule[$i] == "---- ") {
                    echo $exRule[$i] . " ";
                } else {
                    if ($exRule[$i - 1] == "---- ") {
                        echo "<font color='#336699'><b>" . $exRule[$i] . "</b></font> <b>: ?</b>";
                    } else {
                        $strip = '';
                        for ($x = 1; $x <= $i; $x++) {
                            $strip .= "---- ";
                        }
                        echo "<br>" . $strip . "<font color='#336699'><b>" . $exRule[$i] . "</b></font> <b>: ?</b>";
                    }
                }
            }
        }
        echo "<br>";
        $ll++;
    @endphp
@endforeach

               
            </table>
        </div>
    </div>
</div>























<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Afif Bangkit Nur Rahmaan</span>
        </div>
    </div>
    </footer>
    @endsection