Создание своего драйвера
========================

Для создания драйвера для социальный сети вам необходимо:

1. Создать класс и унаследовать его от `\ymaker\social\share\base\Driver`

```php
use ymaker\social\share\base\Driver;

class LinkedIn extends Driver
{
}
```

2. Реализовать два метода

```php
use ymaker\social\share\base\Driver;

class LinkedIn extends Driver
{
    /**
     * @inheritdoc
     */
    public function getLink()
    {
    }
    
    /**
     * @inheritdoc
     */
    protected function processShareData()
    {
    }
}
```

В методе `getLink()` вам нужно присвоить строку с ссылкой для шаринга в переменную `_link` и вернуть результат родительского метода `getLink()`

```php
/**
 * @inheritdoc
 */
public function getLink()
{
    $this->_link = 'https://www.linkedin.com/shareArticle?mini=true'
                    . '&url={url}'
                    . '&title={title}'
                    . '&summary={description}';
                    
    return parent::getLink();
}
```

В этой строке вы можете использовать четыре ключа: `{url}`, `{title}`, `{description}` и `{imageUrl}`.
В результате эти ключи будут заменены на данные из конфигурации виджета.

Если вам нужно добавить мета-теги на страницу - вы должны добавить эти мета теги в массив `_metaTags`

```php
/**
 * @inheritdoc
 */
public function getLink()
{
    $this->_metaTags = [
        ['property' => 'og:url',         'content' => '{url}'],
        ['property' => 'og:type',        'content' => 'website'],
        ['property' => 'og:title',       'content' => '{title}'],
        ['property' => 'og:description', 'content' => '{description}'],
        ['property' => 'og:image',       'content' => '{imageUrl}'],
    ];
                    
    return parent::getLink();
}
```

Во втором методе вам необходимо обработать данные из конфирурации виджета

```php
/**
 * @inheritdoc
 */
protected function processShareData()
{
    $this->url = static::encodeData($this->url);
    $this->title = static::encodeData($this->title);
    $this->description = static::encodeData($this->description);
}
```

Если данные будут передаватся через URL - вам необходимо их закодировать для корректной работы.
В базовом классе драйвера есть статический метод для этого.

Теперь вы можете использовать ваш драйвер в конфигураторе

```php
'components' => [
    // ...
    'socialShare' => [
        'class' => \ymaker\social\share\configurators\Configurator::class,
        'socialNetworks' => [
            'linkedIn' => [
                'class' => \namespace\of\my\driver\LinkedIn::class,
                'label' => Yii::t('app', 'LinkedIn'),
                'options' => ['class' => 'in'],
            ],
        ],
    ],
],
```