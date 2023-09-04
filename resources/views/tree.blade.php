@extends('layout/main')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    .decision-tree {
        margin-left: 20px;
    }
    
    .decision-tree ul {
        list-style-type: none;
        padding-left: 20px;
    }
    
    .decision-tree ul li {
        position: relative;
    }
    
    .decision-tree ul li::before {
        content: '';
        position: absolute;
        top: 0;
        left: -10px;
        border-left: 1px solid #ccc;
        height: 100%;
    }
    
    .decision-tree ul li::after {
        content: '';
        position: absolute;
        top: 10px;
        left: -6px;
        border-top: 1px solid #ccc;
        width: 10px;
    }
    
    .decision-tree ul li:last-child::before {
        height: 50px;
    }
    
    .chart-container {
        width: 100%;
        max-width: 600px;
        margin: 20px auto;
    }
</style>

<div class="card shadow mb-4">
    <div class="card-body">
        <hr>
        <h4 class="text-center">Pohon Keputusan</h4>
        <hr>
        
        <div class="decision-tree">
            <ul>
                @php
                $ll = 0;
                use Illuminate\Support\Facades\DB;
                @endphp
                
                @foreach ($query as $bar)
                    @php
                    // Menampung rule
                    if ($bar->parent != '') {
                        $rule = $bar->parent . " AND " . $bar->akar;
                    } else {
                        $rule = $bar->akar;
                    }
            
                    $rule = str_replace("OR", "/", $rule);
                    // Explode rule
                    $exRule = explode(" AND ", $rule);
                    $jml_ExRule = count($exRule);
                    $jml_temp = isset($temp_rule) ? count($temp_rule) : 0;
                    @endphp
            
                    @php
                    $i = 0;
                    @endphp
                    
                    
                        
                            @php
                            $i = 0;
                            @endphp
                            @while ($i < $jml_ExRule)
                                @php
                                if (!isset($temp_rule[$i])) {
                                    $temp_rule[$i] = "";
                                }
            
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
                                @endphp
            
                                @php
                                if ($i == ($jml_ExRule - 1))
                                {
                                    $strip = '';
                                    for ($x = 1; $x <= $i; $x++) {
                                        $strip = $strip . "---- ";
                                    }
            
                                    $row_bar = DB::table('pohonkeputusans')->where('id', $id[$ll])->first();
                                    if ($exRule[$i - 1] == "---- ") {
                                        echo "<font color='#336699'><b>".$exRule[$i]."</b></font> <i>Maka Tepatwaktu = </i><strong><div>".$row_bar->keputusan."(".$row_bar->id.")</strong>";
                                    } else if ($exRule[$i - 1] != "---- ") {
                                        echo "<br>".$strip."<font color='#336699'><b>".$exRule[$i]."</b></font> <i>Maka Tepatwaktu = </i><strong>".$row_bar->keputusan."  (".$row_bar->id.")</strong>";
                                    }
                                }
                                else if ($i == 0)
                                {
                                    if ($ll == 1) {
                                        echo "<font color='#336699'><b>".$exRule[$i]."</b></font> <b>: ?</b>";
                                    } else {
                                        echo $exRule[$i]." ";
                                    }
                                }
                                else
                                {
                                    if ($exRule[$i] == "---- ") {
                                        echo $exRule[$i]." ";
                                    } else {
                                        if ($exRule[$i - 1] == "---- ") {
                                            echo "$exRule[$i]";
                                        } else {
                                            $strip = '';
                                            for ($x = 1; $x <= $i; $x++) {
                                                $strip = $strip . "---- ";
                                            }
                                            echo "<font color='#336699'><b>".$exRule[$i]."</b></font> <b>: ?</b>";

                                        }
                                    }
                                }
                                @endphp
            
                                @php
                                	
                                $i++;
                                @endphp
                            @endwhile
                     
            
                    @php
                    echo "<br>";
                    $ll++;
                    @endphp
                @endforeach
            </ul>
        </div>
        
        <canvas id="decisionTreeData"></canvas>
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

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const decisionTreeData = Array.from(document.querySelectorAll('.decision-tree span')).map(span => span.innerText);
        
        const ctx = document.getElementById('decision-tree-chart').getContext('2d');
        
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: decisionTreeData,
                datasets: [{
                    label: 'Keputusan',
                    data: [10, 20, 30, 40], // Ganti dengan data keputusan yang sesuai
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    });
</script>
@endsection
