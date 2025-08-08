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

//馬_性別カラーコード
$gencolor = [
  '牡' => '#696969',
  '牝' => '#dc143c',
  'ｾﾝ' => '#4682b4',
];
@endphp

<!DOCTYPE html>

    <meta charset="utf-8">
        <!-- 入力画面 -->
        
    <head>
        <title>単勝グラフ</title>
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
                border: 5px solid rgb(215, 255, 252);
            }

            .sidebar-list { /*サイドコンテンツ*/
                width: 300px;
                background-color: white;
                box-sizing: border-box;
                border: 5px solid rgb(215, 255, 252);
            }

            .sidebar-list h1{ 
                display: flex; /*プロパティの一括指定*/
                vertical-align: top;
                height: 0 auto;
                border-left:5px solid #f4b270;
            }

            .saide-btn{ /*レース一覧*/
                /*position: fixed;*/
                flex-grow: 3;
                display: flex; /*プロパティの一括指定*/
                flex-wrap: wrap; /*はみ出たものは下に折り返す*/
                color: white;
            }
            
            .btn{ /* レースボタン */
                display: inline-block;
                opacity: 0.8;
                font-size: 15px;/* ボタン内の文字の大きさ */
                margin: 5px; /* 左右のみ */
                padding: 8px 24px;
                color: white;
                background-color: #55acee;
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

            .flex-list .a6{ /*グラフ*/
                flex: auto;
                flex-direction: row; /* 高さを揃えるための指定 */
                height:auto;

                width: 49%; /*大きさ指定*/
                border: 4px solid #73e773;
                margin: 1px;
            }

            .flex-list .a7{ /*グラフ*/
                flex: auto;
                flex-direction: row; /* 高さを揃えるための指定 */
                height:auto;

                width: 49%; /*大きさ指定*/
                border: 4px solid #f5bc50;
                margin: 1px;
            }

            .flex-list .a8{ /*グラフ*/
                flex: auto;
                flex-direction: row; /* 高さを揃えるための指定 */
                height:auto;

                width: 49%; /*大きさ指定*/
                border: 4px solid #ff89c4;
                margin: 1px;
            }

            .win5{
                display: inline-block;
                opacity: 0.8;
                font-size: 15px;/* ボタン内の文字の大きさ */
                margin: 10px; /* 左右のみ */
                padding: 8px 24px;
                color: white;
                background-color: #55acee;
            }

        </style>
    </head>

    <body>

      
      @if($hondai == null)
        <a href="#" onclick="history.back(-1);return false;">戻る</a>
        <!-- buttonタグ -->
      @elseif ($hondai->RACE_CODE)
        <header class="header"> 
         {{-- モデルからレース名を取得 --}}
          <h1 class="headline">
            <a href="https://db.netkeiba.com/race/{{substr($hondai->RACE_CODE,0,4) . substr($hondai->RACE_CODE,8,8)}}/" target="_blank">{{config('const.keibajo.' .  $hondai->KEIBAJO_CODE)}}{{$hondai->RACE_BANGO}}R</a> {{--インライン要素--}}
              @if($hondai->KYOSOMEI_HONDAI) {{--レース名ある場合--}}
                <a>{{$hondai->KYOSOMEI_HONDAI}}</a> {{--インライン要素--}}
              @endif
          </h1>
           {{-- モデルからレースの詳細を取得 --}}
          <h2 class="corse">
            <a>{{config('const.track.' .  $hondai->TRACK_CODE)}}{{$hondai->KYORI}}m</a>
          </h2>
           {{-- RECE_CODEからレースデータ取得 --}}
          <form action="/chart/race" method="GET" class="form">
            <input type="date" value="{{request()->query('date')}}" name="date"> {{-- 日付 --}}
            @if(!request()->query('id'))
            
            @endif
            <input type="text" value="{{request()->query('id')}}" name="id"> {{-- レースコード --}}
            <input type="submit" class="btn-form btn-primary" value="レース検索">
          </form>
        </header>
  
      
        <div class="main"> {{-- 取得したデータから単勝オッズの時系列グラフを表示 --}}
          @if($flg)
            {{-- 時系列グラフのプロパティ --}}
              <ul class="flex-list">
                @foreach($tansho as $umaban => $odds)
                  <a href="https://db.netkeiba.com/horse/{{$dtuma[$umaban]}}" target="_blank" class="a{{$waku[$umaban]}}" >
                    <canvas id="chart{{$umaban}}"></canvas>
                  </a>
                @endforeach
                @if($umaban % 2 == 1) {{--頭数が奇数の場合の処理--}}
                  <a class="a1" ></a>
                @endif
              </ul>
  
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> {{-- グラフ --}}
  
            <script>
                @foreach($tansho as $umaban => $odds) 
                const ctx{{$umaban}} = document.getElementById('chart{{$umaban}}');
                const chart{{$umaban}} = new Chart(ctx{{$umaban}},  {
                    type: 'line', //折れ線グラフ指定
                    data: {  
                        labels: @json($jihun[$umaban]),// オッズ_発表時分     
                        datasets: [{   
                            label: '{{$umaban}}' + '番 ' + '{{$bamei[$umaban] ?? ''}}' + ' / ' + '{{$seibetsu[$umaban]}}' + ' / ' + '{{$barei[$umaban]}}' + '歳',// 馬番_馬名_性別_馬齢
                            data: @json($tansho[$umaban]),// オッズ_倍率ごとにカラー変更
                            borderWidth: 2,
                            borderColor:'{{$wakucolor[$waku[$umaban]]}}'// 枠番カラー
                        }]     
                    },
                    options: {
                        scales: { //軸設定
                                y: { //y軸設定
                                    suggestedMin: {{$min[$umaban] ?? 0}},
                                    suggestedMax: {{$max[$umaban] ?? 1}},
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
                @endforeach
                
            </script>
          @endif
            <div class="sidebar-list">
              <h1>レース場一覧</h1>
                <div class="saide-btn">
                  @foreach ($result as $value)
                    <a href="/chart/race?id={{$value->RACE_CODE}}&date={{request()->query('date')}}" class=btn>
                      {{config('const.keibajo.' .  $value->KEIBAJO_CODE)}}{{$value->RACE_BANGO}}R
                    </a>
                  @endforeach
                </div>
            </div>
        </div>
      @endif
      <footer>
        <a href="/chart/win5" class="win5">
                    WIN5 過去データ
        </a>
      </footer>
    </body>
</html>

