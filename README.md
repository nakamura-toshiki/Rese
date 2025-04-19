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
# 環境構築
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
