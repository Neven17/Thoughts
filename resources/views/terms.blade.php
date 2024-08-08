@extends('layout.layout')

@section('title', 'Terms')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-4 col-12">
            @include('shared.left-sidebar')
        </div>
        <div class="col-lg-6 col-md-8 col-12">
            <h1 class="my-4">{{ __('terms.terms')}}</h1>
            <div class="terms-content">
                <p>{{ __('terms.welcome_to_thoughts')}}</p>
                <h3>{{ __('terms.history_of_thoughts')}}</h3>
                <p>{{ __('terms.founded_in_2023')}}</p>
                <h3>{{ __('terms.terms_of_use')}}</h3>
                <h4>{{ __('terms.posting_content')}}</h4>
                <p>{{ __('terms.users_can_post_content')}}</p>
                <h4>{{ __('terms.commenting')}}</h4>
                <p>{{ __('terms.comments_are_welcome')}}</p>
                <h4>{{ __('terms.liking_and_following')}}</h4>
                <p>{{ __('terms.users_can_like_and_follow')}}</p>
                <h4>{{ __('terms.blocking')}}</h4>
                <p>{{ __('terms.users_can_block')}}</p>
                <h4>{{ __('terms.privacy_policy')}}</h4>
                <p>{{ __('terms.your_privacy_is_important')}}</p>
                <h4>{{ __('terms.account_rules')}}</h4>
                <p>{{ __('terms.we_reserve_the_right')}}</p>
                <h3>{{ __('terms.contact')}}</h3>
                <p>{{ __('terms.if_you_have_any_questions')}}</p>
                <p>{{ __('terms.thank_you_for_being_a_part')}}</p>
            </div>
        </div>
        <div class="col-lg-3 col-md-12 col-12">
            @include('shared.follow-box')
        </div>
    </div>
@endsection
