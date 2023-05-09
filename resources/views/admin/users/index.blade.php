@extends('layouts.app')

@section('title', 'Admin Users')

@section('content')
<main class="main">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h6 class="h6 mb-0 text-gray-800">Users</h6>
    </div>

    <div class="animated fadeIn">
        <ul class="nav nav-tabs mb-4" role="tab-list">
            <li class="nav-item">
                <a class="nav-link {{ ($stockist == null) ? 'active' : '' }}" href="{{ route('admin.users.index') }}" style="{{ ($stockist == null) ? 'background-color:#0e4d22; color:#ffffff; border-bottom:1px solid #0e4d22' : 'background-color:rgba(0,0,0,0); color:#0e4d22' }}">All</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ ($stockist == 1) ? 'active' : '' }}" href="{{ route('admin.users.index', ['stockist' => 1]) }}" style="{{ ($stockist == 1) ? 'background-color:#0e4d22; color:#ffffff; border-bottom:1px solid #0e4d22' : 'background-color:rgba(0,0,0,0); color:#0e4d22' }}">Mobile Stockists</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ ($stockist == 2) ? 'active' : '' }}" href="{{ route('admin.users.index', ['stockist' => 2]) }}" style="{{ ($stockist == 2) ? 'background-color:#0e4d22; color:#ffffff; border-bottom:1px solid #0e4d22' : 'background-color:rgba(0,0,0,0); color:#0e4d22' }}">Center Stockists</a>
            </li>
        </ul>

        <div class="d-none" id="stockist">{{ $stockist }}</div>
        <input type="hidden" id="set-stockist-route" value="{{ route('admin.users.setStockist') }}" />

        <div id="users-table-container">
            @include('admin.users.includes.usersTable')
        </div>
    </div>
</main>
@endsection
