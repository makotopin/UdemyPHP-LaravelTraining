【12/2】
PHPからLaravelまで サーバーサイドをとことんやってみよう
110.edit 編集画面
リソースコントローラーの表を確認する
- HTTP通信：GET
- URI：/xxx/{id}/edit
- ルート名：xxx.edit

【ルーティング】
showのものをコピーし、'edit'を追加

【コントローラー】
showと同じようにid指定でデータを取得する
```
$contact = ContactForm::find($id);

return view('contact.edit',compact('contact'));
```

【ビュー】
createをコピーする（edit.blade.phpを作成）
h2を「編集画面」に設定。
内容はともかく、これでファイルそのものは作成完了

まずは編集画面に遷移するためのリンクを作成する
show.blade.phpを編集する
下部のボタンを、「新規登録」から「編集する」にする
★showにボタン残ってるのはいいのか？

formタグを消してしまっているので、それを書いてあげる
```
<form method="get" action="{{ route('contact.edit', [ 'id' => @contact->id ])}}"
```

まずはここまでで画面遷移するかどうかを確認する。
大丈夫ならばedit.blade.phpを編集していく。

inputタグにvalueを追加する
```
value="{{ $contacct->name }}"
```
これを他のtitle, email, urlでも同様の処理をする。

textareaの場合はタグ内ではなく開始タグと閉じタグの間に書いてあげる
```
<textarea ...>{{ $contact->contact }}</textarea>
```

「注意事項に同意」はまるごとカットする

性別と年齢に関しては、タグの中にifで判定を入れてあげる。
```
@if($contact->gender === 0) checked @endif
```