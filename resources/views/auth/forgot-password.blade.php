<x-guest-layout>
    

    {{-- <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form> --}}

    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('login')}}" rel="nofollow">Connexion</a>                    
                    <a class="text-dark" href="{{ route('register')}}"><span></span> Inscription </a>
                    <span></span> Reintialiser
                </div>
            </div>
        </div>
        <section class="pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <div class="mb-4 text-sm text-center text-gray-600">
                        {{ __('Mot de passe oublié? Pas de problème. Une fois que vous connaissez votre Email nous allons vous envoyer un mail de reintialisation de Mot de passe.') }}
                    </div>
                    <div class="col-lg-10 m-auto">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="login_wrap widget-taber-content p-30 background-white border-radius-10 mb-md-5 mb-lg-0 mb-sm-5">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h3 class="mb-30">Reintialisation</h3>
                                        </div>
                                        <form method="POST" action="{{  route('password.email') }}">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" required="" name="email" placeholder="Email" value="{{old('email')}}" required autofocus>
                                            </div>
                                            @error('email')
                                                <div class="alert alert-danger text-center">{{ $message }}</div>
                                            @enderror
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-fill-out btn-block hover-up">Envoyez</button>
                                            </div>
                                        </form>
                                        <div class="text-muted text-center">Pas de compte? <a href="{{ route('register')}}">Creez-en </a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1"></div>
                            <div class="col-lg-6">
                               <img src="{{asset('assets/imgs/login.png')}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @push('title')
                <title> {{__('Reintialisation').config('app.name') }} </title>
            @endpush
        </section>
    </main>
</x-guest-layout>
