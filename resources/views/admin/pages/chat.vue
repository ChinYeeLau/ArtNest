@extends('admin.layout.layout')
@section('content')
<template>
    <div>
        <h1>Chat</h1>
        <ul>
            <li v-for="message in messages" :key="message.id">{{ message.text }}</li>
        </ul>
    </div>
</template>
@endsection
