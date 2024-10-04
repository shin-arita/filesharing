# ファイル共有サービス

## todo
### ログイン
### OAuth2
### 権限（一般ユーザ・グループ管理者・システム管理者）
### 全文検索（名前・説明文）
### 遅延アップロード（API）ウィルスチェック
### メール送信（API）
### アップロードファイル展開パスワード送信
### 二段階認証
### AWS（S3, DB）

## 環境
| 種類          | 説明        | メモ     |
|-------------|-----------|--------|
| 言語          | php(8.2)  |        |
| FrameWork   | Laravel11 |        |
| DataBase    | MySQL     |        |
| ソース管理       | GitHub    | URLを書く |

## Docker コマンド一覧
### 起動
```bash
make up
```
### 終了
```bash
make down
```
### 再起動
```bash
make restart
```
### ログ表示
```bash
make logs
```
### ビルド
```bash
make build
```
### コンテナ状態表示
```bash
make ps
```
### ビルド＆起動
```bash
make start
```

## コンテナ
| コンテナ                       | 名称                 | 搭載ソフトウェア         | bash                                      | メモ |
|----------------------------|--------------------|------------------|-------------------------------------------|----|
| アプリケーションコンテナ(app)          | project-app        | PHP 8.3          | `docker exec -it project-app bash`        |    |
| データベースコンテナ(db)             | project-db         | MariaDB 11.4     | `docker exec -it project-db bash`         |    |
| PhpMyAdminコンテナ(phpmyadmin) | project-phpmyadmin | PhpMyAdmin 5.2.1 | `docker exec -it project-phpmyadmin bash` |    |
| nginxサーバコンテナ(nginx)        | project-nginx      | nginx 1.27.1     | `docker exec -it project-nginx bash`      |    |
| npmコンテナ(npm)               | project-npm        | npm（最新版）         | `docker exec -it project-npm bash`        |    |
| Mailpitコンテナ(mailpit)       | project-mailpit    | Mailpit（最新版）     | `docker exec -it project-mailpit bash`    |    |

## コミット時
コーディング規約チェック  
```
composer sniffer
```
※コーディング規約はPRS-12（phpcs.xmlで定義）  
（同時にModelクラスPHPDocが作成され、PhpUnitが実行される）  

## phpunit
```
php artisan test テストファイル
```
