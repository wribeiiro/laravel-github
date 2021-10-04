@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <div class="card p-2">
                <div class="card-body text-center">
                    <img class="rounded-circle text-center" width="120px" src="{{Auth::user()->social[0]->avatar}}">
                </div>

                <div class="card-body">
                    <div class="d-flex flex-row justify-content-between">
                        <div class="flex-item">
                            <h4 class="text">{{Auth::user()->name}}</h4>
                        </div>

                        <div class="flex-item">
                            <h4 class="text">Level 4</h4>
                        </div>
                    </div>

                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="70"
                        aria-valuemin="0" aria-valuemax="100" style="width:70%">
                            <span class="sr-only">70% Complete</span>
                        </div>
                    </div> 

                    <div class="d-flex flex-row justify-content-between mt-2">
                        <div class="flex-item">
                            <h4 class="text">Xp 161/300</h4>
                        </div>
                        <div class="flex-item">
                            <h4 class="text">53%</h4>
                        </div>
                    </div>
                </div>

                <div class="card-body d-flex flex-row justify-content-around">
                    <div class="flex-item text-center">
                        <a href="#" class="text-danger text-center">
                            <i class="fa fa-trash fa-2x"></i> <br>
                            <span class="text">Deletar Conta</span>
                        </a>
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

        <div class="col-4">
            <div class="card p-2">
                <h4 class="text-vue">Ranking</h4>
                <table class="table-sm table table-borderless">
                    <thead>
                        <th>#Position</th>
                        <th>#Name</th>
                        <th>#XP</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1° <i class="fas fa-trophy"></i></td>
                            <td>Well</td>
                            <td>46546</td>
                        </tr>
                        <tr>
                            <td>2° <i class="fas fa-trophy"></i></td>
                            <td>Leandro</td>
                            <td>41755</td>
                        </tr>
                        <tr>
                            <td>3° <i class="fas fa-trophy"></i></td>
                            <td>Lipszera</td>
                            <td>40484</td>
                        </tr>
                        <tr>
                            <td>4°</td>
                            <td>Herick</td>
                            <td>39122</td>
                        </tr>
                        <tr>
                            <td>5°</td>
                            <td>Luiz</td>
                            <td>40484</td>
                        </tr>
                        <tr>
                            <td>6°</td>
                            <td>João</td>
                            <td>30433</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
