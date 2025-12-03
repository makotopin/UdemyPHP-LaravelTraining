【12/3】
# PHPからLaravelまで サーバーサイドをとことんやってみよう
## 111. update更新画面
リソースコントローラーでは更新(update)に関しては以下の通り
- HTTP通信：POST（PUT・PUTCHという動詞だが、formタグではPOST）
- URI：/xxx/{id}
- ルート名：xxx.update

手順は同じ
ルーティング→コントローラ記入
ほぼcreateと同じだが、$idを指定するという点が変わる

routes/web.php
```
Route::post('/{id}', 'update')->name('update');
```

ContactFormController.php
```
public function update(Request $request, $id){
	$contact = ContactForm::find($id);
	$contact->name = $request->name;
	$contact->title = $request->title;
	$contact->email = $request->email;
	$contact->url = $request->url;
	$contact->gender = $request->gender;
	$contact->age = $request->age;
	$contact->contact = $request->contact;
	$contact->save();

	return to_route('contacts.index');
}
```

edit.blade.php
```
<form method="post" action="{{ route('contacts.update', ['id' => $contact->id ])}}">...
	@csrf`
```
POSTなのでCSRF対策が必要となる。


