<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            編集画面
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <section class="text-gray-600 body-font relative">
                        <form method="POST" action="{{ route('contacts.update', ['id' => $contact->id]) }}">
                            @csrf
                            <div class="container px-5 mx-auto">
                                <div class="lg:w-1/2 md:w-2/3 mx-auto">

                                    @if ($errors->any())
                                        <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded">
                                            <ul class="text-sm text-red-600 space-y-1">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <div class="p-2 w-full">
                                        <div class="relative">
                                        <label for="name" class="leading-7 text-sm text-gray-600">氏名</label>
                                        <input type="text" id="name" name="name" value="{{ old('name', $contact->name) }}"
                                            class="block w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300
                                                focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200
                                                text-base outline-none text-gray-700 py-1 px-3 leading-8
                                                transition-colors duration-200 ease-in-out">
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="p-2 w-full">
                                        <div class="relative">
                                        <label for="title" class="leading-7 text-sm text-gray-600">件名</label>
                                        <input type="text" id="title" name="title" value="{{ old('title', $contact->title) }}"
                                            class="block w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300
                                                focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200
                                                text-base outline-none text-gray-700 py-1 px-3 leading-8
                                                transition-colors duration-200 ease-in-out">
                                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="p-2 w-full">
                                        <div class="relative">
                                        <label for="email" class="leading-7 text-sm text-gray-600">メールアドレス</label>
                                        <input type="email" id="email" name="email" value="{{ old('email', $contact->email) }}"
                                            class="block w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300
                                                focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200
                                                text-base outline-none text-gray-700 py-1 px-3 leading-8
                                                transition-colors duration-200 ease-in-out">
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="p-2 w-full">
                                        <div class="relative">
                                        <label for="url" class="leading-7 text-sm text-gray-600">ホームページ</label>
                                        <input type="url" id="url" name="url" value="{{ old('url', $contact->url) }}"
                                            class="block w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300
                                                focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200
                                                text-base outline-none text-gray-700 py-1 px-3 leading-8
                                                transition-colors duration-200 ease-in-out">
                                        <x-input-error :messages="$errors->get('url')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="p-2 w-full">
                                        <div class="relative">
                                        <label class="leading-7 text-sm text-gray-600">性別</label><br>
                                        <input type="radio" name="gender" value="0" {{ old('gender', $contact->gender) == 0 ? 'checked' : '' }}>男性
                                        <input type="radio" name="gender" value="1" {{ old('gender', $contact->gender) == 1 ? 'checked' : '' }}>女性
                                        <input type="radio" name="gender" value="2" {{ old('gender', $contact->gender) == 2 ? 'checked' : '' }}>その他
                                        <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="p-2 w-full">
                                        <div class="relative">
                                        <label for="age" class="leading-7 text-sm text-gray-600">年齢</label>
                                        <select name="age" id="age" class="block w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300
                                                focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200
                                                text-base outline-none text-gray-700 py-1 px-3 leading-8
                                                transition-colors duration-200 ease-in-out">
                                                <option value="1" {{ old('age', $contact->age) == 1 ? 'selected' : '' }}>~19歳</option>
                                                <option value="2" {{ old('age', $contact->age) == 2 ? 'selected' : '' }}>20~29歳</option>
                                                <option value="3" {{ old('age', $contact->age) == 3 ? 'selected' : '' }}>30~39歳</option>
                                                <option value="4" {{ old('age', $contact->age) == 4 ? 'selected' : '' }}>40~49歳</option>
                                                <option value="5" {{ old('age', $contact->age) == 5 ? 'selected' : '' }}>50~59歳</option>
                                                <option value="6" {{ old('age', $contact->age) == 6 ? 'selected' : '' }}>60歳~</option>
                                            </select>
                                        <x-input-error :messages="$errors->get('age')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="p-2 w-full">
                                        <div class="relative">
                                        <label for="contact" class="leading-7 text-sm text-gray-600">お問い合わせ内容</label>
                                        <textarea id="contact" name="contact"
                                            class="block w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300
                                                focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200
                                                h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6
                                                transition-colors duration-200 ease-in-out">{{ old('contact', $contact->contact) }}</textarea>
                                        <x-input-error :messages="$errors->get('contact')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="p-2 w-full">
                                        <button
                                        class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none
                                                hover:bg-indigo-600 rounded text-lg">Button</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                      </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
