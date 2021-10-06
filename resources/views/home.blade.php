@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row mt-5">
        <div class="col-12 col-sm-12 col-md-8 col-lg-8 mb-2">
            <h2 class="text">My Dashboard</h2>
            <hr>
        </div>
    </div>
    
    <div class="row mt-3">
        <div class="col-12 col-sm-12 col-md-8 col-lg-8 mb-2">
            <div class="card p-2 border-card">
                <div class="card-body text-center">
                    <img class="rounded-circle text-center" width="120px" src="{{ isset(Auth::user()->social[0]->avatar) ? Auth::user()->social[0]->avatar : 'https://avatars.githubusercontent.com/u/47313528?v=4'}}">
                </div>

                <div class="card-body">
                    <div class="d-flex flex-row justify-content-between">
                        <div class="flex-item">
                            <h4 class="text">{{Auth::user()->name}}</h4>
                        </div>

                        <div class="flex-item">
                            <h5 class="text">Level {{$experience->level}}</h4>
                        </div>
                    </div>

                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="{{$experience->progress}}"
                        aria-valuemin="0" aria-valuemax="100" style="width:{{$experience->progress}}%">
                            <span class="sr-only">{{$experience->progress}}% Complete</span>
                        </div>
                    </div> 

                    <div class="d-flex flex-row justify-content-between mt-2">
                        <div class="flex-item">
                            <h5 class="text">Xp {{$experience->xp}}/{{$experience->limitup}}</h5>
                        </div>
                        <div class="flex-item">
                            <h5 class="text">{{$experience->progress}}%</h5>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="card-body d-flex flex-row justify-content-around">
                    <div class="flex-item text-center">
                        <a href="#" class="text-danger text-center">
                            <i class="fa fa-trash fa-2x"></i> <br>
                            <span class="text">Deletar Conta</span>
                        </a>
                    </div>

                    <div class="flex-item text-center">

                        @if (isset(Auth::user()->social[0]) && Auth::user()->social[0]->social_type == 'github')
                            <a href="{{ url('github/logout') }}" class="text">
                                <i class="fab fa-github fa-2x"></i> 
                                <br>
                                <span class="text">Desconectar</span>
                            </a>
                        @else
                            <a href="{{ url('github/auth') }}" class="text-discord">
                                <i class="fab fa-discord fa-2x"></i> 
                                <br>
                                <span class="text">Conectar com Github</span>
                            </a>
                        @endif
                    </div>

                    <div class="flex-item text-center">

                        @if (isset(Auth::user()->social[1]) && Auth::user()->social[1]->social_type == 'discord')
                            <a href="{{ url('discord/logout') }}" class="text-discord">
                                <i class="fab fa-discord fa-2x"></i> 
                                <br>
                                <span class="text">Desconectar</span>
                            </a>
                        @else
                            <a href="{{ url('discord/auth') }}" class="text-discord">
                                <i class="fab fa-discord fa-2x"></i> 
                                <br>
                                <span class="text">Conectar com Discord</span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-4 col-lg-4 mb-2">
            <div class="card p-2 border-card">
                <h4 class="text-vue mt-3">Ranking</h4>
                <table class="table-sm table table-borderless">
                    <thead>
                        <th>#</th>
                        <th style="text-align: center">#Position</th>
                        <th>#Name</th>
                        <th>#XP</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td><i class="fas fa-trophy trophy-gold"></i></td>
                            <td align="center">1°</td>
                            <td>Well</td>
                            <td>46546</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-trophy trophy-silver"></i></td>
                            <td align="center">2°</td>
                            <td>Leandro</td>
                            <td>41755</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-trophy trophy-bronze"></i></td>
                            <td align="center">3°</td>
                            <td>Lipszera</td>
                            <td>40484</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-medal trophy-gold"></i></td>
                            <td align="center">4°</td>
                            <td>Herick</td>
                            <td>39122</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-medal trophy-gold"></i></td>
                            <td align="center">5°</td>
                            <td>Luiz</td>
                            <td>40484</td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-medal trophy-gold"></i></td>
                            <td align="center">6°</td>
                            <td>João</td>
                            <td>30433</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="card p-2 border-card mt-2">
                <h4 class="text-purple mt-3">Achievements</h4>

                <div class="card-body d-flex flex-row justify-content-around">
                    <div class="flex-item text-center">
                        <i class="fab fa-html5 fa-2x" title="HTML"></i> 
                    </div>
                    <div class="flex-item text-center">
                        <i class="fab fa-css3-alt fa-2x" title="CSS"></i> 
                    </div>
                    <div class="flex-item text-center">
                        <i class="fab fa-js-square fa-2x" title="Javascript"></i> 
                    </div>
                    <div class="flex-item text-center">
                        <i class="fab fa-vuejs fa-2x" title="Javascript"></i> 
                    </div>
                </div>

                <div class="card-body d-flex flex-row justify-content-around">
                    <div class="flex-item text-center">
                        <i class="fab fa-php fa-2x" title="PHP"></i> 
                    </div>
                    <div class="flex-item text-center">
                        <i class="fab fa-laravel fa-2x" title="Laravel"></i> 
                    </div>
                    <div class="flex-item text-center">
                        <i class="fab fa-python fa-2x" title="Python"></i> 
                    </div>
                    <div class="flex-item text-center">
                        <i class="fab fa-react fa-2x" title="React"></i> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
