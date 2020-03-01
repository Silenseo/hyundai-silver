
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
</head>

<body>
    <div>На сайте hyundai.ru оставлен запрос на проведение мероприятия в Motorstudio</div>

    <div>Название мероприятия: {{ $data->title }}</div>
    <div>Описание мероприятия: {{ $data->description }}</div>
    <div>Дата проведения: {{ $data->date }}</div>
    <div>Время проведения: {{ $data->time }}</div>
    <div>Примерное количество участников: {{ $data->members }}</div>
    <div>Портрет гостя: {{ $data->guests }}</div>
    <div>Кейтеринг: {{ $data->catering }}</div>
    <div>ФИО организатора: {{ $data->fio }}</div>
    <div>E-Mail организатора: {{ $data->email }}</div>
    <div>Телефон организатора: {{ $data->tel }}</div>
    <div>Об организаторе: {{ $data->about }}</div>
    <div>Файл с таймингом: <a href="https://www.hyundai.ru/storage/{{ $data->file }}">Скачать</a></div>
</body>

</html>
