@extends('layouts.app')

@section('title', 'Settings')

@section('body-class', 'settings')

@section('content')
<h1>Settings</h1>
<hr>
<form action="{{ url('settings') }}" method="POST">
	{{ csrf_field() }}
	<div class="form-group">
		<label for="app_name">Application Name<em>*</em></label>
		<input type="text" name="app_name" id="app_name" class="form-control" autofocus placeholder="Enter your application name" value="">
	</div>
	<div class="form-group">
		<label for="slack_hook">Slack Hook</label>
		<input type="text" name="slack_hook" id="slack_hook" class="form-control" placeholder="Enter your Slack Hook" value="{{ \Auth::user()->slack_webhook_url }}">
		<p class="help-block">Enter your slack hook above to integrate slack notification</p>
	</div>
	<div class="form-group">
		<button class="btn btn-primary" type="submit">
			Update Settings
		</button>
	</div>
</form>
@endsection
