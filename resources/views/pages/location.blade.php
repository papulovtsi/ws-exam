@extends('app')

@section('title', 'Где нас найти?')

@section('content')
    <div class="d-flex flex-column gap-4">
        <div class="card">
            <div class="card-header">
                Наш телефон
            </div>
            <div class="card-body word">
                <blockquote class="blockquote mb-0">
                    <a href="tel:79876543210">+79876543210</a>
                </blockquote>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Наш адрес
            </div>
            <div class="card-body word">
                <blockquote class="blockquote mb-0">
                    <p>г. Курган, ул. Подбельского, 27а</p>
                </blockquote>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Email
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0 word">
                    <a href="mailto:copystar@mail.ru">CopyStar@mail.ru</a>
                </blockquote>
            </div>
        </div>
        <div class="card map">
            <div class="card-header">
                Где нас найти
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <img src="/media/images/map.jpg" alt="">
                </blockquote>
            </div>
        </div>
    </div>
@endsection
