@extends('layouts.sidebar')

@section('content')
    @include('layouts.errors')
    <main class="flex flex-col space-y-10 items-start justify-center py-10 pl-1 bg-gray">
        <div class="ml-0px text-card-foreground w-full max-w-lg bg-gray-100 border-gray-300 border rounded-lg shadow-lg"
             data-v0-t="card" style="margin-top: -30px" data-v0-t="card">
            <form action="{{ route('profile.update',auth()->user()->getAuthIdentifier())}}" method="post"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="p-6 space-y-4">
                    <!-- Заголовок и изображение профиля -->
                    <header class="flex flex-col items-start space-y-2">
                        <div class="space-y-2">
                            <label for="profile-pic"
                                   class="rounded-full bg-white border-2 border-gray-300 block cursor-pointer"
                                   id="profile-pic-label"></label>
                            <input
                                name="main_image"
                                class="h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 hidden"
                                id="profile-pic"
                                aria-label="Upload profile picture"
                                type="file"
                                onchange="displayImage(this)"
                            />
                        </div>
                        <h1 class="text-2xl font-bold text-gray-800">{{ auth()->user()->name }}</h1>
                    </header>

                    <!-- Поля формы для обновления профиля -->
                    <div class="space-y-2">
                        <label for="name"
                               class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-gray-800">Имя</label>
                        <input value="{{ auth()->user()->name }}"
                               class="flex h-10 w-full rounded-md border bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 border-gray-300"
                               id="name"
                               name="name"
                               placeholder="Введите имя"
                        />
                    </div>

                    <div class="space-y-2">
                        <label for="surname"
                               class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-gray-800">Фамилия</label>
                        <input value="{{ auth()->user()->surname }}"
                               class="flex h-10 w-full rounded-md border bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 border-gray-300"
                               id="surname"
                               name="surname"
                               placeholder="Введите фамилию"
                        />
                    </div>

                    <div class="space-y-2">
                        <label for="city"
                               class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-gray-800">Город</label>
                        <input value="{{ auth()->user()->city }}"
                               class="flex h-10 w-full rounded-md border bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 border-gray-300"
                               id="city"
                               name="city"
                               placeholder="Введите город"
                        />
                    </div>

                    <div class="space-y-2">
                        <label for="email"
                               class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-gray-800">Email</label>
                        <input value="{{ auth()->user()->email }}"
                               class="flex h-10 w-full rounded-md border bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 border-gray-300"
                               id="email"
                               name="email"
                               placeholder="Введите email"
                               type="email"
                        />
                    </div>

                    <div class="space-y-2">
                        <label for="phone_number"
                               class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 text-gray-800">Номер телефона</label>
                        <input value="{{ auth()->user()->phone_number }}"
                               class="flex h-10 w-full rounded-md border bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 border-gray-300"
                               id="phone_number"
                               name="phone_number"
                               placeholder="Введите номер телефона"
                        />
                    </div>
                    <div class="flex items-center p-6">
                        <button type="submit"
                                class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-primary/90 h-10 px-4 py-2 ml-auto bg-gray-800 text-white">
                            Сохранить
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection

<script>
    function displayImage(input) {
        var label = document.getElementById('profile-pic-label');
        var file = input.files[0];

        if (file) {
            var reader = new FileReader();

            reader.onload = function (e) {
                label.style.backgroundImage = 'url(' + e.target.result + ')';
            };

            reader.readAsDataURL(file);
        } else {
            label.style.backgroundImage = 'none';
        }
    }
</script>

<style>
    .rounded-full {
        width: 100px;
        height: 100px;
        background-size: cover;
        background-position: center;
        border-radius: 50%;
    }
</style>
