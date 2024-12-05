# Laravel 学習用リポジトリ

## セットアップ

### .env ファイルの作成

```bash
cp -n .env.example .env
```

### PHP のインストール

[shivammathur/homebrew-php: :beer: Homebrew tap for PHP 5.6 to 8.4. PHP 8.4 is built nightly.](https://github.com/shivammathur/homebrew-php)

```bash
brew install shivammathur/php/php@8.3
```

#### グローバルで使用される PHP のバージョンを設定

```bash
brew link --force --overwrite shivammathur/php/php@8.3
```

### Composer のインストール

```bash
brew install composer
```

### パッケージのインストール

```bash
composer install
```

### キーの生成

```bash
php artisan key:generate
```

### データベースマイグレーション
  
```bash
php artisan migrate
```

## サーバーの起動

```bash
php artisan serve
```
