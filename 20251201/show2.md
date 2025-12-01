d【12/1】
# PHPからLaravelまで
## 109. 詳細画面表示②
show.blade.phpを編集していく
データを表示するには{{ }}でデータを囲んであげる必要がある。

inputタグは使わないのでdivタグに変更する
同時に、type, id, nameなどが不要になるのでそれらもカットする。
{{$contact->name}}</div>をラストに追加すればOK
背景色を消すとグレーアウトは無くなって白になる。

性別・年齢・問い合わせ内容などもすべてdivタグに置き換える。

このままだと、データが入っていない「ホームページ」の表示がおかしい＋性別や年齢でオプションの数字が出てきてしまう。
ホームページの部分に関しては、@ifを使用して
```
@if($contact->url)
                                        <div class="block w-full bg-opacity-50 rounded border border-gray-300
                                                focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200
                                                text-base outline-none text-gray-700 py-1 px-3 leading-8
                                                transition-colors duration-200 ease-in-out">{{$contact->url}}</div>
                                        </div>
                                        @else
                                        <div class="block w-full bg-opacity-50 rounded border border-gray-300
                                                focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200
                                                text-base outline-none text-gray-700 py-1 px-3 leading-8
                                                transition-colors duration-200 ease-in-out">未設定</div>
                                        @endif
```で、値の有無を判定する
性別・年齢に関してはコントローラー側で変換して値を送ってくる。

ContactFormController.php
```
public function show($id)
    {
        $contact = ContactForm::find($id);

        if($contact->gender == 0) {
            $gender = '男性';
        } else {
            $gender = '女性';
        }

        if($contact->age == 1){$age = '~19歳';}
        if($contact->age == 2){$age = '20~29歳';}
        if($contact->age == 3){$age = '30~39歳';}
        if($contact->age == 4){$age = '40~49歳';}
        if($contact->age == 5){$age = '50~59歳';}
        if($contact->age == 6){$age = '60歳~';}

        return view('contacts.show', compact('contact', 'gender', 'age'));
    }
```

受け取るフロント側でも新たに追加した変数を指定して表示させる。
