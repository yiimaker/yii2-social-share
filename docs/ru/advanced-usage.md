Продвинутое использование
=========================
> Так же читайте [cоветы и фичи](tips-and-tricks.md).

Конфигуратор
------------

#### 1) Опции для настройки

| Опция | Описаник | Тип данных | Стандартное значение |
|----|----|----|----|
|socialNetworks|Массив с настройками драйверов социальных сетей|array|-|
|options|HTML опции для ссылки|array|-|
|enableSeoOptions|Вкл/выкл добавление SEO опций для ссылки|bool|true|
|seoOptions|SEO опции для ссылки|`['target' => '_blank', 'rel' => 'nofollow']`|
|enableDefaultIcons|Вкл/выкл использование иконок вместо текстовых лэйблов|bool|false|
|icons|Ассоциативный массив с именем класса драйвера и селектором иконки|array|Используется стандартный набор иконок|

#### 2) Создание своего конфигуратора

Если вы хотите создать свой конфигуратор - вам нужно:
1. Создать класс и унаследовать его от `\yii\base\Object` или `\yii\base\Component`
2. Реализовать методы [ConfiguratorInterface](https://github.com/yiimaker/yii2-social-share/blob/master/src/configurators/ConfiguratorInterface.php) интерфейса
3. Прописать реальзацию этих методов

Виджет
------

#### 1) Опции для настройки

| Опция | Описаник | Тип данных | Стандартное значение |
|----|----|----|----|
|configuratorId|ID конфигуратора из конфигурации приложения|string|-|
|url|Абсолютная ссылка к странице|string|Результат работы `Url::to('', true)`|
|title|Заголовок страницы|string|-|
|description|Описание страницы|string|-|
|imageUrl|Абсолютная ссылка к изображению для страницы|string|-|
|wrapperTag|Имя HTML тега для обёртки всех ссылок|string|ul|
|wrapperOptions|HTML опции для тега-обёртки|array|`['class' => 'social-share']`|
|linkWrapperTag|Имя HTML тега для обёртки одной ссылки|bool/string|li|
|linkWrapperOptions|HTML опции для тега-обёртки ссылки|array|-|

Драйвера социальных сетей
-------------------------

#### 1) Опции для настройки

| Опция | Описаник | Тип данных | Стандартное значение |
|----|----|----|----|
|class|Полное имя класса драйвера|string|-|
|label|Лэйбл который будет отображатся в ссылке|string|В качестве лэйбла будет использоватся ключ массива с конфигурацией для этого драйвера|
|options|HTML опции для ссылки. Если конфигуратор в настройках HTML содержит CSS классы, классы из этого массива будут прикреплены к классам из конфигуратора.|array|-|
|config|Массив с конфирурацией дополнитеьных полей в классе драйвера (если драйвер содержит эти поля)|array|-|

#### 2) Создание собственного драйвера

Для создания драйвера для социальный сети вам неоьходимо:

1. Создать класс и унаследоваь его от `\ymaker\social\share\base\Driver`
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

В методе `getLink()` вам нужно присвоить строку с ссылкой для шаринга в переменную `_link` и вернуть результат работы родительского метода `getLink()`

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

В этой строке вы можете использовать четыре ключа - `{url}`, `{title}`, `{description}` и `{imageUrl}`.
В результате эти ключи будут заменены на данные из конфигурации виджета.

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