【12/4】
PHPからLaravelまで サーバーサイドをとことんやってみよう
112.destroy
リソースコントローラ(php artisan make:controller ContactFromController --resource)で確認
- HTTP：DELETE
- URI：/xxx/{id}
- ルート名：xxx.destroy
フォームタグで使用する際にはGET, POSTしか使えないので、URIがバッティングしないようにルート名を変更する。
Ajax通信について

web.php
```
Route::post('/{id}/destroy', 'destroy')->name('destroy');
```

ContactFormController.php::destroy($id)
```
$contact = ContactForm::find($id);
$contact->delete();

return to_route('contacts.index')
```
ただ、これだけだと一発で消えてしまう。
確認画面をフロント側で実装する。

show.blade.php
ページ下部の編集ボタンをコピーして削除ボタンに書き換える。
メソッドをpostに、ルーティングをdestroyに、CSRFを追加、「編集」から「削除」に、ボタンの色を変更、マージンをつける。
```
<form class="mt-40" method=post action="{{ route('contacts.destroy', [ 'id' => $contact->id]) }}"

<a ... bg-pink-xxx>
```

さらに、確認画面を表示するためにidをフォームに振ってあげる
このidを利用して、javascriptにて確認画面を用意する。
まずはidを振る
```
<form class="mt-40" method=post action="{{ route('contacts.destroy', [ 'id' => $contact->id]) id="delete_{{contact_id}}" }}"
```
続いて、aタグクリック時にJavascriptを動かすコードを追記
```
<a href="#" data-id="{{ $contact->id }}" onclick="deletePost(this)">
```
クリックした時に、deletePost(this)が動くように、その処理を下部に書いていく。
なお、(this)はこのaタグの情報を投げるという意味。
"x-app-layout"タグの閉じタグの直前にscriptタグを用意。
```
<!-- 確認メッセージ -->
<script>
function deletePost(e){
	'use strict'
	if(confirm('本当に削除していいですか？')){
		document.getElementByID('delete_' + e.dataset.id).submit()
	}
}
</script>
```