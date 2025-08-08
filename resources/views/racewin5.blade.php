@php
//枠_カラーコード
$wakucolor = [
  '1' => '#dcdcdc',
  '2' => '#000000',
  '3' => '#dc143c',
  '4' => '#0000ff',
  '5' => '#ffff00',
  '6' => '#008000',
  '7' => '#ffa500',
  '8' => '#ff69b4',
];
@endphp

<!DOCTYPE html>
  <meta charset="utf-8"> 
    <head>
        <title>win5グラフ</title>
          <style>
            body, div, dl, dt, dd, ul, ol, li, h1, h2, h3, h4, h5, h6, pre,
            form, fieldset, input, textarea, p, blockquote, th, td {
                margin: 0; 
                padding: 0;
            }

            .header { /*レースタイトル_検索from*/
                text-align: right;
                width: 99%;
                background-color: rgb(255, 255, 255);
                border: 5px solid rgb(215, 255, 252);
            }

            .headline { /*レースタイトル*/             
                font-size: 30px;
                text-align: right;
            }

            .form { 
                text-align: right;
            }

            .btn-form {
                display: inline-block;
                opacity: 0.8;
                font-size: 15px;/* ボタン内の文字の大きさ */
                margin: 5px; /* 左右のみ */
                padding: 8px 24px;
                color: white;
                background-color: #f4b270;
            }

            .main { /* グラフとレース検索欄を囲んでいます。 */
                display: flex;
                flex-direction: row;
                flex-grow: 1;
                width: 99%;
                border: 5px solid rgb(76, 86, 86);
            }



            .flex-list { /*グラフ*/   
                flex-grow: 1;
                display: flex; /*プロパティの一括指定*/
                flex-wrap: wrap; /*はみ出たものは下に折り返す*/
                width: 100%;
                background-color:rgb(255, 255, 255);
            }

            .flex-list .a1{ /*グラフ*/
                flex: auto;
                flex-direction: row; /* 高さを揃えるための指定 */
                height:auto;

                width: 49%; /*大きさ指定*/
                border: 4px solid #b8b4b4;
                margin: 1px;
            }

            .flex-list .a2{ /*グラフ*/
                flex: auto;
                flex-direction: row; /* 高さを揃えるための指定 */
                height:auto;

                width: 49%; /*大きさ指定*/
                border: 4px solid #2e2e2e;
                margin: 1px;
            }

            .flex-list .a3{ /*グラフ*/
                flex: auto;
                flex-direction: row; /* 高さを揃えるための指定 */
                height:auto;

                width: 49%; /*大きさ指定*/
                border: 4px solid #f75d7c;
                margin: 1px;
            }

            .flex-list .a4{ /*グラフ*/
                flex: auto;
                flex-direction: row; /* 高さを揃えるための指定 */
                height:auto;

                width: 49%; /*大きさ指定*/
                border: 4px solid #499deb;
                margin: 1px;
            }

            .flex-list .a5{ /*グラフ*/
                flex: auto;
                flex-direction: row; /* 高さを揃えるための指定 */
                height:auto;

                width: 49%; /*大きさ指定*/
                border: 4px solid #ffff9c;
                margin: 1px;
            }
          </style>
    </head>

    <body>
      <header>
        <h1>過去5年払戻金</h1>
        <form action="/chart" method="GET" class="form">
            <input type="date" value="{{request()->query('date')}}" name="date"> {{--レース名--}}
            <input type="submit" class="btn-form btn-primary" value="WIN5検索"> {{--レース一覧--}}
        </form>

      </header>

  <canvas id="win5"></canvas>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
  
  <script>
  var ctx = document.getElementById("win5");
  var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['2018年12月23日', '2019年12月22日', '2020年12月27日', '2021年12月26日', '2022年12月25日'], // 開催年過去5年  
      datasets: [
        {
          label: '払戻金', 
          data: [0, 15.380, 15.380, 15.380, 15.380], // 払戻金
          backgroundColor: "rgba(219,39,91,0.5)"
        }
      ]
    },
    options: {
      title: {
        display: true,
        text: '有馬記念' + '他' //レース名
      },
      scales: {
        yAxes: [{
          ticks: {
            
            suggestedMin: 0, //最低
            stepSize: 10,
            callback: function(value, index, values){
              return  value
            }
          }
        }]
      },
    }
  });
  </script>
       <!-- <header class="header"> 
         
    
            <input type="submit" class="btn-form btn-primary" value="レース検索">
          </form>
        </header>
       -->
  
      
        <div class="main"> {{-- 取得したデータから結果・払戻のグラフ5年分を表示 --}}
          
            {{-- 結果・払戻グラフのプロパティ --}}
              <ul class="flex-list">
               
                  <a>
                    <canvas id="chart"></canvas>
                  </a>
                
                
              </ul>

            {{-- 対象レースグラフのプロパティ --}}
            <!--   <ul class="flex-list">
                
                  <a >
                    <canvas id="chart/win5"></canvas>
                  </a>
                
               </ul>
            -->

            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/Chart.min.js"></script> {{-- 縦グラフ --}}
  
            <script>
                const ctx = document.getElementById('chart/win5');
                const chart = new Chart(ctx,  {
                    type: 'bar', //縦グラフ指定
                    data: {  
                        labels: 2023,// 開催年  
                        datasets: [{   
                            label: 1// 的中馬番_払戻金_的中票数_馬齢
                            data: 1000//払戻金
                            borderWidth: 2,
                            borderColor:// 枠番カラー
                        }]     
                    },
                    options: {
                        scales: { //軸設定
                                y: { //y軸設定
                                    //suggestedMin: ,
                                    //suggestedMax: ,
                                    beginAtZero: false // グラフ軸の初期化
                                    //display: true, // 表示設定
                                    //labelString: ,
                                    //fontColor: 'blue' // 文字のカラー
                                    //fontSize: , // 文字サイズ
                                    //fontStyle: , // フォント
                                    //max:70, 上限
                                }
                            }
                    }            
                }); // chart_close
                
            </script>
         
            
        </div>
      
    </body>
</html>

