@extends('layouts.app')
@section('other_metas')
    <meta name="robots" content="noindex" />
@endsection

@section('page_title')
	{!! trans('titles.exceeded') !!}
@endsection

@section('content')

	<section class="px-2 px-md-0 py-md-7" ya-style="background-color: #464242">
		<img class="background" src="/storage/other/login-bg.jpg" alt="">
		<div class="container">
			<div class="row">
				<div class="col-sm-8 col-md-6 col-lg-6 mx-auto">
					<div class="card mb-0 border-0">
						<div class="card-header">
							<h5 class="card-title"><i class="ya ya-times-circle"></i> {!! trans('titles.exceeded') !!}</h5>
						</div>
						<div class="card-body p-3">
							<p>
								{!! trans('auth.tooManyEmails', ['email' => $email, 'hours' => $hours]) !!}
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
