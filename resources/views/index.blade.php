<!DOCTYPE html>

    <meta charset="utf-8">
        <!-- 入力画面 -->
        
    <head>
        <title>レース検索</title>
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
                text-align: right;      
                font-size: 30px;
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
                width: 300%;
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
        </style>
        <meta http-equiv="Refresh" content="">{{--自動更新--}}
    </head>

    <body>
     <header>

        {{-- KAISAI_NENGAPPIからレースデータ取得 --}}
        <form action="/chart" method="GET" class="form">
            <input type="date" value="{{request()->query('date')}}" name="date">
            <input type="submit" class="btn-form btn-primary" value="レース検索">
        </form>

    </header>

    
      <div class="main"> {{-- 取得したデータから単勝オッズの時系列グラフを表示 --}}
        <div class="sidebar-list">
        <h1>レース場一覧</h1>
          <div class="saide-btn">

              @if(isset($result))
                @foreach ($result as $value)
                  <a href="/chart/race?id={{$value->RACE_CODE}}&date={{request()->query('date')}}" class=btn>
                    {{config('const.keibajo.' .  $value->KEIBAJO_CODE)}}{{$value->RACE_BANGO}}R
                  </a>
                @endforeach
              @endif
                
                
          </div>
        </div>
      </div>
      <footer>
        <a href="/chart/win5" class="win5">
                    WIN5 過去データ
        </a>
      </footer>
    </body>
</html>
