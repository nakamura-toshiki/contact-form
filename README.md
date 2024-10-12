# お問い合わせフォーム
## 環境構築
### Dockerビルド
 1.docker-compose up -d --build
### Laravel環境構築
 1.docker-compose exec php bash
 
 2.composer create-project "laravel/laravel=8.*" . --prefer-dist
 
 3.プロジェクト内でconfigフォルダのapp.phpを開き、時間設定
 
 4..envファイルで環境変数を変更
 
 5.php artisan migrate
 
 6.php artisan db:seed
 
 7.php artisan key:generate
## 使用技術
 ・php 7.4.9
 
 ・Laravel 8
 
 ・mysql 8.0.26
## ER図

## URL
 ・開発環境: http://localhost/
 
 ・phpMyAdmin: http://localhost/:8080/
