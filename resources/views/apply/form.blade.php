@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('apply.store') }}" enctype="multipart/form-data">
    @csrf

    <input type="text" name="first_name" placeholder="Имя" required class="form-control mb-2">
    <input type="text" name="last_name" placeholder="Фамилия" class="form-control mb-2">
    <input type="text" name="birth_year" placeholder="Год рождения" class="form-control mb-2">
    <input type="text" name="phone" placeholder="Телефон" required class="form-control mb-2">
    <input type="email" name="email" placeholder="Email" class="form-control mb-2">
    <input type="text" name="position" placeholder="Должность" class="form-control mb-2">
    <textarea name="experience" placeholder="Опыт работы" class="form-control mb-2"></textarea>
    <textarea name="education" placeholder="Образование" class="form-control mb-2"></textarea>
    <input type="file" name="resume" class="form-control mb-3">
    <button type="submit" class="btn btn-primary">Отправить</button>
</form>
