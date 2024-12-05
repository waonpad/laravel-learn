# Laravel 学習用リポジトリ

## セットアップ

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

### composer.jsonに定義したセットアップスクリプトを実行
  
```bash
composer run post-root-package-install && composer run post-create-project-cmd
```

### Git Hooks の設定

```bash
brew install lefthook && lefthook install
```

## サーバーの起動

```bash
composer dev
```
