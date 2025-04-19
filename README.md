# Rese
### 概要説明
ある企業のグループ会社の飲食店予約サービス
## 作成した目的
外部の飲食店予約サービスは手数料を取られるので自社で予約サービスを持ちたい。
## アプリケーションURL
・開発環境：http://localhost/  
・phpMyAdmin：http://localhost:8080/  
・本番環境：http://52.199.49.47  
・店舗代表者ログイン：http://localhost/owner/login  
  ※本番環境（localhost->52.199.49.47に変更)  
・管理者ログイン：http://localhost/admin/login  
  ※本番環境（localhost->52.199.49.47に変更)
## 機能一覧
-会員登録  
-ログイン  
-ユーザー情報取得  
-ユーザ―飲食店お気に入り一覧取得  
-ユーザー飲食店予約情報取得  
-飲食店一覧取得  
-飲食店詳細取得  
-飲食店お気に入り追加  
-飲食店お気に入り削除  
-飲食店予約情報追加  
-飲食店予約情報削除  
-エリアで検索する  
-ジャンルで検索する  
-店名で検索する  
-予約を変更する  
-評価機能  
-店舗情報作成  
-店舗情報更新  
-店舗予約情報取得
-店舗代表者作成  
-管理者メール送信  
-リマインダー送信  
-QRコード発行  
-決済機能
## 使用技術
・php 7.4.9  
・Laravel 8  
・mysql 8.0.26  
・nginx 1.21.1  
(本番環境)
AWS　EC2,S3,RDS使用
## テーブル設計
![user](https://github.com/nakamura-toshiki/Rese/blob/main/tables/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88%202025-04-19%20151743.png)
![shop](https://github.com/nakamura-toshiki/Rese/blob/main/tables/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88%202025-04-19%20151804.png)
![area](https://github.com/nakamura-toshiki/Rese/blob/main/tables/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88%202025-04-19%20151835.png)
![category](https://github.com/nakamura-toshiki/Rese/blob/main/tables/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88%202025-04-19%20151856.png)
![like](https://github.com/nakamura-toshiki/Rese/blob/main/tables/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88%202025-04-19%20151919.png)
![reservation](https://github.com/nakamura-toshiki/Rese/blob/main/tables/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88%202025-04-19%20151932.png)
![review](https://github.com/nakamura-toshiki/Rese/blob/main/tables/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88%202025-04-19%20151951.png)
## ER図
![ER図](https://github.com/nakamura-toshiki/Rese/blob/main/.drawio.png)
# 環境構築
## テスト環境
### Dockerビルド
1. git clone git@github.com:nakamura-toshiki/Rese.git  
2. docker-compose up -d --build
### Laravel環境構築
1. docker-compose exec php bash  
2. composer install  
3. cp .env.example .env,環境変数を変更  
``` text
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```
4. php artisan key:generate  
5. php artisan migrate  
6. php artisan db:seed
### メール認証
mailtrapを使用
1. 次のリンクから会員登録　
   https://mailtrap.io/
2. メールボックスのIntegrationsから 「laravel 7.x and 8.x」を選択　
3. .envファイルのMAIL_MAILERからMAIL_ENCRYPTIONまでの項目をコピー＆ペースト　
4. MAIL_FROM_ADDRESSに任意のメールアドレスを設定
## 本番環境
### EC2接続
ssh -i ~/.ssh/Rese-ec2.pem ec2-user@ec2-52-199-49-47.ap-northeast-1.compute.amazonaws.com
### Dockerビルド
1. 
## デフォルトユーザー
管理者  
name: admin  
email: admin@example.com  
pass: admin12345  
店舗代表者
name: owner  
email: owner@example.com  
pass: owner12345  
一般ユーザー
name: user  
email: user@example.com  
pass: user12345  
