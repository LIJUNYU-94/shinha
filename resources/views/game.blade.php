<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Brick Game') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="shadow-sm sm:rounded-lg">
                <div class="p-3 text-gray-900 flex flex-col items-center">
                    
                    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
                    <!-- CSRF Token for JS -->
                    <meta name="csrf-token" content="{{ csrf_token() }}">

                    <p class="tboss">boss lp： <span class="bosslp"></span></p>
                    <p class="tpoint">Point now：<span class="point"></span></p>
                    <p class="tlevel">Stage now：<span class="level"></span></p>
                    
                    <canvas id="gameCanvas" width="480" height="320" style="border:1px solid #000;"></canvas>
                    
                    <br>
                    <button id="startButton" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">ゲーム開始</button>
                    
                    <div class="lvl mt-4">
                      <label for="level">レベル選択：</label>
                      <select name="level" id="level" class="border rounded p-1">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <!-- <option value="4">4</option> -->
                      </select>
                    </div>

                    <p class="rule mt-4 text-gray-600">
                      遊び方：<br />
                      移動：← →↑ ↓ <br />またはa(←) d（→）<br />spaceで最初の発射 <br />
                      <br />level4は最終boss登場！
                    </p>

                    <script src="{{ asset('js/game.js') }}" defer></script>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
