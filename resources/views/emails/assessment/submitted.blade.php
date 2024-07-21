@extends('layouts.email')

@section('title', 'Assessment Submitted')

@section('header', 'Assessment Submission')

@section('content')

    Dear {{ $user->name }},

    I hope this email finds you well.

    I am pleased to inform you that your test scores are now available. Below are your scores for your reference:

    Test: {{ $attempt->assessment->name }}

    Attempt number: {{ $attempt->attempt_number }}

    Date: {{ $attempt->assessment->validity_start_time }}

    Score: {{ $attempt->correctly_answered }}/{{ $attempt->total_number_of_questions }} ({{ $attempt->percentage_score }}%)

    If you have any questions or need further assistance, please don't hesitate to reach out.

    Best regards,
    NCBI Director

@endsection
