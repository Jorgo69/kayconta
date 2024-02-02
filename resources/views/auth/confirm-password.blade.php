    <x-guest-layout>
        <main class="main">
            <div class="page-header breadcrumb-wrap">
                <div class="container">
                    <div class="breadcrumb">
                        <a href="{{ route('home.index')}}" rel="nofollow">Accueil</a>                    
                        <span></span> Zone securisée
                    </div>
                </div>
            </div>
            <section class="pt-150 pb-150">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 m-auto">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="login_wrap widget-taber-content p-30 background-white border-radius-10 mb-md-5 mb-lg-0 mb-sm-5">
                                        <div class="padding_eight_all bg-white">
                                            <div class="heading_s1">
                                                <h3 class="mb-30">Confirmer</h3>
                                            </div>
                                            <form method="POST" action="{{ route('password.confirm') }}">
                                                @csrf
                                                    
                                                <div class="form-group">
                                                    <input type="password" name="password" placeholder="Password" required autocomplete="current-password">
                                                </div>
                                                @error('password')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                                
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-fill-out btn-block hover-up">Connexion</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1"></div>
                                <div class="col-lg-6">
                                   <img src="{{ asset('assets/imgs/login.png ') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @push('title')
                    <title> {{__('Connexion').config('app.name') }} </title>
                @endpush
            </section>
        </main>
    </x-guest-layout>
{{-- </x-guest-layout> --}}
