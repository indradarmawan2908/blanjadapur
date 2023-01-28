@extends('base')

@section('main')

<ul class="list-group">
  <li class="list-group-item bg-white mb-3 rounded-0">
  	<h5 class="card-title">{{ Auth::user()->nama }}</h5>
  	<span>{{ Auth::user()->nohp }}</span>
  </li>
  
  <li class="list-group-item bg-white mb-3 rounded-0"><a href="{{ route('member.profil') }}">Profil Anda</a></li>
  <li class="list-group-item bg-white rounded-0"><a href="{{ route('member.toko') }}">Profile Toko</a></li>
  <li class="list-group-item bg-white rounded-0"><a href="newsToko">News</a></li>
  
  <li class="list-group-item bg-white rounded-0">
	<a  href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
	<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
		@csrf
	</form>
  </li>
</ul>

@endsection