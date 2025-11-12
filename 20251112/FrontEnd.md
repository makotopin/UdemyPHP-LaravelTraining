【11/12】
# PHPからLaravelまで サーバーサイドをとことんやってみよう
## 90. Laravel フロントエンド

フロントエンドとバックエンドはクライアントサイドとサーバーサイドとも言う。
クライアント側はHTML, JavaScript, CSS

クライアント側：見やすい、早い
サーバー側：作りやすい、管理しやすい
というニーズを叶える為にツールが乱立している

フロントエンドの必須ツール
- Node.js
- Webpack
- Vite
- Babel

### コンパイル
HTMLのpug
CSSのBootstrap, tailwind
JavaScripuのReact, Vue
などは、新しい書き方で書くが、古い書き方にコンパイルされる
Babelがこれにあたる

### バンドル
複数ファイルを読み込む時に1つの塊で読み込むことでスピードを上げる技術
- Webpack
- Vite
が有名

Laravelで採用されているのはVite
Viteを利用するにはNode.js/npmが別途インストールが必要
package.jsonがフロントエンド側のcomposer.json。これで管理する。
vite.config.jsで設定したファイルがバンドルの対象になる。