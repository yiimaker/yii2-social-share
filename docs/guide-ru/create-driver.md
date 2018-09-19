Создание своего драйвера
========================

Для создания драйвера для социальный сети вам необходимо:

1. Создать класс и унаследовать его от `\ymaker\social\share\base\AbstractDriver`

```php
use ymaker\social\share\base\AbstractDriver;

class LinkedIn extends AbstractDriver
{
}
```

2. Реализовать два метода

```php
use ymaker\social\share\base\AbstractDriver;

class LinkedIn extends AbstractDriver
{
        /**
         * {@inheritdoc}
         */
        protected function processShareData()
        {
        }
    
        /**
         * {@inheritdoc}
         */
        protected function buildLink()
        {
        }
}
```

В методе `processShareData()` вам необходимо обработать данные из конфирурации виджета

```php
/**
 * {@inheritdoc}
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

В методе `buildLink()` вам нужно вернуть шаблон ссылки

```php
/**
 * {@inheritdoc}
 */
protected function buildLink()
{
    return 'https://www.linkedin.com/shareArticle?mini=true'
        . '&url={url}'
        . '&title={title}'
        . '&summary={description}'
    ;
}
```

В этой строке вы можете использовать четыре ключа: `{url}`, `{title}`, `{description}` и `{imageUrl}`.
В результате эти ключи будут заменены на данные из конфигурации виджета.

Если вам нужно добавить мета-теги на страницу - вы должны переопределить метод `getMetaTags()`

```php
/**
 * @return array
 */
protected function getMetaTags()
{
    return [
        ['property' => 'og:url',         'content' => '{url}'],
        ['property' => 'og:type',        'content' => 'website'],
        ['property' => 'og:title',       'content' => '{title}'],
        ['property' => 'og:description', 'content' => '{description}'],
        ['property' => 'og:image',       'content' => '{imageUrl}'],
    ];
}
```

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
