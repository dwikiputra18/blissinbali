@extends('layouts.front')

@section('title', 'Search: "' . $query . '" — Bliss in Bali')

@section('content')
    <x-search-results :query="$query" :packages="$packages" :categories="$categories" />
@endsection