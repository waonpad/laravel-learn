# [zircote/swagger-php](https://github.com/zircote/swagger-php)のアプリケーション固有の拡張用ファイルを格納するディレクトリ

## 使用方法

### composer.jsonに設定追加

```json
{
    "autoload": {
        "psr-4": {
            "OpenApi\\": "app/OpenApi/"
        },
    }
}
```

### namespaceを指定して拡張ファイルを作成

```php
<?php

namespace OpenApi\...;
```
