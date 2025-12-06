【11/26】
# PHPからLaravelまで サーバーサイドをとことんやってみよう
## 104. createフォーム
前回作ったcreate.blade.phpを編集して、フォームの調整をしていく
まずは、セクションタグの中をformタグで囲っておく
追加するフォームは以下
- 氏名
- 件名
- メールアドレス
- ホームページ
- 性別
- 年齢
- お問い合わせ内容
- 注意事項に同意する
bladeファイルの中で、入力欄となっているlabelタグやinputタグと、それを囲っているdivタグを探してコピーで増やす。
ここでは１から作成するのではなく、今あるものをコピーして再利用する。

labelタグのfor, inputタグのname, idの値を揃える
※macであれば、optionを押しながらクリックすることでマルチカーソル機能が使える。

性別に関しては、inputタグのtypeをradioにして、オプションの数だけ並べる。
それに伴って、labelタグのfor, inputタグのid, (css)classは邪魔になってしまうので削除する。
```
<div class="p-2 w-full">
                                        <div class="relative">
                                        <label class="leading-7 text-sm text-gray-600">性別</label><br>
                                        <input type="radio" name="gender" value="0">男性
                                        <input type="radio" name="gender" value="1">女性
                                        <input type="radio" name="gender" value="2">その他
                                        </div>
                                    </div>
```

また、年齢に関してはinputタグを削除し、selectタグを用意。
inputタグの時と同様にlabelタグのfor, inputタグのname, idの値を'age'に変更し、オプションを記入する。
```
<div class="p-2 w-full">
                                        <div class="relative">
                                        <label for="age" class="leading-7 text-sm text-gray-600">年齢</label>
                                        <select name="age" id="age" class="block w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300
                                                focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200
                                                text-base outline-none text-gray-700 py-1 px-3 leading-8
                                                transition-colors duration-200 ease-in-out">
                                                <option value="1">~19歳</option>
                                                <option value="2">20~29歳</option>
                                                <option value="3">30~39歳</option>
                                                <option value="4">40~49歳</option>
                                                <option value="5">50~59歳</option>
                                                <option value="6">60歳~</option>
                                            </select>
                                        </div>
                                    </div>
```

また、注意事項への同意に関しては
labelタグ、inputタグのclassを削除してinputタグのtype-checkboxとする。
```
<div class="p-2 w-full">
                                        <div class="relative">
                                        <input type="checkbox" id="caution" name="caution">注意事項に同意する<br>
                                        </div>
                                    </div>
```

最後にformタグの中を以下のようにする。
```form method="POST" action="">
                            @csrf```なお、まだactionの中身は空でいい。