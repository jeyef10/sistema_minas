@extends('errors::minimal')

@section('title', __('Prohibido'))
@section('code', '403')
{{-- @section('message', __($exception->getMessage() ?: 'Prohibido'))--}}
@section('message', 'EL USUARIO NO TIENE LOS PERMISOS CORRECTOS.')
